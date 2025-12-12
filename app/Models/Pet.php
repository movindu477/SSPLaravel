<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $table = 'Pets';
    
    protected $primaryKey = 'id';
    
    public $timestamps = false;
    
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
    
    public function getImageUrlAttribute($value)
    {
        if (empty($value) || trim($value) === '') {
            return 'images/Petmart.png';
        }
        
        $value = trim($value);
        
        if (str_starts_with($value, 'http://') || str_starts_with($value, 'https://')) {
            return $value;
        }
        
        if (str_starts_with($value, '/')) {
            $value = ltrim($value, '/');
        }
        
        if (!str_starts_with($value, 'images/')) {
            $value = 'images/' . ltrim($value, '/');
        }
        
        return $value;
    }
    
    public function getImageAssetUrl()
    {
        $imageUrl = $this->image_url;
        if (str_starts_with($imageUrl, 'http://') || str_starts_with($imageUrl, 'https://')) {
            return $imageUrl;
        }
        return asset($imageUrl);
    }
}

