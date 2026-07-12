<?php

namespace Database\Seeders;

use App\Models\LphSection;
use Illuminate\Database\Seeder;

class LphSectionSeeder extends Seeder
{
    public function run(): void
    {
        foreach (LphSection::defaultSections() as $section) {
            LphSection::query()->updateOrCreate(
                ['slug' => $section['slug']],
                $section,
            );
        }
    }
}
