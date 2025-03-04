<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Fetch cart items
    public function fetchCartData()
    {
        $user = Auth::user();
        $cart = $user->cart;
        $cartItems = $cart ? $cart->cartItems->map(function ($item) {
            return [
                'id' => $item->id,
                'product_name' => $item->product->name,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'subtotal' => $item->subtotal,
            ];
        }) : [];

        $subtotal = $cart ? $cart->total : 0;
        $vat = $subtotal * 0.16;
        $total = $subtotal + $vat;

        return response()->json([
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'vat' => $vat,
            'total' => $total,
        ]);
    }

    // Remove item from cart
    public function removeItem($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();

        // Update cart total
        $cart = $cartItem->cart;
        $cart->total = $cart->cartItems->sum('subtotal');
        $cart->save();

        return response()->json(['success' => 'Item removed from cart']);
    }

    // Clear cart
    public function clearCart()
    {
        $user = Auth::user();
        $cart = $user->cart;

        if ($cart) {
            $cart->cartItems()->delete();
            $cart->total = 0;
            $cart->save();
        }

        return response()->json(['success' => 'Cart cleared']);
    }
}

