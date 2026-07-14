<?php

namespace App\Filament\Resources\ProfilePages\Pages;

use App\Filament\Concerns\HasIndonesianNotifications;
use App\Filament\Resources\ProfilePages\ProfilePageResource;
use Filament\Resources\Pages\EditRecord;

class EditProfilePage extends EditRecord
{
    use HasIndonesianNotifications;

    protected static string $resource = ProfilePageResource::class;
}
