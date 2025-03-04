<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RegisterMpesaCallback extends Command {
    protected $signature = 'mpesa:register-callback';
    protected $description = 'Register M-Pesa callback URL with Safaricom Daraja API';

    public function handle() {
        $accessToken = $this->getAccessToken();

        if (!$accessToken) {
            $this->error("Failed to get access token. Check your API credentials.");
            return;
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json'
        ])->post('https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl', [
            'ShortCode' => config('mpesa.shortcode'),
            'ResponseType' => 'Completed',
            'ConfirmationURL' => config('mpesa.callback_url'),
            'ValidationURL' => config('mpesa.validation_url')
        ]);

        if ($response->failed()) {
            Log::error("M-Pesa Callback Registration Failed", ['response' => $response->body()]);
            $this->error("Callback registration failed. Check logs.");
        } else {
            $this->info("Response: " . $response->body());
        }
    }

    private function getAccessToken() {
        $consumerKey = config('mpesa.consumer_key');
        $consumerSecret = config('mpesa.consumer_secret');

        $response = Http::withBasicAuth($consumerKey, $consumerSecret)
                        ->get('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');

        if ($response->failed()) {
            Log::error("Failed to get M-Pesa Access Token", ['response' => $response->body()]);
            return null;
        }

        return $response->json()['access_token'] ?? null;
    }
}
