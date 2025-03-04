<div id="cartDropdown" class="absolute right-0 mt-2 w-80 bg-white border rounded-lg shadow-lg p-4 hidden">
    <div id="cartItemsContainer">
        <h4 class="text-xs font-bold text-black">Cart</h4>
        @foreach($cartItems as $item)
            @php
                $images = json_decode($item->product->product_image, true);
                $firstImage = is_array($images) && count($images) > 0 ? $images[0] : 'default-image.jpg';
            @endphp
            <div class="cart-item flex items-center space-x-4 p-2 border-b">
                <img src="{{ asset($firstImage) }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded">
                <div class="flex-1">
                    <p class="text-sm font-semibold text-black">{{ $item->product->name }}</p>
                    <p class="text-xs text-gray-500 text-black">Qty: {{ $item->quantity }}</p>
                    <p class="text-xs font-bold text-black">KSh {{ number_format($item->subtotal, 2) }}</p>
                </div>
                <button class="text-red-500 removeItem" data-id="{{ $item->id }}">
                    &times;
                </button>
            </div>
        @endforeach
    </div>

    <!-- Cart Totals -->
    <div class="mt-2 text-sm text-black">
        <p>Subtotal: <span id="subtotal">KSh {{ number_format($subtotal, 2) }}</span></p>
        <p>VAT (16%): <span id="vat">KSh {{ number_format($vat, 2) }}</span></p>
        <p class="font-bold">Total: <span id="total">KSh {{ number_format($total, 2) }}</span></p>
    </div>

    <!-- Buttons -->
    <div class="mt-3 flex justify-between">
        <button id="clearCart" class="bg-red-500 text-white px-4 py-2 rounded text-sm">Clear Cart</button>
        <a href="{{ route('checkout') }}" class="bg-blue-500 text-white px-4 py-2 rounded text-sm">Checkout</a>
    </div>
</div>
