<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Show Cart Items (for dropdown)
    public function show()
    {
        $cart = session()->get('cart', []);
        $subtotal = array_sum(array_map(function ($item) {
            return ($item['price'] * $item['quantity']);
        }, $cart));
        $vat = $subtotal * 0.16;
        $total = $subtotal + $vat;

        return view('partials.cart-dropdown', compact('cart', 'subtotal', 'vat', 'total'));
    }

    // Add to Cart
    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        // Check if product already in cart
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $request->quantity;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->discount_price ?? $product->price,
                'quantity' => $request->quantity,
                'image' => json_decode($product->product_image, true)[0] ?? 'default.jpg',
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'message' => "{$product->name} added to cart!",
            'cart_count' => count($cart),
        ]);
    }

    // Remove Item from Cart
    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$request->product_id])) {
            unset($cart[$request->product_id]);
            session()->put('cart', $cart);
        }

        return response()->json(['message' => 'Item removed from cart.']);
    }

    // Clear Entire Cart
    public function clear()
    {
        session()->forget('cart');
        return response()->json(['message' => 'Cart cleared!']);
    }
}
