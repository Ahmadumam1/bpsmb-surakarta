<?php

namespace App\Filament\Resources\CalibrationScopes\Pages;

use App\Filament\Concerns\HasIndonesianNotifications;
use App\Filament\Resources\CalibrationScopes\CalibrationScopeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCalibrationScope extends CreateRecord
{
    use HasIndonesianNotifications;

    protected static string $resource = CalibrationScopeResource::class;
}
