<?php

namespace App\Filament\Resources\CostDocuments\Pages;

use App\Filament\Resources\CostDocuments\CostDocumentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCostDocuments extends ListRecords
{
    protected static string $resource = CostDocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
