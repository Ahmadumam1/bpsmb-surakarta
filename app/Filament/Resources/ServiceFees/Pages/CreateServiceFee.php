<?php

namespace App\Filament\Resources\ServiceFees\Pages;

use App\Filament\Concerns\HasIndonesianNotifications;
use App\Filament\Resources\ServiceFees\ServiceFeeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateServiceFee extends CreateRecord
{
    use HasIndonesianNotifications;

    protected static string $resource = ServiceFeeResource::class;
}
