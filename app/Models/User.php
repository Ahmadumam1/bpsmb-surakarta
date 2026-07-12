<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'password_changed_at',
        'password_expires_at',
        'password_must_be_changed',
        'google2fa_secret',
        'google2fa_enabled',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'password_changed_at' => 'datetime',
            'password_expires_at' => 'datetime',
            'password_must_be_changed' => 'boolean',
            'google2fa_secret' => 'encrypted',
            'google2fa_enabled' => 'boolean',
        ];
    }

    public function passwordExpired(): bool
    {
        return $this->password_must_be_changed
            || ($this->password_expires_at !== null && $this->password_expires_at->isPast());
    }

    public function isSuperadmin(): bool
    {
        return $this->roleType() === 'superadmin';
    }

    public function accessRole(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function roleType(): ?string
    {
        return $this->accessRole?->type;
    }

    public function hasPermission(string $permission): bool
    {
        if ($this->isSuperadmin()) {
            return true;
        }

        return $this->roleType() === 'admin'
            && ($this->accessRole?->is_active ?? false)
            && $this->accessRole->hasPermission($permission);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $panel->getId() === 'admin'
            && ($this->accessRole?->is_active ?? false)
            && in_array($this->roleType(), ['superadmin', 'admin'], true);
    }
}
