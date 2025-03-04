<div class="p-4 w-[500px] max-h-[80vh] overflow-y-auto bg-white shadow-lg rounded-lg border border-gray-200 text-black relative" id="cart-dropdown">
    <h3 class="text-lg font-semibold mb-4">Your Cart</h3>

    <div id="cart-items">
        @if(session('cart') && count(session('cart')) > 0)
            <div class="grid grid-cols-4 gap-4 font-semibold border-b pb-2 mb-2">
                <div>Item</div>
                <div class="text-center">Qty</div>
                <div class="text-right">Price</div>
                <div class="text-right">Action</div>
            </div>

            @foreach(session('cart') as $key => $item)
                <div class="grid grid-cols-4 gap-4 items-center mb-4" data-key="{{ $key }}">
                    <div class="flex items-center">
                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-10 h-10 object-cover rounded">
                        <div class="ml-2">
                            <p class="font-semibold text-black">{{ $item['name'] }}</p>
                            <p class="text-sm text-gray-700">{{ $item['size'] }} / {{ $item['color'] }}</p>
                        </div>
                    </div>

                    <div class="text-center">
                        <input type="number" value="{{ $item['quantity'] }}" min="1"
                               data-key="{{ $key }}" onchange="updateQuantity('{{ $key }}', this.value)"
                               class="w-16 text-center border border-gray-300 rounded">
                    </div>

                    <div class="text-right">
                        <p class="text-sm text-black">${{ number_format(($item['discount_price'] ?? $item['price']) * $item['quantity'], 2) }}</p>
                    </div>

                    <div class="text-right">
                        <button class="remove-item text-red-500 hover:text-red-700" data-key="{{ $key }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-gray-700">Your cart is empty.</p>
        @endif
    </div>

    <div class="border-t pt-4">
        <div class="space-y-2 text-black">
            <div class="flex justify-between">
                <span>Subtotal</span>
                <span id="cart-subtotal">${{ number_format($subtotal ?? 0, 2) }}</span>
            </div>
            <div class="flex justify-between">
                <span>VAT (16%)</span>
                <span id="cart-vat">${{ number_format($vat ?? 0, 2) }}</span>
            </div>
            <div class="flex justify-between font-semibold">
                <span>Total</span>
                <span id="cart-total">${{ number_format($total ?? 0, 2) }}</span>
            </div>
        </div>
        <button class="clear-cart w-full mt-4 bg-red-500 text-white py-2 rounded hover:bg-red-600">Clear Cart</button>
    </div>

    <script>
        document.getElementById('cart-dropdown').addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-item')) {
                const key = event.target.dataset.key;
                removeCartItem(key);
            } else if (event.target.classList.contains('clear-cart')) {
                clearCart();
            }
        });

        function removeCartItem(key) {
            fetch(`/cart/remove/${key}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                },
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('cart-count').innerText = data.cart_count;
                document.getElementById('cart-dropdown').innerHTML = data.cart_html;
            })
            .catch(error => console.error('Error removing item:', error));
        }

        function clearCart() {
            fetch("/cart/clear", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                },
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('cart-count').innerText = data.cart_count;
                document.getElementById('cart-dropdown').innerHTML = data.cart_html;
            })
            .catch(error => console.error('Error clearing cart:', error));
        }

        function updateQuantity(key, quantity) {
            fetch(`/cart/update-quantity/${key}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ quantity: quantity })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('cart-dropdown').innerHTML = data.cart_html;
                document.getElementById('cart-count').innerText = data.cart_count; // Update the count
            })
            .catch(error => console.error('Error updating quantity:', error));
        }
    </script>
</div>
