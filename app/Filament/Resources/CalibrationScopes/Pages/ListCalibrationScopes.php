<?php

namespace App\Filament\Resources\CalibrationScopes\Pages;

use App\Filament\Resources\CalibrationScopes\CalibrationScopeResource;
use App\Filament\Support\CsvImportActions;
use App\Support\CalibrationScopeCsv;
use Filament\Resources\Pages\ListRecords;

class ListCalibrationScopes extends ListRecords
{
    protected static string $resource = CalibrationScopeResource::class;

    protected function getHeaderActions(): array
    {
        return CsvImportActions::make(
            csvClass: CalibrationScopeCsv::class,
            directory: 'imports/calibration-scopes',
            helperText: 'Gunakan file CSV dengan kolom: kategori, alat_ruang_lingkup. Maksimal 5 MB.',
            notificationTitle: 'Import ruang lingkup kalibrasi selesai',
        );
    }
}
