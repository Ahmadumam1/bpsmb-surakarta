<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SampleCollectionFee extends Model
{
    protected $fillable = [
        'description',
        'sample_count',
        'fee',
    ];

    protected function casts(): array
    {
        return [
            'sample_count' => 'integer',
            'fee' => 'integer',
        ];
    }

    public function formattedFee(): string
    {
        return 'Rp'.number_format($this->fee, 0, ',', '.');
    }

    public function formattedSample(): string
    {
        return "{$this->sample_count} sample";
    }
}
