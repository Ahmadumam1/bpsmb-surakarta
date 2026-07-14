<?php

namespace App\Filament\Resources\HomeCommitments\Pages;

use App\Filament\Resources\HomeCommitments\HomeCommitmentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHomeCommitments extends ListRecords
{
    protected static string $resource = HomeCommitmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('New'),
        ];
    }
}
