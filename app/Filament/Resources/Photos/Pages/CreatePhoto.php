<?php

namespace App\Filament\Resources\Photos\Pages;

use App\Filament\Concerns\HasIndonesianNotifications;
use App\Filament\Resources\Photos\PhotoResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePhoto extends CreateRecord
{
    use HasIndonesianNotifications;

    protected static string $resource = PhotoResource::class;
}
