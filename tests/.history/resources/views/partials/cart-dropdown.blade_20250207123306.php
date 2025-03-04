@php
    $cart = session('cart', []);
    $subtotal = $subtotal ?? 0;
    $vat = $vat ?? 0;
    $total = $total ?? 0;
@endphp

<!-- Cart Dropdown -->
<div id="cart-dropdown" class="hidden fixed top-16 right-4 w-96 max-h-[80vh] bg-white rounded-lg shadow-lg overflow-y-auto z-[9999] p-4 border border-gray-200">
    @if(count($cart) > 0)
        <h2 class="text-lg font-bold mb-4 text-gray-700">Your Cart</h2>

        @foreach($cart as $key => $item)
            <div class="flex items-center justify-between mb-4 border-b pb-2">
                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-16 h-16 rounded-md object-contain">

                <div class="ml-4 flex-1">
                    <h3 class="font-semibold text-gray-700">{{ $item['name'] }}</h3>
                    <p class="text-sm text-gray-600">Size: {{ $item['size'] ?? 'N/A' }}, Color: {{ $item['color'] ?? 'N/A' }}</p>
                    <p class="text-sm text-gray-600">Qty: {{ $item['quantity'] }}</p>
                    <p class="text-sm text-blue-500">Price: Ksh. {{ number_format(($item['discount_price'] ?? $item['price']) * $item['quantity']) }}</p>
                </div>

                <button class="remove-item text-red-500 hover:text-red-700" data-key="{{ $key }}">
                    &times;
                </button>
            </div>
        @endforeach

        <!-- Cart Totals -->
        <div class="mt-4 border-t pt-4">
            <div class="flex justify-between text-sm text-gray-600">
                <span>Subtotal:</span>
                <span>KES {{ number_format($subtotal, 2) }}</span>
            </div>
            <div class="flex justify-between text-sm text-gray-600">
                <span>VAT (16%):</span>
                <span>KES {{ number_format($vat, 2) }}</span>
            </div>
            <div class="flex justify-between font-bold text-lg text-gray-700">
                <span>Total:</span>
                <span>KES {{ number_format($total, 2) }}</span>
            </div>
        </div>

        <!-- Cart Buttons -->
        <div class="mt-4 flex justify-between">
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
        const cartDropdown = document.getElementById('cart-dropdown');

        document.getElementById('cart-button').addEventListener('click', function() {
            cartDropdown.classList.toggle('hidden');
        });

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
