document.addEventListener("DOMContentLoaded", function () {
    const cartIcon = document.getElementById("cartIcon");
    const cartDropdown = document.getElementById("cartDropdown");
    const cartItemsContainer = document.getElementById("cartItemsContainer");
    const subtotalElement = document.getElementById("subtotal");
    const vatElement = document.getElementById("vat");
    const totalElement = document.getElementById("total");
    const cartCountElement = document.getElementById("cartCount");
    const clearCartButton = document.getElementById("clearCart");
    const checkoutButton = document.getElementById("checkout");

    // ✅ Toggle cart dropdown when clicking the cart icon
    cartIcon.addEventListener("click", function () {
        cartDropdown.classList.toggle("hidden");
        fetchCartItems(); // Fetch cart items when opening cart
    });

    // ✅ Close cart when clicking outside
    document.addEventListener("click", function (event) {
        if (!cartDropdown.contains(event.target) && event.target !== cartIcon) {
            cartDropdown.classList.add("hidden");
        }
    });

    // ✅ Fetch cart items from backend
    function fetchCartItems() {
        fetch("/cart/get")
            .then(response => response.json())
            .then(data => {
                cartItemsContainer.innerHTML = ""; // Clear previous items
                if (data.cartItems.length === 0) {
                    cartItemsContainer.innerHTML = "<p class='text-gray-500'>Your cart is empty.</p>";
                    clearCartButton.classList.add("hidden"); // Hide clear cart button
                    checkoutButton.classList.add("hidden"); // Hide checkout button
                } else {
                    data.cartItems.forEach(item => {
                        let cartItem = `
                            <div class="flex justify-between items-center border-b py-2">
                                <div>
                                    <p class="font-semibold">${item.product.name}</p>
                                    <p class="text-sm text-gray-600">Qty: ${item.quantity} | Price: KSh ${item.product.price}</p>
                                </div>
                                <button class="text-red-500 removeItem" data-id="${item.id}">🗑</button>
                            </div>
                        `;
                        cartItemsContainer.innerHTML += cartItem;
                    });
                    clearCartButton.classList.remove("hidden"); // Show clear cart button
                    checkoutButton.classList.remove("hidden"); // Show checkout button
                }
                // Update totals
                subtotalElement.textContent = `KSh ${data.subtotal}`;
                vatElement.textContent = `KSh ${data.vat}`;
                totalElement.textContent = `KSh ${data.total}`;
                cartCountElement.textContent = data.cartCount;
            })
            .catch(error => console.error("Error fetching cart:", error));
    }

    // ✅ Remove item from cart (AJAX)
    document.addEventListener("click", function (event) {
        if (event.target.classList.contains("removeItem")) {
            let itemId = event.target.dataset.id;
            fetch(`/cart/remove/${itemId}`, {
                method: "DELETE",
                headers: { "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content") }
            })
                .then(response => response.json())
                .then(data => {
                    fetchCartItems(); // Refresh cart items
                })
                .catch(error => console.error("Error removing item:", error));
        }
    });

    // ✅ Clear entire cart (AJAX)
    clearCartButton.addEventListener("click", function () {
        fetch(`/cart/clear`, {
            method: "DELETE",
            headers: { "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content") }
        })
            .then(response => response.json())
            .then(data => {
                fetchCartItems(); // Refresh cart items
            })
            .catch(error => console.error("Error clearing cart:", error));
    });

    // ✅ Fetch cart items on page load
    fetchCartItems();
});
