<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    // Ensure the user is authenticated
    //public function __construct()
   // {
   //     $this->middleware('auth');
   // }

    // Show the checkout form with cart items and total
    public function index()
    {
        return view('checkout.index'); // Ensure this view exists
    }

    // Process the checkout and create an order
    public function process(Request $request)
    {
        // Get the authenticated user
        $user = auth()->user();

        // Validate the request data (billing details)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string',
            'phone' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        // Retrieve cart items for the user
        $cartItems = Cart::where('user_id', $user->id)->get();
        $cartTotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // Create an order record
        $order = Order::create([
            'user_id' => $user->id,
            'total' => $cartTotal,
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'payment_method' => $request->payment_method,
            'status' => 'pending', // Default status can be pending
        ]);

        // Clear the user's cart after successful checkout
        Cart::where('user_id', $user->id)->delete();

        // Redirect to a success page or order summary page
        return redirect()->route('order.details', $order->id)->with('success', 'Order placed successfully');
    }
}
