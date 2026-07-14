<?php

namespace App\Filament\Resources\LphSections\Pages;

use App\Filament\Concerns\HasIndonesianNotifications;
use App\Filament\Resources\LphSections\LphSectionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLphSection extends EditRecord
{
    use HasIndonesianNotifications;

    protected static string $resource = LphSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
