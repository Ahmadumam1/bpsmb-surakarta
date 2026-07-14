<?php

namespace App\Support;

use App\Models\CalibrationScope;
use App\Support\CsvReader;
use Illuminate\Support\Facades\Storage;
use SplFileObject;

class CalibrationScopeCsv
{
    public const HEADERS = [
        'kategori',
        'alat_ruang_lingkup',
    ];

    public static function streamExport()
    {
        return response()->streamDownload(function (): void {
            $output = fopen('php://output', 'wb');
            fwrite($output, "\xEF\xBB\xBF");
            fputcsv($output, self::HEADERS);

            CalibrationScope::query()
                ->orderBy('category')
                ->orderBy('id')
                ->each(function (CalibrationScope $scope) use ($output): void {
                    fputcsv($output, [
                        $scope->category,
                        $scope->item,
                    ]);
                });

            fclose($output);
        }, 'ruang-lingkup-kalibrasi.csv', [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    public static function streamTemplate()
    {
        return response()->streamDownload(function (): void {
            $output = fopen('php://output', 'wb');
            fwrite($output, "\xEF\xBB\xBF");
            fputcsv($output, self::HEADERS);
            fclose($output);
        }, 'template-ruang-lingkup-kalibrasi.csv', [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    public static function import(string $path): array
    {
        $fullPath = Storage::disk('local')->path($path);
        $file = new SplFileObject($fullPath);
        $file->setCsvControl(CsvReader::detectDelimiter($fullPath));
        $file->setFlags(SplFileObject::READ_CSV | SplFileObject::SKIP_EMPTY | SplFileObject::DROP_NEW_LINE);

        $created = 0;
        $updated = 0;
        $skipped = 0;
        $headers = [];

        foreach ($file as $index => $row) {
            if ($row === [null] || $row === false) {
                continue;
            }

            $row = array_map(fn($value): string => trim((string) $value), $row);

            if ($index === 0) {
                $headers = CsvReader::normalizeHeaders($row);
                continue;
            }

            $data = CsvReader::mapRow($headers, $row);

            if (! self::isValidRow($data)) {
                $skipped++;
                continue;
            }

            $record = CalibrationScope::query()->updateOrCreate(
                [
                    'category' => $data['kategori'],
                    'item' => $data['alat_ruang_lingkup'],
                ],
                []
            );

            $record->wasRecentlyCreated ? $created++ : $updated++;
        }

        Storage::disk('local')->delete($path);

        return compact('created', 'updated', 'skipped');
    }

}
