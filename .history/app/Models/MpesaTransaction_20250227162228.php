<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MpesaTransaction extends Model {
    use HasFactory;

    protected $fillable = [
        'order_id',
        'phone_number',
        'amount',
        'mpesa_receipt_number',
        'transaction_status',
    ];

    /**
     * Relationship with Order model.
     */
    public function order() {
        return $this->belongsTo(Order::class);
    }
}
