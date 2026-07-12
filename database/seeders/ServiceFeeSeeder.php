<?php

namespace Database\Seeders;

use App\Models\ServiceFee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ServiceFeeSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/data/service_fees.csv');

        if (! File::exists($path)) {
            return;
        }

        ServiceFee::query()->delete();

        $handle = fopen($path, 'rb');
        $header = fgetcsv($handle);

        while (($row = fgetcsv($handle)) !== false) {
            $data = array_combine($header, $row);

            ServiceFee::create([
                'category' => $data['category'],
                'service_name' => preg_replace('/^\s*\d+\.?\s+/', '', $data['service_name']),
                'description' => $data['description'] ?: null,
                'unit' => $data['unit'],
                'price' => (int) $data['price'],
                'regulation_reference' => $data['regulation_reference'] ?: null,
                'source_page' => $data['source_page'] !== '' ? (int) $data['source_page'] : null,
                'is_active' => true,
            ]);
        }

        fclose($handle);
    }
}
