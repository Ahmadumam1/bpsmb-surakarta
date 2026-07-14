<?php

namespace App\Filament\Pages;

use App\Models\HomePopup;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ManageHomePopup extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBell;

    protected static ?string $navigationLabel = 'Popup Pengumuman';

    protected static ?string $title = 'Popup Pengumuman';

    protected static ?string $slug = 'home-popup';

    protected static string|\UnitEnum|null $navigationGroup = 'Home Page';

    protected static ?int $navigationSort = 2;

    protected string $view = 'filament.pages.manage-home-popup';

    public ?array $data = [];

    public static function canAccess(): bool
    {
        $user = auth()->user();

        return $user?->isSuperadmin() || ($user?->hasPermission('home.popup') ?? false);
    }

    public function mount(): void
    {
        $record = HomePopup::query()->oldest('id')->first()
            ?? HomePopup::query()->create([
                'title' => 'Popup Pengumuman',
                'is_active' => false,
            ]);

        $this->form->fill([
            'title' => $record->title,
            'image' => $record->image,
            'image_2' => $record->image_2,
            'image_3' => $record->image_3,
            'link_url' => $record->link_url,
            'is_active' => $record->is_active ?? false,
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
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
                    ->maxSize(2048)
                    ->helperText('Gambar PNG, JPG, atau WEBP. Maksimal 2 MB. Rekomendasi ukuran: 768 x 580 piksel (Rasio 4:3) agar tampil pas tanpa scroll.')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image_2')
                    ->label('Gambar Pengumuman 2 (Opsional)')
                    ->image()
                    ->disk('public')
                    ->directory('home/popups')
                    ->imageEditor()
                    ->maxSize(2048)
                    ->helperText('Gambar PNG, JPG, atau WEBP. Maksimal 2 MB. Rekomendasi ukuran: 768 x 580 piksel (Rasio 4:3) agar tampil pas tanpa scroll.')
                    ->columnSpanFull(),
                FileUpload::make('image_3')
                    ->label('Gambar Pengumuman 3 (Opsional)')
                    ->image()
                    ->disk('public')
                    ->directory('home/popups')
                    ->imageEditor()
                    ->maxSize(2048)
                    ->helperText('Gambar PNG, JPG, atau WEBP. Maksimal 2 MB. Rekomendasi ukuran: 768 x 580 piksel (Rasio 4:3) agar tampil pas tanpa scroll.')
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

    public function save(): void
    {
        $formData = $this->form->getState();

        $record = HomePopup::query()->oldest('id')->first()
            ?? new HomePopup();

        $record->fill($formData);
        $record->save();

        Notification::make()
            ->title('Popup pengumuman berhasil disimpan')
            ->success()
            ->send();
    }
}
