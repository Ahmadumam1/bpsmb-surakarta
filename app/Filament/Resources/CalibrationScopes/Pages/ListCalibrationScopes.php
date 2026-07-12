<?php

namespace App\Filament\Resources\CalibrationScopes\Pages;

use App\Filament\Resources\CalibrationScopes\CalibrationScopeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCalibrationScopes extends ListRecords
{
    protected static string $resource = CalibrationScopeResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
