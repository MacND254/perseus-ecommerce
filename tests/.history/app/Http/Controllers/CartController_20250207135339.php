<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $product = Product::find($request->product_id);
        if (!$product) {
            return response()->json(['error' => 'Product not found.'], 404);
        }

        $cart = session()->get('cart', []);
        $cartKey = $product->id; // Simplified key

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += $request->quantity;
        } else {
            $cart[$cartKey] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'discount_price' => $product->discount_price ?? null,
                'quantity' => $request->quantity,
                'image' => asset('storage/' . json_decode($product->product_image, true)[0] ?? 'default.jpg'),
            ];
        }

        session()->put('cart', $cart);

        return $this->getCartData();
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        foreach ($cart as $key => $item) { // Find the item by ID
            if ($item['id'] == $id) {
                unset($cart[$key]);
                break; // Stop after finding and removing the item
            }
        }
        session()->put('cart', $cart);

        return $this->getCartData();
    }


    public function clear()
    {
        session()->forget('cart');
        return $this->getCartData();
    }

    public function updateQuantity(Request $request, $id) // Use ID for update
    {
        $cart = session()->get('cart', []);
        foreach ($cart as $key => $item) {
            if ($item['id'] == $id) {
                $cart[$key]['quantity'] = (int)$request->quantity;
                break;
            }
        }

        session()->put('cart', $cart);
        return $this->getCartData();
    }

    private function calculateCartTotal($cart)
    {
        $subtotal = 0;
        if ($cart) {
            foreach ($cart as $item) {
                $subtotal += ($item['discount_price'] ?? $item['price']) * $item['quantity'];
            }
        }
        $vat = $subtotal * 0.16;
        $total = $subtotal + $vat;

        return [
            'subtotal' => $subtotal,
            'vat' => $vat,
            'total' => $total,
        ];
    }

    private function getCartData()
    {
        $cart = session()->get('cart', []);
        $cartTotal = $this->calculateCartTotal($cart);

        return response()->json([
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
