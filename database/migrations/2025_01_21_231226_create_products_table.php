<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2); // Price with two decimal places
            $table->integer('quantity')->default(0); // Stock quantity
            $table->string('product_image')->nullable(); // Image path
            $table->json('additional_images')->nullable(); // Store multiple images in JSON format
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Foreign key to categories
            $table->timestamps(); // Created_at and Updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

