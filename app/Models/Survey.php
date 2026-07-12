<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Survey extends Model
{
    public const ALLOWED_MIME_TYPES = [
        'application/pdf',
        'image/jpeg',
        'image/png',
        'image/webp',
    ];

    public const MIME_TYPES_BY_EXTENSION = [
        'pdf' => 'application/pdf',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png' => 'image/png',
        'webp' => 'image/webp',
    ];

    protected $fillable = [
        'title',
        'description',
        'file_path',
        'file_type',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function openUrl(): string
    {
        return route('surveys.open', $this);
    }

    public function fileExtension(): ?string
    {
        if (! $this->file_path) {
            return null;
        }

        return Str::lower(pathinfo($this->file_path, PATHINFO_EXTENSION));
    }

    public function isPdf(): bool
    {
        return $this->fileExtension() === 'pdf';
    }

    public function isImage(): bool
    {
        return in_array($this->fileExtension(), ['jpg', 'jpeg', 'png', 'webp'], true);
    }

    public function isAllowedFileType(): bool
    {
        $extension = $this->fileExtension();

        return $extension !== null && array_key_exists($extension, self::MIME_TYPES_BY_EXTENSION);
    }

    public function isSafeLocalDocumentPath(): bool
    {
        if (! $this->file_path) {
            return false;
        }

        return Str::startsWith($this->file_path, 'surveys/satisfaction/')
            && ! Str::contains($this->file_path, ['..', '\\', "\0"])
            && $this->isAllowedFileType();
    }

    public function localFilePath(): string
    {
        return Storage::disk('local')->path($this->file_path);
    }
}
