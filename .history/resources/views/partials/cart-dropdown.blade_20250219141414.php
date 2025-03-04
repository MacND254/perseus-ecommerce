<div id="cartDropdown" class="hidden absolute right-0 mt-2 w-80 bg-white shadow-lg rounded-lg p-4 border border-gray-200">
    <h3 class="text-lg font-semibold border-b pb-2 mb-2 text-black">Shopping Cart</h3>

    <div id="cartItemsContainer" class="max-h-64 overflow-y-auto text-black">
        <!-- Cart items will be dynamically loaded here -->
    </div>

    <div class="border-t pt-2 mt-2">
        <p class="text-sm text-black"><strong>Subtotal:</strong> <span id="subtotal" class="float-right">0.00</span></p>
        <p class="text-sm text-black"><strong>VAT (16%):</strong> <span id="vat" class="float-right">0.00</span></p>
        <p class="text-lg font-bold text-black"><strong>Total:</strong> <span id="total" class="float-right">0.00</span></p>
    </div>

    <div class="mt-4 flex justify-between">
        <button id="checkoutBtn" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Checkout</button>
        <button id="clearCartBtn" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Clear Cart</button>
    </div>
</div>
<!--
<script>
document.addEventListener("DOMContentLoaded", function () {
    const cartDropdown = document.getElementById("cartDropdown");
    const cartIcon = document.getElementById("cartIcon");
    const cartItemsContainer = document.getElementById("cartItemsContainer");
    const subtotalElement = document.getElementById("subtotal");
    const vatElement = document.getElementById("vat");
    const totalElement = document.getElementById("total");
    const cartCounter = document.getElementById("cartCounter");

    // Toggle cart dropdown
    cartIcon.addEventListener("click", function () {
        cartDropdown.classList.toggle("hidden");
        fetchCartItems();
    });

    // Fetch cart items
    function fetchCartItems() {
        fetch("{{ route('cart.fetch') }}")
            .then(response => response.json())
            .then(data => {
                cartItemsContainer.innerHTML = "";

                if (data.cartItems.length === 0) {
                    cartItemsContainer.innerHTML = "<p class='text-gray-500'>Your cart is empty.</p>";
                } else {
                    data.cartItems.forEach(item => {
                        const cartItem = document.createElement("div");
                        cartItem.classList.add("flex", "justify-between", "items-center", "border-b", "py-2");

                        cartItem.innerHTML = `
                            <div>
                                <p class="text-sm">${item.product_name}</p>
                                <p class="text-xs text-gray-600">${item.quantity} x $${item.price}</p>
                            </div>
                            <button class="text-red-500 text-xs remove-item" data-id="${item.id}">Remove</button>
                        `;

                        cartItemsContainer.appendChild(cartItem);
                    });

                    // Update totals
                    subtotalElement.textContent = `$${data.subtotal.toFixed(2)}`;
                    vatElement.textContent = `$${data.vat.toFixed(2)}`;
                    totalElement.textContent = `$${data.total.toFixed(2)}`;
                    cartCounter.textContent = data.cartItems.length;
                }
            })
            .catch(error => console.error("Error fetching cart items:", error));
    }

    // Remove item from cart
    cartItemsContainer.addEventListener("click", function (event) {
        if (event.target.classList.contains("remove-item")) {
            const cartItemId = event.target.dataset.id;

            fetch(`/cart/remove/${cartItemId}`, {
                method: "DELETE",
                headers: { "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content") }
            })
                .then(response => response.json())
                .then(data => fetchCartItems())
                .catch(error => console.error("Error removing cart item:", error));
        }
    });

    // Clear cart
    document.getElementById("clearCartBtn").addEventListener("click", function () {
        fetch("{{ route('cart.clear') }}", {
            method: "DELETE",
            headers: { "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content") }
        })
            .then(response => response.json())
            .then(data => fetchCartItems())
            .catch(error => console.error("Error clearing cart:", error));
    });
});
</script>
-->
