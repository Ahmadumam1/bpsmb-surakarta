<?php

namespace App\Filament\Resources\LphSections;

use App\Filament\Concerns\AuthorizesResourceByRole;
use App\Filament\Resources\LphSections\Pages\CreateLphSection;
use App\Filament\Resources\LphSections\Pages\EditLphSection;
use App\Filament\Resources\LphSections\Pages\ListLphSections;
use App\Models\LphSection;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class LphSectionResource extends Resource
{
    use AuthorizesResourceByRole;

    protected static ?string $model = LphSection::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShieldCheck;

    protected static ?string $navigationLabel = 'LPH';

    protected static ?string $modelLabel = 'Konten LPH';

    protected static ?string $pluralModelLabel = 'Konten LPH';

    protected static string|\UnitEnum|null $navigationGroup = 'Jasa Layanan';

    protected static ?int $navigationSort = 9;


    protected static function permissionKey(): ?string
    {
        return 'services.lph_section';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('tab_label')
                ->label('Label Tab')
                ->required()
                ->maxLength(80),
            TextInput::make('slug')
                ->label('Slug / ID Panel')
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(120)
                ->helperText('Contoh: lingkup-lph. Dipakai untuk hash URL.'),
            TextInput::make('eyebrow')
                ->label('Label Kecil')
                ->maxLength(150),
            TextInput::make('title')
                ->label('Judul')
                ->required()
                ->maxLength(255)
                ->columnSpanFull(),
            Textarea::make('description')
                ->label('Deskripsi')
                ->rows(4)
                ->columnSpanFull(),
            Repeater::make('items')
                ->label('Daftar Isi / Poin')
                ->schema([
                    TextInput::make('title')
                        ->label('Judul / Poin')
                        ->required()
                        ->maxLength(255),
                    Textarea::make('description')
                        ->label('Keterangan')
                        ->rows(3),
                    FileUpload::make('file_path')
                        ->label('File')
                        ->disk('public')
                        ->directory('lph/documents')
                        ->acceptedFileTypes([
                            'application/pdf',
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
                        ->helperText('Opsional. PDF (Maks. 5 MB) atau JPG, PNG, WEBP (Maks. 2 MB).'),
                ])
                ->defaultItems(0)
                ->addActionLabel('Tambah poin')
                ->reorderable()
                ->columnSpanFull(),
            TextInput::make('primary_button_label')
                ->label('Tombol Utama'),
            TextInput::make('primary_button_url')
                ->label('URL Tombol Utama')
                ->helperText('Boleh URL lengkap, misalnya https://..., atau path lokal seperti /kontak.'),
            TextInput::make('secondary_button_label')
                ->label('Tombol Kedua'),
            TextInput::make('secondary_button_url')
                ->label('URL Tombol Kedua')
                ->helperText('Boleh URL lengkap, misalnya https://..., atau path lokal seperti /kontak.'),
            Toggle::make('is_active')
                ->label('Tampilkan ke publik')
                ->default(true)
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query): Builder => $query->orderBy('id'))
            ->columns([
                TextColumn::make('no')->label('No')->rowIndex(),
                TextColumn::make('tab_label')->label('Tab')->searchable()->sortable(),
                TextColumn::make('title')->label('Judul')->searchable()->sortable()->wrap(),
                TextColumn::make('slug')->label('Slug')->badge()->color('gray'),
                TextColumn::make('items')
                    ->label('Poin')
                    ->formatStateUsing(fn (?array $state): string => (string) count($state ?? []))
                    ->badge()
                    ->color('info'),
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
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLphSections::route('/'),
            'create' => CreateLphSection::route('/create'),
            'edit' => EditLphSection::route('/{record}/edit'),
        ];
    }
}
