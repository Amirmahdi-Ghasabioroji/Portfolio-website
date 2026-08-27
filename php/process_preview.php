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

// Check if an action was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $action = $_POST['action'];
    
    if ($action === 'publish') {
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

        // Get data from session
        $title = $_SESSION['preview_data']['title'];
        $content = $_SESSION['preview_data']['content'];
        $user_id = $_SESSION['user_id'];

        // Prepare SQL to insert post
        $sql = "INSERT INTO blog_posts (user_id, title, content, created_at) VALUES (?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $user_id, $title, $content);

        // Execute the statement
        if ($stmt->execute()) {
            // Clear the preview data
            unset($_SESSION['preview_data']);
            
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
    } 
    elseif ($action === 'edit') {
        // Redirect back to the addpost page to edit
        // The form data is still in the session
        header("Location: addpost.php");
        exit();
    }
} else {
    // If no action, redirect to addpost
    header("Location: addpost.php");
    exit();
}