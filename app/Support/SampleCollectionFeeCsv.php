<?php

namespace App\Support;

use App\Models\SampleCollectionFee;
use App\Support\CsvReader;
use Illuminate\Support\Facades\Storage;
use SplFileObject;

class SampleCollectionFeeCsv
{
    public const HEADERS = [
        'uraian',
        'sampel',
        'biaya',
    ];

    public static function streamExport()
    {
        return response()->streamDownload(function (): void {
            $output = fopen('php://output', 'wb');
            fwrite($output, "\xEF\xBB\xBF");
            fputcsv($output, self::HEADERS);

            SampleCollectionFee::query()
                ->orderBy('description')
                ->orderBy('id')
                ->each(function (SampleCollectionFee $fee) use ($output): void {
                    fputcsv($output, [
                        $fee->description,
                        $fee->sample_count,
                        $fee->fee,
                    ]);
                });

            fclose($output);
        }, 'tarif-pengambilan-contoh.csv', [
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
        }, 'template-tarif-pengambilan-contoh.csv', [
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

            $record = SampleCollectionFee::query()->updateOrCreate(
                [
                    'description' => $data['uraian'],
                    'sample_count' => max((int) $data['sampel'], 1),
                ],
                [
                    'fee' => max((int) $data['biaya'], 0),
                ]
            );

            $record->wasRecentlyCreated ? $created++ : $updated++;
        }

        Storage::disk('local')->delete($path);

        return compact('created', 'updated', 'skipped');
    }

}
