
document.addEventListener("DOMContentLoaded", function () {
    let cartDropdown = document.getElementById("cartDropdown");
    let cartIcon = document.getElementById("cartIcon");

    cartIcon.addEventListener("click", function () {
        cartDropdown.classList.toggle("hidden");
        fetchCartData();
    });

    function fetchCartData() {
        fetch("/cart/data")
            .then(response => response.json())
            .then(data => {
                let cartItemsContainer = document.getElementById("cartItemsContainer");
                let cartSubtotal = document.getElementById("cartSubtotal");
                let cartVAT = document.getElementById("cartVAT");
                let cartTotal = document.getElementById("cartTotal");
                let cartCount = document.getElementById("cartCount");

                cartItemsContainer.innerHTML = "";
                cartCount.textContent = data.cartCount || 0;

                if (data.items.length === 0) {
                    cartItemsContainer.innerHTML = "<p class='text-gray-500 text-sm'>Your cart is empty.</p>";
                } else {
                    data.items.forEach(item => {
                        let itemDiv = document.createElement("div");
                        itemDiv.classList.add("flex", "justify-between", "items-center", "border-b", "py-2");
                        itemDiv.innerHTML = `
                            <div>
                                <p class="text-sm">${item.product_name}</p>
                                <p class="text-xs text-gray-600">Qty: ${item.quantity}</p>
                                <p class="text-sm font-semibold">$${item.subtotal.toFixed(2)}</p>
                            </div>
                            <button class="text-red-500 removeCartItem" data-id="${item.id}">❌</button>
                        `;
                        cartItemsContainer.appendChild(itemDiv);
                    });

                    document.querySelectorAll(".removeCartItem").forEach(button => {
                        button.addEventListener("click", function () {
                            let itemId = this.getAttribute("data-id");
                            removeCartItem(itemId);
                        });
                    });
                }

                cartSubtotal.textContent = `$${data.subtotal.toFixed(2)}`;
                cartVAT.textContent = `$${data.vat.toFixed(2)}`;
                cartTotal.textContent = `$${data.total.toFixed(2)}`;
            });
    }

    function removeCartItem(itemId) {
        fetch(`/cart/remove/${itemId}`, { method: "DELETE", headers: { "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content") } })
            .then(response => response.json())
            .then(data => {
                if (data.success) fetchCartData();
            });
    }

    document.getElementById("clearCart").addEventListener("click", function () {
        fetch("/cart/clear", { method: "DELETE", headers: { "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content") } })
            .then(response => response.json())
            .then(data => {
                if (data.success) fetchCartData();
            });
    });

    fetchCartData();
});
