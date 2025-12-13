<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'Pets';

    protected $fillable = [
        'pet_type',
        'accessories_type',
        'price',
        'image_url',
        'product_name'
    ];

    public $timestamps = true;
}
