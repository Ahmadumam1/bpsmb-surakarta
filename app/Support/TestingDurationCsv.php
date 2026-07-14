<?php

namespace App\Support;

use App\Models\TestingDuration;
use App\Support\CsvReader;
use Illuminate\Support\Facades\Storage;
use SplFileObject;

class TestingDurationCsv
{
    public const HEADERS = [
        'kategori',
        'karakteristik_uji',
        'durasi',
    ];

    public static function streamExport()
    {
        return response()->streamDownload(function (): void {
            $output = fopen('php://output', 'wb');
            fwrite($output, "\xEF\xBB\xBF");
            fputcsv($output, self::HEADERS);

            TestingDuration::query()
                ->orderBy('category')
                ->orderBy('name')
                ->each(function (TestingDuration $duration) use ($output): void {
                    fputcsv($output, [
                        $duration->category,
                        $duration->name,
                        $duration->duration,
                    ]);
                });

            fclose($output);
        }, 'lama-pengujian.csv', [
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
        }, 'template-lama-pengujian.csv', [
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

            $record = TestingDuration::query()->updateOrCreate(
                [
                    'category' => $data['kategori'],
                    'name' => $data['karakteristik_uji'],
                ],
                [
                    'duration' => max((int) $data['durasi'], 1),
                ],
            );

            $record->wasRecentlyCreated ? $created++ : $updated++;
        }

        Storage::disk('local')->delete($path);

        return compact('created', 'updated', 'skipped');
    }

}
