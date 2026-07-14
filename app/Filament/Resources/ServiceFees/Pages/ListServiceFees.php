<?php

namespace App\Filament\Resources\ServiceFees\Pages;

use App\Filament\Resources\ServiceFees\ServiceFeeResource;
use App\Filament\Support\CsvImportActions;
use App\Support\ServiceFeeCsv;
use Filament\Resources\Pages\ListRecords;

class ListServiceFees extends ListRecords
{
    protected static string $resource = ServiceFeeResource::class;

    protected function getHeaderActions(): array
    {
        return CsvImportActions::make(
            csvClass: ServiceFeeCsv::class,
            directory: 'imports/service-fees',
            helperText: 'Gunakan file CSV dengan kolom: kategori, uraian_layanan, satuan, tarif. Maksimal 5 MB.',
            notificationTitle: 'Import tarif biaya layanan selesai',
        );
    }
}
