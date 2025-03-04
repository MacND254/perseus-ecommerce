<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class MpesaService {
    protected $client;
    protected $shortcode = "174379"; // Your M-Pesa Paybill or Till Number
    protected $passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
    protected $callbackUrl = "https://gt66hftf-80.uks1.devtunnels.ms/perseus/public/api/mpesa/callback";
    protected $consumerKey = "kgC8GYIk70LAiJGjnLAljYdhxLiwSbDztZufTNCdtGyAkbHP";
    protected $consumerSecret = "G2iLA0uAVu69ZNy8M3Rd6e34mBoFoxtLOhqWGSGH11qA77e0N5gP2WlFFudhDQqi";

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
