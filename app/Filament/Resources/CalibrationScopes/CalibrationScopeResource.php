<?php

namespace App\Filament\Resources\CalibrationScopes;

use App\Filament\Concerns\AuthorizesResourceByRole;
use App\Filament\Resources\CalibrationScopes\Pages\CreateCalibrationScope;
use App\Filament\Resources\CalibrationScopes\Pages\EditCalibrationScope;
use App\Filament\Resources\CalibrationScopes\Pages\ListCalibrationScopes;
use App\Models\CalibrationScope;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CalibrationScopeResource extends Resource
{
    use AuthorizesResourceByRole;

    protected static ?string $model = CalibrationScope::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static ?string $navigationLabel = 'Ruang Lingkup Kalibrasi';

    protected static ?string $modelLabel = 'Ruang Lingkup Kalibrasi';

    protected static ?string $pluralModelLabel = 'Ruang Lingkup Kalibrasi';

    protected static string|\UnitEnum|null $navigationGroup = 'Jasa Layanan';

    protected static ?int $navigationSort = 3;

    protected static function allowedRoles(): array
    {
        return ['superadmin', 'admin'];
    }

    protected static function permissionKey(): ?string
    {
        return 'services.calibration_scope';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('category')
                ->label('Kategori')
                ->required()
                ->searchable()
                ->options(fn (): array => CalibrationScope::query()
                    ->orderBy('category')
                    ->pluck('category', 'category')
                    ->unique()
                    ->all())
                ->createOptionForm([
                    TextInput::make('category')
                        ->label('Kategori baru')
                        ->required()
                        ->maxLength(255),
                ])
                ->createOptionUsing(fn (array $data): string => $data['category'])
                ->columnSpanFull(),
            Textarea::make('item')
                ->label('Alat / ruang lingkup')
                ->required()
                ->rows(3)
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query): Builder => $query->orderBy('category')->orderBy('id'))
            ->columns([
                TextColumn::make('no')->label('No')->rowIndex(),
                TextColumn::make('category')->label('Kategori')->searchable()->wrap()->limit(70),
                TextColumn::make('item')->label('Alat / ruang lingkup')->searchable()->wrap()->limit(70),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->label('Kategori')
                    ->options(fn (): array => CalibrationScope::query()
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
            'index' => ListCalibrationScopes::route('/'),
            'create' => CreateCalibrationScope::route('/create'),
            'edit' => EditCalibrationScope::route('/{record}/edit'),
        ];
    }
}
