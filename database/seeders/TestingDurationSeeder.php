<?php

namespace Database\Seeders;

use App\Models\TestingDuration;
use DOMDocument;
use DOMXPath;
use Illuminate\Database\Seeder;

class TestingDurationSeeder extends Seeder
{
    public function run(): void
    {
        $items = $this->itemsFromSourceHtml(storage_path('app/lama-pengujian-source.html'));

        if ($items === []) {
            $items = $this->fallbackItems();
        }

        TestingDuration::query()->delete();

        foreach ($items as $item) {
            TestingDuration::create($item);
        }
    }

    private function itemsFromSourceHtml(string $path): array
    {
        $html = file_exists($path)
            ? file_get_contents($path)
            : @file_get_contents('https://bpsmbsurakarta.com/index.php/jasa-layanan/jasa-pengujian/lama-pengujian');

        if (! $html) {
            return [];
        }

        libxml_use_internal_errors(true);

        $dom = new DOMDocument();
        $dom->loadHTML($html);
        $xpath = new DOMXPath($dom);
        $tables = $xpath->query('//table[@width="495"]');
        $items = [];
        $seen = [];
        $category = null;
        $parent = null;

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
                    $cells[] = trim($text);
                }

                if (count($cells) < 3) {
                    continue;
                }

                [$number, $name, $duration] = $cells;
                $name = $this->normalizeName($name);
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
                ];
            }
        }

        return $items;
    }

    private function normalizeName(string $name): string
    {
        $name = str_replace(['�', ' :'], [' ', ':'], $name);
        $name = preg_replace('/\s+/u', ' ', $name);
        $name = preg_replace('/\s+:/u', ':', $name);
        $name = preg_replace('/:\s*-/u', ': -', $name);

        return trim($name);
    }

    private function fallbackItems(): array
    {
        return [
            ['name' => 'Bau', 'category' => 'Pengujian Organoleptik', 'duration' => 1],
            ['name' => 'Rasa', 'category' => 'Pengujian Organoleptik', 'duration' => 1],
            ['name' => 'Warna', 'category' => 'Pengujian Organoleptik', 'duration' => 1],
            ['name' => 'Kadar air - metode oven', 'category' => 'Pengujian Kimia', 'duration' => 2],
            ['name' => 'Abu', 'category' => 'Pengujian Kimia', 'duration' => 2],
            ['name' => 'Serat kasar', 'category' => 'Pengujian Kimia', 'duration' => 2],
        ];
    }
}
