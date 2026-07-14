<?php

namespace App\Support;

use App\Models\ServiceFee;
use App\Support\CsvReader;
use Illuminate\Support\Facades\Storage;
use SplFileObject;

class ServiceFeeCsv
{
    public const HEADERS = [
        'kategori',
        'uraian_layanan',
        'satuan',
        'tarif',
    ];

    public static function streamExport()
    {
        return response()->streamDownload(function (): void {
            $output = fopen('php://output', 'wb');
            fwrite($output, "\xEF\xBB\xBF");
            fputcsv($output, self::HEADERS);

            ServiceFee::query()
                ->orderBy('category')
                ->orderBy('service_name')
                ->orderBy('id')
                ->each(function (ServiceFee $fee) use ($output): void {
                    fputcsv($output, [
                        $fee->category,
                        $fee->service_name,
                        $fee->unit,
                        $fee->price,
                    ]);
                });

            fclose($output);
        }, 'tarif-layanan.csv', [
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
        }, 'template-tarif-layanan.csv', [
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

            $record = ServiceFee::query()->updateOrCreate(
                [
                    'category' => preg_replace('/\s+/', ' ', trim(str_replace(['(', ')'], '', $data['kategori']))),
                    'service_name' => $data['uraian_layanan'],
                ],
                [
                    'unit' => (int) preg_replace('/[^0-9]/', '', $data['satuan'] ?? '') ?: 1,
                    'price' => max((int) ($data['tarif'] ?? 0), 0),
                ]
            );

            $record->wasRecentlyCreated ? $created++ : $updated++;
        }

        Storage::disk('local')->delete($path);

        return compact('created', 'updated', 'skipped');
    }

}
