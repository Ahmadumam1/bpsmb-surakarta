<?php

namespace App\Filament\Pages;

use App\Models\HomeHeadline;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ManageHomeHeadline extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMegaphone;

    protected static ?string $navigationLabel = 'Headline';

    protected static ?string $title = 'Headline';

    protected static ?string $slug = 'home-headline';

    protected static string|\UnitEnum|null $navigationGroup = 'Home Page';

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.pages.manage-home-headline';

    public ?array $data = [];

    public static function canAccess(): bool
    {
        $user = auth()->user();

        return $user?->isSuperadmin() || ($user?->hasPermission('home.headline') ?? false);
    }

    public function mount(): void
    {
        $record = HomeHeadline::query()->oldest('id')->first()
            ?? HomeHeadline::query()->create([
                'title' => 'Headline Homepage',
                'is_active' => true,
            ]);

        $this->form->fill([
            'subtitle' => $record->subtitle,
            'title' => $record->title,
            'description' => $record->description,
            'image' => $record->image,
            'image_2' => $record->image_2,
            'image_3' => $record->image_3,
            'primary_button_label' => $record->primary_button_label,
            'primary_button_url' => $record->primary_button_url,
            'secondary_button_label' => $record->secondary_button_label,
            'secondary_button_url' => $record->secondary_button_url,
            'is_active' => $record->is_active ?? true,
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                TextInput::make('subtitle')->label('Label kecil')->maxLength(255)->columnSpanFull(),
                TextInput::make('title')->label('Judul')->required()->columnSpanFull(),
                Textarea::make('description')->label('Deskripsi')->rows(4)->columnSpanFull(),
                FileUpload::make('image')
                    ->label('Foto headline 1')
                    ->image()
                    ->disk('public')
                    ->directory('home/headlines')
                    ->imageEditor()
                    ->maxSize(2048)
                    ->helperText('Gambar PNG, JPG, atau WEBP. Maksimal 2 MB.')
                    ->columnSpanFull(),
                FileUpload::make('image_2')
                    ->label('Foto headline 2')
                    ->image()
                    ->disk('public')
                    ->directory('home/headlines')
                    ->imageEditor()
                    ->maxSize(2048)
                    ->helperText('Gambar PNG, JPG, atau WEBP. Maksimal 2 MB.'),
                FileUpload::make('image_3')
                    ->label('Foto headline 3')
                    ->image()
                    ->disk('public')
                    ->directory('home/headlines')
                    ->imageEditor()
                    ->maxSize(2048)
                    ->helperText('Gambar PNG, JPG, atau WEBP. Maksimal 2 MB.'),
                TextInput::make('primary_button_label')->label('Label tombol utama')->maxLength(255),
                TextInput::make('primary_button_url')->label('URL tombol utama')->maxLength(255),
                TextInput::make('secondary_button_label')->label('Label tombol kedua')->maxLength(255),
                TextInput::make('secondary_button_url')->label('URL tombol kedua')->maxLength(255),
                Toggle::make('is_active')->label('Aktif')->default(true)->required(),
            ]);
    }

    public function save(): void
    {
        $formData = $this->form->getState();

        $record = HomeHeadline::query()->oldest('id')->first()
            ?? new HomeHeadline();

        $record->fill($formData);
        $record->save();

        Notification::make()
            ->title('Headline berhasil disimpan')
            ->success()
            ->send();
    }
}
