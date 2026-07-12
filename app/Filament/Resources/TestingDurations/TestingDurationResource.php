<?php

namespace App\Filament\Resources\TestingDurations;

use App\Filament\Concerns\AuthorizesResourceByRole;
use App\Filament\Resources\TestingDurations\Pages\CreateTestingDuration;
use App\Filament\Resources\TestingDurations\Pages\EditTestingDuration;
use App\Filament\Resources\TestingDurations\Pages\ListTestingDurations;
use App\Models\TestingDuration;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TestingDurationResource extends Resource
{
    use AuthorizesResourceByRole;

    protected static ?string $model = TestingDuration::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClock;

    protected static ?string $navigationLabel = 'Lama Pengujian';

    protected static ?string $modelLabel = 'Lama Pengujian';

    protected static ?string $pluralModelLabel = 'Lama Pengujian';

    protected static string|\UnitEnum|null $navigationGroup = 'Jasa Layanan';

    protected static ?int $navigationSort = 1;

    protected static function allowedRoles(): array
    {
        return ['superadmin', 'admin'];
    }

    protected static function permissionKey(): ?string
    {
        return 'services.testing_duration';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->label('Karakteristik uji')
                ->required()
                ->maxLength(255)
                ->columnSpanFull(),
            Select::make('category')
                ->label('Kategori')
                ->required()
                ->searchable()
                ->options([
                    'Organoleptik' => 'Organoleptik',
                    'Kimia' => 'Kimia',
                    'Mikrobiologi' => 'Mikrobiologi',
                    'Pengujian Khusus' => 'Pengujian Khusus',
                ])
                ->createOptionForm([
                    TextInput::make('category')
                        ->label('Kategori baru')
                        ->required()
                        ->maxLength(255),
                ])
                ->createOptionUsing(fn (array $data): string => $data['category'])
                ->columnSpanFull(),
            TextInput::make('duration')
                ->label('Durasi')
                ->numeric()
                ->minValue(1)
                ->suffix('hari kerja')
                ->default(1)
                ->required()
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query): Builder => $query->orderBy('category')->orderBy('name')->orderBy('id'))
            ->columns([
                TextColumn::make('no')->label('No')->rowIndex(),
                TextColumn::make('name')->label('Karakteristik uji')->searchable()->sortable(),
                TextColumn::make('category')->label('Kategori')->searchable()->sortable(),
                TextColumn::make('duration')
                    ->label('Durasi')
                    ->formatStateUsing(fn (TestingDuration $record): string => "{$record->duration} hari kerja")
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->label('Kategori')
                    ->options(fn (): array => TestingDuration::query()
                        ->orderBy('category')
                        ->pluck('category', 'category')
                        ->unique()
                        ->all()),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTestingDurations::route('/'),
            'create' => CreateTestingDuration::route('/create'),
            'edit' => EditTestingDuration::route('/{record}/edit'),
        ];
    }
}
