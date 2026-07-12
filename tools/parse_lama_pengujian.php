<?php

$html = file_get_contents(__DIR__ . '/../storage/app/lama-pengujian-source.html');

libxml_use_internal_errors(true);

$dom = new DOMDocument();
$dom->loadHTML($html);

$xpath = new DOMXPath($dom);
$tables = $xpath->query('//table[@width="495"]');

echo 'tables=' . $tables->length . PHP_EOL;

foreach ($tables as $tableIndex => $table) {
    echo 'TABLE ' . ($tableIndex + 1) . PHP_EOL;

    $rows = $xpath->query('.//tr', $table);

    foreach ($rows as $rowIndex => $row) {
        $cells = [];

        foreach ($xpath->query('./td|./th', $row) as $cell) {
            $text = html_entity_decode($cell->textContent, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $text = preg_replace('/\s+/u', ' ', $text);
            $text = str_replace("\xC2\xA0", ' ', $text);
            $text = trim($text);

            $cells[] = $text;
        }

        if (count($cells) >= 2) {
            echo ($rowIndex + 1) . ': ' . implode(' | ', $cells) . PHP_EOL;
        }
    }
}
