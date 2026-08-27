<?php
// Database connection parameters
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "ecs214";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get selected month from GET parameter (if any)
$selected_month = isset($_GET['month']) ? $conn->real_escape_string($_GET['month']) : 'all';

// Prepare query without ORDER BY - we'll sort in PHP
if ($selected_month === 'all') {
    $sql = "SELECT bp.id, bp.title, bp.content, bp.created_at, u.firstName, u.lastName 
            FROM blog_posts bp 
            JOIN USERS u ON bp.user_id = u.id";
} else {
    $sql = "SELECT bp.id, bp.title, bp.content, bp.created_at, u.firstName, u.lastName 
            FROM blog_posts bp 
            JOIN USERS u ON bp.user_id = u.id 
            WHERE DATE_FORMAT(bp.created_at, '%b') = ?";
}

// Prepare and execute the statement
$stmt = $conn->prepare($sql);
if ($selected_month !== 'all') {
    $stmt->bind_param("s", $selected_month);
}
$stmt->execute();
$result = $stmt->get_result();

// Fetch all results into an array
$posts = [];
while ($row = $result->fetch_assoc()) {
    $posts[] = $row;
}

// Custom sorting function using PHP's usort
usort($posts, function($a, $b) {
    $dateA = strtotime($a['created_at']);
    $dateB = strtotime($b['created_at']);
    
    // Sort in descending order (newest first)
    return $dateB - $dateA;
});

// Get unique months for dropdown
$months_query = "SELECT DISTINCT DATE_FORMAT(created_at, '%b') as month 
                 FROM blog_posts 
                 ORDER BY MONTH(created_at)";
$months_result = $conn->query($months_query);

// Set the default timezone 
date_default_timezone_set('UTC');  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Posts - Amirmahdi Ghasabioroji</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" media="screen and (max-width: 1024px)" href="../css/mobile.css">
    <link rel="stylesheet" href="../css/portfolio.css">
    <link rel="stylesheet" href="../css/addpost.css">
    <link rel="stylesheet" href="../css/blog.css">
    <link href="https://fonts.googleapis.com/css2?family=Italiana&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Italiana&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:ital,wght@0,300..700;1,300..700&family=Italiana&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="../nav.js"></script>
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
                <li><a href="#blog">Posts</a></li>
                <li><a href="../experience.html">Experience</a></li>
                <li><a href="../skills.html">Skills</a></li>
                <li><a href="addpost.php">Add-post</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="hero-section">
            <div class="blog-form-container" >
                <h1 class="form-title" id="blog">Blog Posts</h1>

                <div class="form-field">
                    <form method="get" action="">
                        <select name="month" onchange="this.form.submit()" class="form-control">
                            <option value="all" <?php echo ($selected_month === 'all') ? 'selected' : ''; ?>>
                                All Months
                            </option>
                            <?php 
                            while ($month_row = $months_result->fetch_assoc()) {
                                $month = $month_row['month'];
                                $selected = ($selected_month === $month) ? 'selected' : '';
                                echo "<option value='$month' $selected>$month</option>";
                            }
                            ?>
                        </select>
                    </form>
                </div>

                <?php if (count($posts) > 0): ?>
                    <?php foreach ($posts as $row): ?>
                        <div class="blog-post">
                            <h2>
                                <?php echo htmlspecialchars($row['title']); ?>
                            </h2>
                            <h3 class="post-meta">
                                By <?php echo htmlspecialchars($row['firstName'] . ' ' . $row['lastName']); ?> 
                                on <?php echo date('F j, Y h:i A (T)', strtotime($row['created_at'])); ?>
                            </h3>
                            <div class="post-content">
                                <?php echo nl2br(htmlspecialchars($row['content'])); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="no-posts">No blog posts found.</p>
                <?php endif; ?>
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

<?php
// Close connections
$stmt->close();
$conn->close();
?>