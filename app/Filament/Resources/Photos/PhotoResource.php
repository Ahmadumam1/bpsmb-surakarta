<?php

namespace App\Filament\Resources\Photos;

use App\Filament\Concerns\AuthorizesResourceByRole;
use App\Filament\Resources\Photos\Pages\CreatePhoto;
use App\Filament\Resources\Photos\Pages\EditPhoto;
use App\Filament\Resources\Photos\Pages\ListPhotos;
use App\Models\Photo;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class PhotoResource extends Resource
{
    use AuthorizesResourceByRole;

    protected static ?string $model = Photo::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static ?string $navigationLabel = 'Galeri Foto';

    protected static ?string $modelLabel = 'Foto';

    protected static ?string $pluralModelLabel = 'Galeri Foto';

    protected static string|\UnitEnum|null $navigationGroup = 'Media';

    protected static ?int $navigationSort = 3;


    protected static function permissionKey(): ?string
    {
        return 'media.photo';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('category')->label('Kategori')->maxLength(255),
            TextInput::make('title')->label('Judul')->required()->maxLength(255),
            FileUpload::make('image')
                ->label('Foto')
                ->image()
                ->disk('public')
                ->directory('home/photos')
                ->imageEditor()
                ->maxSize(2048)
                ->helperText('Gambar PNG, JPG, atau WEBP. Maksimal 2 MB.'),
            Toggle::make('is_active')->label('Aktif')->default(true)->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')->label('No')->rowIndex(),
                ImageColumn::make('image')->label('Foto')->disk('public')->square(),
                TextColumn::make('category')->label('Kategori')->searchable(),
                TextColumn::make('title')->label('Judul')->searchable()->limit(45),
                TextColumn::make('is_active')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Aktif' : 'Nonaktif')
                    ->color(fn (bool $state): string => $state ? 'success' : 'gray'),
            ])
            ->filters([TernaryFilter::make('is_active')->label('Aktif')])
            ->defaultSort('id', 'desc')
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPhotos::route('/'),
            'create' => CreatePhoto::route('/create'),
            'edit' => EditPhoto::route('/{record}/edit'),
        ];
    }
}
