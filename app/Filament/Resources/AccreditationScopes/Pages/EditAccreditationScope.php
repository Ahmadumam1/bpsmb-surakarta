<?php

namespace App\Filament\Resources\AccreditationScopes\Pages;

use App\Filament\Resources\AccreditationScopes\AccreditationScopeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAccreditationScope extends EditRecord
{
    protected static string $resource = AccreditationScopeResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
