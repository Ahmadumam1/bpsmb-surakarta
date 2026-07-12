<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\TwoFactorAuthenticationService;
use Filament\Facades\Filament;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class TwoFactorChallengeController extends Controller
{
    public function create(Request $request): View|RedirectResponse
    {
        $user = Filament::auth()->user();

        if (! $user) {
            return redirect()->route('filament.admin.auth.login');
        }

        if (! ($user->google2fa_enabled ?? false)) {
            return redirect(Filament::getUrl());
        }

        if ($request->session()->get('filament.admin.2fa.passed') === true) {
            return redirect()->intended(Filament::getUrl());
        }

        return view('filament.pages.auth.two-factor-challenge');
    }

    public function store(Request $request, TwoFactorAuthenticationService $twoFactor): RedirectResponse
    {
        $user = Filament::auth()->user();

        if (! $user) {
            return redirect()->route('filament.admin.auth.login');
        }

        $key = $this->rateLimitKey($request);

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);

            throw ValidationException::withMessages([
                'code' => "Terlalu banyak percobaan. Coba lagi dalam {$seconds} detik.",
            ]);
        }

        $validated = $request->validate([
            'code' => ['required', 'digits:6'],
        ], [
            'code.required' => 'Kode autentikator wajib diisi.',
            'code.digits' => 'Kode autentikator harus 6 digit.',
        ]);

        if (! $twoFactor->verify((string) $user->google2fa_secret, $validated['code'])) {
            RateLimiter::hit($key, 60);

            throw ValidationException::withMessages([
                'code' => 'Kode autentikator tidak valid.',
            ]);
        }

        RateLimiter::clear($key);
        $request->session()->put('filament.admin.2fa.passed', true);
        $request->session()->regenerate();

        return redirect()->intended(Filament::getUrl());
    }

    public function destroy(Request $request): RedirectResponse
    {
        Filament::auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('filament.admin.auth.login');
    }

    protected function rateLimitKey(Request $request): string
    {
        return 'admin-2fa-challenge:'.Filament::auth()->id().'|'.$request->ip();
    }
}
