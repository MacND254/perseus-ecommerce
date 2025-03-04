<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MpesaService;
use App\Models\Order;

class MpesaController extends Controller
{
    protected $mpesaService;

    public function __construct(MpesaService $mpesaService)
    {
        $this->mpesaService = $mpesaService;
    }

    /**
     * Initiate STK Push
     */
    public function initiateStkPush(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'phone' => 'required|regex:/^254[7][0-9]{8}$/',
        ]);

        $order = Order::create([
            'user_id' => auth()->id(),
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        $response = $this->mpesaService->stkPush($request->amount, $request->phone, $order->id);

        return response()->json($response);
    }

    /**
     * M-Pesa Callback
     */
    public function mpesaCallback(Request $request)
    {
        $data = $request->all();

        if (isset($data['Body']['stkCallback']['ResultCode']) && $data['Body']['stkCallback']['ResultCode'] == 0) {
            $orderId = $data['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'];
            Order::where('id', $orderId)->update(['status' => 'paid']);
        }

        return response()->json(['message' => 'Callback received']);
    }
}
