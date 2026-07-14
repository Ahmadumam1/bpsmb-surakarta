<?php

namespace App\Filament\Resources\Documents;

use App\Filament\Concerns\AuthorizesResourceByRole;
use App\Filament\Resources\Documents\Pages\CreateDocument;
use App\Filament\Resources\Documents\Pages\EditDocument;
use App\Filament\Resources\Documents\Pages\ListDocuments;
use App\Models\Document;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class DocumentResource extends Resource
{
    use AuthorizesResourceByRole;

    protected static ?string $model = Document::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowDownTray;

    protected static ?string $navigationLabel = 'Download Dokumen';

    protected static ?string $modelLabel = 'Download Dokumen';

    protected static ?string $pluralModelLabel = 'Download Dokumen';

    protected static string|\UnitEnum|null $navigationGroup = 'Lainnya';

    protected static ?int $navigationSort = 13;


    protected static function permissionKey(): ?string
    {
        return 'content.document';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')
                ->label('Nama dokumen')
                ->required()
                ->maxLength(255)
                ->columnSpanFull(),
            FileUpload::make('file_path')
                ->label('File dokumen')
                ->disk('public')
                ->columnSpanFull()
                ->directory('documents')
                ->acceptedFileTypes([
                    'application/pdf',
                    'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'application/vnd.ms-excel',
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'application/vnd.ms-powerpoint',
                    'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                    'image/jpeg',
                    'image/png',
                    'image/webp',
                ])
                ->maxSize(5120)
                ->rules([
                    fn (): \Closure => function (string $attribute, $value, \Closure $fail) {
                        if ($value instanceof \Illuminate\Http\UploadedFile) {
                            $isImage = str_starts_with($value->getMimeType(), 'image/');
                            $maxKb = $isImage ? 2048 : 5120;
                            if ($value->getSize() > $maxKb * 1024) {
                                $fail($isImage ? 'Ukuran gambar tidak boleh lebih dari 2 MB.' : 'Ukuran file tidak boleh lebih dari 5 MB.');
                            }
                        }
                    },
                ])
                ->downloadable(false)
                ->openable(false)
                ->required()
                ->helperText('PDF, Word, Excel, PPT (Maks. 5 MB) atau JPG, PNG, WEBP (Maks. 2 MB).'),
            Hidden::make('file_type'),
            Toggle::make('is_active')
                ->label('Tampilkan ke publik')
                ->default(true)
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query): Builder => $query->orderBy('title'))
            ->columns([
                TextColumn::make('no')->label('No')->rowIndex(),
                TextColumn::make('title')->label('Nama dokumen')->searchable()->sortable()->wrap(),
                TextColumn::make('file_type')
                    ->label('Format')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => strtoupper($state ?? '-')),
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
                Action::make('view_file')
                    ->label('Lihat')
                    ->icon(Heroicon::OutlinedEye)
                    ->url(fn (Document $record): string => $record->viewUrl())
                    ->openUrlInNewTab()
                    ->visible(fn (Document $record): bool => $record->is_active && filled($record->file_path)),
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function resolveFileType(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        return strtolower(pathinfo($path, PATHINFO_EXTENSION)) ?: null;
    }

    public static function prepareDocumentData(array $data): array
    {
        $data['file_type'] = static::resolveFileType($data['file_path'] ?? null);

        return $data;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDocuments::route('/'),
            'create' => CreateDocument::route('/create'),
            'edit' => EditDocument::route('/{record}/edit'),
        ];
    }
}
