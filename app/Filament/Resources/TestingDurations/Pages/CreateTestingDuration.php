<?php

namespace App\Filament\Resources\TestingDurations\Pages;

use App\Filament\Concerns\HasIndonesianNotifications;
use App\Filament\Resources\TestingDurations\TestingDurationResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTestingDuration extends CreateRecord
{
    use HasIndonesianNotifications;

    protected static string $resource = TestingDurationResource::class;
}
