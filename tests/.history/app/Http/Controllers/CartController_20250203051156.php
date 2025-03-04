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
        $cart = session()->get('cart', []);

        $id = $request->input('id');

        if (isset($cart[$id])) {
            // Update quantity if item exists
            $cart[$id]['quantity'] += $request->input('quantity', 1);
        } else {
            // Add new product
            $cart[$id] = [
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'image' => $request->input('image'),
                'quantity' => $request->input('quantity', 1),
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'cart_count' => count($cart)
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
