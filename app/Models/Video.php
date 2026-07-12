<?php

namespace App\Models;

use App\Models\Concerns\HasPublicImageUrl;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasPublicImageUrl;

    protected $table = 'videos';

    protected $fillable = [
        'category',
        'title',
        'description',
        'thumbnail',
        'video_url',
        'is_featured',
        'is_active',
    ];

    protected $appends = [
        'embed_url',
        'image_url',
        'youtube_id',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->publicImageUrl($this->thumbnail)
            ?: ($this->youtube_id ? "https://img.youtube.com/vi/{$this->youtube_id}/hqdefault.jpg" : null);
    }

    public function getYoutubeIdAttribute(): ?string
    {
        if ($this->video_url === null || $this->video_url === '') {
            return null;
        }

        $host = parse_url($this->video_url, PHP_URL_HOST) ?: '';
        $path = trim(parse_url($this->video_url, PHP_URL_PATH) ?: '', '/');
        parse_str(parse_url($this->video_url, PHP_URL_QUERY) ?: '', $query);

        if (isset($query['v']) && $query['v'] !== '') {
            return $query['v'];
        }

        if (str_contains($host, 'youtu.be')) {
            return $path !== '' ? explode('/', $path)[0] : null;
        }

        if (str_contains($host, 'youtube.com') && str_starts_with($path, 'embed/')) {
            return str_replace('embed/', '', $path);
        }

        if (str_contains($host, 'youtube.com') && str_starts_with($path, 'shorts/')) {
            return str_replace('shorts/', '', $path);
        }

        return null;
    }

    public function getEmbedUrlAttribute(): ?string
    {
        if ($this->youtube_id) {
            return "https://www.youtube.com/embed/{$this->youtube_id}";
        }

        return $this->video_url;
    }
}
