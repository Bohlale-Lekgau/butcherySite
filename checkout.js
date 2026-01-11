document.addEventListener('DOMContentLoaded', function() {
    const orderItems = document.getElementById('order-items');
    const orderTotal = document.getElementById('order-total');
    const checkoutForm = document.getElementById('checkout-form');

    // Retrieve the cart from localStorage
    const cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Display order summary
    function displayOrderSummary() {
        orderItems.innerHTML = '';
        let total = 0;
        cart.forEach(item => {
            const li = document.createElement('li');
            li.textContent = `${item.product} x${item.quantity} - R${(item.price * item.quantity).toFixed(2)}`;
            orderItems.appendChild(li);
            total += item.price * item.quantity;
        });
        orderTotal.textContent = total.toFixed(2);
    }

    displayOrderSummary();

    // Handle form submission
    checkoutForm.addEventListener('submit', function(e) {
        e.preventDefault();
        // send the order data to the server
        // we'll just show an alert
        alert('Thank you for your order! It has been processed successfully.');
        // Clear the cart and redirect to the home page
        localStorage.removeItem('cart');
        window.location.href = 'index.html';
    });
});

