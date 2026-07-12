<?php

namespace App\Filament\Pages;

use App\Support\SiteSettings;
use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ContactSettings extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static ?string $navigationLabel = 'Kontak & Sosmed';

    protected static ?string $title = 'Kontak & Sosmed';

    protected static ?string $slug = 'contact-settings';

    protected static string|\UnitEnum|null $navigationGroup = 'Lainnya';

    protected static ?int $navigationSort = 20;

    protected string $view = 'filament.pages.contact-settings';

    public ?array $data = [];

    public static function canAccess(): bool
    {
        $user = auth()->user();

        return $user?->isSuperadmin() || ($user?->hasPermission('settings.contact') ?? false);
    }

    public function mount(): void
    {
        $this->form->fill($this->formDataFromSettings(SiteSettings::all()));
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                Textarea::make('contact_address')
                    ->label('Alamat')
                    ->rows(3)
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('contact_phone')
                    ->label('Telepon')
                    ->required()
                    ->maxLength(255),
                TextInput::make('contact_whatsapp_number')
                    ->label('Nomor WhatsApp')
                    ->tel()
                    ->required()
                    ->maxLength(50),
                TextInput::make('contact_email')
                    ->label('Email utama')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('contact_secondary_email')
                    ->label('Email kedua')
                    ->email()
                    ->maxLength(255),
                TextInput::make('contact_working_hours')
                    ->label('Jam kerja')
                    ->required()
                    ->maxLength(255),
                TextInput::make('social_instagram_url')
                    ->label('Instagram')
                    ->url()
                    ->maxLength(255),
                TextInput::make('social_facebook_url')
                    ->label('Facebook')
                    ->url()
                    ->maxLength(255),
                TextInput::make('social_youtube_url')
                    ->label('YouTube')
                    ->url()
                    ->maxLength(255),
            ]);
    }

    public function save(): void
    {
        SiteSettings::setMany($this->settingsFromFormData($this->form->getState()));

        Notification::make()
            ->title('Kontak & sosmed berhasil disimpan')
            ->success()
            ->send();
    }

    private function formDataFromSettings(array $settings): array
    {
        return [
            'contact_address' => $settings['contact.address'] ?? '',
            'contact_phone' => $settings['contact.phone'] ?? '',
            'contact_whatsapp_number' => $settings['contact.whatsapp_number'] ?? '',
            'contact_email' => $settings['contact.email'] ?? '',
            'contact_secondary_email' => $settings['contact.secondary_email'] ?? '',
            'contact_working_hours' => $settings['contact.working_hours'] ?? '',
            'social_instagram_url' => $settings['social.instagram_url'] ?? '',
            'social_facebook_url' => $settings['social.facebook_url'] ?? '',
            'social_youtube_url' => $settings['social.youtube_url'] ?? '',
        ];
    }

    private function settingsFromFormData(array $data): array
    {
        return [
            'contact.address' => $data['contact_address'] ?? '',
            'contact.phone' => $data['contact_phone'] ?? '',
            'contact.whatsapp_number' => $data['contact_whatsapp_number'] ?? '',
            'contact.email' => $data['contact_email'] ?? '',
            'contact.secondary_email' => $data['contact_secondary_email'] ?? '',
            'contact.working_hours' => $data['contact_working_hours'] ?? '',
            'social.instagram_url' => $data['social_instagram_url'] ?? '',
            'social.facebook_url' => $data['social_facebook_url'] ?? '',
            'social.youtube_url' => $data['social_youtube_url'] ?? '',
        ];
    }
}
