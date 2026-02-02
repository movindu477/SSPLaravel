<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Favorite;

class Pet extends Model
{
    protected $table = 'pets';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'pet_type',
        'accessories_type',
        'price',
        'image_url',
        'product_name'
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];
    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'pet_id');
    }

    public function getImageUrlAttribute($value)
    {
        if (empty($value)) {
            return asset('images/Petmart.png');
        }

        if (str_starts_with($value, 'http')) {
            return $value;
        }

        // Fix for legacy public images (if any) to avoid breaking them
        if ($value === 'images/Petmart.png' || $value === 'images/login.jpg' || $value === 'images/register.jpg') {
            return asset($value);
        }

        return asset('storage/' . $value);
    }
}
