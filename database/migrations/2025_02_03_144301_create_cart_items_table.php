<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained('carts')->onDelete('cascade');  // Links to carts
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');  // Links to products
            $table->integer('quantity')->default(1);
            $table->decimal('price', 10, 2);  // Price per product
            $table->decimal('subtotal', 10, 2);  // quantity * price
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
};
