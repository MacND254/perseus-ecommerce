<!-- Cart Dropdown -->
<div id="cart-dropdown" class="absolute right-0 mt-2 w-72 bg-white border shadow-lg rounded-lg p-4 hidden">
    @if(count($cartItems) > 0)
        @foreach($cartItems as $item)
            @php
                $images = json_decode($item->product->product_image, true);
                $firstImage = is_array($images) && count($images) > 0 ? $images[0] : 'default-image.jpg';
            @endphp

            <div class="cart-item flex items-center space-x-4 p-2 border-b">
                <img src="{{ asset($firstImage) }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded">

                <div class="flex-1">
                    <p class="text-sm font-semibold">{{ $item->product->name }}</p>
                    <p class="text-xs text-gray-500">Qty: {{ $item->quantity }}</p>
                    <p class="text-xs font-bold">KSh {{ number_format($item->subtotal, 2) }}</p>
                </div>

                <button class="text-red-500 remove-item" data-id="{{ $item->id }}">
                    &times;
                </button>
            </div>
        @endforeach

        <!-- Cart Totals -->
        <div class="p-2 border-t">
            <p class="text-sm">Subtotal: <strong>KSh {{ number_format($subtotal, 2) }}</strong></p>
            <p class="text-sm">VAT (16%): <strong>KSh {{ number_format($vat, 2) }}</strong></p>
            <p class="text-lg font-bold">Total: KSh {{ number_format($total, 2) }}</p>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between mt-3">
            <button id="clear-cart" class="bg-red-500 text-white px-4 py-2 rounded text-sm">Clear Cart</button>
            <a href="{{ route('checkout') }}" class="bg-blue-500 text-white px-4 py-2 rounded text-sm">Checkout</a>
        </div>
    @else
        <p class="text-gray-500 text-center">Your cart is empty.</p>
    @endif
</div>
