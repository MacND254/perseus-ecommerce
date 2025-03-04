// resources/js/cart.js
document.addEventListener('DOMContentLoaded', () => {
    const cartButton = document.getElementById('cart-button');
    const cartDropdown = document.getElementById('cart-dropdown');

    if (cartButton && cartDropdown) {
        // Toggle Cart Dropdown
        cartButton.addEventListener('click', (event) => {
            event.stopPropagation();
            cartDropdown.classList.toggle('hidden');
        });

        // Close Cart Dropdown When Clicking Outside
        document.addEventListener('click', (event) => {
            if (!cartButton.contains(event.target) && !cartDropdown.contains(event.target)) {
                cartDropdown.classList.add('hidden');
            }
        });
    }
});
