<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorStat extends Model
{
    protected $fillable = [
        'date',
        'total_views',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'total_views' => 'integer',
        ];
    }
}
