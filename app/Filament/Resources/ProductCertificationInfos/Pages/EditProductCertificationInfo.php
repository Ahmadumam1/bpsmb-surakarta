<?php

namespace App\Filament\Resources\ProductCertificationInfos\Pages;

use App\Filament\Resources\ProductCertificationInfos\ProductCertificationInfoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProductCertificationInfo extends EditRecord
{
    protected static string $resource = ProductCertificationInfoResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return ProductCertificationInfoResource::prepareInfoData($data);
    }

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
