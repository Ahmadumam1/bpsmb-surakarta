<?php

namespace App\Filament\Resources\HomeMarqueeLogos\Pages;

use App\Filament\Resources\HomeMarqueeLogos\HomeMarqueeLogoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHomeMarqueeLogos extends ListRecords
{
    protected static string $resource = HomeMarqueeLogoResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
