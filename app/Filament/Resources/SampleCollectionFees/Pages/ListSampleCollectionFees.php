<?php

namespace App\Filament\Resources\SampleCollectionFees\Pages;

use App\Filament\Resources\SampleCollectionFees\SampleCollectionFeeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSampleCollectionFees extends ListRecords
{
    protected static string $resource = SampleCollectionFeeResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
