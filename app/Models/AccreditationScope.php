<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccreditationScope extends Model
{
    protected $fillable = [
        'commodity_type',
        'reference',
    ];
}
