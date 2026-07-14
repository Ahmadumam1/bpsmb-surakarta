<?php

namespace App\Filament\Resources\HomeMarqueeLogos\Pages;

use App\Filament\Concerns\HasIndonesianNotifications;
use App\Filament\Resources\HomeMarqueeLogos\HomeMarqueeLogoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHomeMarqueeLogo extends EditRecord
{
    use HasIndonesianNotifications;

    protected static string $resource = HomeMarqueeLogoResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
