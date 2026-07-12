<?php

namespace Database\Seeders;

use App\Models\AccreditationScope;
use Illuminate\Database\Seeder;

class AccreditationScopeSeeder extends Seeder
{
    public function run(): void
    {
        AccreditationScope::query()->delete();

        foreach ($this->items() as $item) {
            AccreditationScope::create($item);
        }
    }

    private function items(): array
    {
        return [
            ['commodity_type' => 'Minyak Daun Cengkeh', 'reference' => 'SNI 2387 : 2019'],
            ['commodity_type' => 'Teh hitam', 'reference' => 'SNI 1902-2016'],
            ['commodity_type' => 'Biji kopi', 'reference' => 'SNI 2907-2008'],
            ['commodity_type' => 'Teh hijau', 'reference' => 'SNI 3945-2016'],
            ['commodity_type' => 'Tembakau Rajangan Boyolali', 'reference' => 'SNI 01-3935-1995'],
            ['commodity_type' => 'Tembakau Rajangan Temanggung', 'reference' => 'SNI 01-4102-1996'],
            ['commodity_type' => 'Tembakau Rajangan Weleri', 'reference' => 'SNI 01-3943-1995'],
            ['commodity_type' => 'Tembakau Rajangan Muntilan', 'reference' => 'SNI 01-3934-1995'],
            ['commodity_type' => 'Tembakau Rajangan Mranggen', 'reference' => 'SNI 01-3944-1995'],
            ['commodity_type' => 'Tembakau Boyolali Asepan', 'reference' => 'SNI 01-3936-1995'],
            ['commodity_type' => 'Tembakau Vorstenlanden', 'reference' => 'SNI 01-3940-1995'],
        ];
    }
}
