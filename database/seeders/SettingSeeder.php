<?php

namespace Database\Seeders;

use App\Support\SiteSettings;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        SiteSettings::setMany(SiteSettings::defaults());
    }
}
