<?php

namespace App\Filament\Resources\HomeMarqueeLogos\Pages;

use App\Filament\Concerns\HasIndonesianNotifications;
use App\Filament\Resources\HomeMarqueeLogos\HomeMarqueeLogoResource;
use Filament\Resources\Pages\CreateRecord;

class CreateHomeMarqueeLogo extends CreateRecord
{
    use HasIndonesianNotifications;

    protected static string $resource = HomeMarqueeLogoResource::class;
}
