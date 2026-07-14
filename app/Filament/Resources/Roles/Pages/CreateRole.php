<?php

namespace App\Filament\Resources\Roles\Pages;

use App\Filament\Concerns\HasIndonesianNotifications;
use App\Filament\Resources\Roles\RoleResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRole extends CreateRecord
{
    use HasIndonesianNotifications;

    protected static string $resource = RoleResource::class;
}
