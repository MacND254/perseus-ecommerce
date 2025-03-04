<!-- resources/views/checkout/index.blade.php -->
@extends('layouts.app')

@section('title', 'Checkout | Perseus eCommerce')

@section('content')
    <section class="container mx-auto py-12">
        <h1 class="text-3xl font-bold mb-6">Checkout</h1>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Billing Details -->
            <div>
                <h2 class="text-xl font-bold mb-4">Billing & Shipping Information</h2>
                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium">Full Name:</label>
                        <input type="text" id="name" name="name" required class="w-full border rounded p-2">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium">Email Address:</label>
                        <input type="email" id="email" name="email" required class="w-full border rounded p-2">
                    </div>
                    <div class="mb-4">
                        <label for="address" class="block text-sm font-medium">Shipping Address:</label>
                        <input type="text" id="address" name="address" required class="w-full border rounded p-2">
                    </div>
                    <div class="mb-4">
                        <label for="phone" class="block text-sm font-medium">Phone Number:</label>
                        <input type="tel" id="phone" name="phone" required class="w-full border rounded p-2">
                    </div>
                    <div class="mb-4">
                        <label for="payment" class="block text-sm font-medium">Payment Method:</label>
                        <select id="payment" name="payment_method" class="w-full border rounded p-2">
                            <option value="credit_card">Credit Card</option>
                            <option value="paypal">PayPal</option>
                            <option value="bank_transfer">Bank Transfer</option>
                        </select>
                    </div>
                    <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">Place Order</button>
                </form>
            </div>

            <!-- Order Summary -->
            <div>
                <h2 class="text-xl font-bold mb-4">Order Summary</h2>
                <div class="space-y-4">
                    @foreach($cartItems as $item)
                        <div class="flex justify-between items-center p-4 bg-gray-100 rounded">
                            <p>{{ $item->product->name }} (x{{ $item->quantity }})</p>
                            <p>${{ $item->product->price * $item->quantity }}</p>
                        </div>
                    @endforeach
                </div>
                <hr class="my-4">
                <p class="flex justify-between font-bold text-lg">
                    <span>Total:</span>
                    <span>${{ $cartTotal }}</span>
                </p>
            </div>
        </div>
    </section>
@endsection
