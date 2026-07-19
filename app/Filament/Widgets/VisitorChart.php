<?php

namespace App\Filament\Widgets;

use App\Models\VisitorStat;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class VisitorChart extends ChartWidget
{
    protected static ?int $sort = 2;

    protected ?string $heading = 'Grafik Kunjungan (30 Hari Terakhir)';

    protected int | string | array $columnSpan = 8;

    protected ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $data = VisitorStat::query()
            ->orderBy('date', 'desc')
            ->limit(30)
            ->get()
            ->sortBy('date')
            ->values();

        return [
            'datasets' => [
                [
                    'label' => 'Total Tayangan',
                    'data' => $data->pluck('total_views')->toArray(),
                    'borderColor' => '#08236f',
                    'backgroundColor' => 'rgba(8, 35, 111, 0.1)',
                    'fill' => 'start',
                ],
            ],
            'labels' => $data->pluck('date')->map(fn($date) => Carbon::parse($date)->format('d M'))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
