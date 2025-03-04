<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Add item to cart
    public function addToCart(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'You must be logged in to add items to the cart.'], 401);
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $user = Auth::user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id], ['total' => 0]);

        $cartItem = CartItem::updateOrCreate(
            ['cart_id' => $cart->id, 'product_id' => $request->product_id],
            ['quantity' => \DB::raw("quantity + {$request->quantity}"), 'subtotal' => \DB::raw("quantity * price")]
        );

        // Recalculate total
        $cart->total = $cart->cartItems->sum('subtotal');
        $cart->save();

        return response()->json(['success' => 'Item added to cart successfully!']);
    }

    // Fetch Cart Items
    public function fetchCartItems()
    {
        $cart = Auth::user()->cart;

        if (!$cart) {
            return response()->json(['cartItems' => [], 'subtotal' => 0, 'vat' => 0, 'total' => 0, 'cartCount' => 0]);
        }

        $cartItems = $cart->cartItems->map(function ($item) {
            return [
                'id' => $item->id,
                'product_name' => $item->product->name,
                'quantity' => $item->quantity,
                'subtotal' => $item->subtotal,
            ];
        });

        $subtotal = $cart->total;
        $vat = $subtotal * 0.16;
        $total = $subtotal + $vat;

        return response()->json(['cartItems' => $cartItems, 'subtotal' => $subtotal, 'vat' => $vat, 'total' => $total, 'cartCount' => $cart->cartItems->count()]);
    }

    // Remove an Item
    public function removeItem($id)
    {
        CartItem::findOrFail($id)->delete();
        return $this->fetchCartItems();
    }

    // Clear Cart
    public function clearCart()
    {
        Auth::user()->cart->cartItems()->delete();
        return $this->fetchCartItems();
    }

    // Checkout
    public function checkout()
    {
        return view('checkout');
    }
}

