<?php

namespace App\Filament\Resources\AccreditationScopes\Pages;

use App\Filament\Resources\AccreditationScopes\AccreditationScopeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAccreditationScopes extends ListRecords
{
    protected static string $resource = AccreditationScopeResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
