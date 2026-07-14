<?php

namespace App\Support;

class CsvReader
{
    public static function normalizeHeaders(array $headers): array
    {
        return array_map(
            fn(string $header): string => str_replace([' ', '-'], '_', strtolower(trim($header, "\xEF\xBB\xBF \t\n\r\0\x0B"))),
            $headers,
        );
    }

    public static function detectDelimiter(string $fullPath): string
    {
        $handle = fopen($fullPath, 'rb');

        if ($handle === false) {
            return ',';
        }

        $firstLine = (string) fgets($handle);
        fclose($handle);

        return substr_count($firstLine, ';') > substr_count($firstLine, ',') ? ';' : ',';
    }

    public static function mapRow(array $headers, array $row): array
    {
        $data = [];

        foreach ($headers as $index => $header) {
            $data[$header] = $row[$index] ?? '';
        }

        return $data;
    }
}
