@php
    $cart = session('cart', []);
    $subtotal = $subtotal ?? 0;
    $vat = $vat ?? 0;
    $total = $total ?? 0;
@endphp


<div id="cart-dropdown" class="hidden absolute right-0 mt-2 w-96 max-h-[80vh] bg-white rounded-lg shadow-lg overflow-y-auto z-70 p-4">
    @if(count($cart) > 0)
        <h2 class="text-lg font-bold mb-4 text-gray-500">Your Cart</h2>

        @foreach($cart as $key => $item)
            <div class="flex items-center justify-between mb-4 border-b pb-2">
                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-16 h-16 rounded-md object-contain">

                <div class="ml-4 flex-1">
                    <h3 class="font-semibold text-gray-500">{{ $item['name'] }}</h3>
                    <p class="text-sm text-gray-500">Size: {{ $item['size'] ?? 'N/A' }}, Color: {{ $item['color'] ?? 'N/A' }}</p>
                    <p class="text-sm text-gray-500">Qty: {{ $item['quantity'] }}</p>
                    <p class="text-sm text-blue-500">Price: Ksh. {{ number_format(($item['discount_price'] ?? $item['price']) * $item['quantity']) }}</p>
                </div>

                <button class="remove-item text-red-500 hover:text-red-700" data-key="{{ $key }}">
                    &times;
                </button>
            </div>
        @endforeach

        <!-- Subtotal, VAT, Total -->
        <div class="mt-4">
            <p class="text-sm text-blue-500">Subtotal: <span class="font-semibold">Ksh. {{ number_format($subtotal) }}</span></p>
            <p class="text-sm text-blue-500">VAT (16%): <span class="font-semibold">Ksh. {{ number_format($vat) }}</span></p>
            <p class="text-lg font-bold text-blue-500">Total: Ksh. {{ number_format($total) }}</p>
        </div>

        <!-- Cart Buttons -->
        <div class="mt-4 flex justify-between">
           <!-- Clear Cart Button -->
<button id="clear-cart" class="w-full bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">
    Clear Cart
</button>
            <a href="{{ route('checkout') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Checkout
            </a>
        </div>

    @else
        <p class="text-center text-gray-500">Your cart is empty.</p>
    @endif
</div>

<!-- Cart Dropdown Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Remove Item Button
        document.querySelectorAll('.remove-item').forEach(button => {
            button.addEventListener('click', function() {
                let key = this.dataset.key;
                fetch(`{{ url('/cart/remove') }}/${key}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('cart-content').innerHTML = data.cart_html;
                    document.getElementById('cart-count').textContent = data.cart_count;
                })
                .catch(error => console.error('Error:', error));
            });
        });

        // Clear Cart Button
        document.getElementById('clear-cart').addEventListener('click', function() {
            fetch(`{{ route('cart.clear') }}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('cart-content').innerHTML = data.cart_html;
                document.getElementById('cart-count').textContent = data.cart_count;
            })
            .catch(error => console.error('Error:', error));
        });
    });
</script>

