<?php

namespace Database\Seeders;

use App\Models\SampleCollectionFee;
use Illuminate\Database\Seeder;

class SampleCollectionFeeSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            'Panili',
            'The Hitam',
            'The Hijau Seduh',
            'The Hijau Celup',
            'The Merah',
            'The Melati',
            'The Lemon',
            'The Jahe',
            'The Wangi',
            'The Ginseng',
            'Jasmine Black Tea',
            'Kopi Jahe',
            'Gaplek',
            'Kopi Biji',
            'Biji Kakao',
            'Lada Hitam',
            'Lada Putih',
            'Minyak Daun Cengkeh',
            'Minyak Nilam',
            'Minyak kayu Putih',
            'Minyak Akar Wangi',
            'Minyak Kenanga',
            'Minyak Sereh',
            'Air Minum Dalam Kemasan',
            'Air Bersih',
            'Air Limbah',
            'Pupuk',
            'Produk dalam Kemasan',
            'Uji mikrobiologi',
            'Kopi bubuk',
            'Kopi Instan',
            'Komoditas lainnya',
        ];

        SampleCollectionFee::query()->delete();

        foreach ($items as $description) {
            SampleCollectionFee::create([
                'description' => $description,
                'sample_count' => 1,
                'fee' => 100000,
            ]);
        }
    }
}
