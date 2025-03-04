<div id="cart-dropdown" class="hidden absolute right-0 mt-2 bg-white shadow-lg rounded-lg w-[500px] max-h-[80vh] overflow-y-auto z-50 p-4">
    <h3 class="text-lg font-semibold mb-4">Your Cart</h3>

    <div id="cart-items">
        @if(isset($cart) && count($cart) > 0)
            @foreach($cart as $key => $item)
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-14 h-14 rounded-lg object-cover mr-4">
                        <div>
                            <p class="font-semibold">{{ $item['name'] }}</p>
                            <p class="text-sm text-gray-500">Qty: {{ $item['quantity'] }}</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <p class="text-right mr-4">Ksh. {{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                        <button data-product-id="{{ $key }}" class="remove-item text-red-500 hover:text-red-700">
                            &#10005;
                        </button>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-gray-500">Your cart is empty.</p>
        @endif
    </div>

    <div class="border-t pt-4 mt-4">
        <div class="space-y-2">
            <div class="flex justify-between">
                <span>Subtotal</span>
                <span id="cart-subtotal">Ksh. {{ number_format($subtotal ?? 0, 2) }}</span>
            </div>
            <div class="flex justify-between">
                <span>VAT (16%)</span>
                <span id="cart-vat">Ksh. {{ number_format($vat ?? 0, 2) }}</span>
            </div>
            <div class="flex justify-between font-bold">
                <span>Total</span>
                <span id="cart-total">Ksh. {{ number_format($total ?? 0, 2) }}</span>
            </div>
        </div>
        <button id="clear-cart" class="w-full mt-4 bg-red-500 text-white py-2 rounded hover:bg-red-600">Clear Cart</button>
    </div>
</div>
