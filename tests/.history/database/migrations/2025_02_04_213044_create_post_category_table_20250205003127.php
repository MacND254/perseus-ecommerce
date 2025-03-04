<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('post_category', function (Blueprint $table) {
            $table->id(); // Or $table->increments('id'); for older Laravel versions
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            // Foreign keys (Important!)
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade'); // Assuming you have a 'posts' table
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade'); // Assuming you have a 'categories' table

            // Unique constraint to prevent duplicate entries (Optional but Recommended)
            $table->unique(['post_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_category');
    }
};
