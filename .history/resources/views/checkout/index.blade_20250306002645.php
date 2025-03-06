@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container mx-auto py-10">
    <h2 class="text-2xl font-bold mb-5">Checkout</h2>

    <form id="checkout-form">
        @csrf
        <div class="mb-4">
            <label class="block font-semibold">Shipping Address:</label>
            <input type="text" name="shipping_address" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Phone Number (M-Pesa):</label>
            <input type="text" name="phone_number" class="w-full border p-2 rounded" required>
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
            Pay with M-Pesa
        </button>
    </form>

    <p id="response-message" class="text-green-500 mt-4 hidden"></p>
</div>

<script>
    document.getElementById('checkout-form').addEventListener('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        fetch("{{ route('checkout.process') }}", {
            method: "POST",
            body: formData,
            headers: {
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('response-message').innerText = data.message;
                document.getElementById('response-message').classList.remove('hidden');
            } else {
                alert("Payment failed: " + (data.error || "Unknown error"));
            }
        })
        .catch(error => console.error("Error:", error));
    });
</script>
@endsection
