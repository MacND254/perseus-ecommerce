<div id="cartDropdown" class="hidden absolute right-0 mt-2 bg-white shadow-lg rounded-lg w-80 p-4">
    @if (auth()->check() && auth()->user()->cart)
        <div>
            <h3 class="text-lg font-semibold mb-2">Your Cart</h3>

            <!-- Cart Items -->
            <div id="cartItemsContainer">
                @foreach (auth()->user()->cart->cartItems as $cartItem)
                    <div class="flex justify-between items-center border-b py-2">
                        <div class="flex items-center space-x-2">
                            <img src="{{ $cartItem->product->image_url }}" alt="{{ $cartItem->product->name }}" class="w-12 h-12 object-cover rounded-md">
                            <span class="font-semibold">{{ $cartItem->product->name }}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <input type="number" class="w-12 p-1 border rounded" value="{{ $cartItem->quantity }}" min="1" data-cart-item-id="{{ $cartItem->id }}" id="quantity-{{ $cartItem->id }}">
                            <span class="text-sm">Ksh. {{ number_format($cartItem->subtotal, 2) }}</span>
                            <button class="text-red-500 text-sm" onclick="removeItem({{ $cartItem->id }})">Remove</button>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-between mt-2">
                <span class="font-semibold">Total:</span>
                <span id="cartTotal" class="font-semibold">Ksh. {{ auth()->user()->cart->total }}</span>
            </div>

            <div class="mt-4">
                <button onclick="clearCart()" class="w-full bg-red-500 text-white py-2 rounded-md">Clear Cart</button>
                <button onclick="window.location.href='/checkout'" class="w-full bg-blue-500 text-white py-2 rounded-md mt-2">Checkout</button>
            </div>
        </div>
    @else
        <p class="text-center text-sm text-gray-500">Your cart is empty.</p>
    @endif
</div>
