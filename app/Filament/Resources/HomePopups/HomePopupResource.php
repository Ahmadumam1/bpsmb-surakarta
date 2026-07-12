<?php

namespace App\Filament\Resources\HomePopups;

use App\Filament\Concerns\AuthorizesResourceByRole;
use App\Filament\Resources\HomePopups\Pages\EditHomePopup;
use App\Filament\Resources\HomePopups\Pages\ListHomePopups;
use App\Models\HomePopup;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Navigation\NavigationItem;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HomePopupResource extends Resource
{
    use AuthorizesResourceByRole;

    protected static ?string $model = HomePopup::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static ?string $navigationLabel = 'Popup Pengumuman';

    protected static ?string $modelLabel = 'Popup Pengumuman';

    protected static ?string $pluralModelLabel = 'Popup Pengumuman';

    protected static string|\UnitEnum|null $navigationGroup = 'Home Page';

    protected static ?int $navigationSort = 4;

    public static function getNavigationItems(): array
    {
        return [
            NavigationItem::make(static::getNavigationLabel())
                ->group(static::getNavigationGroup())
                ->icon(static::getNavigationIcon())
                ->isActiveWhen(fn (): bool => request()->routeIs('filament.admin.resources.home-popups.*'))
                ->sort(static::getNavigationSort())
                ->url(static::getUrl('edit', ['record' => static::getEditableRecordKey()])),
        ];
    }

    public static function getEditableRecordKey(): int
    {
        return HomePopup::query()->oldest('id')->value('id')
            ?? HomePopup::query()->create([
                'title' => 'Popup Pengumuman',
                'is_active' => false,
            ])->getKey();
    }

    protected static function allowedRoles(): array
    {
        return ['superadmin', 'admin'];
    }

    protected static function permissionKey(): ?string
    {
        return 'home.popup';
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')
                ->label('Judul Popup')
                ->required()
                ->maxLength(255)
                ->columnSpanFull(),
            FileUpload::make('image')
                ->label('Gambar Pengumuman 1')
                ->image()
                ->disk('public')
                ->directory('home/popups')
                ->imageEditor()
                ->required()
                ->columnSpanFull(),
            FileUpload::make('image_2')
                ->label('Gambar Pengumuman 2 (Opsional)')
                ->image()
                ->disk('public')
                ->directory('home/popups')
                ->imageEditor()
                ->columnSpanFull(),
            FileUpload::make('image_3')
                ->label('Gambar Pengumuman 3 (Opsional)')
                ->image()
                ->disk('public')
                ->directory('home/popups')
                ->imageEditor()
                ->columnSpanFull(),
            TextInput::make('link_url')
                ->label('Tautan / Link Tujuan (Opsional)')
                ->url()
                ->placeholder('https://example.com/berita-atau-halaman')
                ->maxLength(255)
                ->columnSpanFull(),
            Toggle::make('is_active')
                ->label('Aktifkan Popup')
                ->default(false)
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHomePopups::route('/'),
            'edit' => EditHomePopup::route('/{record}/edit'),
        ];
    }
}
