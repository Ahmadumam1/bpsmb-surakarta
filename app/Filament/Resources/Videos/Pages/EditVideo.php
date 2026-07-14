<?php

namespace App\Filament\Resources\Videos\Pages;

use App\Filament\Concerns\HasIndonesianNotifications;
use App\Filament\Resources\Videos\VideoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditVideo extends EditRecord
{
    use HasIndonesianNotifications;

    protected static string $resource = VideoResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
