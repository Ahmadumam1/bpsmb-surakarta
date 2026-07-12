<?php

namespace App\Models;

use App\Models\Concerns\HasPublicImageUrl;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class HomeCommitment extends Model
{
    use HasPublicImageUrl;

    protected $fillable = [
        'subtitle',
        'title',
        'statement',
        'description',
        'image',
        'is_active',
    ];

    protected $appends = ['image_url'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->publicImageUrl($this->image);
    }
}
