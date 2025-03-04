<form id="mpesaCheckout">
    @csrf
    <label>Enter Phone Number (2547XXXXXXXX):</label>
    <input type="text" id="phone" name="phone" required>
    <label>Amount:</label>
    <input type="number" id="amount" name="amount" required>
    <button type="submit">Pay via M-Pesa</button>
</form>

<script>
document.getElementById("mpesaCheckout").addEventListener("submit", function(event) {
    event.preventDefault();

    let phone = document.getElementById("phone").value;
    let amount = document.getElementById("amount").value;

    fetch("{{ route('mpesa.stkpush') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ phone: phone, amount: amount })
    })
    .then(response => response.json())
    .then(data => alert("M-Pesa STK Push Sent!"))
    .catch(error => console.error("Error:", error));
});
</script>
