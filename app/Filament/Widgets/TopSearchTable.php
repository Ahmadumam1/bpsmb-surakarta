<?php

namespace App\Filament\Widgets;

use App\Models\SearchLog;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\DB;

class TopSearchTable extends BaseWidget
{
    protected static ?int $sort = 3;

    protected static ?string $heading = '5 Pencarian Terpopuler';

    protected int | string | array $columnSpan = 4;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                SearchLog::query()
                    ->select('keyword', DB::raw('count(*) as total'))
                    ->groupBy('keyword')
                    ->orderByDesc('total')
                    ->limit(5)
            )
            ->columns([
                TextColumn::make('keyword')
                    ->label('Kata Kunci')
                    ->wrap(),
                TextColumn::make('total')
                    ->label('Jumlah Pencarian')
                    ->badge()
                    ->color('info')
                    ->alignEnd(),
            ])
            ->paginated(false);
    }
}
