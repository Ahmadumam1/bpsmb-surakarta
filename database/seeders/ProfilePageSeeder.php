<?php

namespace Database\Seeders;

use App\Models\ProfilePage;
use Illuminate\Database\Seeder;

class ProfilePageSeeder extends Seeder
{
    public function run(): void
    {
        collect([
            [
                'slug' => 'pendahuluan',
                'title' => 'Pendahuluan',
                'subtitle' => 'Profil BPSMB Surakarta',
                'content' => '<p>BPSMB Surakarta menyediakan layanan teknis untuk mendukung pengujian, kalibrasi, dan penjaminan mutu barang sesuai standar yang berlaku.</p>',
                'sort_order' => 1,
            ],
            [
                'slug' => 'visi-misi',
                'title' => 'Visi dan Misi',
                'subtitle' => 'Arah pelayanan',
                'content' => '<h2>Visi</h2><p>Menjadi lembaga layanan teknis yang profesional, terpercaya, dan berorientasi pada mutu pelayanan publik.</p><h2>Misi</h2><ul><li>Meningkatkan kualitas layanan pengujian dan kalibrasi.</li><li>Mendukung peningkatan daya saing produk daerah.</li><li>Mewujudkan pelayanan yang transparan, akuntabel, dan responsif.</li></ul>',
                'sort_order' => 2,
            ],
            [
                'slug' => 'jenis-pelayanan',
                'title' => 'Jenis Layanan',
                'subtitle' => 'Layanan teknis',
                'content' => '<p>Informasi jenis layanan BPSMB Surakarta dapat disesuaikan melalui halaman admin.</p>',
                'sort_order' => 3,
            ],
            [
                'slug' => 'sotk',
                'title' => 'SOTK',
                'subtitle' => 'Struktur organisasi',
                'content' => '<p>Informasi struktur organisasi dan tata kerja BPSMB Surakarta dapat disesuaikan melalui halaman admin.</p>',
                'sort_order' => 4,
            ],
        ])->each(function (array $page): void {
            ProfilePage::updateOrCreate(
                ['slug' => $page['slug']],
                $page + ['is_active' => true],
            );
        });
    }
}
