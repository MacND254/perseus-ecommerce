<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class MpesaService {
    protected $client;
    protected $shortcode = "123456"; // Your M-Pesa Paybill or Till Number
    protected $passkey = "YOUR_MPESA_PASSKEY";
    protected $callbackUrl = "https://yourdomain.com/api/mpesa/callback";
    protected $consumerKey = "YOUR_CONSUMER_KEY";
    protected $consumerSecret = "YOUR_CONSUMER_SECRET";

    public function __construct() {
        $this->client = new Client(['verify' => false]); // Disable SSL verification for local testing
    }

    public function stkPush($amount, $phone, $orderId) {
        $timestamp = now()->format('YmdHis');
        $password = base64_encode($this->shortcode . $this->passkey . $timestamp);

        // Ensure phone number format (2547xxxxxxxx)
        $phone = preg_replace('/^0/', '254', $phone);

        $response = $this->client->post('https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->getAccessToken(),
                'Content-Type' => 'application/json',
            ],
            'json' => [
                "BusinessShortCode" => $this->shortcode,
                "Password" => $password,
                "Timestamp" => $timestamp,
                "TransactionType" => "CustomerPayBillOnline",
                "Amount" => $amount,
                "PartyA" => $phone,
                "PartyB" => $this->shortcode,
                "PhoneNumber" => $phone,
                "CallBackURL" => $this->callbackUrl,
                "AccountReference" => "ORDER-" . $orderId,
                "TransactionDesc" => "Payment for Order #" . $orderId
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

    private function getAccessToken() {
        $response = $this->client->post('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials', [
            'auth' => [$this->consumerKey, $this->consumerSecret]
        ]);

        return json_decode($response->getBody(), true)['access_token'];
    }
}
