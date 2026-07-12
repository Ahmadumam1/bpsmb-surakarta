<?php

namespace App\Filament\Resources\ProductCertificationInfos\Pages;

use App\Filament\Resources\ProductCertificationInfos\ProductCertificationInfoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProductCertificationInfos extends ListRecords
{
    protected static string $resource = ProductCertificationInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
