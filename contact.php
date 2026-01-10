<?php
session_start();
require_once 'db_config.php';

$confirmation_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form submission
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';

    try {
        $stmt = $pdo->prepare("INSERT INTO contact_submissions (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $phone, $subject, $message]);
        $confirmation_message = "Thank you, $name. Your message has been received.";
    } catch(PDOException $e) {
        $confirmation_message = "We're sorry, there was an error submitting your message. Please try again later.";
        // Log the error for admin review
        error_log("Contact form error: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Mphenama Butchery - Get in Touch</title>
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
                    <li><a href="contact.php" class="nav-link active"><i class="fas fa-envelope"></i> Contact</a></li>
                </ul>
            </nav>
            <div class="header-cta">
                <a href="#" class="cta-button"><i class="fas fa-phone"></i> Call Now</a>
            </div>
        </div>
    </header>

    <main>
        <section id="contact">
            <h1><i class="fas fa-envelope"></i> Contact Us</h1>
            <p>We'd love to hear from you! Whether you have a question about our products, want to place a special order, or just want to say hello, please don't hesitate to reach out.</p>
            
            <div class="contact-container">
                <div class="contact-form">
                    <h2>Send Us a Message</h2>
                    <?php if ($confirmation_message): ?>
                        <div id="confirmationMessage">
                            <p><i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($confirmation_message); ?></p>
                        </div>
                    <?php else: ?>
                        <form id="contactForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class="form-group">
                                <label for="name"><i class="fas fa-user"></i> Name:</label>
                                <input type="text" id="name" name="name" required>
                            </div>

                            <div class="form-group">
                                <label for="email"><i class="fas fa-envelope"></i> Email:</label>
                                <input type="email" id="email" name="email" required>
                            </div>

                            <div class="form-group">
                                <label for="phone"><i class="fas fa-phone"></i> Phone (optional):</label>
                                <input type="tel" id="phone" name="phone">
                            </div>

                            <div class="form-group">
                                <label for="subject"><i class="fas fa-tag"></i> Subject:</label>
                                <select id="subject" name="subject" required>
                                    <option value="">Select a subject</option>
                                    <option value="general">General Inquiry</option>
                                    <option value="order">Place an Order</option>
                                    <option value="feedback">Feedback</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="message"><i class="fas fa-comment"></i> Message:</label>
                                <textarea id="message" name="message" rows="5" required></textarea>
                            </div>

                            <button type="submit" id="submitButton"><i class="fas fa-paper-plane"></i> Send Message</button>
                        </form>
                    <?php endif; ?>
                </div>

                <div class="contact-info">
                    <h2>Our Contact Information</h2>
                    <p><i class="fas fa-map-marker-alt"></i> Address: 123 Main Street, Johannesburg, South Africa</p>
                    <p><i class="fas fa-phone"></i> Phone: +27 11 234 5678</p>
                    <p><i class="fas fa-envelope"></i> Email: info@mphenama.com</p>
                    <p><i class="fas fa-clock"></i> Business Hours:</p>
                    <ul>
                        <li>Monday - Friday: 8:00 AM - 6:00 PM</li>
                        <li>Saturday: 9:00 AM - 4:00 PM</li>
                        <li>Sunday: Closed</li>
                    </ul>
                    <div class="social-links">
                        <a href="https://www.facebook.com/mphenama" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.twitter.com/mphenama" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.instagram.com/mphenama" target="_blank"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
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
</body>
</html>