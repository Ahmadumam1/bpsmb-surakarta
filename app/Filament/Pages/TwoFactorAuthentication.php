<?php

namespace App\Filament\Pages;

use App\Services\TwoFactorAuthenticationService;
use BackedEnum;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class TwoFactorAuthentication extends Page
{
    use WithRateLimiting;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShieldCheck;

    protected static ?string $navigationLabel = 'Two-Factor Authentication';

    protected static ?string $title = 'Two-Factor Authentication';

    protected static ?string $slug = 'two-factor-authentication';

    protected static string|\UnitEnum|null $navigationGroup = 'Keamanan';

    protected static ?int $navigationSort = 2;

    protected string $view = 'filament.pages.two-factor-authentication';

    public ?array $data = [];

    public string $secret = '';

    public string $qrCodeSvg = '';

    public function mount(TwoFactorAuthenticationService $twoFactor): void
    {
        $this->refreshSetupSecret($twoFactor);
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        $enabled = (bool) (Filament::auth()->user()?->google2fa_enabled);

        return $schema
            ->statePath('data')
            ->components($enabled ? [
                TextInput::make('current_password')
                    ->label('Password saat ini')
                    ->password()
                    ->revealable(filament()->arePasswordsRevealable())
                    ->autocomplete('current-password')
                    ->required(),
            ] : [
                TextInput::make('code')
                    ->label('Kode 6 digit')
                    ->required()
                    ->rule('digits:6')
                    ->maxLength(6)
                    ->autocomplete('one-time-code')
                    ->extraInputAttributes([
                        'inputmode' => 'numeric',
                        'class' => 'text-center text-lg font-semibold tracking-[0.35em]',
                    ]),
            ]);
    }

    public function regenerate(TwoFactorAuthenticationService $twoFactor): void
    {
        session()->forget('filament.admin.2fa.setup_secret');

        $this->refreshSetupSecret($twoFactor);
        $this->form->fill();

        Notification::make()
            ->title('QR Code baru berhasil dibuat')
            ->success()
            ->send();
    }

    public function enable(TwoFactorAuthenticationService $twoFactor): void
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            throw ValidationException::withMessages([
                'data.code' => "Terlalu banyak percobaan. Coba lagi dalam {$exception->secondsUntilAvailable} detik.",
            ]);
        }

        $data = $this->form->getState();

        if (! $twoFactor->verify($this->secret, $data['code'])) {
            throw ValidationException::withMessages([
                'data.code' => 'Kode autentikator tidak valid.',
            ]);
        }

        $user = Filament::auth()->user();

        $twoFactor->enable($user, $this->secret);

        session()->forget('filament.admin.2fa.setup_secret');
        session()->put('filament.admin.2fa.passed', true);

        $this->refreshSetupSecret($twoFactor);
        $this->form->fill();

        Notification::make()
            ->title('Two-Factor Authentication berhasil diaktifkan')
            ->success()
            ->send();
    }

    public function disable(TwoFactorAuthenticationService $twoFactor): void
    {
        $data = $this->form->getState();

        $user = Filament::auth()->user();

        if (! Hash::check($data['current_password'], $user->password)) {
            throw ValidationException::withMessages([
                'data.current_password' => 'Password saat ini tidak sesuai.',
            ]);
        }

        $twoFactor->disable($user);

        session()->forget('filament.admin.2fa.passed');

        $this->refreshSetupSecret($twoFactor);
        $this->form->fill();

        Notification::make()
            ->title('Two-Factor Authentication berhasil dinonaktifkan')
            ->success()
            ->send();
    }

    protected function refreshSetupSecret(TwoFactorAuthenticationService $twoFactor): void
    {
        $user = Filament::auth()->user();

        if ($user?->google2fa_enabled) {
            $this->secret = '';
            $this->qrCodeSvg = '';

            return;
        }

        $this->secret = session()->get('filament.admin.2fa.setup_secret') ?: $twoFactor->generateSecret();

        session()->put('filament.admin.2fa.setup_secret', $this->secret);

        $this->qrCodeSvg = $twoFactor->qrCodeSvg($user, $this->secret);
    }
}
