<?php

namespace App\Http\Middleware;

use App\Filament\Pages\ChangePassword;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePasswordIsNotExpired
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user === null || ! method_exists($user, 'passwordExpired') || ! $user->passwordExpired()) {
            return $next($request);
        }

        if ($request->routeIs('filament.admin.pages.change-password') || $request->routeIs('filament.admin.auth.logout')) {
            return $next($request);
        }

        return redirect(ChangePassword::getUrl());
    }
}
