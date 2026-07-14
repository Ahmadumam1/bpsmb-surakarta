<?php

namespace App\Filament\Resources\ProductCertificationInfos\Pages;

use App\Filament\Resources\ProductCertificationInfos\ProductCertificationInfoResource;
use App\Filament\Support\CsvImportActions;
use App\Support\ProductCertificationInfoCsv;
use Filament\Resources\Pages\ListRecords;

class ListProductCertificationInfos extends ListRecords
{
    protected static string $resource = ProductCertificationInfoResource::class;

    protected function getHeaderActions(): array
    {
        return CsvImportActions::make(
            csvClass: ProductCertificationInfoCsv::class,
            directory: 'imports/product-certification-infos',
            helperText: 'Gunakan file CSV dengan kolom: skema, kategori, jenis_produk, acuan. Maksimal 5 MB.',
            notificationTitle: 'Import informasi sertifikasi produk selesai',
        );
    }
}
