<?php

namespace App\Filament\Resources\HomeHeadlines\Pages;

use App\Filament\Resources\HomeHeadlines\HomeHeadlineResource;
use Filament\Resources\Pages\ListRecords;

class ListHomeHeadlines extends ListRecords
{
    protected static string $resource = HomeHeadlineResource::class;

    public function mount(): void
    {
        $this->redirect(
            HomeHeadlineResource::getUrl('edit', [
                'record' => HomeHeadlineResource::getEditableRecordKey(),
            ])
        );
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
