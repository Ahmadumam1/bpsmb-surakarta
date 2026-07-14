<?php

namespace App\Filament\Resources\News\Pages;

use App\Filament\Concerns\HasIndonesianNotifications;
use App\Filament\Resources\News\NewsResource;
use Filament\Resources\Pages\CreateRecord;

class CreateNews extends CreateRecord
{
    use HasIndonesianNotifications;

    protected static string $resource = NewsResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return NewsResource::prepareNewsData($data);
    }
}
