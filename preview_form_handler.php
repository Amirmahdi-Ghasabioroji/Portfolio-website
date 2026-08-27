<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate inputs
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    // Check if title and content are not empty
    if (empty($title) || empty($content)) {
        $_SESSION['post_error'] = "Title and content cannot be empty.";
        header("Location: addpost.php");
        exit();
    }

    // Check which action was requested
    if (isset($_POST['action']) && $_POST['action'] === 'post') {
        // Direct posting to blog
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

        $user_id = $_SESSION['user_id'];

        // Prepare SQL to insert post
        $sql = "INSERT INTO blog_posts (user_id, title, content, created_at) VALUES (?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $user_id, $title, $content);

        // Execute the statement
        if ($stmt->execute()) {
            // Set success message
            $_SESSION['post_success'] = "Blog post published successfully!";
            
            // Redirect to blog page
            header("Location: blog.php");
            exit();
        } else {
            // Handle error
            $_SESSION['post_error'] = "Error publishing blog post: " . $conn->error;
            header("Location: addpost.php");
            exit();
        }

        $stmt->close();
        $conn->close();
    } else {
        // Preview flow (default)
        // Store form data in session for preview
        $_SESSION['preview_data'] = [
            'title' => $title,
            'content' => $content
        ];

        // Redirect to preview page
        header("Location: preview.php");
        exit();
    }
}
else {
    // If accessed directly without POST data, redirect to addpost
    header("Location: addpost.php");
    exit();
}