<?php

use App\Models\TestingDuration;
use Illuminate\Contracts\Console\Kernel;

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Kernel::class)->bootstrap();

$html = file_get_contents(__DIR__ . '/../storage/app/lama-pengujian-source.html');

libxml_use_internal_errors(true);

$dom = new DOMDocument();
$dom->loadHTML($html);
$xpath = new DOMXPath($dom);
$tables = $xpath->query('//table[@width="495"]');

$items = [];
$seen = [];
$category = null;
$parent = null;
$sort = 1;

foreach ($tables as $tableIndex => $table) {
    if ($tableIndex >= 6) {
        break;
    }

    foreach ($xpath->query('.//tr', $table) as $row) {
        $cells = [];

        foreach ($xpath->query('./td|./th', $row) as $cell) {
            $text = html_entity_decode($cell->textContent, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $text = preg_replace('/\s+/u', ' ', $text);
            $text = str_replace(["\xC2\xA0", '�'], ' ', $text);
            $text = trim($text);

            $cells[] = $text;
        }

        if (count($cells) < 3) {
            continue;
        }

        [$number, $name, $duration] = $cells;
        $name = normalize_testing_name($name);
        $duration = trim($duration);

        if ($name === '' || str_contains($name, 'KARAKTERISTIK UJI')) {
            continue;
        }

        if (str_contains($name, 'PENGUJIAN ORGANOLEPTIK')) {
            $category = 'Pengujian Organoleptik';
            $parent = null;
            continue;
        }

        if (str_contains($name, 'PENGUJIAN KIMIA')) {
            $category = 'Pengujian Kimia';
            $parent = null;
            continue;
        }

        if (! is_numeric($duration)) {
            if (str_ends_with($name, ':')) {
                $parent = rtrim($name, ': ');
            }

            continue;
        }

        if ($category === null) {
            continue;
        }

        if ($number === '' && $parent !== null) {
            $name = $parent . ' - ' . ltrim($name, '- ');
        } elseif (str_contains($name, ': -')) {
            [$base, $detail] = explode(': -', $name, 2);
            $parent = trim($base);
            $name = $parent . ' - ' . trim($detail);
        } elseif (str_ends_with($name, ':')) {
            $parent = rtrim($name, ': ');
            continue;
        } else {
            $parent = null;
        }

        $key = mb_strtolower($category . '|' . $name . '|' . $duration);

        if (isset($seen[$key])) {
            continue;
        }

        $seen[$key] = true;
        $items[] = [
            'name' => $name,
            'category' => $category,
            'duration' => (int) $duration,
            'unit' => 'hari kerja',
            'sort_order' => $sort++,
            'is_active' => true,
        ];
    }
}

TestingDuration::query()->delete();

foreach ($items as $item) {
    TestingDuration::create($item);
}

echo 'Synced ' . count($items) . ' testing duration rows.' . PHP_EOL;

function normalize_testing_name(string $name): string
{
    $name = str_replace(['�', ' :'], [' ', ':'], $name);
    $name = preg_replace('/\s+/u', ' ', $name);
    $name = preg_replace('/\s+:/u', ':', $name);
    $name = preg_replace('/:\s*-/u', ': -', $name);

    return trim($name);
}
