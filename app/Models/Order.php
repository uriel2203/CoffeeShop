<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'customer_name',
        'subtotal',
        'tax_amount',
        'discount_type',
        'discount_amount',
        'total',
        'payment_method',
        'cash_tendered',
        'cash_change',
        'status',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
