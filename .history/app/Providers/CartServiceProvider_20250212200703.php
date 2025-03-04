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
        View::composer('navigation-menu', function ($view) {
            $user = Auth::user();

            // Get the cart count if the user is logged in
            $cartCount = $user ? optional($user->cart)->cartItems->count() ?? 0 : 0;

            // Share it with the navigation view
            $view->with('cartCount', $cartCount);
        });
    }

    public function register()
    {
        //
    }
}

