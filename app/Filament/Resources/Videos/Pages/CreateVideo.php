<?php

namespace App\Filament\Resources\Videos\Pages;

use App\Filament\Concerns\HasIndonesianNotifications;
use App\Filament\Resources\Videos\VideoResource;
use Filament\Resources\Pages\CreateRecord;

class CreateVideo extends CreateRecord
{
    use HasIndonesianNotifications;

    protected static string $resource = VideoResource::class;
}
