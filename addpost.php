<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add-post - Amirmahdi Ghasabioroji's Portfolio</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" media="screen and (max-width: 1024px)" href="css/mobile.css">
    <link rel="stylesheet" href="css/portfolio.css">
    <link rel="stylesheet" href="css/addpost.css">
    <link href="https://fonts.googleapis.com/css2?family=Italiana&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Italiana&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:ital,wght@0,300..700;1,300..700&family=Italiana&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="nav.js"></script>
    <script src="addpost.js"></script>
    <script src="preview.js"></script>
</head>

<body>
    <header class="header">
        <div class="logo">
            <h1>Amirmahdi Ghasabioroji</h1>
        </div>
        <input type="checkbox" id="nav-toggle" class="nav-toggle">
        <label for="nav-toggle" class="hamburger">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </label>
        <nav>
            <ul>
                <li><a href="portfolio.php">Home</a></li>
                <li><a href="portfolio.php#experience">Experience</a></li>
                <li><a href="portfolio.php#skills">Skills</a></li>
                <li><a href="blog.php">Blog</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="hero-section">
            <div class="blog-form-container">
                <h1 class="form-title">Welcome, <?php echo htmlspecialchars($_SESSION['first_name']); ?>! Add Blog Entry</h1>
                
                <?php if (isset($_SESSION['post_error'])): ?>
                    <div class="error-message">
                        <?php 
                            echo $_SESSION['post_error']; 
                            unset($_SESSION['post_error']);
                        ?>
                    </div>
                <?php endif; ?>
                
                <form action="preview_form_handler.php" method="post" id="blogForm">
                    <div class="form-field">
                        <input type="text" name="title" id="title" placeholder="Title" value="<?php echo isset($_SESSION['preview_data']) ? htmlspecialchars($_SESSION['preview_data']['title']) : ''; ?>">
                    </div>
                    <div class="form-field">
                        <textarea name="content" id="content" placeholder="Enter your text here"><?php echo isset($_SESSION['preview_data']) ? htmlspecialchars($_SESSION['preview_data']['content']) : ''; ?></textarea>
                    </div>
                    <div class="form-buttons">
                        <button type="button" class="form-button preview" id="previewBtn">Preview</button>
                        <button type="submit" name="action" value="post" class="form-button">Post</button>
                        <button type="button" class="form-button clear">Clear</button>
                    </div>
                    <div class="portfolio-button-container">
                        <a href="logout.php" class="portfolio-button">
                            <span>Logout</span>
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <footer id="contact">
        <div class="footer-content">
            <div class="contact-info">
                <h2>Contact</h2>
                <p><i class="fas fa-envelope"></i> Email: Ghasabioroji@gmail.com</p>
                <p><i class="fas fa-phone"></i> Phone: +44 7867 081909</p>
                <p><i class="fas fa-map-marker-alt"></i> Address: London, United Kingdom</p>
            </div>
            <div class="copyright">
                <p>&copy; 2025 Amirmahdi Ghasabioroji. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>