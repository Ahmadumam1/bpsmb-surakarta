<?php

namespace App\Support;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SiteSettings
{
    public static function defaults(): array
    {
        return [
            'contact.address' => 'Jl. Pajang - Kartasura KM. 8 Pabelan, Kartasura, Sukoharjo, Jawa Tengah 57169',
            'contact.phone' => '(0271) 743959 / (0271) 7881926 / 0812-1536-6242',
            'contact.whatsapp_number' => '0812-1536-6242',
            'contact.email' => 'bpsmb_surakarta@disperindag.jatengprov.go.id',
            'contact.secondary_email' => 'bpsmbsurakarta@yahoo.com',
            'contact.working_hours' => 'Senin - Jumat: 07.30 - 16.00 WIB',
            'social.instagram_url' => '',
            'social.facebook_url' => '',
            'social.youtube_url' => '',
        ];
    }

    public static function all(): array
    {
        try {
            return Cache::rememberForever('site-settings', function (): array {
                $settings = Setting::query()
                    ->whereIn('key', array_keys(static::defaults()))
                    ->pluck('value', 'key')
                    ->all();

                return array_replace(static::defaults(), $settings);
            });
        } catch (\Throwable) {
            return static::defaults();
        }
    }

    public static function get(string $key): ?string
    {
        return static::all()[$key] ?? null;
    }

    public static function whatsappUrl(?array $settings = null): ?string
    {
        $number = $settings['contact.whatsapp_number'] ?? static::get('contact.whatsapp_number');
        $number = preg_replace('/\D+/', '', (string) $number);

        if ($number === '') {
            return null;
        }

        if (str_starts_with($number, '0')) {
            $number = '62' . substr($number, 1);
        } elseif (str_starts_with($number, '8')) {
            $number = '62' . $number;
        }

        return "https://wa.me/{$number}";
    }

    public static function setMany(array $values): void
    {
        foreach (static::defaults() as $key => $default) {
            Setting::updateOrCreate(
                ['key' => $key],
                [
                    'value' => $values[$key] ?? $default,
                    'group' => explode('.', $key, 2)[0],
                ],
            );
        }

        Cache::forget('site-settings');
    }
}
