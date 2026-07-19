<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchLog extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'keyword';
    
    public $incrementing = false;
    
    protected $keyType = 'string';

    protected $fillable = [
        'keyword',
        'created_at',
    ];
}
