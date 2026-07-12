<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $documents = Document::query()
            ->with('service')
            ->active()
            ->when($request->service, fn ($query, string $slug) => $query->whereHas('service', fn ($query) => $query->where('slug', $slug)))
            ->orderBy('sort_order')
            ->orderBy('title')
            ->paginate(4)
            ->withQueryString();

        return view('public.downloads.index', [
            'documents' => $documents,
            'services' => Service::query()->active()->orderBy('name')->get(),
            'selectedService' => $request->service,
        ]);
    }

    public function download(Document $document): BinaryFileResponse
    {
        abort_unless($document->is_active, 404);
        abort_if(Str::contains($document->file_path, ['..', '\\', "\0"]), 404);

        foreach (['public', 'local'] as $disk) {
            if (Storage::disk($disk)->exists($document->file_path)) {
                $extension = Str::lower(pathinfo($document->file_path, PATHINFO_EXTENSION));
                $fileName = (Str::slug($document->title) ?: 'dokumen').($extension ? ".{$extension}" : '');

                return response()->file(Storage::disk($disk)->path($document->file_path), [
                    'Content-Disposition' => 'inline; filename="'.$fileName.'"',
                    'X-Content-Type-Options' => 'nosniff',
                ]);
            }
        }

        abort(404);
    }
}
