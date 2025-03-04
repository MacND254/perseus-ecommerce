document.addEventListener('DOMContentLoaded', function() {
    const cartDropdown = document.getElementById('cart-dropdown');

    cartDropdown.addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-item')) {
            const key = event.target.dataset.key;
            removeCartItem(key);
        } else if (event.target.classList.contains('clear-cart')) {
            clearCart();
        }
    });

    cartDropdown.addEventListener('change', function(event) {
        if (event.target.classList.contains('quantity-input')) {
            const key = event.target.dataset.key;
            updateQuantity(event.target);
        }
    });


    function removeCartItem(key) {
        fetch('/cart/remove', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: key })
        })
        .then(response => response.json())
        .then(data => {
            updateCartView(data); // Call updateCartView
        })
        .catch(error => console.error('Error removing item:', error));
    }

    function clearCart() {
        fetch('/cart/clear', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            updateCartView(data);  // Call updateCartView
        })
        .catch(error => console.error('Error clearing cart:', error));
    }

    function updateQuantity(input) {
        const key = input.dataset.key;
        const quantity = input.value;

        fetch(`/cart/update-quantity/${key}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ quantity: quantity })
        })
        .then(response => response.json())
        .then(data => {
            updateCartView(data); // Call updateCartView
        })
        .catch(error => console.error('Error updating quantity:', error));
    }

    function updateCartView(data) {
        document.getElementById('cart-count').innerText = data.cart_count;
        document.getElementById('cart-dropdown').innerHTML = data.cart_html;
        // Update subtotal, vat, and total
        document.getElementById('cart-subtotal').innerText = "$" + data.subtotal;
        document.getElementById('cart-vat').innerText = "$" + data.vat;
        document.getElementById('cart-total').innerText = "$" + data.total;
    }

});
