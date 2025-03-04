<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Services\MpesaService;

class CheckoutController extends Controller {
    public function index() {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to checkout.');
        }

        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();

        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->route('dashboard')->with('error', 'Your cart is empty.');
        }

        return view('checkout.index', compact('cart', 'user'));
    }

    public function processCheckout(Request $request, MpesaService $mpesaService) {
        $request->validate([
            'shipping_address' => 'required|string',
            'phone_number' => 'required|string|min:10|max:13',
        ]);

        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();

        if (!$cart || $cart->cartItems->isEmpty()) {
            return response()->json(['error' => 'Cart is empty.'], 400);
        }

        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => Order::generateOrderNumber(),
                'total_amount' => $cart->total * 1.16, // Including VAT
                'payment_status' => 'pending',
                'payment_method' => 'mpesa',
                'shipping_address' => $request->shipping_address,
                'phone_number' => $request->phone_number,
                'status' => 'pending'
            ]);

            foreach ($cart->cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->subtotal
                ]);
            }

            $cart->cartItems()->delete();
            $cart->delete();

            DB::commit();

            // Initiate M-Pesa STK Push
            $mpesaResponse = $mpesaService->stkPush($order->total_amount, $request->phone_number, $order->id);

            if (isset($mpesaResponse['error'])) {
                return response()->json(['error' => $mpesaResponse['error']], 500);
            }

            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully! Check your phone to complete payment.',
                'order_id' => $order->id
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to process order: ' . $e->getMessage()], 500);
        }
    }

}
