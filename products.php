<?php
session_start();
require_once 'db_config.php';

// Initialize the cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Function to add item to cart
function addToCart($product, $price) {
    if (isset($_SESSION['cart'][$product])) {
        $_SESSION['cart'][$product]['quantity']++;
    } else {
        $_SESSION['cart'][$product] = array(
            'price' => $price,
            'quantity' => 1
        );
    }
}

// Handle add to cart action
if (isset($_POST['add_to_cart'])) {
    $product = $_POST['product'];
    $price = $_POST['price'];
    addToCart($product, $price);
}

// Fetch products from the database
try {
    $stmt = $pdo->query("SELECT * FROM products");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Error fetching products: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Products - Mphenama Butchery</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo-container">
                <img src="images/mphenama-logo.png" alt="Mphenama Butchery Logo" class="logo">
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
        <section id="products">
            <h1><i class="fas fa-drumstick-bite"></i> Our Premium Meat Selection</h1>
            <p>At Mphenama Butchery, we pride ourselves on offering the highest quality meats. Browse our selection below:</p>
            
            <div class="product-list">
                <?php foreach ($products as $product): ?>
                    <div class="product-card">
                        <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="product-image">
                        <div class="product-details">
                            <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                            <p>R<?php echo number_format($product['price'], 2); ?> per kg</p>
                        </div>
                        <form method="post">
                            <input type="hidden" name="product" value="<?php echo htmlspecialchars($product['name']); ?>">
                            <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
                            <button type="submit" name="add_to_cart" class="add-to-cart">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section id="cart">
            <h2><i class="fas fa-shopping-cart"></i> Your Cart</h2>
            <ul id="cart-items">
                <?php
                $total = 0;
                foreach ($_SESSION['cart'] as $product => $item):
                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal;
                ?>
                    <li><?php echo htmlspecialchars($product); ?> x <?php echo $item['quantity']; ?> - R<?php echo number_format($subtotal, 2); ?></li>
                <?php endforeach; ?>
            </ul>
            <p>Total: R<span id="cart-total"><?php echo number_format($total, 2); ?></span></p>
            <button id="checkout-btn">
                <i class="fas fa-shopping-cart"></i> Proceed to Checkout
            </button>
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
            <p>&copy; <?php echo date("Y"); ?> Mphenama Butchery. All rights reserved.</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkoutBtn = document.getElementById('checkout-btn');

            checkoutBtn.addEventListener('click', function() {
                if (<?php echo count($_SESSION['cart']); ?> === 0) {
                    alert('Your cart is empty!');
                } else {
                    alert('Proceeding to checkout...');
                    // Here you would typically redirect to a checkout page
                    // window.location.href = 'checkout.php';
                }
            });
        });
    </script>
</body>
</html>