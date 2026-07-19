<?php

namespace App\Filament\Widgets;

use App\Models\PageView;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class TopPagesTable extends BaseWidget
{
    protected static ?int $sort = 5;

    protected static ?string $heading = '5 Halaman Terpopuler';

    protected int | string | array $columnSpan = 6;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                PageView::query()->orderByDesc('views')->limit(5)
            )
            ->columns([
                TextColumn::make('title')
                    ->label('Nama Halaman')
                    ->wrap(),
                TextColumn::make('views')
                    ->label('Total Kunjungan')
                    ->badge()
                    ->color('warning')
                    ->alignEnd(),
            ])
            ->paginated(false);
    }
}
