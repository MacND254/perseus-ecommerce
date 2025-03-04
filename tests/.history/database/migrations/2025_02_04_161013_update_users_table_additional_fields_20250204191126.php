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
        Schema::table('users', function (Blueprint $table) {
            // Contact Information
            $table->string('phone')->nullable()->after('email');
            $table->string('address')->nullable()->after('phone');
            $table->string('city')->nullable()->after('address');

            // Profile & Social Login Information
            $table->string('avatar')->nullable()->after('profile_photo_path');
            $table->string('social_id')->nullable()->after('avatar');
            $table->string('provider')->nullable()->after('social_id');

            // Two-Factor Authentication
            $table->text('two_factor_secret')->nullable()->after('provider');
            $table->text('two_factor_recovery_codes')->nullable()->after('two_factor_secret');

            // System Timestamps
            $table->timestamp('last_login_at')->nullable()->after('updated_at');
            $table->softDeletes()->after('last_login_at');  // Adds 'deleted_at' column for soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'address',
                'city',
                'avatar',
                'social_id',
                'provider',
                'two_factor_secret',
                'two_factor_recovery_codes',
                'last_login_at',
                'deleted_at'
            ]);
        });
    }
};
