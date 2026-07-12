<?php

namespace App\Filament\Pages\Auth;

use Filament\Actions\Action;
use Filament\Auth\Pages\PasswordReset\RequestPasswordReset as BaseRequestPasswordReset;
use Illuminate\Contracts\Support\Htmlable;

class RequestPasswordReset extends BaseRequestPasswordReset
{
    public function loginAction(): Action
    {
        return parent::loginAction()
            ->label('Back to login')
            ->icon(null);
    }

    public function getSubheading(): string | Htmlable | null
    {
        return null;
    }
}
