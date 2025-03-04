<div id="cartDropdown" class="hidden bg-white shadow-lg rounded-lg w-80 p-4 absolute right-0 top-12 z-50">
    <h2 class="text-lg font-bold border-b pb-2 mb-4">Your Cart</h2>

    <div id="cartItems" class="space-y-4">
        <!-- Cart items will be loaded here via AJAX -->
    </div>

    <div id="cartSummary" class="border-t pt-4 mt-4">
        <p class="font-semibold">Subtotal: <span id="cartSubtotal">$0.00</span></p>
        <p class="font-semibold">VAT (16%): <span id="cartVAT">$0.00</span></p>
        <p class="font-bold text-lg">Total: <span id="cartTotal">$0.00</span></p>

        <a href="{{ route('checkout') }}" class="mt-4 block text-center bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Proceed to Checkout</a>
        <button id="clearCart" class="mt-2 w-full text-center bg-red-500 text-white py-2 rounded hover:bg-red-600">Clear Cart</button>
    </div>
</div>
