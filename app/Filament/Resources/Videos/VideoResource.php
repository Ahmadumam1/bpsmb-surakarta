<?php

namespace App\Filament\Resources\Videos;

use App\Filament\Concerns\AuthorizesResourceByRole;
use App\Filament\Resources\Videos\Pages\CreateVideo;
use App\Filament\Resources\Videos\Pages\EditVideo;
use App\Filament\Resources\Videos\Pages\ListVideos;
use App\Models\Video;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class VideoResource extends Resource
{
    use AuthorizesResourceByRole;

    protected static ?string $model = Video::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedVideoCamera;

    protected static ?string $navigationLabel = 'Galeri Video';

    protected static ?string $modelLabel = 'Video';

    protected static ?string $pluralModelLabel = 'Galeri Video';

    protected static string|\UnitEnum|null $navigationGroup = 'Media';

    protected static ?int $navigationSort = 4;

    protected static function allowedRoles(): array
    {
        return ['superadmin', 'admin'];
    }

    protected static function permissionKey(): ?string
    {
        return 'media.video';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('category')->label('Kategori / tanggal')->maxLength(255),
            TextInput::make('title')->label('Judul')->required()->maxLength(255),
            Textarea::make('description')->label('Deskripsi / durasi')->rows(3)->columnSpanFull(),
            FileUpload::make('thumbnail')->label('Thumbnail opsional')->image()->disk('public')->directory('home/videos')->imageEditor(),
            TextInput::make('video_url')->label('Link YouTube')->url()->maxLength(255),
            Toggle::make('is_featured')->label('Video utama')->default(false)->required(),
            Toggle::make('is_active')->label('Aktif')->default(true)->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')->label('No')->rowIndex(),
                ImageColumn::make('thumbnail')->label('Thumbnail')->disk('public')->square(),
                TextColumn::make('title')->label('Judul')->searchable()->limit(45),
                TextColumn::make('is_featured')
                    ->label('Tipe')
                    ->badge()
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Utama' : 'Biasa')
                    ->color(fn (bool $state): string => $state ? 'warning' : 'gray'),
                TextColumn::make('is_active')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Aktif' : 'Nonaktif')
                    ->color(fn (bool $state): string => $state ? 'success' : 'gray'),
            ])
            ->filters([
                TernaryFilter::make('is_featured')->label('Video utama'),
                TernaryFilter::make('is_active')->label('Aktif'),
            ])
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
            'index' => ListVideos::route('/'),
            'create' => CreateVideo::route('/create'),
            'edit' => EditVideo::route('/{record}/edit'),
        ];
    }
}
