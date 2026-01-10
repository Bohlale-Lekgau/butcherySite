
<?php
session_start();
require_once 'db_config.php';

// Initialize the cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Calculate the total
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the order (in a real application, you'd save to a database, etc.)
    // For now, we'll just clear the cart
    $_SESSION['cart'] = array();
    $orderPlaced = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mphenama Butchery - Checkout</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo-container">
                <img src="images/mphenama-logo.png" alt="Mphenama Butchery Logo" class="logo">
                <h1 class="company-name">Mphenama Butchery</h1>
            </div>
            <nav>
                <ul class="nav-links">
                    <li><a href="index.php" class="nav-link"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="products.php" class="nav-link"><i class="fas fa-drumstick-bite"></i> Our Products</a></li>
                    <li><a href="about.php" class="nav-link"><i class="fas fa-info-circle"></i> About Us</a></li>
                    <li><a href="contact.php" class="nav-link"><i class="fas fa-envelope"></i> Contact</a></li>
                </ul>
            </nav>
            <div class="header-cta">
                <a href="#" class="cta-button"><i class="fas fa-phone"></i> Call Now</a>
            </div>
        </div>
    </header>

    <main>
        <section id="checkout">
            <h1><i class="fas fa-credit-card"></i> Checkout</h1>
            <?php if (isset($orderPlaced) && $orderPlaced): ?>
                <div class="order-confirmation">
                    <h2>Thank you for your order!</h2>
                    <p>Your order has been placed successfully.</p>
                    <a href="products.php" class="btn">Continue Shopping</a>
                </div>
            <?php else: ?>
                <form id="checkout-form" method="post">
                    <h2>Shipping Information</h2>
                    <div class="form-group">
                        <label for="full-name"><i class="fas fa-user"></i> Full Name:</label>
                        <input type="text" id="full-name" name="full-name" required>
                    </div>
                    <div class="form-group">
                        <label for="address"><i class="fas fa-home"></i> Address:</label>
                        <input type="text" id="address" name="address" required>
                    </div>
                    <div class="form-group">
                        <label for="city"><i class="fas fa-city"></i> City:</label>
                        <input type="text" id="city" name="city" required>
                    </div>
                    <div class="form-group">
                        <label for="postal-code"><i class="fas fa-mail-bulk"></i> Postal Code:</label>
                        <input type="text" id="postal-code" name="postal-code" required>
                    </div>

                    <h2>Payment Information</h2>
                    <div class="form-group">
                        <label for="card-number"><i class="fas fa-credit-card"></i> Card Number:</label>
                        <input type="text" id="card-number" name="card-number" required>
                    </div>
                    <div class="form-group">
                        <label for="expiry-date"><i class="fas fa-calendar"></i> Expiry Date:</label>
                        <input type="text" id="expiry-date" name="expiry-date" placeholder="MM/YY" required>
                    </div>
                    <div class="form-group">
                        <label for="cvv"><i class="fas fa-lock"></i> CVV:</label>
                        <input type="text" id="cvv" name="cvv" required>
                    </div>

                    <div id="order-summary">
                        <h2>Order Summary</h2>
                        <ul id="order-items">
                            <?php foreach ($_SESSION['cart'] as $product => $item): ?>
                                <li><?php echo $product; ?> x <?php echo $item['quantity']; ?> - R<?php echo number_format($item['price'] * $item['quantity'], 2); ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <p>Total: R<span id="order-total"><?php echo number_format($total, 2); ?></span></p>
                    </div>

                    <button type="submit" id="place-order-btn"><i class="fas fa-check-circle"></i> Place Order</button>
                </form>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-section footer-logo">
                <img src="images/mphenama-logo.png" alt="Mphenama Butchery Logo" class="footer-logo-img">
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="products.php">Our Products</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact</h3>
                <p>Phone: (016) 456-7890<br>Email: info@mphenama.com</p>
            </div>
            <div class="footer-section">
                <h3>Hours</h3>
                <p>Mon-Fri: 8am - 6pm<br>Sat: 9am - 5pm<br>Sun: Closed</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Mphenama Butchery. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>