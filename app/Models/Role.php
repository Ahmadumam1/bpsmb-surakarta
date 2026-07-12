<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    protected $fillable = [
        'name',
        'type',
        'permissions',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'permissions' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function hasPermission(string $permission): bool
    {
        if ($this->type === 'superadmin') {
            return true;
        }

        $permissions = $this->permissions;

        if (is_string($permissions)) {
            $permissions = json_decode($permissions, true) ?: [];
        }

        return in_array($permission, $permissions ?? [], true);
    }
}
