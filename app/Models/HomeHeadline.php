<?php

namespace App\Models;

use App\Models\Concerns\HasPublicImageUrl;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class HomeHeadline extends Model
{
    use HasPublicImageUrl;

    protected $fillable = [
        'subtitle',
        'title',
        'description',
        'image',
        'image_2',
        'image_3',
        'primary_button_label',
        'primary_button_url',
        'secondary_button_label',
        'secondary_button_url',
        'is_active',
    ];

    protected $appends = ['image_url', 'image_2_url', 'image_3_url'];

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

    public function getImage2UrlAttribute(): ?string
    {
        return $this->publicImageUrl($this->image_2);
    }

    public function getImage3UrlAttribute(): ?string
    {
        return $this->publicImageUrl($this->image_3);
    }
}
