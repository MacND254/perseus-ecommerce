<div id="cart-dropdown" class="absolute right-0 mt-2 w-[500px] h-[80vh] bg-white shadow-lg rounded-lg p-4 overflow-y-auto hidden z-50">
    <h3 class="text-lg font-semibold mb-4">Your Cart</h3>

    <!-- Cart Items -->
    <div id="cart-items">
        @if(session('cart') && count(session('cart')) > 0)
            <!-- Table Header -->
            <div class="grid grid-cols-4 gap-4 font-semibold border-b pb-2 mb-2">
                <div>Item</div>
                <div class="text-center">Qty</div>
                <div class="text-right">Price</div>
                <div class="text-right">Action</div>
            </div>

            <!-- Cart Items -->
            @foreach(session('cart') as $key => $item)
                <div class="grid grid-cols-4 gap-4 items-center mb-4" data-key="{{ $key }}">
                    <!-- Item Info -->
                    <div class="flex items-center">
                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-12 h-12 object-cover rounded">
                        <div class="ml-2">
                            <p class="font-semibold">{{ $item['name'] }}</p>
                            <p class="text-sm text-gray-500">{{ $item['size'] ?? '' }} {{ $item['color'] ?? '' }}</p>
                        </div>
                    </div>

                    <!-- Quantity -->
                    <div class="text-center">
                        <p class="text-sm">{{ $item['quantity'] }}</p>
                    </div>

                    <!-- Price -->
                    <div class="text-right">
                        <p class="text-sm">Ksh. {{ number_format(($item['discount_price'] ?? $item['price']) * $item['quantity'], 2) }}</p>
                    </div>

                    <!-- Remove Button -->
                    <div class="text-right">
                        <button class="remove-item-btn text-red-500 hover:text-red-700" data-key="{{ $key }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-gray-500">Your cart is empty.</p>
        @endif
    </div>

    <!-- Cart Summary -->
    <div class="border-t pt-4">
        <div class="space-y-2">
            <div class="flex justify-between">
                <span>Subtotal</span>
                <span id="cart-subtotal">Ksh. {{ number_format($subtotal ?? 0, 2) }}</span>
            </div>
            <div class="flex justify-between">
                <span>VAT (16%)</span>
                <span id="cart-vat">Ksh. {{ number_format($vat ?? 0, 2) }}</span>
            </div>
            <div class="flex justify-between font-semibold">
                <span>Total</span>
                <span id="cart-total">Ksh. {{ number_format($total ?? 0, 2) }}</span>
            </div>
        </div>

        <!-- Clear Cart Button -->
        <button id="clear-cart-btn" class="w-full mt-4 bg-red-500 text-white py-2 rounded hover:bg-red-600">Clear Cart</button>
    </div>

    <!-- JavaScript for Cart Functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Remove Item from Cart
            document.querySelectorAll('.remove-item-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const key = this.getAttribute('data-key');

                    fetch(`{{ route('cart.remove') }}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ key: key })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.querySelector(`.grid[data-key="${key}"]`).remove();
                            updateCartSummary(data.cart_count, data.subtotal, data.vat, data.total);
                        }
                    })
                    .catch(error => console.error('Error:', error));
                });
            });

            // Clear Entire Cart
            document.getElementById('clear-cart-btn').addEventListener('click', function () {
                fetch(`{{ route('cart.clear') }}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('cart-items').innerHTML = '<p class="text-gray-500">Your cart is empty.</p>';
                        updateCartSummary(0, 0, 0, 0);
                    }
                })
                .catch(error => console.error('Error:', error));
            });

            // Update Cart Summary Function
            function updateCartSummary(count, subtotal, vat, total) {
                document.getElementById('cart-count').textContent = count;
                document.getElementById('cart-subtotal').textContent = 'Ksh. ' + subtotal.toFixed(2);
                document.getElementById('cart-vat').textContent = 'Ksh. ' + vat.toFixed(2);
                document.getElementById('cart-total').textContent = 'Ksh. ' + total.toFixed(2);
            }
        });
    </script>
</div>
