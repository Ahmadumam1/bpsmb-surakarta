<?php

namespace App\Filament\Concerns;

trait HasIndonesianNotifications
{
    protected function getCreatedNotificationTitle(): ?string
    {
        return static::getResource()::getModelLabel() . ' berhasil dibuat';
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return static::getResource()::getModelLabel() . ' berhasil disimpan';
    }
}
