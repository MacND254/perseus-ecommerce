<?php

return [

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'), // Default guard (usually 'web')
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'admin' => [ // Add the 'admin' guard
            'driver' => 'session',
            'provider' => 'admins', // Link it to the 'admins' provider
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'admins' => [ // Add the 'admins' provider
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class, // VERY IMPORTANT: Correct path to your Admin model
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
        'admins' => [ // Password reset configuration for admins
            'provider' => 'admins',
            'table' => 'admin_password_reset_tokens', // Separate table for admin password resets
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
