<?php

namespace App\Filament\Resources\CostDocuments\Pages;

use App\Filament\Resources\CostDocuments\CostDocumentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCostDocument extends EditRecord
{
    protected static string $resource = CostDocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
