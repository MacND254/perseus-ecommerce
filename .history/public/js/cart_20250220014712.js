document.addEventListener("DOMContentLoaded", function () {
    let cartDropdown = document.getElementById("cartDropdown");
    let cartIcon = document.getElementById("cartIcon");
    let cartItemsContainer = document.getElementById("cartItemsContainer");
    let cartCount = document.getElementById("cartCount");
    let subtotalElem = document.getElementById("subtotal");
    let vatElem = document.getElementById("vat");
    let totalElem = document.getElementById("total");

    cartIcon.addEventListener("click", function () {
        cartDropdown.classList.toggle("hidden");
        fetchCartData();
    });

    function fetchCartData() {
        fetch("/cart/fetch")
            .then(response => response.json())
            .then(data => {
                cartItemsContainer.innerHTML = ""; // Clear previous items

                if (data.cartItems.length === 0) {
                    document.getElementById("emptyCartMessage").classList.remove("hidden");
                } else {
                    document.getElementById("emptyCartMessage").classList.add("hidden");

                    data.cartItems.forEach(item => {
                        let cartItemHTML = `
                            <div class="flex justify-between items-center border-b pb-2 mb-2">
                                <div>
                                    <p class="text-sm font-medium">${item.product_name}</p>
                                    <p class="text-xs text-gray-500">${item.quantity} x $${item.price}</p>
                                </div>
                                <button class="text-red-500 text-sm removeCartItem" data-id="${item.id}">❌</button>
                            </div>
                        `;
                        cartItemsContainer.innerHTML += cartItemHTML;
                    });
                }

                cartCount.textContent = data.cartCount;
                subtotalElem.textContent = `$${data.subtotal.toFixed(2)}`;
                vatElem.textContent = `$${data.vat.toFixed(2)}`;
                totalElem.textContent = `$${data.total.toFixed(2)}`;
            })
            .catch(error => console.error("Error fetching cart:", error));
    }

    // Remove Item
    cartItemsContainer.addEventListener("click", function (event) {
        if (event.target.classList.contains("removeCartItem")) {
            let itemId = event.target.getAttribute("data-id");

            fetch(`/cart/remove/${itemId}`, { method: "DELETE" })
                .then(response => response.json())
                .then(data => {
                    fetchCartData(); // Refresh cart data
                })
                .catch(error => console.error("Error removing item:", error));
        }
    });

    // Clear Cart
    document.getElementById("clearCart").addEventListener("click", function () {
        fetch("/cart/clear", { method: "DELETE" })
            .then(response => response.json())
            .then(data => {
                fetchCartData(); // Refresh cart data
            })
            .catch(error => console.error("Error clearing cart:", error));
    });

    fetchCartData(); // Load cart items on page load
});
