<?php

namespace App\Support;

use Illuminate\Validation\Rules\Password;

class PasswordPolicy
{
    public static function rule(): Password
    {
        $rule = Password::min((int) config('password_policy.min_length', 12));

        if (config('password_policy.mixed_case', true)) {
            $rule->mixedCase();
        }

        if (config('password_policy.numbers', true)) {
            $rule->numbers();
        }

        if (config('password_policy.symbols', true)) {
            $rule->symbols();
        }

        if (config('password_policy.uncompromised', true)) {
            $rule->uncompromised();
        }

        return $rule;
    }

    public static function expiresAt(): ?\Carbon\CarbonInterface
    {
        $days = (int) config('password_policy.expires_days', 90);

        return $days > 0 ? now()->addDays($days) : null;
    }

    public static function description(): string
    {
        $parts = [
            'minimal ' . config('password_policy.min_length', 12) . ' karakter',
        ];

        if (config('password_policy.mixed_case', true)) {
            $parts[] = 'huruf besar dan kecil';
        }

        if (config('password_policy.numbers', true)) {
            $parts[] = 'angka';
        }

        if (config('password_policy.symbols', true)) {
            $parts[] = 'simbol';
        }

        return 'Kata sandi harus memuat ' . implode(', ', $parts) . '.';
    }
}
