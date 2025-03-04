<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);
    
        $user = Auth::user();
        $product = Product::findOrFail($request->product_id);
    
        // Ensure user has a cart
        $cart = Cart::firstOrCreate(
            ['user_id' => $user->id],
            ['total_price' => 0]
        );
    
        // Debugging: Log the cart details
        \Log::info("Cart found/created: ", $cart->toArray());
    
        // Check if the item exists in cart
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();
    
        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            $cartItem = CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'price' => $product->price
            ]);
        }
    
        // Debugging: Log the cart item details
        \Log::info("CartItem added/updated: ", $cartItem->toArray());
    
        // Update cart total price
        $cart->total_price = $cart->cartItems()->sum('price');
        $cart->save();
    
        return response()->json(['success' => 'Product added to cart!', 'cartItem' => $cartItem]);
    }
    
}



