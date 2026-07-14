<?php

namespace App\Filament\Resources\ServiceFees;

use App\Filament\Concerns\AuthorizesResourceByRole;
use App\Filament\Resources\ServiceFees\Pages\CreateServiceFee;
use App\Filament\Resources\ServiceFees\Pages\EditServiceFee;
use App\Filament\Resources\ServiceFees\Pages\ListServiceFees;
use App\Models\ServiceFee;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
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

class ServiceFeeResource extends Resource
{
    use AuthorizesResourceByRole;

    protected static ?string $model = ServiceFee::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBanknotes;

    protected static ?string $navigationLabel = 'Biaya Layanan';

    protected static ?string $modelLabel = 'Biaya Layanan';

    protected static ?string $pluralModelLabel = 'Biaya Layanan';

    protected static string|\UnitEnum|null $navigationGroup = 'Biaya Layanan';

    protected static ?int $navigationSort = 1;


    protected static function permissionKey(): ?string
    {
        return 'services.service_fee';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('category')
                ->label('Kategori')
                ->required()
                ->searchable()
                ->options(fn (): array => ServiceFee::query()
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
                ->createOptionUsing(fn (array $data): string => $data['category']),
            TextInput::make('service_name')
                ->label('Uraian layanan')
                ->required()
                ->maxLength(255),

            TextInput::make('unit')
                ->label('Satuan')
                ->numeric()
                ->default(1)
                ->suffix('Sampel')
                ->required(),
            TextInput::make('price')
                ->label('Tarif')
                ->numeric()
                ->prefix('Rp')
                ->minValue(0)
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query): Builder => $query->orderBy('category')->orderBy('service_name')->orderBy('id'))
            ->columns([
                TextColumn::make('no')->label('No')->rowIndex(),
                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('service_name')->label('Uraian layanan')->searchable()->sortable()->wrap(),
                TextColumn::make('unit')->label('Satuan')->suffix(' Sampel')->searchable()->sortable(),
                TextColumn::make('price')
                    ->label('Tarif')
                    ->money('IDR', locale: 'id')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->label('Kategori')
                    ->options(fn (): array => ServiceFee::query()
                        ->orderBy('category')
                        ->pluck('category', 'category')
                        ->unique()
                        ->all()),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListServiceFees::route('/'),
            'create' => CreateServiceFee::route('/create'),
            'edit' => EditServiceFee::route('/{record}/edit'),
        ];
    }
}
