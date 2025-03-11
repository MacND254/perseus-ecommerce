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
        Schema::create('user_contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->string('phone')->nullable(); // Phone number (optional)
            $table->string('address')->nullable(); // Address (optional)
            $table->string('city')->nullable(); // City (optional)
            $table->string('state')->nullable(); // State (optional)
            $table->string('country')->nullable(); // Country (optional)
            $table->string('postal_code')->nullable(); // Postal code (optional)
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade'); // Delete user_contacts when a user is deleted
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_contacts');
    }
};
