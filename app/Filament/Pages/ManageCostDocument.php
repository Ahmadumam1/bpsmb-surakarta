<?php

namespace App\Filament\Pages;

use App\Models\CostDocument;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\HtmlString;

class ManageCostDocument extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $navigationLabel = 'Dokumen Biaya Layanan';

    protected static ?string $title = 'Dokumen Biaya Layanan';

    protected static ?string $slug = 'cost-document';

    protected static string|\UnitEnum|null $navigationGroup = 'Biaya Layanan';

    protected static ?int $navigationSort = 10;

    protected string $view = 'filament.pages.manage-cost-document';

    public ?array $data = [];

    public static function canAccess(): bool
    {
        $user = auth()->user();

        return $user?->isSuperadmin() || ($user?->hasPermission('content.cost_document') ?? false);
    }

    public function mount(): void
    {
        $record = CostDocument::query()->orderBy('sort_order')->orderByDesc('id')->first()
            ?? new CostDocument();

        $this->form->fill([
            'title' => $record->title ?? 'Daftar Biaya Layanan',
            'file_path' => $record->file_path,
            'is_active' => $record->is_active ?? true,
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                TextInput::make('title')
                    ->label('Judul dokumen')
                    ->default('Daftar Biaya Layanan')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                FileUpload::make('file_path')
                    ->label('File PDF')
                    ->disk('local')
                    ->directory('costs')
                    ->acceptedFileTypes([CostDocument::PDF_MIME_TYPE])
                    ->maxSize(5120)
                    ->required()
                    ->helperText('Hanya file PDF. Maksimal 5 MB.')
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->required(),
            ]);
    }

    public function save(): void
    {
        $formData = $this->form->getState();

        $record = CostDocument::query()->orderBy('sort_order')->orderByDesc('id')->first()
            ?? new CostDocument();

        $record->fill([
            'title' => $formData['title'],
            'file_path' => $formData['file_path'],
            'is_active' => $formData['is_active'],
            'sort_order' => $record->sort_order ?? 0,
        ]);

        $record->save();

        Notification::make()
            ->title('Dokumen biaya layanan berhasil disimpan')
            ->success()
            ->send();
    }
}
