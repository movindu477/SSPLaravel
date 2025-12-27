<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $table = 'User';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'address',
        'phonenumber',
        'email',
        'password',
        'confirm_password',
        'role',
        'created_at'
    ];

    protected $hidden = [
        'password',
        'confirm_password'
    ];
}
