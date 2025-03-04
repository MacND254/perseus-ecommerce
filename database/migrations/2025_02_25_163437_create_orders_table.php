<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // User who placed the order
            $table->string('order_number')->unique(); // Unique order number
            $table->decimal('total_amount', 10, 2); // Total order amount
            $table->string('payment_status')->default('pending'); // Payment status: pending, paid, failed
            $table->string('payment_method')->default('mpesa'); // Payment method: M-Pesa
            $table->string('mpesa_code')->nullable(); // M-Pesa transaction ID
            $table->string('shipping_address'); // Shipping address
            $table->string('phone_number'); // Customer phone number
            $table->enum('status', ['pending', 'processing', 'shipped', 'delivered'])->default('pending'); // Order status
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
