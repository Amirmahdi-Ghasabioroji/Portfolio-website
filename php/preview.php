<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Check if form data exists in session
if (!isset($_SESSION['preview_data'])) {
    header("Location: addpost.php");
    exit();
}

$previewData = $_SESSION['preview_data'];
$title = htmlspecialchars($previewData['title']);
$content = htmlspecialchars($previewData['content']);

// Set the default timezone 
date_default_timezone_set('Europe/London'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview Post - Amirmahdi Ghasabioroji's Portfolio</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" media="screen and (max-width: 1024px)" href="../css/mobile.css">
    <link rel="stylesheet" href="../css/portfolio.css">
    <link rel="stylesheet" href="../css/addpost.css">
    <link rel="stylesheet" href="../css/blog.css">
    <link rel="stylesheet" href="../css/preview.css">
    <link href="https://fonts.googleapis.com/css2?family=Italiana&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Italiana&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:ital,wght@0,300..700;1,300..700&family=Italiana&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="../nav.js"></script>
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
                <li><a href="../index.html">Home</a></li>
                <li><a href="../experience.html">Experience</a></li>
                <li><a href="../skills.html">Skills</a></li>
                <li><a href="blog.php">Blog</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="hero-section">
            <div class="blog-form-container">
                <h1 class="form-title">Post Preview</h1>
                
                <div class="preview-post">
                    <h2><?php echo $title; ?></h2>
                    <h3 class="post-meta">
                        By <?php echo htmlspecialchars($_SESSION['first_name'] . ' ' . ($_SESSION['last_name'] ?? '')); ?> 
                        on <?php echo date('F j, Y h:i A (T)'); ?>
                    </h3>
                    <div class="post-content">
                        <?php echo nl2br($content); ?>
                    </div>
                </div>

                <div class="preview-actions">
                    <form action="process_preview.php" method="post" id="previewForm">
                        <input type="hidden" name="action" id="previewAction" value="">
                        <div class="form-buttons">
                            <button type="button" class="form-button publish" onclick="submitAction('publish')">Publish Post</button>
                            <button type="button" class="form-button edit" onclick="submitAction('edit')">Edit Post</button>
                        </div>
                    </form>
                </div>
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