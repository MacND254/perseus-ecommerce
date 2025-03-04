function updateCartCount() {
    fetch("/cart/fetch")
        .then(response => response.json())
        .then(data => {
            document.getElementById("cart-count").innerText = data.cartCount;
        });
}

// Call `updateCartCount()` when the page loads
document.addEventListener("DOMContentLoaded", updateCartCount);

// Modify your "Add to Cart" button logic
document.querySelectorAll(".add-to-cart-btn").forEach(button => {
    button.addEventListener("click", function () {
        let productId = this.dataset.productId;
        let quantity = 1; // Default quantity (modify as needed)

        fetch("/cart/add", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            },
            body: JSON.stringify({ product_id: productId, quantity: quantity })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateCartCount(); // Update cart count only after a successful addition
            }
        });
    });
});
