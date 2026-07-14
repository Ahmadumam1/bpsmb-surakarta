<?php

namespace App\Filament\Resources\Surveys\Pages;

use App\Filament\Concerns\HasIndonesianNotifications;
use App\Filament\Resources\Surveys\SurveyResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSurvey extends EditRecord
{
    use HasIndonesianNotifications;

    protected static string $resource = SurveyResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return SurveyResource::prepareSurveyData($data);
    }

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
