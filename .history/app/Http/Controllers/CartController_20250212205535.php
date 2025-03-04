<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
{
    $cart = auth()->user()->cart; // Get the user's cart (assuming the user is authenticated)
    $cartCount = $cart ? $cart->cartItems->count() : 0; // Get the cart item count, default to 0 if the cart is empty

    return view('products.index', compact('cartCount'));


}

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

    // Check if the user has an active cart; otherwise, create a new one
    $cart = Cart::where('user_id', $user->id)
                ->where('status', 'active')
                ->first();

    if (!$cart) {
        $cart = Cart::create([
            'user_id' => $user->id,
            'total' => 0,
            'status' => 'active', // Ensure the new cart is active
        ]);
    }

    // Check if the item is already in the cart
    $cartItem = CartItem::where('cart_id', $cart->id)
                        ->where('product_id', $product->id)
                        ->first();

    if ($cartItem) {
        // Update the quantity and subtotal
        $cartItem->quantity += $request->quantity;
        $cartItem->subtotal = $cartItem->quantity * $product->price;
        $cartItem->save();
    } else {
        // Create a new cart item
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
        $cartCount = $cart ? $cart->cartItems->count() : 0; // Get the cart item count
        return view('your-view', compact('cart', 'cartCount')); // Pass the cart count to the view
    }


    public function fetchCartData()
    {
        $cart = Cart::where('user_id', auth()->id())
                    ->where('status', 'active')
                    ->first();
    
        if (!$cart) {
            return response()->json([
                'cartCount' => 0,  // Return 0 if no active cart exists
                'cartItems' => [],
                'total' => 0,
                'vat' => 0,
            ]);
        }
    
        $cartItems = $cart->cartItems;
        $total = $cart->total;
        $vat = $total * 0.16;
    
        // Calculate total quantity of all items
        $cartCount = $cartItems->sum('quantity');
    
        return response()->json([
            'cartCount' => $cartCount,
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
public function checkout()
{
    $cart = auth()->user()->cart;

    if (!$cart || $cart->cartItems->isEmpty()) {
        return response()->json(['error' => 'Your cart is empty!'], 400);
    }

    // Mark cart as checked out
    $cart->update(['status' => 'checked_out']);

    return response()->json(['success' => 'Checkout successful!']);
}


}
