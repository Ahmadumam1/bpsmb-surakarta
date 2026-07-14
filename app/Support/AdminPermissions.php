<?php

namespace App\Support;

class AdminPermissions
{
    public static function options(): array
    {
        return [
            'home.headline' => 'Home - Headline',
            'home.commitment' => 'Home - Maklumat Pelayanan',
            'home.marquee_logo' => 'Home - Logo Marquee',
            'home.popup' => 'Home - Popup Pengumuman',
            'profile.pages' => 'Profil - Halaman Profil',
            'media.news' => 'Media - Berita',
            'media.news_category' => 'Media - Kategori Berita',
            'media.photo' => 'Media - Foto',
            'media.video' => 'Media - Video',
            'services.testing_duration' => 'Jasa Layanan - Lama Pengujian',
            'services.accreditation_scope' => 'Jasa Layanan - Ruang Lingkup Akreditasi',
            'services.product_certification_info' => 'Jasa Layanan - Sertifikasi Produk',
            'services.sample_collection_fee' => 'Jasa Layanan - Biaya Pengambilan Contoh',
            'services.calibration_scope' => 'Jasa Layanan - Ruang Lingkup Kalibrasi',
            'services.service_fee' => 'Jasa Layanan - Biaya Layanan',
            'services.lph_section' => 'Jasa Layanan - LPH',
            'content.document' => 'Konten - Dokumen',
            'content.cost_document' => 'Konten - Dokumen Biaya Layanan',
            'content.survey' => 'Konten - Survey',
            'settings.contact' => 'Lainnya - Kontak & Sosmed',
        ];
    }

}
