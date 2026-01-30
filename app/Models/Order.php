<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'status',
        'shipping_address',
        'shipping_city',
        'shipping_phone',
        'payment_method',
        'total',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
