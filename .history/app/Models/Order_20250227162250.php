<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'order_number', 'total_amount', 'payment_status',
        'payment_method', 'mpesa_code', 'shipping_address', 'phone_number', 'status'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public static function generateOrderNumber()
    {
        return 'ORD-' . strtoupper(Str::random(10));
    }
    public function mpesaTransaction() {
        return $this->hasOne(MpesaTransaction::class);
    }

}

