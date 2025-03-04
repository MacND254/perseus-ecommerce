<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class MpesaService {
    protected $client;
    protected $shortcode = "123456"; // Your Till Number
    protected $passkey = "YOUR_MPESA_PASSKEY";
    protected $callbackUrl = "https://yourdomain.com/api/mpesa/callback";

    public function __construct() {
        $this->client = new Client(['verify' => false]); // Disable SSL verification for local testing
    }

    public function stkPush($phone, $amount, $orderId) {
        $timestamp = now()->format('YmdHis');
        $password = base64_encode($this->shortcode . $this->passkey . $timestamp);

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
            'auth' => ['YOUR_CONSUMER_KEY', 'YOUR_CONSUMER_SECRET']
        ]);

        return json_decode($response->getBody(), true)['access_token'];
    }
}
