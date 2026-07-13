<?php

namespace App\Filament\Widgets;

use App\Models\VisitorStat;
use App\Models\Photo;
use App\Models\Video;
use App\Models\News;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalViews = VisitorStat::sum('total_views');
        $totalPhotos = Photo::count();
        $totalVideos = Video::count();
        $totalBerita = News::count();

        $visitorTrend = VisitorStat::query()
            ->orderBy('date', 'desc')
            ->limit(7)
            ->pluck('total_views')
            ->reverse()
            ->values()
            ->toArray();


        return [
            Stat::make('Total Kunjungan', $totalViews)
                ->icon('heroicon-m-eye')
                ->color('primary'),

            Stat::make('Total Berita', $totalBerita)
                ->icon('heroicon-m-document-text')
                ->color('danger'),

            Stat::make('Total Foto', $totalPhotos)
                ->icon('heroicon-m-photo')
                ->color('info'),

            Stat::make('Total Video', $totalVideos)
                ->icon('heroicon-m-video-camera')
                ->color('warning'),

        ];
    }
}
