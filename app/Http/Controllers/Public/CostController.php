<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\CostDocument;
use App\Models\ServiceFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CostController extends Controller
{
    public function index(Request $request)
    {
        $costDocument = CostDocument::query()
            ->active()
            ->whereNotNull('file_path')
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->first();
        $search = trim((string) $request->query('q'));
        $baseQuery = ServiceFee::query();

        $fees = (clone $baseQuery)
            ->orderBy('category')
            ->orderBy('service_name')
            ->get()
            ->map(fn (ServiceFee $fee) => [
                'category' => $fee->category,
                'service_name' => $fee->service_name,
                'unit' => $fee->unit,
                'price' => $fee->price,
                'formatted_price' => $fee->formattedPrice(),
                'regulation_reference' => $fee->regulation_reference,
                'search' => Str::lower(implode(' ', array_filter([
                    $fee->category,
                    $fee->service_name,
                    $fee->unit,
                    $fee->formattedPrice(),
                    $fee->regulation_reference,
                ]))),
            ]);

        return view('public.cost.index', [
            'costDocument' => $costDocument,
            'fees' => $fees,
            'search' => $search,
        ]);
    }

    public function pdf(CostDocument $costDocument): BinaryFileResponse
    {
        abort_unless($costDocument->is_active, 404);
        abort_unless($costDocument->isSafeLocalPdfPath(), 404);
        abort_unless(Storage::disk('local')->exists($costDocument->file_path), 404);
        abort_unless(Storage::disk('local')->mimeType($costDocument->file_path) === CostDocument::PDF_MIME_TYPE, 404);

        $fileName = (Str::slug($costDocument->title) ?: 'biaya-layanan').'.pdf';

        return response()->file($costDocument->localFilePath(), [
            'Content-Disposition' => 'inline; filename="'.$fileName.'"',
            'Content-Type' => CostDocument::PDF_MIME_TYPE,
            'X-Content-Type-Options' => 'nosniff',
            'Cache-Control' => 'private, max-age=3600',
        ]);
    }
}
