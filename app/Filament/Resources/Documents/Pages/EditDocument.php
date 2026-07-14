<?php

namespace App\Filament\Resources\Documents\Pages;

use App\Filament\Concerns\HasIndonesianNotifications;
use App\Filament\Resources\Documents\DocumentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDocument extends EditRecord
{
    use HasIndonesianNotifications;

    protected static string $resource = DocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
