<?php

namespace App\Filament\Pages;

use App\Support\PasswordPolicy;
use BackedEnum;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ChangePassword extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedKey;

    protected static ?string $navigationLabel = 'Ganti Password';

    protected static ?string $title = 'Ganti Password';

    protected static ?string $slug = 'change-password';

    protected static string|\UnitEnum|null $navigationGroup = 'Keamanan';

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.pages.change-password';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                TextInput::make('current_password')
                    ->label('Password saat ini')
                    ->password()
                    ->revealable(filament()->arePasswordsRevealable())
                    ->autocomplete('current-password')
                    ->currentPassword(guard: Filament::getAuthGuard())
                    ->required()
                    ->dehydrated(false),
                TextInput::make('password')
                    ->label('Password baru')
                    ->helperText(PasswordPolicy::description())
                    ->password()
                    ->revealable(filament()->arePasswordsRevealable())
                    ->autocomplete('new-password')
                    ->rule(PasswordPolicy::rule())
                    ->maxLength((int) config('password_policy.max_length', 255))
                    ->required()
                    ->same('password_confirmation'),
                TextInput::make('password_confirmation')
                    ->label('Konfirmasi password baru')
                    ->password()
                    ->revealable(filament()->arePasswordsRevealable())
                    ->autocomplete('new-password')
                    ->required()
                    ->dehydrated(false),
            ]);
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $user = Filament::auth()->user();

        $user->forceFill([
            'password' => $data['password'],
            'password_changed_at' => now(),
            'password_expires_at' => PasswordPolicy::expiresAt(),
            'password_must_be_changed' => false,
        ])->save();

        session()->put([
            'password_hash_' . Filament::getAuthGuard() => $user->password,
        ]);

        $this->form->fill();

        Notification::make()
            ->title('Password berhasil diperbarui')
            ->success()
            ->send();

        $this->redirect(Filament::getUrl());
    }
}
