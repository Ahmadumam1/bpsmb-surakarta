<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\AccreditationScope;
use App\Models\CalibrationScope;
use App\Models\ProductCertificationInfo;
use App\Models\SampleCollectionFee;
use App\Models\Service;
use App\Models\TestingDuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ServiceController extends Controller
{
    public function index()
    {
        return view('public.services.index', [
            'services' => Service::query()->active()->orderBy('name')->get(),
        ]);
    }

    public function show(Service $service)
    {
        abort_unless($service->is_active, 404);

        $service->load(['documents' => fn ($query) => $query->active()->orderBy('title')]);

        return view('public.services.generic.show', compact('service'));
    }

    public function productCertification()
    {
        $certificationMenus = ProductCertificationInfo::query()
            ->orderBy('scheme')
            ->orderBy('category')
            ->orderBy('product_type')
            ->orderBy('id')
            ->get();

        return view('public.services.product-certification.index', compact('certificationMenus'));
    }

    public function openProductCertificationInfo(ProductCertificationInfo $productCertificationInfo): BinaryFileResponse
    {
        abort_unless($productCertificationInfo->isSafeLocalDocumentPath(), 404);
        abort_unless(Storage::disk('local')->exists($productCertificationInfo->file_path), 404);

        $mimeType = Storage::disk('local')->mimeType($productCertificationInfo->file_path);

        abort_unless(in_array($mimeType, ProductCertificationInfo::ALLOWED_MIME_TYPES, true), 404);

        $extension = $productCertificationInfo->fileExtension();
        $fileName = (Str::slug($productCertificationInfo->product_type) ?: 'informasi-sertifikasi-produk').".{$extension}";

        return response()->file($productCertificationInfo->localFilePath(), [
            'Content-Disposition' => 'inline; filename="'.$fileName.'"',
            'Content-Type' => $mimeType,
            'X-Content-Type-Options' => 'nosniff',
            'Cache-Control' => 'private, max-age=3600',
        ]);
    }

    public function testingDuration(Request $request)
    {
        $search = trim((string) $request->query('q'));
        $selectedCategory = (string) $request->query('category');
        $baseQuery = TestingDuration::query();
        $categories = (clone $baseQuery)->orderBy('category')->pluck('category')->unique()->values();
        $testingDurations = (clone $baseQuery)
            ->orderBy('category')
            ->orderBy('name')
            ->get()
            ->map(fn (TestingDuration $duration) => [
                'name' => $duration->name,
                'category' => $duration->category,
                'duration' => $duration->duration,
                'search' => Str::lower(implode(' ', array_filter([
                    $duration->name,
                    $duration->category,
                    $duration->duration,
                    'hari kerja',
                ]))),
            ]);

        return view('public.services.testing.duration', [
            'testingDurations' => $testingDurations,
            'categories' => $categories,
            'fastestDuration' => (clone $baseQuery)->min('duration') ?? 0,
            'longestDuration' => (clone $baseQuery)->max('duration') ?? 0,
            'search' => $search,
            'selectedCategory' => $selectedCategory,
        ]);
    }

    public function testingAccreditationScope(Request $request)
    {
        $search = trim((string) $request->query('q'));
        $baseQuery = AccreditationScope::query();
        $scopes = (clone $baseQuery)
            ->orderBy('id')
            ->get()
            ->map(fn (AccreditationScope $scope) => [
                'commodity_type' => $scope->commodity_type,
                'reference' => $scope->reference,
                'search' => Str::lower(implode(' ', array_filter([
                    $scope->commodity_type,
                    $scope->reference,
                ]))),
            ]);

        return view('public.services.testing.accreditation-scope', [
            'scopes' => $scopes,
            'totalScopes' => (clone $baseQuery)->count(),
            'search' => $search,
        ]);
    }

    public function sampleCollection(Request $request)
    {
        $search = trim((string) $request->query('q'));
        $baseQuery = SampleCollectionFee::query();
        $fees = (clone $baseQuery)
            ->orderBy('description')
            ->get()
            ->map(fn (SampleCollectionFee $fee) => [
                'description' => $fee->description,
                'sample_count' => $fee->sample_count,
                'sample_label' => $fee->formattedSample(),
                'fee' => $fee->fee,
                'formatted_fee' => $fee->formattedFee(),
                'search' => Str::lower(implode(' ', array_filter([
                    $fee->description,
                    $fee->formattedSample(),
                    $fee->formattedFee(),
                ]))),
            ]);

        return view('public.services.sample-collection.index', [
            'fees' => $fees,
            'search' => $search,
            'totalFees' => $fees->count(),
        ]);
    }

    public function calibration()
    {
        $calibrationScopes = CalibrationScope::query()
            ->orderBy('category')
            ->orderBy('id')
            ->get()
            ->groupBy('category')
            ->values()
            ->map(fn ($items, int $index) => [
                'number' => $index + 1,
                'category' => $items->first()->category,
                'items' => $items->pluck('item')->all(),
            ]);

        return view('public.services.calibration.index', compact('calibrationScopes'));
    }
}
