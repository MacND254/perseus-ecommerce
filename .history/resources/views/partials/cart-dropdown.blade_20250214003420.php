<div id="cartDropdown" class="hidden absolute right-0 mt-2 w-80 bg-white shadow-lg rounded-lg p-4 border border-gray-200">
    <h3 class="text-lg font-semibold border-b pb-2 mb-2 text-black">Shopping Cart</h3>

    <div id="cartItemsContainer" class="max-h-64 overflow-y-auto text-black">
        <!-- Cart items will be loaded dynamically here -->
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

<script>
    document.addEventListener("DOMContentLoaded", function () {
        fetchCartItems();

        // Toggle Cart Dropdown
        document.getElementById("cartIcon").addEventListener("click", function () {
            document.getElementById("cartDropdown").classList.toggle("hidden");
        });

        // Fetch Cart Items
        function fetchCartItems() {
            fetch("{{ route('cart.fetch') }}")
                .then(response => response.json())
                .then(data => {
                    let cartItemsContainer = document.getElementById("cartItemsContainer");
                    let subtotalElement = document.getElementById("subtotal");
                    let vatElement = document.getElementById("vat");
                    let totalElement = document.getElementById("total");
                    let cartCount = document.getElementById("cartCount");

                    cartItemsContainer.innerHTML = "";

                    if (data.cartItems.length === 0) {
                        cartItemsContainer.innerHTML = "<p class='text-center text-black'>Your cart is empty.</p>";
                    } else {
                        data.cartItems.forEach(item => {
                            cartItemsContainer.innerHTML += `
                                <div class="flex justify-between items-center border-b pb-2 mb-2">
                                    <span class="text-sm text-black">${item.product_name} x ${item.quantity}</span>
                                    <span class="text-sm text-black">$${item.subtotal.toFixed(2)}</span>
                                    <button class="text-red-500 text-sm remove-item" data-id="${item.id}">❌</button>
                                </div>
                            `;
                        });

                        // Update Totals
                        subtotalElement.textContent = `$${data.subtotal.toFixed(2)}`;
                        vatElement.textContent = `$${data.vat.toFixed(2)}`;
                        totalElement.textContent = `$${data.total.toFixed(2)}`;
                        cartCount.textContent = data.cartCount;
                    }
                });
        }

        // Remove Item
        document.addEventListener("click", function (event) {
            if (event.target.classList.contains("remove-item")) {
                let itemId = event.target.getAttribute("data-id");

                fetch(`/cart/remove/${itemId}`, { method: "DELETE" })
                    .then(response => response.json())
                    .then(() => fetchCartItems());
            }
        });

        // Clear Cart
        document.getElementById("clearCart").addEventListener("click", function () {
            fetch("{{ route('cart.clear') }}", { method: "DELETE" })
                .then(response => response.json())
                .then(() => fetchCartItems());
        });
    });
</script>
