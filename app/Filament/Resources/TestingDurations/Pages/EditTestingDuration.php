<?php

namespace App\Filament\Resources\TestingDurations\Pages;

use App\Filament\Concerns\HasIndonesianNotifications;
use App\Filament\Resources\TestingDurations\TestingDurationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTestingDuration extends EditRecord
{
    use HasIndonesianNotifications;

    protected static string $resource = TestingDurationResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
