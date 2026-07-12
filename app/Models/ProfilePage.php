<?php

namespace App\Models;

use App\Models\Concerns\HasPublicImageUrl;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ProfilePage extends Model
{
    use HasPublicImageUrl;

    protected $fillable = [
        'slug',
        'title',
        'subtitle',
        'content',
        'image',
        'meta_description',
        'sort_order',
        'is_active',
    ];

    protected $appends = ['image_url'];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->publicImageUrl($this->image);
    }

    public function fileExtension(): ?string
    {
        if (! $this->image) {
            return null;
        }

        $path = parse_url($this->image, PHP_URL_PATH) ?: $this->image;

        return strtolower(pathinfo($path, PATHINFO_EXTENSION));
    }

    public function isPdf(): bool
    {
        return $this->fileExtension() === 'pdf';
    }

    public function isImage(): bool
    {
        return in_array($this->fileExtension(), ['jpg', 'jpeg', 'png', 'webp'], true);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
