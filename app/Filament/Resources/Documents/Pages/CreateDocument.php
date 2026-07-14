<?php

namespace App\Filament\Resources\Documents\Pages;

use App\Filament\Concerns\HasIndonesianNotifications;
use App\Filament\Resources\Documents\DocumentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDocument extends CreateRecord
{
    use HasIndonesianNotifications;

    protected static string $resource = DocumentResource::class;
}
