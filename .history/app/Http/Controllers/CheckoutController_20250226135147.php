<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\MpesaTransaction;
use App\Services\MpesaService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller {
    protected $mpesaService;

    public function __construct(MpesaService $mpesaService) {
        $this->mpesaService = $mpesaService;
    }

    public function checkout(Request $request) {
        $request->validate([
            'phone_number' => 'required|string',
            'shipping_address' => 'required|string',
        ]);

        $order = Order::create([
            'user_id' => auth()->id(),
            'order_number' => Str::random(10),
            'total_amount' => 1000, // Fetch from cart
            'payment_status' => 'pending',
            'phone_number' => $request->phone_number,
            'shipping_address' => $request->shipping_address,
        ]);

        $response = $this->mpesaService->stkPush($request->phone_number, 1000, $order->id);

        return response()->json($response);
    }
}
