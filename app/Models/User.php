<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    // SQL Server table name - User is a reserved keyword, Laravel should handle brackets automatically
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
        'role'
    ];

    protected $hidden = [
        'password',
        'confirm_password'
        ];
}
