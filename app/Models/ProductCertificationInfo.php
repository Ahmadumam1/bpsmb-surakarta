<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductCertificationInfo extends Model
{
    public const ALLOWED_MIME_TYPES = [
        'application/pdf',
    ];

    public const MIME_TYPES_BY_EXTENSION = [
        'pdf' => 'application/pdf',
    ];

    protected $fillable = [
        'scheme',
        'category',
        'product_type',
        'reference',
        'file_path',
    ];

    public function openUrl(): string
    {
        return route('services.product-certification.info.open', $this);
    }

    public function fileExtension(): ?string
    {
        if (! $this->file_path) {
            return null;
        }

        return Str::lower(pathinfo($this->file_path, PATHINFO_EXTENSION));
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

        return Str::startsWith($this->file_path, 'product-certification/information/')
            && ! Str::contains($this->file_path, ['..', '\\', "\0"])
            && $this->isAllowedFileType();
    }

    public function localFilePath(): string
    {
        return Storage::disk('local')->path($this->file_path);
    }
}
