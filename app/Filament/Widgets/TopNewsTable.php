<?php

namespace App\Filament\Widgets;

use App\Models\News;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class TopNewsTable extends BaseWidget
{
    protected static ?int $sort = 4;

    protected static ?string $heading = '5 Berita Terpopuler';

    protected int | string | array $columnSpan = 6;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                News::query()->published()->orderByDesc('views')->limit(5)
            )
            ->columns([
                TextColumn::make('title')
                    ->label('Judul Berita')
                    ->wrap(),
                TextColumn::make('views')
                    ->label('Total Tayangan')
                    ->badge()
                    ->color('success')
                    ->alignEnd(),
            ])
            ->paginated(false);
    }
}
