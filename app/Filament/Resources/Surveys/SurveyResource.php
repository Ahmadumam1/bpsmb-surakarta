<?php

namespace App\Filament\Resources\Surveys;

use App\Filament\Concerns\AuthorizesResourceByRole;
use App\Filament\Resources\Surveys\Pages\CreateSurvey;
use App\Filament\Resources\Surveys\Pages\EditSurvey;
use App\Filament\Resources\Surveys\Pages\ListSurveys;
use App\Models\Survey;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
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

class SurveyResource extends Resource
{
    use AuthorizesResourceByRole;

    protected static ?string $model = Survey::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;

    protected static ?string $navigationLabel = 'Survei Kepuasan Pelanggan';

    protected static ?string $modelLabel = 'Survei Kepuasan Pelanggan';

    protected static ?string $pluralModelLabel = 'Survei Kepuasan Pelanggan';

    protected static string|\UnitEnum|null $navigationGroup = 'Lainnya';

    protected static ?int $navigationSort = 12;


    protected static function permissionKey(): ?string
    {
        return 'content.survey';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')
                ->label('Judul')
                ->default('Survei Kepuasan Pelanggan')
                ->required()
                ->maxLength(255),
            Textarea::make('description')
                ->label('Deskripsi')
                ->rows(3)
                ->columnSpanFull(),
            FileUpload::make('file_path')
                ->label('File gambar atau PDF')
                ->disk('local')
                ->directory('surveys/satisfaction')
                ->acceptedFileTypes(Survey::ALLOWED_MIME_TYPES)
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
                ->helperText('Hanya PDF (Maks. 5 MB) atau JPG, PNG, WEBP (Maks. 2 MB). File ditampilkan di halaman Survei Kepuasan Pelanggan.'),
            Hidden::make('file_type'),
            TextInput::make('sort_order')
                ->label('Urutan')
                ->numeric()
                ->default(0)
                ->required(),
            Toggle::make('is_active')
                ->label('Tampilkan ke publik')
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
                TextColumn::make('file_type')->label('Tipe')->badge()->formatStateUsing(fn (?string $state): string => strtoupper($state ?? '-')),
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
                    ->url(fn (Survey $record): string => $record->openUrl())
                    ->openUrlInNewTab()
                    ->visible(fn (Survey $record): bool => $record->is_active && filled($record->file_path)),
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

        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        return array_key_exists($extension, Survey::MIME_TYPES_BY_EXTENSION) ? $extension : null;
    }

    public static function prepareSurveyData(array $data): array
    {
        $data['file_type'] = static::resolveFileType($data['file_path'] ?? null);

        return $data;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSurveys::route('/'),
            'create' => CreateSurvey::route('/create'),
            'edit' => EditSurvey::route('/{record}/edit'),
        ];
    }
}
