<?php

namespace App\Filament\Resources\CalibrationScopes\Pages;

use App\Filament\Concerns\HasIndonesianNotifications;
use App\Filament\Resources\CalibrationScopes\CalibrationScopeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCalibrationScope extends EditRecord
{
    use HasIndonesianNotifications;

    protected static string $resource = CalibrationScopeResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
