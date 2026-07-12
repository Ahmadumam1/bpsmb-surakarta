<?php

namespace Database\Seeders;

use App\Models\HomeCommitment;
use App\Models\HomeHeadline;
use App\Models\HomeMarqueeLogo;
use App\Models\Photo;
use App\Models\Video;
use Illuminate\Database\Seeder;

class HomepageSeeder extends Seeder
{
    public function run(): void
    {
        HomeHeadline::updateOrCreate(
            ['title' => 'Menjamin Integritas Mutu Untuk Produk Daerah Berdaya Saing Global'],
            [
                'subtitle' => 'Balai Pengujian & Sertifikasi Mutu Barang',
                'description' => 'Layanan teknis pengujian, kalibrasi, dan sertifikasi terakreditasi untuk memastikan standar kualitas produk unggulan Anda.',
                'primary_button_label' => 'Layanan Kami',
                'primary_button_url' => '/jasa-layanan',
                'secondary_button_label' => 'Profil',
                'secondary_button_url' => '/profil/pendahuluan',
                'is_active' => true,
            ],
        );

        HomeCommitment::updateOrCreate(
            ['title' => 'Maklumat Pelayanan'],
            [
                'subtitle' => 'Komitmen Pelayanan',
                'statement' => 'Dengan ini, kami menyatakan sanggup menyelenggarakan pelayanan sesuai Standar Pelayanan yang telah ditetapkan...',
                'description' => 'BPSMB Surakarta berkomitmen penuh untuk melakukan perbaikan secara terus menerus serta siap menerima sanksi sesuai peraturan perundang-undangan yang berlaku.',
                'is_active' => true,
            ],
        );

        foreach ([
            ['15 Okt 2023', 'Sosialisasi Akreditasi Laboratorium KAN', 'Duration: 3:45', true],
            ['10 Okt 2023', 'Prosedur Kalibrasi Alat Ukur Industri', 'Duration: 3:45', false],
            ['05 Okt 2023', 'Kunjungan Kerja Dinas Perindustrian', 'Duration: 3:45', false],
        ] as [$category, $title, $description, $isFeatured]) {
            Video::updateOrCreate(
                ['title' => $title],
                [
                    'category' => $category,
                    'description' => $description,
                    'is_featured' => $isFeatured,
                    'is_active' => true,
                ],
            );
        }

        foreach ([
            ['Kunjungan', 'Kunjungan Kerja Dinas Perdagangan'],
            ['Pelatihan', 'Pelatihan Kalibrasi Massa & Suhu'],
            ['Layanan', 'Pengujian Komoditas Beras Premium'],
            ['Koordinasi', 'Rapat Koordinasi Evaluasi Mutu Tahunan'],
        ] as [$category, $title]) {
            Photo::updateOrCreate(
                ['title' => $title],
                [
                    'category' => $category,
                    'is_active' => true,
                ],
            );
        }

        foreach ([
            ['BPSMB Surakarta', '/'],
            ['Layanan Pengujian', '/jasa-layanan'],
            ['Profil BPSMB', '/profil/pendahuluan'],
            ['Kontak BPSMB', '/kontak'],
        ] as [$name, $url]) {
            HomeMarqueeLogo::updateOrCreate(
                ['name' => $name],
                [
                    'url' => $url,
                    'is_active' => true,
                ],
            );
        }
    }
}
