
<?php
// Start the session (for cart functionality)
session_start();
require_once 'db_config.php';

// Include functions file (we'll create this later)
require_once 'includes/functions.php';

// Set the page title
$pageTitle = "Mphenama Butchery - Premium Meats & Expert Service";

// Include the header
include 'includes/header.php';
?>

<main>
    <section id="hero">
        <h1>Welcome to Mphenama Butchery</h1>
        <p>Your premier destination for premium quality meats and expert butchery services in the Vaal. At Mphenama Butchery, we pride ourselves on offering an unparalleled selection of fresh, locally-sourced meats and personalized service that caters to all your culinary needs.</p>

        <p>Established in 2023, Mphenama Butchery has been serving the Vaal community for over two decades, building a reputation for excellence in quality and customer satisfaction. Our commitment to providing the finest cuts of meat is matched only by our dedication to supporting local farmers and sustainable farming practices.</p>

        <p>From succulent beef and tender lamb to flavorful pork and fresh poultry, our extensive range caters to every taste and occasion. Whether you're planning a family braai, preparing a gourmet meal, or simply looking for your weekly essentials, our expert butchers are here to assist you in selecting the perfect cuts.</p>

        <p>At Mphenama, we understand that great meat is the foundation of great meals. That's why we go above and beyond to ensure that every product that leaves our shop meets our high standards. Our state-of-the-art facilities and strict quality control measures guarantee that you're getting nothing but the best.</p>

        <div class="cta-container">
            <a href="products.php" class="cta-button">Shop Now</a>
        </div>
    </section>

    <section id="featured-products">
        <h2>Featured Products</h2>
        <div class="product-grid">
            <?php
            // Fetch featured products from the database (we'll implement this function later)
            $featuredProducts = getFeaturedProducts();

            // Loop through featured products and display them
            foreach ($featuredProducts as $product) {
                echo '<div class="product-card">';
                echo '<img src="' . htmlspecialchars($product['image']) . '" alt="' . htmlspecialchars($product['name']) . '" class="product-image">';
                echo '<div class="product-details">';
                echo '<h3>' . htmlspecialchars($product['name']) . '</h3>';
                echo '<p>' . htmlspecialchars($product['description']) . '</p>';
                echo '<a href="' . htmlspecialchars($product['category']) . '-products.php" class="view-details">View Details</a>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </section>

    <section id="testimonials">
        <h2>Reviews</h2>
        <?php
        // Fetch testimonials from the database (we'll implement this function later)
        $testimonials = getTestimonials();

        // Display testimonials
        foreach ($testimonials as $testimonial) {
            echo '<div class="testimonial">';
            echo '<p>"' . htmlspecialchars($testimonial['content']) . '"</p>';
            echo '<cite>- ' . htmlspecialchars($testimonial['author']) . ', ' . htmlspecialchars($testimonial['title']) . '</cite>';
            echo '</div>';
        }
        ?>
    </section>
</main>

<?php
// Include the footer
include 'includes/footer.php';
?>