<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class MpesaController extends Controller
{
    public function callback(Request $request)
    {
        $mpesaResponse = $request->all();
        \Log::info("M-Pesa Callback: ", $mpesaResponse);

        if (isset($mpesaResponse['Body']['stkCallback']['ResultCode'])) {
            $resultCode = $mpesaResponse['Body']['stkCallback']['ResultCode'];
            $orderId = explode("_", $mpesaResponse['Body']['stkCallback']['MerchantRequestID'])[1];

            $order = Order::find($orderId);

            if ($resultCode == 0 && $order) {
                $order->update(['payment_status' => 'paid']);
            }
        }

        return response()->json(['status' => 'OK']);
    }
}

