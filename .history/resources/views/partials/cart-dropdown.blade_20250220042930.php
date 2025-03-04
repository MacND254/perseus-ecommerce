<div class="p-4">
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

    <!-- Cart Summary & Buttons -->
    <div class="p-2 text-sm">
        <p class="font-semibold">Subtotal: KSh {{ number_format($subtotal, 2) }}</p>
        <p class="text-gray-500">VAT (16%): KSh {{ number_format($vat, 2) }}</p>
        <p class="font-bold">Total: KSh {{ number_format($total, 2) }}</p>

        <div class="mt-2 flex justify-between">
            <button id="clear-cart" class="text-sm bg-red-500 text-white px-3 py-1 rounded">Clear Cart</button>
            <a href="{{ route('checkout') }}" class="text-sm bg-green-500 text-white px-3 py-1 rounded">Checkout</a>
        </div>
    </div>
</div>
