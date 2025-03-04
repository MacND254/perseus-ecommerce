// public/js/cart.js
document.addEventListener('DOMContentLoaded', function () {
    const cartButton = document.getElementById('cartButton');
    const cartDropdown = document.getElementById('cartDropdown');
    const cartCount = document.getElementById('cartCount');
    const cartItemsContainer = document.getElementById('cartItemsContainer');
    const cartTotal = document.getElementById('cart-total');

    // Function to fetch and update cart items
    function updateCart() {
        fetch('{{ route("cart.items") }}')
        .then(response => response.json())
        .then(data => {
            cartItemsContainer.innerHTML = '';

            if (data.items.length === 0) {
                cartItemsContainer.innerHTML = '<p class="text-gray-500">Your cart is empty</p>';
            } else {
                data.items.forEach(item => {
                    cartItemsContainer.innerHTML += `
                        <div class="flex justify-between p-2 border-b">
                            <span>${item.product.name} x${item.quantity}</span>
                            <button onclick="removeCartItem(${item.id})" class="text-red-500">Remove</button>
                        </div>`;
                });
            }

            // Update cart total
            cartTotal.textContent = `$${data.cart_total.toFixed(2)}`;

            // Update cart count
            cartCount.textContent = data.items.length;
        });
    }

    // Toggle cart dropdown on button click
    cartButton.addEventListener('click', function (event) {
        event.stopPropagation(); // Prevent click from bubbling up
        cartDropdown.classList.toggle('hidden');
        updateCart();
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function (event) {
        if (!cartDropdown.contains(event.target) && event.target !== cartButton) {
            cartDropdown.classList.add('hidden');
        }
    });

    // Prevent dropdown from closing when clicking inside it
    cartDropdown.addEventListener('click', function (event) {
        event.stopPropagation();
    });

    // Auto-update cart count on page load
    updateCart();
});

// Function to remove a cart item
function removeCartItem(cartItemId) {
    fetch(`{{ url('/cart/remove/') }}/${cartItemId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        updateCart(); // Refresh cart after removing item
    })
    .catch(error => console.error('Error:', error));
}