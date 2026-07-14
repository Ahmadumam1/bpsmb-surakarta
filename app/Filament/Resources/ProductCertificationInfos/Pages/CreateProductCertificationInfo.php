<?php

namespace App\Filament\Resources\ProductCertificationInfos\Pages;

use App\Filament\Concerns\HasIndonesianNotifications;
use App\Filament\Resources\ProductCertificationInfos\ProductCertificationInfoResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProductCertificationInfo extends CreateRecord
{
    use HasIndonesianNotifications;

    protected static string $resource = ProductCertificationInfoResource::class;
}
