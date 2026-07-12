<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Document extends Model
{
    protected $fillable = [
        'service_id',
        'title',
        'file_path',
        'file_type',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function viewUrl(): string
    {
        return route('documents.download', $this);
    }

    public function fileExtension(): string
    {
        return Str::upper($this->file_type ?: pathinfo($this->file_path, PATHINFO_EXTENSION) ?: '-');
    }

    public function formattedSize(): string
    {
        $size = null;

        foreach (['public', 'local'] as $disk) {
            if (Storage::disk($disk)->exists($this->file_path)) {
                $size = Storage::disk($disk)->size($this->file_path);

                break;
            }
        }

        if ($size === null) {
            return '-';
        }

        if ($size >= 1048576) {
            return number_format($size / 1048576, 1).' MB';
        }

        return number_format($size / 1024, 0).' KB';
    }

    public function badgeLabel(): string
    {
        return $this->service?->name ?? 'Dokumen';
    }
}
