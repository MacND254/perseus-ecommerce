<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer('*', function ($view) {
            $user = auth()->user();
            $cartCount = 0; // Default to 0 if no cart exists
    
            if ($user && $user->cart) {
                $cartCount = $user->cart->cartItems ? $user->cart->cartItems->count() : 0;
            }
    
            $view->with('cartCount', $cartCount);
        });
    }
    

    public function register()
    {
        //
    }
}

