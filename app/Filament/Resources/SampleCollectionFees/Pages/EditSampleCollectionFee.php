<?php

namespace App\Filament\Resources\SampleCollectionFees\Pages;

use App\Filament\Concerns\HasIndonesianNotifications;
use App\Filament\Resources\SampleCollectionFees\SampleCollectionFeeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSampleCollectionFee extends EditRecord
{
    use HasIndonesianNotifications;

    protected static string $resource = SampleCollectionFeeResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
