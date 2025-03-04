<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MpesaService
{
    private $base_url;
    private $consumer_key;
    private $consumer_secret;
    private $shortcode;
    private $passkey;
    private $callback_url;

    public function __construct()
    {
        $this->base_url = config('mpesa.env') === 'sandbox' ? 'https://sandbox.safaricom.co.ke' : 'https://api.safaricom.co.ke';
        $this->consumer_key = config('mpesa.consumer_key');
        $this->consumer_secret = config('mpesa.consumer_secret');
        $this->shortcode = config('mpesa.shortcode');
        $this->passkey = config('mpesa.passkey');
        $this->callback_url = config('mpesa.callback_url');
    }

    /**
     * Generate M-Pesa Access Token
     */
    public function getAccessToken()
    {
        $response = Http::withBasicAuth($this->consumer_key, $this->consumer_secret)
            ->get($this->base_url . '/oauth/v1/generate?grant_type=client_credentials');

        return $response->json()['access_token'] ?? null;
    }

    /**
     * Initiate STK Push Request
     */
    public function stkPush($amount, $phone, $orderId)
    {
        $accessToken = $this->getAccessToken();

        if (!$accessToken) {
            return ['error' => 'Failed to obtain access token'];
        }

        $timestamp = now()->format('YmdHis');
        $password = base64_encode($this->shortcode . $this->passkey . $timestamp);

        $response = Http::withToken($accessToken)
            ->post($this->base_url . '/mpesa/stkpush/v1/processrequest', [
                'BusinessShortCode' => $this->shortcode,
                'Password' => $password,
                'Timestamp' => $timestamp,
                'TransactionType' => 'CustomerPayBillOnline',
                'Amount' => $amount,
                'PartyA' => $phone,
                'PartyB' => $this->shortcode,
                'PhoneNumber' => $phone,
                'CallBackURL' => $this->callback_url,
                'AccountReference' => $orderId,
                'TransactionDesc' => "Payment for Order #$orderId"
            ]);

        return $response->json();
    }
}
