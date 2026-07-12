<?php

namespace Database\Seeders;

use App\Models\CostDocument;
use Illuminate\Database\Seeder;

class CostDocumentSeeder extends Seeder
{
    public function run(): void
    {
        CostDocument::query()
            ->where('title', 'Daftar Tarif Layanan')
            ->update(['title' => 'Daftar Biaya Layanan']);

        CostDocument::updateOrCreate(
            ['title' => 'Daftar Biaya Layanan'],
            [
                'sort_order' => 1,
                'is_active' => true,
            ],
        );
    }
}
