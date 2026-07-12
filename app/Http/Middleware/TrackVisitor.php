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
}
