<?php

namespace App\Filament\Resources\ProductCertificationInfos;

use App\Filament\Concerns\AuthorizesResourceByRole;
use App\Filament\Resources\ProductCertificationInfos\Pages\CreateProductCertificationInfo;
use App\Filament\Resources\ProductCertificationInfos\Pages\EditProductCertificationInfo;
use App\Filament\Resources\ProductCertificationInfos\Pages\ListProductCertificationInfos;
use App\Models\ProductCertificationInfo;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ProductCertificationInfoResource extends Resource
{
    use AuthorizesResourceByRole;

    protected static ?string $model = ProductCertificationInfo::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $navigationLabel = 'Informasi Sertifikasi Produk';

    protected static ?string $modelLabel = 'Informasi Sertifikasi Produk';

    protected static ?string $pluralModelLabel = 'Informasi Sertifikasi Produk';

    protected static string|\UnitEnum|null $navigationGroup = 'Jasa Layanan';

    protected static ?int $navigationSort = 5;


    protected static function permissionKey(): ?string
    {
        return 'services.product_certification_info';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('scheme')
                ->label('Skema')
                ->required()
                ->columnSpanFull()
                ->maxLength(255),
            TextInput::make('category')
                ->label('Kategori')
                ->required()
                ->columnSpanFull()
                ->maxLength(255),
            TextInput::make('product_type')
                ->label('Jenis Produk')
                ->required()
                ->maxLength(255)
                ->columnSpanFull(),
            TextInput::make('reference')
                ->label('Acuan')
                ->required()
                ->maxLength(255)
                ->columnSpanFull(),
            FileUpload::make('file_path')
                ->label('File PDF')
                ->disk('local')
                ->directory('product-certification/information')
                ->acceptedFileTypes(ProductCertificationInfo::ALLOWED_MIME_TYPES)
                ->maxSize(5120)
                ->downloadable(false)
                ->openable(false)
                ->helperText('Hanya PDF. Maksimal 5 MB.')
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query): Builder => $query->orderBy('scheme')->orderBy('category')->orderBy('product_type')->orderBy('id'))
            ->columns([
                TextColumn::make('no')->label('No')->rowIndex(),
                TextColumn::make('scheme')->label('Skema')->searchable()->sortable(),
                TextColumn::make('category')->label('Kategori')->searchable()->sortable()->wrap(),
                TextColumn::make('product_type')->label('Jenis Produk')->searchable()->sortable()->wrap(),
                TextColumn::make('reference')->label('Acuan')->searchable()->sortable()->wrap(),
            ])
            ->recordActions([
                Action::make('open')
                    ->label('Lihat')
                    ->icon(Heroicon::OutlinedArrowTopRightOnSquare)
                    ->url(fn (ProductCertificationInfo $record): string => $record->openUrl())
                    ->openUrlInNewTab()
                    ->visible(fn (ProductCertificationInfo $record): bool => filled($record->file_path)),
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function prepareInfoData(array $data): array
    {
        return $data;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProductCertificationInfos::route('/'),
            'create' => CreateProductCertificationInfo::route('/create'),
            'edit' => EditProductCertificationInfo::route('/{record}/edit'),
        ];
    }
}
