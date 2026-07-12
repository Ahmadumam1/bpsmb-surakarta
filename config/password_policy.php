<?php

return [
    'min_length' => env('PASSWORD_MIN_LENGTH', 12),
    'max_length' => env('PASSWORD_MAX_LENGTH', 255),
    'mixed_case' => env('PASSWORD_MIXED_CASE', true),
    'numbers' => env('PASSWORD_NUMBERS', true),
    'symbols' => env('PASSWORD_SYMBOLS', true),
    'uncompromised' => env('PASSWORD_UNCOMPROMISED', true),
    'expires_days' => env('PASSWORD_EXPIRES_DAYS', 90),
    'max_login_attempts' => env('PASSWORD_MAX_LOGIN_ATTEMPTS', 5),
    'lockout_seconds' => env('PASSWORD_LOCKOUT_SECONDS', 900),
];
