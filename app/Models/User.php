<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    // Sanctum trait for API token authentication
    use HasApiTokens, Notifiable;

    /**
     * SQL Server table name
     */
    protected $table = 'User';

    /**
     * Primary key
     */
    protected $primaryKey = 'id';

    /**
     * SQL Server does NOT manage updated_at automatically
     */
    public $timestamps = false;

    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'name',
        'address',
        'phonenumber',
        'email',
        'password',
        'role',
        'created_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
