<?php

namespace App\Filament\Resources\ProfilePages\Pages;

use App\Filament\Resources\ProfilePages\ProfilePageResource;
use Filament\Resources\Pages\EditRecord;

class EditProfilePage extends EditRecord
{
    protected static string $resource = ProfilePageResource::class;
}
