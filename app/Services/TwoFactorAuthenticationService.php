<?php

namespace App\Services;

use App\Models\User;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use PragmaRX\Google2FA\Google2FA;

class TwoFactorAuthenticationService
{
    public function __construct(
        protected Google2FA $google2fa,
    ) {}

    public function generateSecret(): string
    {
        return $this->google2fa->generateSecretKey(32);
    }

    public function qrCodeSvg(User $user, string $secret): string
    {
        $qrCodeUrl = $this->google2fa->getQRCodeUrl(
            config('app.name', 'BPSMB Surakarta'),
            $user->email,
            $secret,
        );

        $renderer = new ImageRenderer(
            new RendererStyle(220),
            new SvgImageBackEnd(),
        );

        return (new Writer($renderer))->writeString($qrCodeUrl);
    }

    public function verify(string $secret, string $code): bool
    {
        return $this->google2fa->verifyKey($secret, $code, 1);
    }

    public function enable(User $user, string $secret): void
    {
        $user->forceFill([
            'google2fa_secret' => $secret,
            'google2fa_enabled' => true,
        ])->save();
    }

    public function disable(User $user): void
    {
        $user->forceFill([
            'google2fa_secret' => null,
            'google2fa_enabled' => false,
        ])->save();
    }
}
