<?php

namespace App\Filament\Resources\HomeMarqueeLogos;

use App\Filament\Concerns\AuthorizesResourceByRole;
use App\Filament\Resources\HomeMarqueeLogos\Pages\CreateHomeMarqueeLogo;
use App\Filament\Resources\HomeMarqueeLogos\Pages\EditHomeMarqueeLogo;
use App\Filament\Resources\HomeMarqueeLogos\Pages\ListHomeMarqueeLogos;
use App\Models\HomeMarqueeLogo;
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

class HomeMarqueeLogoResource extends Resource
{
    use AuthorizesResourceByRole;

    protected static ?string $model = HomeMarqueeLogo::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMegaphone;

    protected static ?string $navigationLabel = 'Logo Marquee';

    protected static ?string $modelLabel = 'Logo Marquee';

    protected static ?string $pluralModelLabel = 'Logo Marquee';

    protected static string|\UnitEnum|null $navigationGroup = 'Home Page';

    protected static ?int $navigationSort = 6;

    protected static function allowedRoles(): array
    {
        return ['superadmin', 'admin'];
    }

    protected static function permissionKey(): ?string
    {
        return 'home.marquee_logo';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->label('Nama aplikasi')->required()->maxLength(255),
            FileUpload::make('image')->label('Logo')->image()->disk('public')->directory('home/marquee-logos')->imageEditor(),
            TextInput::make('url')
                ->label('Link external')
                ->url()
                ->maxLength(255)
                ->helperText('Gunakan URL lengkap, misalnya https://ptsp.halal.go.id/login.'),
            Toggle::make('is_active')->label('Aktif')->default(true)->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')->label('No')->rowIndex(),
                ImageColumn::make('image')->label('Logo')->disk('public')->square(),
                TextColumn::make('name')->label('Nama aplikasi')->searchable()->limit(45),
                TextColumn::make('url')->label('Link')->searchable()->limit(45),
                TextColumn::make('is_active')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Aktif' : 'Nonaktif')
                    ->color(fn (bool $state): string => $state ? 'success' : 'gray'),
            ])
            ->filters([TernaryFilter::make('is_active')->label('Aktif')])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHomeMarqueeLogos::route('/'),
            'create' => CreateHomeMarqueeLogo::route('/create'),
            'edit' => EditHomeMarqueeLogo::route('/{record}/edit'),
        ];
    }
}
