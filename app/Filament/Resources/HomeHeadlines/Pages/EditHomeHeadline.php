<?php

namespace App\Filament\Resources\HomeHeadlines\Pages;

use App\Filament\Resources\HomeHeadlines\HomeHeadlineResource;
use Filament\Resources\Pages\EditRecord;

class EditHomeHeadline extends EditRecord
{
    protected static string $resource = HomeHeadlineResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
