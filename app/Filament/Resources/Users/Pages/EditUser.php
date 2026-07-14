<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Concerns\HasIndonesianNotifications;
use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    use HasIndonesianNotifications;

    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return UserResource::preparePasswordData($data);
    }
}
