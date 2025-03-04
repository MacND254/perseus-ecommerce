<div id="cartDropdown" class="absolute right-0 mt-2 w-64 bg-white shadow-lg rounded-lg p-4 hidden">
    <!-- Cart Items -->
    <div id="cartItemsContainer">
        @forelse(auth()->user()->cart->cartItems as $cartItem)
            <div class="flex justify-between items-center border-b py-2">
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('storage/' . $cartItem->product->product_image[0]) }}" alt="{{ $cartItem->product->name }}" class="w-12 h-12 object-cover rounded-md">
                    <span class="font-semibold">{{ $cartItem->product->name }}</span>
                </div>
                <div class="flex items-center space-x-2">
                    <input type="number" class="w-12 p-1 border rounded" value="{{ $cartItem->quantity }}" min="1" data-cart-item-id="{{ $cartItem->id }}" id="quantity-{{ $cartItem->id }}">
                    <span class="text-sm">Ksh. {{ number_format($cartItem->subtotal) }}</span>
                    <button class="text-red-500 text-sm" onclick="removeItem({{ $cartItem->id }})">Remove</button>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500">Your cart is empty.</p>
        @endforelse
    </div>

    <!-- Cart Summary -->
    <div class="mt-4">
        <p class="font-bold">Total: Ksh. <span id="cartTotal">{{ number_format(auth()->user()->cart->total) }}</span></p>
        <p class="text-sm text-gray-500">VAT (16%): Ksh. <span id="cartVat">{{ number_format(auth()->user()->cart->total * 0.16) }}</span></p>
    </div>

    <!-- Cart Actions -->
    <div class="mt-4 flex justify-between">
        <button onclick="clearCart()" class="bg-gray-300 text-white px-4 py-2 rounded">Clear Cart</button>
        <a href="{{ route('checkout') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Checkout</a>
    </div>
</div>
