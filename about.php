require_once 'db_config.php';
<?php
// Start the session (if needed for consistency with other pages)
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Mphenama Butchery</title>
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

    <main class="about-page">
        <section id="about-hero" class="fade-in">
            <h1>About Mphenama Butchery</h1>
            <p>Delivering Quality Meats Since 2003</p>
        </section>

        <section id="our-story" class="slide-in-left">
            <h2>Our Story</h2>
            <p>Mphenama Butchery was founded in 2024 with a simple mission: to provide our community with the highest quality meats sourced from local farms. Over the months, we've grown from a small family-run shop to a beloved local institution, never compromising on our commitment to quality and customer service.</p>
        </section>

        <section id="our-values" class="slide-in-right">
            <h2>Our Values</h2>
            <ul>
                <li><strong>Quality:</strong> We source only the finest meats from trusted local farms.</li>
                <li><strong>Community:</strong> We're committed to supporting our local farmers and community.</li>
                <li><strong>Sustainability:</strong> We strive to minimize our environmental impact in all our operations.</li>
                <li><strong>Customer Service:</strong> We believe in building lasting relationships with our customers through exceptional service.</li>
            </ul>
        </section>

        <section id="team-slideshow">
            <h2>Meet Our Team</h2>
            <div class="slideshow-container">
                <?php
                $team_members = [
                    ['name' => 'Walter', 'role' => 'Master Butcher', 'image' => 'john.jpg'],
                    ['name' => 'Ranthumeng', 'role' => 'Customer Service Manager', 'image' => 'meet-manager2.jpg'],
                    ['name' => 'Robson', 'role' => 'Quality Control Specialist', 'image' => 'quality.jpg']
                ];

                foreach ($team_members as $index => $member) {
                    echo '<div class="slide fade">
                        <div class="team-image-container">
                            <img src="images/team/' . $member['image'] . '" alt="' . $member['name'] . '" class="team-image">
                        </div>
                        <div class="text">
                            <h3><strong>' . $member['name'] . '</strong></h3>
                            <p>' . $member['role'] . '</p>
                        </div>
                    </div>';
                }
                ?>

                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>
            <div class="dot-container">
                <?php
                for ($i = 0; $i < count($team_members); $i++) {
                    echo '<span class="dot" onclick="currentSlide(' . ($i + 1) . ')"></span>';
                }
                ?>
            </div>
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
                <p><i class="fas fa-map-marker-alt"></i> 123 Main Street, Johannesburg, South Africa</p>
                <p><i class="fas fa-phone"></i> +27 11 234 5678</p>
                <p><i class="fas fa-envelope"></i> <a href="mailto:info@mphenama.com">info@mphenama.com</a></p>
            </div>
            <div class="footer-section">
                <h3>Follow Us</h3>
                <div class="footer-social">
                    <a href="https://www.facebook.com/mphenama" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.twitter.com/mphenama" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com/mphenama" target="_blank"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Mphenama Butchery. All rights reserved.</p>
        </div>
    </footer>

    <script src="js/animations.js"></script>
    <script src="js/slideshow.js"></script>

</body>
</html>