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
   // Fetch Cart Data
   public function getCart()
   {
       if (!Auth::check()) {
           return response()->json(['error' => 'Unauthorized'], 401);
       }

       $user = Auth::user();

       // Get the active cart of the logged-in user
       $cart = Cart::where('user_id', $user->id)->first();

       if (!$cart) {
           return response()->json([
               'cartItems' => [],
               'subtotal' => 0,
               'vat' => 0,
               'total' => 0,
               'cartCount' => 0
           ]);
       }

       // Get cart items
       $cartItems = CartItem::where('cart_id', $cart->id)->with('product')->get();

       // Calculate totals
       $subtotal = $cart->total;
       $vat = $subtotal * 0.16; // 16% VAT
       $total = $subtotal + $vat;
       $cartCount = $cartItems->sum('quantity'); // Total item count

       return response()->json([
           'cartItems' => $cartItems,
           'subtotal' => number_format($subtotal, 2),
           'vat' => number_format($vat, 2),
           'total' => number_format($total, 2),
           'cartCount' => $cartCount
       ]);
   }

    // Remove an item from the cart
    public function removeItem($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cart = $cartItem->cart;

        $cartItem->delete();

        // Update cart total
        $cart->total = $cart->cartItems()->sum('subtotal');
        $cart->save();

        return response()->json([
            'message' => 'Item removed',
            'subtotal' => number_format($cart->total, 2),
            'vat' => number_format($cart->total * 0.16, 2),
            'total' => number_format($cart->total * 1.16, 2),
            'cartCount' => $cart->cartItems()->sum('quantity')
        ]);
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
        $cart->update(['total' => 0, 'status' => 'cleared']); // Update cart status
    }

    return response()->json([
        'message' => 'Cart cleared',
        'subtotal' => '0.00',
        'vat' => '0.00',
        'total' => '0.00',
        'cartCount' => 0
    ]);
}


public function showCartDropdown()
{
    if (!Auth::check()) {
        return view('partials.cart-dropdown', [
            'cartItems' => [], 'subtotal' => 0, 'vat' => 0, 'total' => 0, 'cartCount' => 0
        ]);
    }

    $user = Auth::user();
    $cart = Cart::where('user_id', $user->id)->where('status', 'active')->first();

    if (!$cart) {
        return view('partials.cart-dropdown', [
            'cartItems' => [], 'subtotal' => 0, 'vat' => 0, 'total' => 0, 'cartCount' => 0
        ]);
    }

    $cartItems = CartItem::where('cart_id', $cart->id)->with('product')->get();

    foreach ($cartItems as $item) {
        // Decode JSON product images
        $images = json_decode($item->product->product_image, true);

        // Extract the first image and generate full URL
        if (is_array($images) && !empty($images)) {
            $item->first_image = asset('storage/' . $images[1]);
        } else {
            $item->first_image = asset('images/default-placeholder.png'); // Fallback image
        }
    }

    $subtotal = $cart->total;
    $vat = $subtotal * 0.16;
    $total = $subtotal + $vat;
    $cartCount = $cartItems->sum('quantity');

    return view('partials.cart-dropdown', compact('cartItems', 'subtotal', 'vat', 'total', 'cartCount'));
}







}
