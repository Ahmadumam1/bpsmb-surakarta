<?php

namespace App\Filament\Resources\HomeHeadlines\Pages;

use App\Filament\Resources\HomeHeadlines\HomeHeadlineResource;
use Filament\Resources\Pages\CreateRecord;

class CreateHomeHeadline extends CreateRecord
{
    protected static string $resource = HomeHeadlineResource::class;
}
