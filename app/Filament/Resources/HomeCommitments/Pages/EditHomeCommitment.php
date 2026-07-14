<?php

namespace App\Filament\Resources\HomeCommitments\Pages;

use App\Filament\Concerns\HasIndonesianNotifications;
use App\Filament\Resources\HomeCommitments\HomeCommitmentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHomeCommitment extends EditRecord
{
    use HasIndonesianNotifications;

    protected static string $resource = HomeCommitmentResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
