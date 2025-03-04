document.addEventListener("DOMContentLoaded", function () {
    const addToCartForm = document.getElementById("addToCartForm");

    if (addToCartForm) {
        addToCartForm.addEventListener("submit", function (event) {
            event.preventDefault();

            let productId = document.getElementById("product_id").value;
            let quantity = document.getElementById("quantity").value;

            fetch("/cart/add", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                },
                body: JSON.stringify({ product_id: productId, quantity: quantity })
            })
            .then(response => {
                if (!response.ok) {
                    if (response.status === 401) {
                        window.location.href = "/login"; // Redirect to login page
                    }
                    throw new Error("Something went wrong");
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    document.getElementById("cartMessage").textContent = data.success;
                    document.getElementById("cartMessage").classList.remove("hidden");
                }
            })
            .catch(error => {
                console.error("Error:", error);
            });
        });
    }
});
