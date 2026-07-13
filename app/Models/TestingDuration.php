<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestingDuration extends Model
{
    protected $fillable = [
        'name',
        'category',
        'duration',
    ];

    protected function casts(): array
    {
        return [
            'duration' => 'integer',
        ];
    }
}
