<?php

namespace App\Filament\Resources\SampleCollectionFees;

use App\Filament\Concerns\AuthorizesResourceByRole;
use App\Filament\Resources\SampleCollectionFees\Pages\CreateSampleCollectionFee;
use App\Filament\Resources\SampleCollectionFees\Pages\EditSampleCollectionFee;
use App\Filament\Resources\SampleCollectionFees\Pages\ListSampleCollectionFees;
use App\Models\SampleCollectionFee;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SampleCollectionFeeResource extends Resource
{
    use AuthorizesResourceByRole;

    protected static ?string $model = SampleCollectionFee::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    protected static ?string $navigationLabel = 'Pengambilan Contoh';

    protected static ?string $modelLabel = 'Biaya Pengambilan Contoh';

    protected static ?string $pluralModelLabel = 'Biaya Pengambilan Contoh';

    protected static string|\UnitEnum|null $navigationGroup = 'Jasa Layanan';

    protected static ?int $navigationSort = 6;


    protected static function permissionKey(): ?string
    {
        return 'services.sample_collection_fee';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('description')
                ->label('Uraian')
                ->required()
                ->columnSpanFull()
                ->maxLength(255),
            TextInput::make('sample_count')
                ->label('Sampel')
                ->numeric()
                ->minValue(1)
                ->default(1)
                ->suffix('sample')
                ->required(),
            TextInput::make('fee')
                ->label('Biaya')
                ->numeric()
                ->prefix('Rp')
                ->minValue(0)
                ->default(100000)
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query): Builder => $query->orderBy('description')->orderBy('id'))
            ->columns([
                TextColumn::make('no')->label('No')->rowIndex(),
                TextColumn::make('description')->label('Uraian')->searchable()->sortable()->wrap(),
                TextColumn::make('sample_count')
                    ->label('Sampel')
                    ->formatStateUsing(fn(SampleCollectionFee $record): string => $record->formattedSample())
                    ->sortable(),
                TextColumn::make('fee')
                    ->label('Biaya')
                    ->money('IDR', locale: 'id')
                    ->sortable(),
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
            'index' => ListSampleCollectionFees::route('/'),
            'create' => CreateSampleCollectionFee::route('/create'),
            'edit' => EditSampleCollectionFee::route('/{record}/edit'),
        ];
    }
}
