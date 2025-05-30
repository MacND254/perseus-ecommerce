<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
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
    $product = Product::findOrFail($request->product_id);

    // Check if user already has an active cart
    $cart = Cart::firstOrCreate(['user_id' => $user->id, 'status' => 'active'], ['total' => 0]);

    // Check if item already exists in cart
    $cartItem = CartItem::where('cart_id', $cart->id)
                        ->where('product_id', $product->id)
                        ->first();

    if ($cartItem) {
        // Update quantity & subtotal
        $cartItem->quantity += $request->quantity;
        $cartItem->subtotal = $cartItem->quantity * $product->price;
        $cartItem->save();
    } else {
        // Create new cart item
        CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'price' => $product->price,
            'subtotal' => $request->quantity * $product->price,
        ]);
    }

    // Update cart total
    $cart->total = $cart->cartItems->sum('subtotal');
    $cart->save();

    return response()->json([
        'success' => 'Item added to cart successfully!',
        'cartCount' => $cart->cartItems->sum('quantity') // Return updated cart count
    ]);
}


    // Fetch Cart Data
    public function fetchCart()
    {
        if (!Auth::check()) {
            return response()->json(['cartItems' => [], 'cartCount' => 0, 'subtotal' => 0, 'vat' => 0, 'total' => 0]);
        }

        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->where('status', 'active')->first();

        if (!$cart) {
            return response()->json(['cartItems' => [], 'cartCount' => 0, 'subtotal' => 0, 'vat' => 0, 'total' => 0]);
        }

        $cartItems = $cart->cartItems->map(function ($item) {
            return [
                'id' => $item->id,
                'product_name' => $item->product->name,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'subtotal' => $item->subtotal,
            ];
        });

        $subtotal = $cart->total;
        $vat = $subtotal * 0.16;
        $total = $subtotal + $vat;

        return response()->json([
            'cartItems' => $cartItems,
            'cartCount' => $cart->cartItems->sum('quantity'),
            'subtotal' => $subtotal,
            'vat' => $vat,
            'total' => $total
        ]);
    }

    // Remove an item from the cart
    public function removeItem($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cart = $cartItem->cart;

        $cartItem->delete();

        // Update cart total
        $cart->total = $cart->cartItems->sum('subtotal');
        $cart->save();

        return response()->json(['message' => 'Item removed']);
    }

    // Clear the cart
    public function clearCart()
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->where('status', 'active')->first();

        if ($cart) {
            $cart->cartItems()->delete();
            $cart->total = 0;
            $cart->save();
        }

        return response()->json(['message' => 'Cart cleared']);
    }

}
