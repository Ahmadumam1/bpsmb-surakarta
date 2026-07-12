<?php

namespace Database\Seeders;

use App\Models\ProductCertificationInfo;
use Illuminate\Database\Seeder;

class ProductCertificationInfoSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['scheme' => 'Produk', 'category' => 'Produk pangan lainnya', 'product_type' => 'Air Mineral', 'reference' => 'SNI 3553:2023'],
            ['scheme' => 'Produk', 'category' => 'Produk pangan lainnya', 'product_type' => 'Air Demineral', 'reference' => 'SNI 6241:2023'],
            ['scheme' => 'Produk', 'category' => 'Produk tanaman dan turunannya', 'product_type' => 'Kopi Instan', 'reference' => 'SNI 2983:2024'],
            ['scheme' => 'Produk', 'category' => 'Produk tanaman dan turunannya', 'product_type' => 'Gula Palma', 'reference' => 'SNI 3743:2021'],
            ['scheme' => 'Produk', 'category' => 'Produk tanaman dan turunannya', 'product_type' => 'Kopi Sangrai dan Kopi Bubuk', 'reference' => 'SNI 8964:2021'],
            ['scheme' => 'Jasa', 'category' => 'Jasa lainnya', 'product_type' => 'Pasar Rakyat', 'reference' => 'SNI 8152:2021'],
        ];

        ProductCertificationInfo::query()
            ->whereNotIn('product_type', collect($items)->pluck('product_type')->all())
            ->whereNull('file_path')
            ->delete();

        foreach ($items as $item) {
            ProductCertificationInfo::updateOrCreate(
                ['product_type' => $item['product_type'], 'reference' => $item['reference']],
                $item,
            );
        }
    }
}
