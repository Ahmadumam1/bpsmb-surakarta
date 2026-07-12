<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Models\Role;
use App\Models\User;
use App\Support\PasswordPolicy;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static ?string $navigationLabel = 'Pengguna';

    protected static ?string $modelLabel = 'Pengguna';

    protected static ?string $pluralModelLabel = 'Pengguna';

    protected static string|\UnitEnum|null $navigationGroup = 'Keamanan';

    protected static ?int $navigationSort = 2;

    public static function canViewAny(): bool
    {
        return auth()->user()?->isSuperadmin() ?? false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->isSuperadmin() ?? false;
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()?->isSuperadmin() ?? false;
    }

    public static function canDelete(Model $record): bool
    {
        return (auth()->user()?->isSuperadmin() ?? false)
            && auth()->id() !== $record->getKey();
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->label('Nama')
                ->required()
                ->maxLength(255),
            TextInput::make('email')
                ->label('Email')
                ->email()
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(255),
            Select::make('role_id')
                ->label('Role/Paket akses')
                ->options(fn (): array => Role::query()
                    ->where('is_active', true)
                    ->orderBy('name')
                    ->pluck('name', 'id')
                    ->all())
                ->searchable()
                ->preload()
                ->native(false)
                ->required(),
            TextInput::make('password')
                ->label('Password')
                ->helperText(PasswordPolicy::description() . ' Kosongkan saat edit jika tidak ingin mengganti password.')
                ->password()
                ->revealable(filament()->arePasswordsRevealable())
                ->autocomplete('new-password')
                ->rule(PasswordPolicy::rule())
                ->maxLength((int) config('password_policy.max_length', 255))
                ->required(fn (string $operation): bool => $operation === 'create')
                ->same('password_confirmation')
                ->dehydrated(fn (?string $state): bool => filled($state)),
            TextInput::make('password_confirmation')
                ->label('Konfirmasi password')
                ->password()
                ->revealable(filament()->arePasswordsRevealable())
                ->autocomplete('new-password')
                ->required(fn (string $operation, Get $get): bool => $operation === 'create' || filled($get('password')))
                ->dehydrated(false),
            Toggle::make('password_must_be_changed')
                ->label('Wajib ganti password saat login berikutnya')
                ->helperText('Aktifkan setelah reset password oleh admin.'),
            DateTimePicker::make('password_expires_at')
                ->label('Password berlaku sampai')
                ->seconds(false)
                ->native(false)
                ->helperText('Kosongkan jika masa berlaku password tidak ingin dipaksa.'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')->label('No')->rowIndex(),
                TextColumn::make('name')->label('Nama')->searchable()->sortable(),
                TextColumn::make('email')->label('Email')->searchable()->sortable(),
                TextColumn::make('accessRole.name')->label('Role/Paket akses')->badge()->sortable(),
                TextColumn::make('password_changed_at')->label('Password diubah')->dateTime('d M Y H:i')->sortable(),
                TextColumn::make('password_expires_at')->label('Berlaku sampai')->dateTime('d M Y H:i')->sortable(),
                IconColumn::make('password_must_be_changed')->label('Wajib ganti')->boolean(),
            ])
            ->filters([
                SelectFilter::make('role_id')
                    ->label('Role/Paket akses')
                    ->relationship('accessRole', 'name'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                    ->visible(fn (User $record): bool => auth()->id() !== $record->id),
            ]);
    }

    public static function preparePasswordData(array $data): array
    {
        if (filled($data['password'] ?? null)) {
            $data['password_changed_at'] = now();
            $data['password_expires_at'] ??= PasswordPolicy::expiresAt();
        }

        return $data;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
