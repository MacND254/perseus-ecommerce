document.addEventListener('DOMContentLoaded', function () {
    const cartIcon = document.getElementById('cartIcon');
    const cartDropdown = document.getElementById('cartDropdown');

    cartIcon.addEventListener('click', function () {
        cartDropdown.classList.toggle('hidden');
        fetchCartItems();  // Load cart items when dropdown is opened
    });

    function fetchCartItems() {
        fetch('/cart/items')
            .then(response => response.json())
            .then(data => {
                const cartItemsContainer = document.getElementById('cartItems');
                cartItemsContainer.innerHTML = '';

                let subtotal = 0;

                if (data.cart && data.cart.items.length > 0) {
                    data.cart.items.forEach(item => {
                        subtotal += item.total_price;

                        const itemHtml = `
                            <div class="flex items-center justify-between">
                                <img src="${item.product.image_url}" class="w-12 h-12 object-cover rounded" alt="${item.product.name}">
                                <div class="ml-4 flex-1">
                                    <h4 class="text-sm font-medium">${item.product.name}</h4>
                                    <p class="text-sm">$${item.price.toFixed(2)} x ${item.quantity}</p>
                                </div>
                                <button class="text-red-500 remove-item" data-id="${item.id}">&times;</button>
                            </div>
                        `;
                        cartItemsContainer.insertAdjacentHTML('beforeend', itemHtml);
                    });
                } else {
                    cartItemsContainer.innerHTML = '<p class="text-center text-gray-500">Your cart is empty.</p>';
                }

                updateCartSummary(subtotal);
            });
    }

    function updateCartSummary(subtotal) {
        const vat = subtotal * 0.16;
        const total = subtotal + vat;

        document.getElementById('cartSubtotal').textContent = `$${subtotal.toFixed(2)}`;
        document.getElementById('cartVAT').textContent = `$${vat.toFixed(2)}`;
        document.getElementById('cartTotal').textContent = `$${total.toFixed(2)}`;
    }

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-item')) {
            const itemId = e.target.dataset.id;
            removeCartItem(itemId);
        }

        if (e.target.id === 'clearCart') {
            clearCart();
        }
    });

    function removeCartItem(itemId) {
        fetch(`/cart/remove/${itemId}`, { method: 'DELETE' })
            .then(response => response.json())
            .then(() => {
                fetchCartItems();
            });
    }

    function clearCart() {
        fetch('/cart/clear', { method: 'DELETE' })
            .then(response => response.json())
            .then(() => {
                fetchCartItems();
            });
    }
});
