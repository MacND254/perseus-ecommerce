<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\MpesaTransaction;
use Illuminate\Support\Facades\Log;

class MpesaController extends Controller {
    public function stkCallback(Request $request) {
        Log::info("M-Pesa Callback Received", $request->all());

        $data = $request->all();

        if (!isset($data['Body']['stkCallback'])) {
            Log::error("Invalid M-Pesa Callback Data", $data);
            return response()->json(['error' => 'Invalid callback data'], 400);
        }

        $mpesaResponse = $data['Body']['stkCallback'];

        // Extract transaction details
        $merchantRequestId = $mpesaResponse['MerchantRequestID'];
        $checkoutRequestId = $mpesaResponse['CheckoutRequestID'];
        $resultCode = $mpesaResponse['ResultCode'];
        $resultDesc = $mpesaResponse['ResultDesc'];

        // Extract metadata
        $amountPaid = 0;
        $transactionId = null;
        $phoneNumber = null;

        if (isset($mpesaResponse['CallbackMetadata']['Item'])) {
            foreach ($mpesaResponse['CallbackMetadata']['Item'] as $item) {
                if ($item['Name'] == 'Amount') {
                    $amountPaid = $item['Value'];
                }
                if ($item['Name'] == 'MpesaReceiptNumber') {
                    $transactionId = $item['Value'];
                }
                if ($item['Name'] == 'PhoneNumber') {
                    $phoneNumber = $item['Value'];
                }
            }
        }

        // Extract order ID from MerchantRequestID (if structured as "ORDER-123")
        $orderId = explode("-", $merchantRequestId)[1] ?? null;

        if (!$orderId || !$transactionId) {
            Log::error("Missing required transaction data", ['orderId' => $orderId, 'transactionId' => $transactionId]);
            return response()->json(['error' => 'Missing required transaction data'], 400);
        }

        $order = Order::find($orderId);

        if (!$order) {
            Log::error("Order Not Found: " . $orderId);
            return response()->json(['error' => 'Order not found'], 404);
        }

        if ($resultCode == 0) { // Successful payment
            // Store the transaction in the database
            MpesaTransaction::create([
                'order_id' => $order->id,
                'phone_number' => $phoneNumber,
                'amount' => $amountPaid,
                'mpesa_receipt_number' => $transactionId,
                'transaction_status' => 'completed'
            ]);

            // Update the order status
            $order->update([
                'payment_status' => 'paid',
                'mpesa_transaction_id' => $transactionId,
                'status' => 'processing'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Payment successful',
                'order_id' => $orderId
            ]);
        } else { // Failed payment
            // Log failed transaction
            MpesaTransaction::create([
                'order_id' => $order->id,
                'phone_number' => $phoneNumber,
                'amount' => $amountPaid,
                'mpesa_receipt_number' => $transactionId,
                'transaction_status' => 'failed'
            ]);

            // Update order status
            $order->update(['payment_status' => 'failed']);

            return response()->json([
                'success' => false,
                'message' => 'Payment failed. Try again.'
            ]);
        }
    }
    public function getAccessToken() {
        $consumerKey = config('mpesa.consumer_key');
        $consumerSecret = config('mpesa.consumer_secret');
        $credentials = base64_encode("$consumerKey:$consumerSecret");

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . $credentials
        ])->get('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');

        if ($response->failed()) {
            Log::error("Failed to get Access Token: " . $response->body());
            return null;
        }

        return $response->json()['access_token'];
    }
    public function validation(Request $request)
    {
        Log::info("M-Pesa Validation Request", $request->all());

        return response()->json([
            "ResultCode" => 0,
            "ResultDesc" => "Accepted"
        ]);
    }

    public function confirmation(Request $request)
{
    Log::info('M-Pesa Confirmation Request:', $request->all());

    // Store the transaction using the correct column names
    $transaction = new MpesaTransaction();
    $transaction->mpesa_receipt_number = $request->input('TransID'); // Correct column
    $transaction->amount = $request->input('TransAmount');
    $transaction->phone_number = $request->input('MSISDN');
    $transaction->transaction_status = 'Completed'; // Correct column
    $transaction->save();

    return response()->json([
        "ResultCode" => 0,
        "ResultDesc" => "Accepted"
    ]);
}



}
