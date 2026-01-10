let cart = [];

function addToCart(productName, price) {
    let item = cart.find(i => i.name === productName);
    if (item) {
        item.quantity++;
    } else {
        cart.push({ name: productName, price: price, quantity: 1 });
    }
    updateCartDisplay();
}

function updateCartDisplay() {
    let cartElement = document.getElementById('cart');
    let total = 0;
    cartElement.innerHTML = '<h3>Your Cart</h3>';
    cart.forEach(item => {
        total += item.price * item.quantity;
        cartElement.innerHTML += `<p>${item.name} x ${item.quantity} - R${(item.price * item.quantity).toFixed(2)}</p>`;
    });
    cartElement.innerHTML += `<p><strong>Total: R${total.toFixed(2)}</strong></p>`;
    cartElement.innerHTML += '<button onclick="proceedToCheckout()">Proceed to Checkout</button>';
}

function proceedToCheckout() {
    localStorage.setItem('cart', JSON.stringify(cart));
    window.location.href = 'checkout.html';
}
