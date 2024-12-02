<?php

namespace App\Models;

use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @method bool can(string $permission)
 * @method bool hasRole(string|array $roles)
 */
class User extends Authenticatable
{
    use HasApiTokens,  Notifiable, HasProfilePhoto, HasTeams, TwoFactorAuthenticatable, HasRoles;
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'roles_name',
        'Status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $appends = ['profile_photo_url'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'roles_name' => 'array',
        ];
    }
}
