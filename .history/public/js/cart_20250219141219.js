
document.addEventListener("DOMContentLoaded", function () {
    const cartDropdown = document.getElementById("cartDropdown");
    const cartItemsContainer = document.getElementById("cartItemsContainer");

    function fetchCartItems() {
        fetch("/cart/items")
            .then(response => response.json())
            .then(data => {
                cartItemsContainer.innerHTML = "";

                if (data.cart_items.length === 0) {
                    cartItemsContainer.innerHTML = "<p class='text-gray-500'>Your cart is empty.</p>";
                } else {
                    data.cart_items.forEach(item => {
                        cartItemsContainer.innerHTML += `
                            <div class="flex justify-between items-center border-b py-2">
                                <div>
                                    <p class="text-sm font-semibold">${item.product.name}</p>
                                    <p class="text-xs text-gray-500">Qty: ${item.quantity} | Price: $${item.price.toFixed(2)}</p>
                                </div>
                                <button class="text-red-500 text-sm removeItem" data-id="${item.id}">Remove</button>
                            </div>
                        `;
                    });
                }

                document.getElementById("subtotal").textContent = `$${data.subtotal}`;
                document.getElementById("vat").textContent = `$${data.vat}`;
                document.getElementById("total").textContent = `$${data.total}`;
            })
            .catch(error => console.error("Error fetching cart items:", error));
    }

    // Fetch cart items when cart dropdown is shown
    document.getElementById("cartIcon").addEventListener("click", function () {
        cartDropdown.classList.toggle("hidden");
        if (!cartDropdown.classList.contains("hidden")) {
            fetchCartItems();
        }
    });

    // Event delegation for removing items
    cartItemsContainer.addEventListener("click", function (event) {
        if (event.target.classList.contains("removeItem")) {
            let itemId = event.target.getAttribute("data-id");

            fetch(`/cart/remove/${itemId}`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                }
            })
            .then(response => response.json())
            .then(() => fetchCartItems());
        }
    });

    // Clear cart button
    document.getElementById("clearCart").addEventListener("click", function () {
        fetch("/cart/clear", {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            }
        })
        .then(response => response.json())
        .then(() => fetchCartItems());
    });
});
