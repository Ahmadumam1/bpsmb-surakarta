<?php

namespace App\Filament\Concerns;

use Illuminate\Database\Eloquent\Model;

trait AuthorizesResourceByRole
{
    protected static function allowedRoles(): array
    {
        return ['superadmin', 'admin'];
    }

    protected static function deleteRoles(): array
    {
        return ['superadmin'];
    }

    protected static function permissionKey(): ?string
    {
        return null;
    }

    protected static function currentUserHasRole(array $roles): bool
    {
        $user = auth()->user();

        if ($user === null || ! in_array($user->roleType(), $roles, true)) {
            return false;
        }

        if ($user->isSuperadmin()) {
            return true;
        }

        $permission = static::permissionKey();

        return $permission === null || $user->hasPermission($permission);
    }

    public static function canViewAny(): bool
    {
        return static::currentUserHasRole(static::allowedRoles());
    }

    public static function canCreate(): bool
    {
        return static::currentUserHasRole(static::allowedRoles());
    }

    public static function canEdit(Model $record): bool
    {
        return static::currentUserHasRole(static::allowedRoles());
    }

    public static function canDelete(Model $record): bool
    {
        return static::currentUserHasRole(static::deleteRoles());
    }

    public static function canDeleteAny(): bool
    {
        return static::currentUserHasRole(static::deleteRoles());
    }
}
