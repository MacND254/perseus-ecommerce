<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /*/ Ensure user is authenticated
    public function __construct()
    {
        $this->middleware('auth');
    }

    */ // Add product to cart
    public function addToCart(Request $request, $productId)
{
    $product = Product::findOrFail($productId);
    $userId = Auth::id();
    $quantity = $request->input('quantity', 1);

    // Get or create the user's cart
    $cart = Cart::firstOrCreate(['user_id' => $userId]);

    // Check if the product is already in the cart
    $cartItem = CartItem::where('cart_id', $cart->id)
                        ->where('product_id', $productId)
                        ->first();

    if ($cartItem) {
        // Update quantity and total price if the product exists
        $cartItem->quantity += $quantity;
        $cartItem->total_price = $cartItem->quantity * $product->price;
        $cartItem->save();
    } else {
        // Add new product to cart
        $cart->items()->create([
            'product_id' => $productId,
            'quantity' => $quantity,
            'price' => $product->price,
            'total_price' => $product->price * $quantity,
        ]);
    }

    // Update cart totals
    $this->updateCartTotals($cart);

    return response()->json(['message' => 'Product added to cart successfully!']);
}

private function updateCartTotals(Cart $cart)
{
    $subtotal = $cart->items->sum('total_price');
    $vat = $subtotal * 0.16;
    $total = $subtotal + $vat;

    $cart->update([
        'subtotal' => $subtotal,
        'vat' => $vat,
        'total' => $total,
    ]);
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
