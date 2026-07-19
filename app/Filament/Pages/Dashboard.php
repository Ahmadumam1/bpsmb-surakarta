<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public function getColumns(): array | int
    {
        return [
            'default' => 1,
            'sm' => 2,
            'md' => 12,
            'lg' => 12,
        ];
    }
}
