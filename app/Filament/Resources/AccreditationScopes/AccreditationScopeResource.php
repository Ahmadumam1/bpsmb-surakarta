<?php

namespace App\Filament\Resources\AccreditationScopes;

use App\Filament\Concerns\AuthorizesResourceByRole;
use App\Filament\Resources\AccreditationScopes\Pages\CreateAccreditationScope;
use App\Filament\Resources\AccreditationScopes\Pages\EditAccreditationScope;
use App\Filament\Resources\AccreditationScopes\Pages\ListAccreditationScopes;
use App\Models\AccreditationScope;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AccreditationScopeResource extends Resource
{
    use AuthorizesResourceByRole;

    protected static ?string $model = AccreditationScope::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentCheck;

    protected static ?string $navigationLabel = 'Ruang Lingkup Akreditasi';

    protected static ?string $modelLabel = 'Ruang Lingkup Akreditasi';

    protected static ?string $pluralModelLabel = 'Ruang Lingkup Akreditasi';

    protected static string|\UnitEnum|null $navigationGroup = 'Jasa Layanan';

    protected static ?int $navigationSort = 2;

    protected static function allowedRoles(): array
    {
        return ['superadmin', 'admin'];
    }

    protected static function permissionKey(): ?string
    {
        return 'services.accreditation_scope';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('commodity_type')
                ->label('Jenis Komoditas')
                ->required()
                ->maxLength(255)
                ->columnSpanFull(),
            TextInput::make('reference')
                ->label('Acuan')
                ->required()
                ->maxLength(255)
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query): Builder => $query->orderBy('id'))
            ->columns([
                TextColumn::make('no')->label('No')->rowIndex(),
                TextColumn::make('commodity_type')->label('Jenis Komoditas')->searchable()->sortable()->wrap(),
                TextColumn::make('reference')->label('Acuan')->searchable()->sortable()->wrap(),
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
            'index' => ListAccreditationScopes::route('/'),
            'create' => CreateAccreditationScope::route('/create'),
            'edit' => EditAccreditationScope::route('/{record}/edit'),
        ];
    }
}
