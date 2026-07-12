<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CostDocument extends Model
{
    public const PDF_MIME_TYPE = 'application/pdf';

    protected $fillable = [
        'title',
        'file_path',
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
        return route('cost.pdf', $this);
    }

    public function isSafeLocalPdfPath(): bool
    {
        if (! $this->file_path) {
            return false;
        }

        return Str::startsWith($this->file_path, 'costs/')
            && Str::endsWith(Str::lower($this->file_path), '.pdf')
            && ! Str::contains($this->file_path, ['..', '\\', "\0"]);
    }

    public function localFilePath(): string
    {
        return Storage::disk('local')->path($this->file_path);
    }
}
