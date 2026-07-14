<?php

namespace App\Support;

use App\Models\ProductCertificationInfo;
use App\Support\CsvReader;
use Illuminate\Support\Facades\Storage;
use SplFileObject;

class ProductCertificationInfoCsv
{
    public const HEADERS = [
        'skema',
        'kategori',
        'jenis_produk',
        'acuan',
        'file_path',
    ];

    public static function streamExport()
    {
        return response()->streamDownload(function (): void {
            $output = fopen('php://output', 'wb');
            fwrite($output, "\xEF\xBB\xBF");
            fputcsv($output, self::HEADERS);

            ProductCertificationInfo::query()
                ->orderBy('scheme')
                ->orderBy('category')
                ->orderBy('product_type')
                ->each(function (ProductCertificationInfo $info) use ($output): void {
                    fputcsv($output, [
                        $info->scheme,
                        $info->category,
                        $info->product_type,
                        $info->reference,
                        $info->file_path,
                    ]);
                });

            fclose($output);
        }, 'informasi-sertifikasi-produk.csv', [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    public static function streamTemplate()
    {
        return response()->streamDownload(function (): void {
            $output = fopen('php://output', 'wb');
            fwrite($output, "\xEF\xBB\xBF");
            // Only export the main 4 text fields in the template to keep it simple for users
            fputcsv($output, [
                'skema',
                'kategori',
                'jenis_produk',
                'acuan',
            ]);
            fclose($output);
        }, 'template-sertifikasi-produk.csv', [
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

            $updateData = [
                'reference' => $data['acuan'],
            ];

            if (filled($data['file_path'] ?? null)) {
                $updateData['file_path'] = $data['file_path'];
            }

            $record = ProductCertificationInfo::query()->updateOrCreate(
                [
                    'scheme' => $data['skema'],
                    'category' => $data['kategori'],
                    'product_type' => $data['jenis_produk'],
                ],
                $updateData
            );

            $record->wasRecentlyCreated ? $created++ : $updated++;
        }

        Storage::disk('local')->delete($path);

        return compact('created', 'updated', 'skipped');
    }

}
