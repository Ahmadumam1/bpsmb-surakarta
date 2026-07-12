<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ServiceFee extends Model
{
    protected $fillable = [
        'category',
        'service_name',
        'description',
        'unit',
        'price',
        'regulation_reference',
        'source_page',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'integer',
            'source_page' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function formattedPrice(): string
    {
        return 'Rp'.number_format($this->price, 0, ',', '.');
    }
}
