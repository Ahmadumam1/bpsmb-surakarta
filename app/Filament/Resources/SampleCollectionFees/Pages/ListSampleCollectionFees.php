<?php

namespace App\Filament\Resources\SampleCollectionFees\Pages;

use App\Filament\Resources\SampleCollectionFees\SampleCollectionFeeResource;
use App\Filament\Support\CsvImportActions;
use App\Support\SampleCollectionFeeCsv;
use Filament\Resources\Pages\ListRecords;

class ListSampleCollectionFees extends ListRecords
{
    protected static string $resource = SampleCollectionFeeResource::class;

    protected function getHeaderActions(): array
    {
        return CsvImportActions::make(
            csvClass: SampleCollectionFeeCsv::class,
            directory: 'imports/sample-collection-fees',
            helperText: 'Gunakan file CSV dengan kolom: uraian, sampel, biaya. Maksimal 5 MB.',
            notificationTitle: 'Import tarif pengambilan contoh selesai',
        );
    }
}
