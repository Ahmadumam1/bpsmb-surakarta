<?php

namespace App\Filament\Resources\SampleCollectionFees\Pages;

use App\Filament\Concerns\HasIndonesianNotifications;
use App\Filament\Resources\SampleCollectionFees\SampleCollectionFeeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSampleCollectionFee extends CreateRecord
{
    use HasIndonesianNotifications;

    protected static string $resource = SampleCollectionFeeResource::class;
}
