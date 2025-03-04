<div id="cartDropdown" class="hidden absolute right-0 mt-2 w-80 bg-white shadow-lg rounded-lg p-4 border border-gray-200">
    <h3 class="text-lg font-semibold border-b pb-2 mb-2 text-black">Shopping Cart</h3>

    <div id="cartItemsContainer" class="max-h-64 overflow-y-auto text-black">
        <!-- Cart items will be loaded here dynamically -->
    </div>

    <div class="border-t pt-2 mt-2">
        <p class="text-sm text-black"><strong>Subtotal:</strong> <span id="subtotal" class="float-right">0.00</span></p>
        <p class="text-sm text-black"><strong>VAT (16%):</strong> <span id="vat" class="float-right">0.00</span></p>
        <p class="text-lg font-bold text-black"><strong>Total:</strong> <span id="total" class="float-right">0.00</span></p>
    </div>

    <div class="mt-4 flex justify-between">
        <a href="{{ route('cart.checkout') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Checkout</a>
        <button id="clearCart" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Clear Cart</button>
    </div>
</div>
