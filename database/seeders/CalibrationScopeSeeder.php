<?php

namespace Database\Seeders;

use App\Models\CalibrationScope;
use Illuminate\Database\Seeder;

class CalibrationScopeSeeder extends Seeder
{
    public function run(): void
    {
        CalibrationScope::query()->delete();

        foreach ($this->categories() as $category) {
            foreach ($category['items'] as $item) {
                CalibrationScope::create([
                    'category' => $category['category'],
                    'item' => $item,
                ]);
            }
        }
    }

    private function categories(): array
    {
        return [
            [
                'category' => 'Suhu dan Kelembaban',
                'items' => [
                    'Enclosure : Oven, Incubator, Waterbath, Autoclave, Chiller, Freezer, muffle furnace',
                    'Liquid in glass thermometer',
                    'Termometer Digital',
                    'Termohigrometer',
                ],
            ],
            [
                'category' => 'Massa',
                'items' => [
                    'Timbangan (elektronik, mekanik)',
                    'Timbangan Bayi',
                    'Timbangan Badan',
                ],
            ],
            [
                'category' => 'Volume',
                'items' => [
                    'Gelas ukur',
                    'Labu ukur',
                    'Pipet ukur',
                    'Pipet volume',
                ],
            ],
            [
                'category' => 'Panjang',
                'items' => [
                    'Caliper',
                    'Mistar baja',
                ],
            ],
            [
                'category' => 'Waktu',
                'items' => [
                    'Stopwatch',
                ],
            ],
            [
                'category' => 'Instrumen Analitik',
                'items' => [
                    'pH meter',
                ],
            ],
        ];
    }
}
