<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    private const TRACKING_TTL_SECONDS = 30 * 60;

    public function handle(Request $request, Closure $next): Response
    {
        if ($this->shouldTrack($request)) {
            $this->track($request);
            $this->trackPageView($request);
        }

        return $next($request);
    }

    private function shouldTrack(Request $request): bool
    {
        if (! $request->isMethod('GET')) {
            return false;
        }

        if ($request->ajax() || $request->expectsJson() || $request->isPrecognitive()) {
            return false;
        }

        if ($request->routeIs(
            'filament.*',
            'cost.pdf',
            'documents.download',
            'services.product-certification.info.open',
            'surveys.open'
        )) {
            return false;
        }

        return ! $request->is(
            'admin',
            'admin/*',
            'filament/*',
            'livewire/*',
            'api/*',
            'assets/*',
            'build/*',
            'css/*',
            'js/*',
            'images/*',
            'storage/*',
            'favicon.ico',
            'robots.txt',
            'up'
        );
    }

    private function track(Request $request): void
    {
        $sessionId = $request->hasSession()
            ? $request->session()->getId()
            : Str::random(40);

        $cacheKey = 'visitor-tracked:'.sha1($sessionId);

        if (! Cache::add($cacheKey, true, self::TRACKING_TTL_SECONDS)) {
            return;
        }

        $now = now();

        try {
            DB::table('visitor_stats')->upsert(
                [[
                    'date' => $now->toDateString(),
                    'total_views' => 1,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]],
                ['date'],
                [
                    'total_views' => DB::raw('total_views + 1'),
                    'updated_at' => $now,
                ]
            );
        } catch (QueryException) {
            Cache::forget($cacheKey);
        }
    }

    private function trackPageView(Request $request): void
    {
        try {
            $path = '/' . trim($request->path(), '/');
            $now = now();

            $title = $this->determinePageTitle($request, $path);

            DB::table('page_views')->upsert(
                [[
                    'path' => $path,
                    'title' => $title,
                    'views' => 1,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]],
                ['path'],
                [
                    'views' => DB::raw('views + 1'),
                    'title' => $title,
                    'updated_at' => $now,
                ]
            );
        } catch (\Throwable $e) {
            // Silently ignore to not disrupt visitors
        }
    }

    private function determinePageTitle(Request $request, string $path): string
    {
        if ($path === '/') {
            return 'Beranda';
        }

        $route = $request->route();
        if ($route) {
            $routeName = $route->getName();
            if ($routeName) {
                switch ($routeName) {
                    case 'cost':
                        return 'Tarif & Maklumat Pelayanan';
                    case 'lph':
                        return 'Layanan Lembaga Pemeriksa Halal';
                    case 'documents.index':
                        return 'Unduh Dokumen';
                    case 'complaints.create':
                        return 'Pengaduan Layanan';
                    case 'surveys.index':
                        return 'Survei Kepuasan Masyarakat';
                    case 'contact':
                        return 'Kontak Kami';
                    case 'media.news.index':
                        return 'Berita';
                    case 'media.photo.index':
                        return 'Galeri Foto';
                    case 'media.video.index':
                        return 'Galeri Video';
                    case 'services.index':
                        return 'Layanan Laboratorium Pengujian';
                    case 'services.calibration':
                        return 'Layanan Laboratorium Kalibrasi';
                    case 'services.product-certification':
                        return 'Layanan Sertifikasi Produk';
                    case 'services.testing-duration':
                        return 'Layanan Lama Pengujian';
                    case 'services.testing-accreditation-scope':
                        return 'Layanan Ruang Lingkup Akreditasi';
                }
            }

            if ($route->parameter('news')) {
                $news = $route->parameter('news');
                if (is_object($news)) {
                    return 'Berita: ' . $news->title;
                }
                if (is_string($news)) {
                    $newsItem = DB::table('news')->where('slug', $news)->first();
                    if ($newsItem) {
                        return 'Berita: ' . $newsItem->title;
                    }
                }
            }

            if ($route->parameter('service')) {
                $service = $route->parameter('service');
                if (is_object($service)) {
                    return 'Layanan: ' . $service->name;
                }
                if (is_string($service)) {
                    $serviceItem = DB::table('services')->where('slug', $service)->first();
                    if ($serviceItem) {
                        return 'Layanan: ' . $serviceItem->name;
                    }
                }
            }
        }

        $segments = array_filter(explode('/', $path));
        return implode(' - ', array_map('ucfirst', $segments));
    }
}
