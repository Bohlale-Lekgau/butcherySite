
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

// Pork products data
$pork_products = array(
    'Pork Chops' => array('price' => 90, 'image' => 'pork-chops.jpg'),
    'Pork Belly' => array('price' => 100, 'image' => 'pork-belly.jpg'),
    'Pork Ribs' => array('price' => 110, 'image' => 'pork-ribs.jpg'),
    'Pork Loin' => array('price' => 95, 'image' => 'pork-loin.jpg'),
    'Pork Shoulder' => array('price' => 85, 'image' => 'pork-shoulder.jpg'),
    'Pork Tenderloin' => array('price' => 120, 'image' => 'pork-tenderloin.jpg'),
    'Ground Pork' => array('price' => 80, 'image' => 'ground-pork.jpg'),
    'Pork Sausages' => array('price' => 75, 'image' => 'pork-sausages.jpg')
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pork Products - Mphenama Butchery</title>
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
        <section id="pork-products">
            <h1>Our Pork Products</h1>
            <div class="product-list">
                <?php foreach ($pork_products as $product => $details): ?>
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
        <div class="footer-content">
            <div class="footer-section footer-logo">
                <img 