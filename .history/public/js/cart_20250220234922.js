document.addEventListener("DOMContentLoaded", function () {
    const cartIcon = document.getElementById("cartIcon");
    const cartDropdown = document.getElementById("cartDropdown");
    const cartItemsContainer = document.getElementById("cartItemsContainer");
    const subtotalElement = document.getElementById("subtotal");
    const vatElement = document.getElementById("vat");
    const totalElement = document.getElementById("total");
    const cartCountElement = document.getElementById("cartCount");
    const clearCartButton = document.getElementById("clearCart");

    // Hide dropdown initially
    cartDropdown.classList.add("hidden");

    // Toggle cart dropdown
    cartIcon.addEventListener("click", function () {
        cartDropdown.classList.toggle("hidden");
        fetchCartItems(); // Fetch cart items when opening cart
    });

    // Fetch cart items from backend
    function fetchCartItems() {
        fetch("/cart/get")
            .then(response => response.json())
            .then(data => {
                cartItemsContainer.innerHTML = ""; // Clear previous items
                if (data.cartItems.length === 0) {
                    cartItemsContainer.innerHTML = "<p class='text-gray-500'>Your cart is empty.</p>";
                } else {
                    data.cartItems.forEach(item => {
                        let cartItem = `
                            <div class="flex justify-between items-center border-b py-2">
                                <div>
                                    <p class="font-semibold">${item.product.name}</p>
                                    <p class="text-sm text-gray-600">Qty: ${item.quantity} | KSh ${item.subtotal}</p>
                                </div>
                                <button class="text-red-500 removeItem" data-id="${item.id}">🗑</button>
                            </div>
                        `;
                        cartItemsContainer.innerHTML += cartItem;
                    });
                }
                // Update totals
                subtotalElement.textContent = `KSh ${data.subtotal}`;
                vatElement.textContent = `KSh ${data.vat}`;
                totalElement.textContent = `KSh ${data.total}`;
                cartCountElement.textContent = data.cartCount;
            })
            .catch(error => console.error("Error fetching cart:", error));
    }

    // Remove item from cart
    document.addEventListener("click", function (event) {
        if (event.target.classList.contains("removeItem")) {
            let itemId = event.target.dataset.id;
            fetch(`/cart/remove/${itemId}`, {
                method: "POST", // Change from DELETE to POST
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ _method: "DELETE" }) // Laravel method spoofing
            })
            .then(response => response.json())
            .then(() => fetchCartItems()) // Refresh cart items
            .catch(error => console.error("Error removing item:", error));
        }
    });

    // Clear cart
    clearCartButton.addEventListener("click", function () {
        fetch("/cart/clear", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                "Content-Type": "application/json"
            }
        })
        .then(response => response.json())
        .then(() => fetchCartItems()) // Refresh cart
        .catch(error => console.error("Error clearing cart:", error));
    });

    // Fetch cart items on page load
    fetchCartItems();
});
