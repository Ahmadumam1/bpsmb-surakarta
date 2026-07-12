<?php

namespace App\Filament\Resources\ProductCertificationInfos\Pages;

use App\Filament\Resources\ProductCertificationInfos\ProductCertificationInfoResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProductCertificationInfo extends CreateRecord
{
    protected static string $resource = ProductCertificationInfoResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return ProductCertificationInfoResource::prepareInfoData($data);
    }
}
