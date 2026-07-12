<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class LphSection extends Model
{
    protected $fillable = [
        'slug',
        'tab_label',
        'eyebrow',
        'title',
        'description',
        'items',
        'primary_button_label',
        'primary_button_url',
        'secondary_button_label',
        'secondary_button_url',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'items' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public static function publicSections(): Collection
    {
        $sections = static::query()
            ->active()
            ->orderBy('id')
            ->get();

        return $sections->isNotEmpty() ? $sections : collect(static::defaultSections());
    }

    public static function defaultSections(): array
    {
        return [
            [
                'slug' => 'lingkup-lph',
                'tab_label' => 'Lingkup',
                'eyebrow' => 'Lingkup Layanan',
                'title' => 'Cakupan pemeriksaan halal',
                'description' => 'LPH BPSMB Surakarta mendukung pemeriksaan produk, bahan, proses produksi, fasilitas, dan dokumen pendukung sesuai pengajuan sertifikasi halal.',
                'items' => [
                    ['title' => 'Pemeriksaan bahan baku, bahan tambahan, dan bahan penolong.'],
                    ['title' => 'Pemeriksaan proses produksi, penyimpanan, distribusi, dan penyajian.'],
                    ['title' => 'Verifikasi dokumen sistem jaminan produk halal.'],
                    ['title' => 'Pemeriksaan lapangan dan/atau pengujian pendukung sesuai kebutuhan.'],
                ],
                'is_active' => true,
            ],
            [
                'slug' => 'persyaratan-lph',
                'tab_label' => 'Persyaratan',
                'eyebrow' => 'Dokumen Persyaratan',
                'title' => 'Siapkan dokumen sebelum pengajuan',
                'description' => 'Kelengkapan dokumen membantu proses verifikasi berjalan lebih cepat dan mengurangi revisi data.',
                'items' => [
                    ['title' => 'Data pelaku usaha dan legalitas usaha.'],
                    ['title' => 'Daftar produk yang diajukan sertifikasi halal.'],
                    ['title' => 'Daftar bahan dan dokumen pendukung bahan.'],
                    ['title' => 'Diagram alir proses produksi dan informasi fasilitas produksi.'],
                    ['title' => 'Dokumen Sistem Jaminan Produk Halal atau dokumen sejenis yang dipersyaratkan.'],
                ],
                'is_active' => true,
            ],
            [
                'slug' => 'biaya-lph',
                'tab_label' => 'Biaya',
                'eyebrow' => 'Biaya',
                'title' => 'Estimasi biaya sertifikasi halal',
                'description' => 'Biaya dapat berbeda sesuai skala usaha, jenis produk, kebutuhan pemeriksaan, dan ketentuan yang berlaku pada sistem BPJPH.',
                'items' => [
                    ['title' => 'Gunakan kalkulator resmi BPJPH untuk memperkirakan kebutuhan biaya.'],
                    ['title' => 'Konsultasikan detail layanan dengan admin LPH BPSMB Surakarta.'],
                ],
                'primary_button_label' => 'Kalkulator Biaya BPJPH',
                'primary_button_url' => 'https://bpjph.halal.go.id/kalkulator-biaya-sh/',
                'secondary_button_label' => 'Tanya Admin LPH',
                'secondary_button_url' => '/kontak',
                'is_active' => true,
            ],
            [
                'slug' => 'regulasi-lph',
                'tab_label' => 'Regulasi',
                'eyebrow' => 'Regulasi',
                'title' => 'Dasar hukum dan rujukan',
                'description' => 'Regulasi detail dapat dilengkapi dengan dokumen resmi ketika file dan tautan final tersedia.',
                'items' => [
                    ['title' => 'UU Jaminan Produk Halal dan aturan turunannya.'],
                    ['title' => 'Ketentuan BPJPH terkait sertifikasi halal.'],
                    ['title' => 'Pedoman pemeriksaan halal dan sistem jaminan produk halal.'],
                ],
                'is_active' => true,
            ],
            [
                'slug' => 'sertifikat-lph',
                'tab_label' => 'Sertifikat',
                'eyebrow' => 'Sertifikat & Legalitas',
                'title' => 'Detail akreditasi LPH',
                'description' => 'LPH BPSMB Surakarta tercatat sebagai layanan pemeriksa halal yang terintegrasi dengan proses sertifikasi halal BPJPH.',
                'items' => [
                    ['title' => 'Akreditasi BPJPH: 23 Oktober 2023.'],
                    ['title' => 'Nomor akreditasi: A0066/TIM-AK/LPH-LHLN/RK.01.01/09/2023.'],
                    ['title' => 'Didukung auditor halal untuk proses pemeriksaan produk.'],
                ],
                'is_active' => true,
            ],
            [
                'slug' => 'alur-lph',
                'tab_label' => 'Alur',
                'eyebrow' => 'Alur Ringkas',
                'title' => 'Proses layanan LPH dibuat sederhana',
                'description' => 'Alur dapat menyesuaikan jenis produk, skema sertifikasi, dan hasil verifikasi dokumen pada sistem BPJPH.',
                'items' => [
                    ['title' => 'Daftar Online', 'description' => 'Pelaku usaha masuk ke PTSP Halal dan melengkapi data pengajuan.'],
                    ['title' => 'Verifikasi Dokumen', 'description' => 'Data produk, bahan, dan dokumen pendukung diperiksa kelengkapannya.'],
                    ['title' => 'Pemeriksaan LPH', 'description' => 'LPH melakukan pemeriksaan proses, fasilitas, dan/atau pengujian produk.'],
                    ['title' => 'Hasil Pemeriksaan', 'description' => 'Hasil pemeriksaan digunakan dalam proses penetapan sertifikasi halal.'],
                ],
                'is_active' => true,
            ],
        ];
    }
}
