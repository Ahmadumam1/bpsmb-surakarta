<?php

namespace App\Filament\Resources\ProfilePages;

use App\Filament\Concerns\AuthorizesResourceByRole;
use App\Filament\Resources\ProfilePages\Pages\EditProfilePage;
use App\Filament\Resources\ProfilePages\Pages\ListProfilePages;
use App\Models\ProfilePage;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Navigation\NavigationItem;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ProfilePageResource extends Resource
{
    use AuthorizesResourceByRole;

    protected static ?string $model = ProfilePage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedIdentification;

    protected static ?string $navigationLabel = 'Halaman Profil';

    protected static ?string $modelLabel = 'Halaman Profil';

    protected static ?string $pluralModelLabel = 'Halaman Profil';

    protected static string|\UnitEnum|null $navigationGroup = 'Profil';

    protected static ?int $navigationSort = 1;

    public static function getNavigationItems(): array
    {
        return collect([
            ['label' => 'Pendahuluan', 'slug' => 'pendahuluan', 'sort' => 1],
            ['label' => 'Visi dan Misi', 'slug' => 'visi-misi', 'sort' => 2],
            ['label' => 'Jenis Layanan', 'slug' => 'jenis-pelayanan', 'sort' => 3],
            ['label' => 'SOTK', 'slug' => 'sotk', 'sort' => 4],
        ])->map(fn(array $page): NavigationItem => NavigationItem::make($page['label'])
            ->group(static::getNavigationGroup())
            ->icon(static::getNavigationIcon())
            ->isActiveWhen(fn(): bool => request()->routeIs('filament.admin.resources.profile-pages.edit')
                && request()->route('record') === $page['slug'])
            ->sort($page['sort'])
            ->url(static::getUrl('edit', ['record' => $page['slug']])))
            ->all();
    }

    protected static function allowedRoles(): array
    {
        return ['superadmin', 'admin'];
    }

    protected static function permissionKey(): ?string
    {
        return 'profile.pages';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')->label('Judul')->required()->maxLength(255),
            TextInput::make('subtitle')->label('Label kecil')->maxLength(255),
            RichEditor::make('content')
                ->label('Isi halaman')
                ->extraInputAttributes(['style' => 'min-height: 300px;'])
                ->columnSpanFull(),
            FileUpload::make('image')
                ->label('Gambar / PDF')
                ->disk('public')
                ->directory('profile/pages')
                ->acceptedFileTypes([
                    'application/pdf',
                    'image/jpeg',
                    'image/png',
                    'image/webp',
                ])
                ->maxSize(20480)
                ->downloadable(false)
                ->openable(false)
                ->helperText('PDF, JPG, PNG, atau WEBP. Maksimal 20 MB.')
                ->columnSpanFull(),
            Toggle::make('is_active')->label('Aktif')->default(true)->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query): Builder => $query->orderBy('sort_order')->orderBy('id'))
            ->columns([
                TextColumn::make('no')->label('No')->rowIndex(),
                TextColumn::make('image')
                    ->label('File')
                    ->formatStateUsing(fn(?string $state): string => $state ? basename($state) : '-')
                    ->wrap(),
                TextColumn::make('title')->label('Halaman')->searchable()->sortable(),
                TextColumn::make('slug')->label('Slug')->badge()->color('gray'),
                TextColumn::make('is_active')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn(bool $state): string => $state ? 'Aktif' : 'Nonaktif')
                    ->color(fn(bool $state): string => $state ? 'success' : 'gray'),
            ])
            ->filters([TernaryFilter::make('is_active')->label('Aktif')])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProfilePages::route('/'),
            'edit' => EditProfilePage::route('/{record}/edit'),
        ];
    }
}
