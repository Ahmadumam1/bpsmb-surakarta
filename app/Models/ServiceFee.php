<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceFee extends Model
{
    protected $fillable = [
        'category',
        'service_name',
        'unit',
        'price',
    ];

    protected function casts(): array
    {
        return [
            'unit'  => 'integer',
            'price' => 'integer',
        ];
    }

    public function formattedPrice(): string
    {
        return 'Rp'.number_format($this->price, 0, ',', '.');
    }
}
