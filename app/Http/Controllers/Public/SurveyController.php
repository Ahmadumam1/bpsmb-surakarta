<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class SurveyController extends Controller
{
    public function index()
    {
        $surveys = Survey::query()
            ->active()
            ->whereNotNull('file_path')
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        return view('public.surveys.index', compact('surveys'));
    }

    public function open(Survey $survey): BinaryFileResponse
    {
        abort_unless($survey->is_active, 404);
        abort_unless($survey->isSafeLocalDocumentPath(), 404);
        abort_unless(Storage::disk('local')->exists($survey->file_path), 404);

        $mimeType = Storage::disk('local')->mimeType($survey->file_path);

        abort_unless(in_array($mimeType, Survey::ALLOWED_MIME_TYPES, true), 404);

        $extension = $survey->fileExtension();
        $fileName = (Str::slug($survey->title) ?: 'survei-kepuasan-pelanggan').".{$extension}";

        return response()->file($survey->localFilePath(), [
            'Content-Disposition' => 'inline; filename="'.$fileName.'"',
            'Content-Type' => $mimeType,
            'X-Content-Type-Options' => 'nosniff',
            'Cache-Control' => 'private, max-age=3600',
        ]);
    }
}
