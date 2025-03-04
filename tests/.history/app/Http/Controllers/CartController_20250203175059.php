<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Ensure user is authenticated
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Add product to cart
    public function addToCart(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $userId = Auth::id();

        // Get or create cart for the user
        $cart = Cart::firstOrCreate(['user_id' => $userId]);

        // Check if item already exists in cart
        $cartItem = CartItem::where('cart_id', $cart->id)->where('product_id', $productId)->first();

        if ($cartItem) {
            // Update quantity if product exists
            $cartItem->quantity += $request->input('quantity', 1);
            $cartItem->total_price = $cartItem->quantity * $product->price;
            $cartItem->save();
        } else {
            // Add new product to cart
            $cart->items()->create([
                'product_id' => $productId,
                'quantity' => $request->input('quantity', 1),
                'price' => $product->price,
                'total_price' => $product->price * $request->input('quantity', 1),
            ]);
        }

        return response()->json(['message' => 'Product added to cart successfully!']);
    }

    // Remove item from cart
    public function removeItem($itemId)
    {
        $cartItem = CartItem::findOrFail($itemId);
        $cartItem->delete();

        return response()->json(['message' => 'Item removed from cart successfully!']);
    }

    // Clear cart
    public function clearCart()
    {
        $userId = Auth::id();
        $cart = Cart::where('user_id', $userId)->first();

        if ($cart) {
            $cart->items()->delete();
            return response()->json(['message' => 'Cart cleared successfully!']);
        }

        return response()->json(['message' => 'Cart is already empty.']);
    }

    // Fetch cart items
    public function getCartItems()
    {
        $userId = Auth::id();
        $cart = Cart::where('user_id', $userId)->with('items.product')->first();

        return response()->json(['cart' => $cart]);
    }
}
