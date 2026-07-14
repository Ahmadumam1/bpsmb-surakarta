<?php

namespace App\Filament\Support;

use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;

class CsvImportActions
{
    /**
     * Returns the standard [Template, Export, Import, Create] header actions
     * for a resource list page that has a matching *Csv support class.
     *
     * @param  class-string  $csvClass       e.g. \App\Support\AccreditationScopeCsv::class
     * @param  string        $directory      Storage sub-directory for uploaded files
     * @param  string        $helperText     Description shown below the file input
     * @param  string        $notificationTitle  Success notification title after import
     */
    public static function make(
        string $csvClass,
        string $directory,
        string $helperText,
        string $notificationTitle,
    ): array {
        return [
            Action::make('download_template')
                ->label('Template')
                ->icon('heroicon-o-document-arrow-down')
                ->color('gray')
                ->action(fn () => $csvClass::streamTemplate()),

            Action::make('export')
                ->label('Export')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->action(fn () => $csvClass::streamExport()),

            Action::make('import')
                ->label('Import')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('warning')
                ->schema([
                    FileUpload::make('file')
                        ->label('File CSV dari Excel')
                        ->disk('local')
                        ->directory($directory)
                        ->acceptedFileTypes([
                            'text/csv',
                            'text/plain',
                            'application/csv',
                            'application/vnd.ms-excel',
                        ])
                        ->maxSize(5120)
                        ->required()
                        ->helperText($helperText),
                ])
                ->action(function (array $data) use ($csvClass, $notificationTitle): void {
                    $path = is_array($data['file']) ? reset($data['file']) : $data['file'];
                    $result = $csvClass::import($path);

                    Notification::make()
                        ->title($notificationTitle)
                        ->body("Baru: {$result['created']}, diperbarui: {$result['updated']}, dilewati: {$result['skipped']}.")
                        ->success()
                        ->send();
                }),

            CreateAction::make()->label('New'),
        ];
    }
}
