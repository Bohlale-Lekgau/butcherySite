require_once 'db_config.php';
<?php
session_start();

// Initialize the cart
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

// Beef products data
$beef_products = array(
    'Ribeye Steak' => array('price' => 250, 'image' => 'ribeye-steak.jpg'),
    'Sirloin Steak' => array('price' => 220, 'image' => 'sirloin-steak.jpg'),
    'Tenderloin' => array('price' => 280, 'image' => 'tenderloin.jpg'),
    'Ground Beef' => array('price' => 120, 'image' => 'ground-beef.jpg'),
    'Beef Brisket' => array('price' => 180, 'image' => 'beef-brisket.jpg'),
    'T-Bone Steak' => array('price' => 240, 'image' => 't-bone-steak.jpg'),
    'Beef Short Ribs' => array('price' => 160, 'image' => 'beef-short-ribs.jpg'),
    'Beef Roast' => array('price' => 200, 'image' => 'beef-roast.jpg')
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beef Products - Mphenama Butchery</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .add-to-cart {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 2px 2px;
            cursor: pointer;
            border-radius: 4px;
        }
        #cart {
            position: fixed;
            top: 100px;
            right: 20px;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
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
        <section id="beef-products">
            <h1>Our Beef Products</h1>
            <div class="product-list">
                <?php foreach ($beef_products as $product => $details): ?>
                    <div class="product-card">
                        <img src="images/products/<?php echo $details['image']; ?>" alt="<?php echo $product; ?>" class="product-image">
                        <div class="product-details">
                            <h3><?php echo $product; ?></h3>
                            <p>R<?php echo number_format($details['price'], 2); ?> per kg</p>
                        </div>
                        <form method="post">
                            <input type="hidden" name="product" value="<?php echo $product; ?>">
                            <input type="hidden" name="price" value="<?php echo $details['price']; ?>">
                            <button type="submit" name="add_to_cart" class="add-to-cart">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <section id="cart">
        <h2><i class="fas fa-shopping-cart"></i> Your Cart</h2>
        <ul id="cart-items">
            <?php
            $total = 0;
            foreach ($_SESSION['cart'] as $product => $item):
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;
            ?>
                <li><?php echo $product; ?> x <?php echo $item['quantity']; ?> - R<?php echo number_format($subtotal, 2); ?></li>
            <?php endforeach; ?>
        </ul>
        <p>Total: R<span id="cart-total"><?php echo number_format($total, 2); ?></span></p>
        <button id="checkout-btn">
            <i class="fas fa-shopping-cart"></i> Proceed to Checkout
        </button>
    </section>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Mphenama Butchery. All rights reserved.</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkoutBtn = document.getElementById('checkout-btn');

            checkoutBtn.addEventListener('click', function() {
                if (<?php echo count($_SESSION['cart']); ?> === 0) {
                    alert('Your cart is empty!');
                } else {
                    alert('Proceeding to checkout...');
                    // redirect to a checkout page
                    // window.location.href = 'checkout.php';
                }
            });
        });
    </script>
</body>

</html>
