<?php

namespace App\Filament\Resources\Surveys\Pages;

use App\Filament\Concerns\HasIndonesianNotifications;
use App\Filament\Resources\Surveys\SurveyResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSurvey extends CreateRecord
{
    use HasIndonesianNotifications;

    protected static string $resource = SurveyResource::class;
}
