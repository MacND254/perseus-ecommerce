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
public function fetchCartItems()
{
    if (!Auth::check()) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    $user = Auth::user();
    $cart = Cart::where('user_id', $user->id)->first();

    if (!$cart) {
        return response()->json([
            'cart_items' => [],
            'subtotal' => 0,
            'vat' => 0,
            'total' => 0,
        ]);
    }

    $cartItems = $cart->cartItems()->with('product')->get();
    $subtotal = $cart->total;
    $vat = $subtotal * 0.16;
    $total = $subtotal + $vat;

    return response()->json([
        'cart_items' => $cartItems,
        'subtotal' => number_format($subtotal, 2),
        'vat' => number_format($vat, 2),
        'total' => number_format($total, 2),
    ]);
}
public function removeItem($id)
{
    $cartItem = CartItem::find($id);

    if (!$cartItem) {
        return response()->json(['error' => 'Item not found'], 404);
    }

    $cart = $cartItem->cart;
    $cartItem->delete();

    // Update cart total
    $cart->total = $cart->cartItems->sum('subtotal');
    $cart->save();

    return response()->json(['success' => 'Item removed from cart']);
}

public function clearCart()
{
    $user = Auth::user();
    $cart = Cart::where('user_id', $user->id)->first();

    if (!$cart) {
        return response()->json(['error' => 'Cart not found'], 404);
    }

    $cart->cartItems()->delete();
    $cart->total = 0;
    $cart->save();

    return response()->json(['success' => 'Cart cleared']);
}

}
