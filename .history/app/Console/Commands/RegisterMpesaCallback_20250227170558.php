<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class RegisterMpesaCallback extends Command {
    protected $signature = 'mpesa:register-callback';
    protected $description = 'Register M-Pesa callback URL with Safaricom Daraja API';

    public function handle() {
        $accessToken = $this->getAccessToken();

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json'
        ])->post('https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl', [
            'ShortCode' => config('mpesa.shortcode'),
            'ResponseType' => 'Completed',
            'ConfirmationURL' => config('mpesa.callback_url'),
            'ValidationURL' => config('mpesa.validation_url')
        ]);

        $this->info("Response: " . $response->body());
    }

    private function getAccessToken() {
        $response = Http::withBasicAuth(
            config('mpesa.consumer_key'),
            config('mpesa.consumer_secret')
        )->post('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');

        return $response->json()['access_token'] ?? null;
    }
}
