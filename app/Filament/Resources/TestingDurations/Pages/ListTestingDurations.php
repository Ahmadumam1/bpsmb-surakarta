<?php

namespace App\Filament\Resources\TestingDurations\Pages;

use App\Filament\Resources\TestingDurations\TestingDurationResource;
use App\Support\TestingDurationCsv;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

class ListTestingDurations extends ListRecords
{
    protected static string $resource = TestingDurationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('download_template')
                ->label('Template')
                ->icon('heroicon-o-document-arrow-down')
                ->color('gray')
                ->action(fn () => TestingDurationCsv::streamTemplate()),
            Action::make('export')
                ->label('Export')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->action(fn () => TestingDurationCsv::streamExport()),
            Action::make('import')
                ->label('Import')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('warning')
                ->schema([
                    FileUpload::make('file')
                        ->label('File CSV dari Excel')
                        ->disk('local')
                        ->directory('imports/testing-durations')
                        ->acceptedFileTypes([
                            'text/csv',
                            'text/plain',
                            'application/csv',
                            'application/vnd.ms-excel',
                        ])
                        ->maxSize(5120)
                        ->required()
                        ->helperText('Gunakan file CSV dengan kolom: kategori, karakteristik_uji, durasi. Maksimal 5 MB.'),
                ])
                ->action(function (array $data): void {
                    $path = is_array($data['file']) ? reset($data['file']) : $data['file'];
                    $result = TestingDurationCsv::import($path);

                    Notification::make()
                        ->title('Import lama pengujian selesai')
                        ->body("Baru: {$result['created']}, diperbarui: {$result['updated']}, dilewati: {$result['skipped']}.")
                        ->success()
                        ->send();
                }),
            CreateAction::make()->label('New'),
        ];
    }
}
