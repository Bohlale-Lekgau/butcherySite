<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mphenama Butchery - <?php echo ucfirst(str_replace(".php", "", $current_page)); ?></title>
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
                    <?php
                    $pages = array(
                        'index.php' => '<i class="fas fa-home"></i> Home',
                        'products.php' => '<i class="fas fa-drumstick-bite"></i> Our Products',
                        'about.php' => '<i class="fas fa-info-circle"></i> About Us',
                        'contact.php' => '<i class="fas fa-envelope"></i> Contact'
                    );
                    foreach ($pages as $url => $title) {
                        $class = ($current_page == $url) ? ' class="nav-link active"' : ' class="nav-link"';
                        echo "<li><a href=\"$url\"$class>$title</a></li>";
                    }
                    ?>
                </ul>
            </nav>
            <div class="header-cta">
                <a href="#" class="cta-button"><i class="fas fa-phone"></i> Call Now</a>
            </div>
        </div>
    </header>
