<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ProfilePage;
use Illuminate\Support\Str;

class ProfilePageController extends Controller
{
    public function show(string $slug)
    {
        $page = ProfilePage::query()
            ->active()
            ->where('slug', $slug)
            ->first();

        return view('public.profile.show', [
            'page' => $page ?: $this->fallbackPage($slug),
        ]);
    }

    private function fallbackPage(string $slug): object
    {
        $title = match ($slug) {
            'pendahuluan' => 'Pendahuluan',
            'visi-misi' => 'Visi dan Misi',
            'jenis-pelayanan' => 'Jenis Layanan',
            'sotk' => 'SOTK',
            default => Str::headline(str_replace('-', ' ', $slug)),
        };

        return (object) [
            'title' => $title,
            'subtitle' => 'Profil BPSMB Surakarta',
            'content' => '<p>Konten halaman ini sedang disiapkan.</p>',
            'image_url' => null,
            'meta_description' => null,
        ];
    }
}
