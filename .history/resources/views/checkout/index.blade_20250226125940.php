@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-4">Checkout</h2>

    <form id="checkout-form">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700">Shipping Address:</label>
            <input type="text" name="shipping_address" class="w-full p-2 border border-gray-300 rounded mt-1" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Phone Number (M-Pesa):</label>
            <input type="text" name="phone_number" class="w-full p-2 border border-gray-300 rounded mt-1" required>
        </div>

        <div class="mb-4">
            <h3 class="text-lg font-semibold">Order Summary</h3>
            <p>Subtotal: KES {{ number_format($cart->total, 2) }}</p>
            <p>VAT (16%): KES {{ number_format($cart->total * 0.16, 2) }}</p>
            <p class="font-bold">Total: KES {{ number_format($cart->total * 1.16, 2) }}</p>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Place Order & Pay via M-Pesa
        </button>
    </form>

    <div id="payment-status" class="mt-4 text-green-600 font-semibold hidden"></div>
</div>

<script>
    document.getElementById("checkout-form").addEventListener("submit", function(event) {
        event.preventDefault();

        let formData = new FormData(this);

        fetch("{{ route('checkout.process') }}", {
            method: "POST",
            body: formData,
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById("payment-status").innerText = data.message;
                document.getElementById("payment-status").classList.remove("hidden");

                // Redirect to M-Pesa Payment
                initiateMpesaPayment(data.order_id);
            } else {
                alert("Checkout failed: " + data.error);
            }
        })
        .catch(error => console.error("Checkout error:", error));
    });

    function initiateMpesaPayment(orderId) {
        alert("Redirecting to M-Pesa payment for Order #" + orderId);
        // Here, integrate M-Pesa API for payment
    }
</script>
@endsection
