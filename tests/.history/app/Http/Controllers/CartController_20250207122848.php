<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Add item to cart
    public function add(Request $request)
    {
        $product = Product::find($request->product_id);
        if (!$product) {
            return response()->json(['error' => 'Product not found.'], 404);
        }

        $cart = session()->get('cart', []);
        $cartKey = $request->product_id . '-' . $request->size . '-' . $request->color;

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += $request->quantity;
        } else {
            $cart[$cartKey] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'discount_price' => $product->discount_price ?? null,
                'quantity' => $request->quantity,
                'size' => $request->size,
                'color' => $request->color,
                'image' => asset('storage/' . json_decode($product->product_image, true)[0] ?? 'default.jpg'),
            ];
        }

        session()->put('cart', $cart);

        return $this->generateCartResponse($cart, 'Product added to cart!');
    }

    // Remove item from cart
    public function remove($key)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$key])) {
            unset($cart[$key]);
            session()->put('cart', $cart);
        }

        return $this->generateCartResponse($cart);
    }

    // Clear entire cart
    public function clear()
    {
        session()->forget('cart');
        return $this->generateCartResponse([]);
    }

    // Fetch cart data
    public function getCartData()
    {
        $cart = session()->get('cart', []);
        return $this->generateCartResponse($cart);
    }

    // Calculate cart totals
    private function calculateCartTotal($cart)
    {
        $subtotal = array_sum(array_map(fn ($item) => ($item['discount_price'] ?? $item['price']) * $item['quantity'], $cart));
        $vat = $subtotal * 0.16; // 16% VAT
        $total = $subtotal + $vat;

        return [
            'subtotal' => $subtotal,
            'vat' => $vat,
            'total' => $total,
        ];
    }

    // Generate cart response
    private function generateCartResponse($cart, $message = null)
    {
        $cartTotal = $this->calculateCartTotal($cart);

        return response()->json([
            'message' => $message,
            'cart_count' => count($cart),
            'cart_html' => view('partials.cart-dropdown', [
                'cart' => $cart,
                'subtotal' => $cartTotal['subtotal'],
                'vat' => $cartTotal['vat'],
                'total' => $cartTotal['total'],
            ])->render(),
        ]);
    }
}
