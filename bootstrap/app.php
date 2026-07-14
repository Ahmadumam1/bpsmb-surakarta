<?php

use App\Http\Middleware\ContentSecurityPolicy;
use App\Http\Middleware\TrackVisitor;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->trustProxies(at: '*');
        $middleware->web(append: [
            TrackVisitor::class,
            ContentSecurityPolicy::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

// Mengarahkan folder public ke public_html secara dinamis untuk cPanel
if (file_exists(dirname(dirname(__DIR__)) . '/public_html')) {
    $app->usePublicPath(dirname(dirname(__DIR__)) . '/public_html');
}

return $app;
