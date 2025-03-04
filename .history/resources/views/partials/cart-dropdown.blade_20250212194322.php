<div id="cartDropdown" class="hidden absolute right-0 mt-2 bg-white shadow-lg rounded-lg w-80 p-4">
    @if (auth()->check() && auth()->user()->cart)
        <div>
            <h3 class="text-lg font-semibold mb-2">Your Cart</h3>
            @foreach (auth()->user()->cart->cartItems as $cartItem)
                <div class="flex justify-between items-center border-b py-2">
                    <div class="flex items-center space-x-2">
                        <img src="{{ $cartItem->product->image_url }}" alt="{{ $cartItem->product->name }}" class="w-12 h-12 object-cover rounded-md">
                        <span class="font-semibold">{{ $cartItem->product->name }}</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <input type="number" class="w-12 p-1 border rounded" value="{{ $cartItem->quantity }}" min="1" data-cart-item-id="{{ $cartItem->id }}">
                        <span class="text-sm">Ksh. {{ number_format($cartItem->subtotal, 2) }}</span>
                        <button class="text-red-500 text-sm" onclick="removeItem({{ $cartItem->id }})">Remove</button>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center text-sm text-gray-500">Your cart is empty.</p>
    @endif
</div>
