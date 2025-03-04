<div id="cartDropdown" class="hidden absolute right-0 mt-2 w-80 bg-white shadow-lg rounded-lg p-4 border border-gray-200">
    <h3 class="text-lg font-semibold border-b pb-2 mb-2 text-black">Shopping Cart</h3>

    <div id="cartItemsContainer" class="max-h-64 overflow-y-auto text-black">
        <p id="emptyCartMessage" class="text-gray-500 text-sm hidden">No items in cart.</p>
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

<!-- JavaScript to Fetch and Display Cart Items -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        fetchCartItems();

        function fetchCartItems() {
            fetch("{{ route('cart.fetch') }}")
                .then(response => response.json())
                .then(data => {
                    let cartItemsContainer = document.getElementById("cartItemsContainer");
                    let emptyCartMessage = document.getElementById("emptyCartMessage");
                    let subtotalElem = document.getElementById("subtotal");
                    let vatElem = document.getElementById("vat");
                    let totalElem = document.getElementById("total");

                    cartItemsContainer.innerHTML = ""; // Clear existing content

                    if (data.cartItems.length === 0) {
                        emptyCartMessage.classList.remove("hidden");
                        subtotalElem.textContent = "0.00";
                        vatElem.textContent = "0.00";
                        totalElem.textContent = "0.00";
                        return;
                    } else {
                        emptyCartMessage.classList.add("hidden");
                    }

                    let subtotal = data.total;
                    let vat = subtotal * 0.16;
                    let total = subtotal + vat;

                    data.cartItems.forEach(item => {
                        let cartItemDiv = document.createElement("div");
                        cartItemDiv.classList.add("flex", "justify-between", "items-center", "border-b", "pb-2", "mb-2");

                        cartItemDiv.innerHTML = `
                            <div>
                                <p class="text-sm font-medium text-black">${item.product.name}</p>
                                <p class="text-xs text-gray-600">Qty: ${item.quantity} x $${item.price.toFixed(2)}</p>
                            </div>
                            <p class="text-sm font-bold text-black">$${item.subtotal.toFixed(2)}</p>
                        `;

                        cartItemsContainer.appendChild(cartItemDiv);
                    });

                    subtotalElem.textContent = `$${subtotal.toFixed(2)}`;
                    vatElem.textContent = `$${vat.toFixed(2)}`;
                    totalElem.textContent = `$${total.toFixed(2)}`;
                })
                .catch(error => console.error("Error fetching cart:", error));
        }
    });
</script>
