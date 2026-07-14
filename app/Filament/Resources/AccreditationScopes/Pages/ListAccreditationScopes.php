<?php

namespace App\Filament\Resources\AccreditationScopes\Pages;

use App\Filament\Resources\AccreditationScopes\AccreditationScopeResource;
use App\Filament\Support\CsvImportActions;
use App\Support\AccreditationScopeCsv;
use Filament\Resources\Pages\ListRecords;

class ListAccreditationScopes extends ListRecords
{
    protected static string $resource = AccreditationScopeResource::class;

    protected function getHeaderActions(): array
    {
        return CsvImportActions::make(
            csvClass: AccreditationScopeCsv::class,
            directory: 'imports/accreditation-scopes',
            helperText: 'Gunakan file CSV dengan kolom: jenis_komoditas, acuan. Maksimal 5 MB.',
            notificationTitle: 'Import ruang lingkup akreditasi selesai',
        );
    }
}
