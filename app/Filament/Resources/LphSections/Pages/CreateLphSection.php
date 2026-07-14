<?php

namespace App\Filament\Resources\LphSections\Pages;

use App\Filament\Concerns\HasIndonesianNotifications;
use App\Filament\Resources\LphSections\LphSectionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLphSection extends CreateRecord
{
    use HasIndonesianNotifications;

    protected static string $resource = LphSectionResource::class;
}
