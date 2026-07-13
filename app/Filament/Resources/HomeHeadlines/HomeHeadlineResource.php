<?php

namespace App\Filament\Resources\HomeHeadlines;

use App\Filament\Concerns\AuthorizesResourceByRole;
use App\Filament\Resources\HomeHeadlines\Pages\EditHomeHeadline;
use App\Filament\Resources\HomeHeadlines\Pages\ListHomeHeadlines;
use App\Models\HomeHeadline;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Navigation\NavigationItem;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HomeHeadlineResource extends Resource
{
    use AuthorizesResourceByRole;

    protected static ?string $model = HomeHeadline::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMegaphone;

    protected static ?string $navigationLabel = 'Headline';

    protected static ?string $modelLabel = 'Headline';

    protected static ?string $pluralModelLabel = 'Headline';

    protected static string|\UnitEnum|null $navigationGroup = 'Home Page';

    protected static ?int $navigationSort = 1;

    public static function getNavigationItems(): array
    {
        return [
            NavigationItem::make(static::getNavigationLabel())
                ->group(static::getNavigationGroup())
                ->icon(static::getNavigationIcon())
                ->isActiveWhen(fn (): bool => request()->routeIs('filament.admin.resources.home-headlines.*'))
                ->sort(static::getNavigationSort())
                ->url(static::getUrl('edit', ['record' => static::getEditableRecordKey()])),
        ];
    }

    public static function getEditableRecordKey(): int
    {
        return HomeHeadline::query()->oldest('id')->value('id')
            ?? HomeHeadline::query()->create([
                'title' => 'Headline Homepage',
                'is_active' => true,
            ])->getKey();
    }


    protected static function permissionKey(): ?string
    {
        return 'home.headline';
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('subtitle')->label('Label kecil')->maxLength(255)->columnSpanFull(),
            TextInput::make('title')->label('Judul')->required()->columnSpanFull(),
            Textarea::make('description')->label('Deskripsi')->rows(4)->columnSpanFull(),
            FileUpload::make('image')
                ->label('Foto headline 1')
                ->image()
                ->disk('public')
                ->directory('home/headlines')
                ->imageEditor()
                ->maxSize(2048)
                ->helperText('Gambar PNG, JPG, atau WEBP. Maksimal 2 MB.')
                ->columnSpanFull(),
            FileUpload::make('image_2')
                ->label('Foto headline 2')
                ->image()
                ->disk('public')
                ->directory('home/headlines')
                ->imageEditor()
                ->maxSize(2048)
                ->helperText('Gambar PNG, JPG, atau WEBP. Maksimal 2 MB.'),
            FileUpload::make('image_3')
                ->label('Foto headline 3')
                ->image()
                ->disk('public')
                ->directory('home/headlines')
                ->imageEditor()
                ->maxSize(2048)
                ->helperText('Gambar PNG, JPG, atau WEBP. Maksimal 2 MB.'),
            TextInput::make('primary_button_label')->label('Label tombol utama')->maxLength(255),
            TextInput::make('primary_button_url')->label('URL tombol utama')->maxLength(255),
            TextInput::make('secondary_button_label')->label('Label tombol kedua')->maxLength(255),
            TextInput::make('secondary_button_url')->label('URL tombol kedua')->maxLength(255),
            Toggle::make('is_active')->label('Aktif')->default(true)->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHomeHeadlines::route('/'),
            'edit' => EditHomeHeadline::route('/{record}/edit'),
        ];
    }
}
