document.addEventListener('DOMContentLoaded', function () {
    const menuToggleButton = document.getElementById('menu-toggle'); // Corrected ID
    const mobileMenu = document.getElementById('mobile-menu');

    if (menuToggleButton && mobileMenu) {
        menuToggleButton.addEventListener('click', function () {
            mobileMenu.classList.toggle('hidden');
        });
    } else {
        console.error("Menu toggle button or mobile menu not found!");
    }
});
