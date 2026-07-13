<?php

namespace App\Filament\Resources\CostDocuments;

use App\Filament\Concerns\AuthorizesResourceByRole;
use App\Filament\Resources\CostDocuments\Pages\CreateCostDocument;
use App\Filament\Resources\CostDocuments\Pages\EditCostDocument;
use App\Filament\Resources\CostDocuments\Pages\ListCostDocuments;
use App\Models\CostDocument;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CostDocumentResource extends Resource
{
    use AuthorizesResourceByRole;

    protected static ?string $model = CostDocument::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $navigationLabel = 'Dokumen Biaya Layanan';

    protected static ?string $modelLabel = 'Dokumen Biaya Layanan';

    protected static ?string $pluralModelLabel = 'Dokumen Biaya Layanan';

    protected static string|\UnitEnum|null $navigationGroup = 'Biaya Layanan';

    protected static ?int $navigationSort = 2;


    protected static function permissionKey(): ?string
    {
        return 'content.cost_document';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')
                ->label('Judul dokumen')
                ->default('Daftar Biaya Layanan')
                ->required()
                ->maxLength(255),
            FileUpload::make('file_path')
                ->label('File PDF')
                ->disk('local')
                ->directory('costs')
                ->acceptedFileTypes([CostDocument::PDF_MIME_TYPE])
                ->maxSize(5120)
                ->downloadable(false)
                ->openable(false)
                ->required()
                ->helperText('Hanya file PDF. Maksimal 5 MB.'),
            TextInput::make('sort_order')
                ->label('Urutan')
                ->numeric()
                ->default(0)
                ->required(),
            Toggle::make('is_active')
                ->label('Aktif')
                ->default(true)
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query): Builder => $query->orderBy('sort_order')->orderByDesc('id'))
            ->columns([
                TextColumn::make('no')->label('No')->rowIndex(),
                TextColumn::make('title')->label('Judul')->searchable()->sortable()->wrap(),
                TextColumn::make('sort_order')->label('Urutan')->sortable(),
                TextColumn::make('is_active')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Aktif' : 'Nonaktif')
                    ->color(fn (bool $state): string => $state ? 'success' : 'gray'),
            ])
            ->filters([
                TernaryFilter::make('is_active')->label('Aktif'),
            ])
            ->recordActions([
                Action::make('open')
                    ->label('Buka')
                    ->icon(Heroicon::OutlinedArrowTopRightOnSquare)
                    ->url(fn (CostDocument $record): string => $record->openUrl())
                    ->openUrlInNewTab()
                    ->visible(fn (CostDocument $record): bool => $record->is_active && filled($record->file_path)),
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCostDocuments::route('/'),
            'create' => CreateCostDocument::route('/create'),
            'edit' => EditCostDocument::route('/{record}/edit'),
        ];
    }
}
