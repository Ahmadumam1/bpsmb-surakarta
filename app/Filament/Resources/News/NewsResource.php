<?php

namespace App\Filament\Resources\News;

use App\Filament\Concerns\AuthorizesResourceByRole;
use App\Filament\Resources\News\Pages\CreateNews;
use App\Filament\Resources\News\Pages\EditNews;
use App\Filament\Resources\News\Pages\ListNews;
use App\Models\News;
use App\Models\NewsCategory;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class NewsResource extends Resource
{
    use AuthorizesResourceByRole;

    protected static ?string $model = News::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedNewspaper;

    protected static ?string $navigationLabel = 'Berita';

    protected static ?string $modelLabel = 'Berita';

    protected static ?string $pluralModelLabel = 'Berita';

    protected static string|\UnitEnum|null $navigationGroup = 'Media';

    protected static ?int $navigationSort = 1;

    protected static function allowedRoles(): array
    {
        return ['superadmin', 'admin'];
    }

    protected static function permissionKey(): ?string
    {
        return 'media.news';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')->label('Judul')->required()->maxLength(255)->columnSpanFull(),
            Hidden::make('slug'),
            Select::make('category_id')
                ->label('Kategori')
                ->options(fn (): array => NewsCategory::query()->where('type', 'news')->orderBy('name')->pluck('name', 'id')->all())
                ->searchable()
                ->preload()
                ->nullable(),
            TextInput::make('author')->label('Penulis')->maxLength(255),
            DateTimePicker::make('published_at')->label('Tanggal publikasi')->seconds(false)->default(now()),
            Toggle::make('is_published')->label('Publikasikan')->default(true)->required(),
            FileUpload::make('thumbnail')->label('Thumbnail')->image()->disk('public')->directory('news')->imageEditor()->columnSpanFull(),
            Textarea::make('excerpt')->label('Ringkasan')->rows(3)->maxLength(500)->columnSpanFull(),
            RichEditor::make('content')
                ->label('Isi berita')
                ->required()
                ->extraInputAttributes(['style' => 'min-height: 320px;'])
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query): Builder => $query->with('category')->latest('published_at')->latest('id'))
            ->columns([
                TextColumn::make('no')->label('No')->rowIndex(),
                ImageColumn::make('thumbnail')->label('Thumbnail')->disk('public')->square(),
                TextColumn::make('title')->label('Judul')->searchable()->sortable()->wrap(),
                TextColumn::make('category.name')->label('Kategori')->badge()->placeholder('Berita')->searchable()->sortable(),
                TextColumn::make('is_published')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Terbit' : 'Draft')
                    ->color(fn (bool $state): string => $state ? 'success' : 'gray'),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name', fn (Builder $query): Builder => $query->where('type', 'news')),
                TernaryFilter::make('is_published')->label('Terbit'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function prepareNewsData(array $data): array
    {
        $data['slug'] = Str::slug($data['title'] ?? '');

        return $data;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListNews::route('/'),
            'create' => CreateNews::route('/create'),
            'edit' => EditNews::route('/{record}/edit'),
        ];
    }
}
