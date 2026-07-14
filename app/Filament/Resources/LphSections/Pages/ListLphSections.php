<?php

namespace App\Filament\Resources\LphSections\Pages;

use App\Filament\Resources\LphSections\LphSectionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLphSections extends ListRecords
{
    protected static string $resource = LphSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('New'),
        ];
    }
}
