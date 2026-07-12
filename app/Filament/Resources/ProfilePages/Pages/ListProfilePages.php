<?php

namespace App\Filament\Resources\ProfilePages\Pages;

use App\Filament\Resources\ProfilePages\ProfilePageResource;
use Filament\Resources\Pages\ListRecords;

class ListProfilePages extends ListRecords
{
    protected static string $resource = ProfilePageResource::class;
}
