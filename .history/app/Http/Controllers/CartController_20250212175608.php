<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Add product to cart.
     */
    public function addToCart(Request $request, $productId)
    {
        $user = Auth::user();
        $product = Product::findOrFail($productId);
        $quantity = $request->quantity;

        // Check if the user already has an active cart
        $cart = Cart::firstOrCreate(
            ['user_id' => $user->id],
            ['total' => 0]  // Initialize total as 0
        );

        // Check if the product is already in the cart
        $cartItem = CartItem::where('cart_id', $cart->id)->where('product_id', $productId)->first();

        if ($cartItem) {
            // Update quantity if the product exists in the cart
            $cartItem->quantity += $quantity;
            $cartItem->subtotal = $cartItem->quantity * $product->price;
            $cartItem->save();
        } else {
            // Create a new cart item
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $product->price,
                'subtotal' => $quantity * $product->price,
            ]);
        }

        // Recalculate total price
        $cartTotal = $cart->cartItems->sum('subtotal');
        $cart->update(['total' => $cartTotal]);

        return response()->json([
            'message' => 'Product added to cart successfully!',
            'cart_count' => $cart->cartItems->count(),
            'cart_total' => number_format($cartTotal, 2),
        ]);
    }

    /**
     * Fetch cart items dynamically.
     */
    public function getCartItems()
    {
        $cart = Cart::where('user_id', Auth::id())->first();

        return response()->json([
            'items' => $cart ? $cart->cartItems->load('product') : [],
            'cart_total' => number_format($cart ? $cart->total : 0, 2),
        ]);
    }

    public function removeCartItem($cartItemId)
    {
        $cartItem = CartItem::findOrFail($cartItemId);
        $cart = $cartItem->cart;
        $cartItem->delete();

        // Update cart total
        $cartTotal = $cart->cartItems->sum('subtotal');
        $cart->update(['total' => $cartTotal]);

        return response()->json([
            'message' => 'Item removed successfully!',
            'cart_total' => number_format($cartTotal, 2),
        ]);
    }

}
