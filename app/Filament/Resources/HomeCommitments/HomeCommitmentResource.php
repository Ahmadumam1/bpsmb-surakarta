<?php

namespace App\Filament\Resources\HomeCommitments;

use App\Filament\Concerns\AuthorizesResourceByRole;
use App\Filament\Resources\HomeCommitments\Pages\CreateHomeCommitment;
use App\Filament\Resources\HomeCommitments\Pages\EditHomeCommitment;
use App\Filament\Resources\HomeCommitments\Pages\ListHomeCommitments;
use App\Models\HomeCommitment;
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

class HomeCommitmentResource extends Resource
{
    use AuthorizesResourceByRole;

    protected static ?string $model = HomeCommitment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentCheck;

    protected static ?string $navigationLabel = 'Maklumat Pelayanan';

    protected static ?string $modelLabel = 'Maklumat Pelayanan';

    protected static ?string $pluralModelLabel = 'Maklumat Pelayanan';

    protected static string|\UnitEnum|null $navigationGroup = 'Home Page';

    protected static ?int $navigationSort = 2;


    protected static function permissionKey(): ?string
    {
        return 'home.commitment';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('subtitle')->label('Label kecil')->maxLength(255),
            TextInput::make('title')->label('Judul')->required()->maxLength(255),
            Textarea::make('statement')->label('Kata kata ')->rows(4)->columnSpanFull(),
            Textarea::make('description')->label('Keterangan')->rows(3)->columnSpanFull(),
            FileUpload::make('image')
                ->label('Gambar')
                ->image()
                ->disk('public')
                ->directory('home/commitments')
                ->imageEditor()
                ->maxSize(2048)
                ->helperText('Gambar PNG, JPG, atau WEBP. Maksimal 2 MB.')
                ->columnSpanFull(),
            Toggle::make('is_active')->label('Aktif')->default(true)->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')->label('No')->rowIndex(),
                ImageColumn::make('image')->label('Gambar')->disk('public')->square(),
                TextColumn::make('title')->label('Judul')->searchable()->limit(50),
                TextColumn::make('is_active')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Aktif' : 'Nonaktif')
                    ->color(fn (bool $state): string => $state ? 'success' : 'gray'),
            ])
            ->filters([TernaryFilter::make('is_active')->label('Aktif')])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHomeCommitments::route('/'),
            'create' => CreateHomeCommitment::route('/create'),
            'edit' => EditHomeCommitment::route('/{record}/edit'),
        ];
    }
}
