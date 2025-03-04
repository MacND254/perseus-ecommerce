<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class MpesaController extends Controller {
    public function stkCallback(Request $request) {
        Log::info("M-Pesa Callback Received", $request->all());

        $data = $request->all();
        $mpesaResponse = $data['Body']['stkCallback'];

        $orderId = explode("-", $mpesaResponse['MerchantRequestID'])[1] ?? null;
        $resultCode = $mpesaResponse['ResultCode'];
        $amountPaid = $mpesaResponse['CallbackMetadata']['Item'][0]['Value'] ?? 0;
        $transactionId = $mpesaResponse['CallbackMetadata']['Item'][1]['Value'] ?? null;

        if (!$orderId || !$transactionId) {
            Log::error("Invalid M-Pesa Callback Data", $data);
            return response()->json(['error' => 'Invalid callback data'], 400);
        }

        $order = Order::find($orderId);

        if (!$order) {
            Log::error("Order Not Found: " . $orderId);
            return response()->json(['error' => 'Order not found'], 404);
        }

        if ($resultCode == 0) {
            $order->update([
                'payment_status' => 'paid',
                'mpesa_transaction_id' => $transactionId,
                'status' => 'processing'
            ]);

            Log::info("Payment successful for Order #" . $orderId);

            return response()->json([
                'success' => true,
                'message' => 'Payment successful',
                'order_id' => $orderId
            ]);
        } else {
            $order->update(['payment_status' => 'failed']);
            Log::warning("Payment failed for Order #" . $orderId);

            return response()->json([
                'success' => false,
                'message' => 'Payment failed. Try again.'
            ]);
        }
    }
}
