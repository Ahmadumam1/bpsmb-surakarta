<?php

namespace App\Filament\Resources\HomePopups\Pages;

use App\Filament\Resources\HomePopups\HomePopupResource;
use Filament\Resources\Pages\ListRecords;

class ListHomePopups extends ListRecords
{
    protected static string $resource = HomePopupResource::class;

    public function mount(): void
    {
        $this->redirect(
            HomePopupResource::getUrl('edit', [
                'record' => HomePopupResource::getEditableRecordKey(),
            ])
        );
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
