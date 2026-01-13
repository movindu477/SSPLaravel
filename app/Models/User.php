<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasProfilePhoto, HasTeams, TwoFactorAuthenticatable;

    protected $table = 'User';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'phonenumber',
        'role',
        'created_at',
        'current_team_id',
        'profile_photo_path',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin()
    {
        return ($this->role ?? 'user') === 'admin';
    }
}
