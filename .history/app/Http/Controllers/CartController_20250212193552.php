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

        // Find or create cart
        $cart = Cart::firstOrCreate(['user_id' => $user->id], ['total' => 0]);

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

        return response()->json(['success' => 'Item added to cart successfully!']);
    }
    // Fetch cart data for the user

    public function showCart()
{
    $cart = auth()->user()->cart; // Get the user's cart
    return view('your-view', compact('cart')); // Pass the cart to the view
}

public function fetchCartData()
{
    $cart = auth()->user()->cart;
    $cartItems = $cart->cartItems;
    $total = $cart->total;
    $vat = $total * 0.16;

    return response()->json([
        'cartItems' => $cartItems,
        'total' => $total,
        'vat' => $vat,
    ]);
}

// Update cart item quantity
public function updateQuantity(Request $request, $cartItemId)
{
    $cartItem = CartItem::findOrFail($cartItemId);
    $cartItem->quantity = $request->quantity;
    $cartItem->subtotal = $cartItem->price * $cartItem->quantity;
    $cartItem->save();

    return $this->fetchCartData();
}

// Remove item from cart
public function removeItem($cartItemId)
{
    CartItem::findOrFail($cartItemId)->delete();

    return $this->fetchCartData();
}

// Clear the cart
public function clearCart()
{
    auth()->user()->cart->cartItems()->delete();

    return $this->fetchCartData();
}

}
