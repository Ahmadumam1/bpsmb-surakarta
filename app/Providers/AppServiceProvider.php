<?php

namespace App\Providers;

use App\Models\VisitorStat;
use App\Support\PasswordPolicy;
use App\Support\SiteSettings;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(glob(database_path('migrations/*'), GLOB_ONLYDIR));

        if (config('app.force_https')) {
            URL::forceScheme('https');
        }

        Password::defaults(fn () => PasswordPolicy::rule());

        Event::listen(PasswordReset::class, function (PasswordReset $event): void {
            $event->user->forceFill([
                'password_changed_at' => now(),
                'password_expires_at' => PasswordPolicy::expiresAt(),
                'password_must_be_changed' => false,
            ])->save();
        });

        View::composer('partials.footer', function ($view): void {
            $stats = Cache::remember('visitor-stats:footer', now()->addMinutes(5), function (): array {
                try {
                    $today = now()->toDateString();
                    $startOfWeek = now()->startOfWeek()->toDateString();
                    $endOfWeek = now()->endOfWeek()->toDateString();

                    return [
                        'today' => VisitorStat::query()
                            ->whereDate('date', $today)
                            ->value('total_views') ?? 0,
                        'week' => VisitorStat::query()
                            ->whereBetween('date', [$startOfWeek, $endOfWeek])
                            ->sum('total_views'),
                        'total' => VisitorStat::query()
                            ->sum('total_views'),
                    ];
                } catch (QueryException) {
                    return [
                        'today' => 0,
                        'week' => 0,
                        'total' => 0,
                    ];
                }
            });

            $view->with([
                'visitorToday' => (int) $stats['today'],
                'visitorWeek' => (int) $stats['week'],
                'visitorTotal' => (int) $stats['total'],
                'siteSettings' => SiteSettings::all(),
            ]);
        });

        View::composer('layouts.public', function ($view): void {
            $siteSettings = SiteSettings::all();

            $view->with([
                'siteSettings' => $siteSettings,
                'whatsappUrl' => SiteSettings::whatsappUrl($siteSettings),
            ]);
        });
    }
}
