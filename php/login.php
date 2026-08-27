<?php
session_start();

// Database connection parameters
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "ecs214";

// Create and check connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialise error variable
$error = "";

// First, insert the user credentials if not already exists
$email = "ghasabioroji@gmail.com";
$firstName = "Amirmahdi";
$lastName = "Ghasabioroji";
$rawPassword = "Amirmahdi0234";

// Hash the password
$hashedPassword = password_hash($rawPassword, PASSWORD_DEFAULT);

// Check if user already exists
$checkUserSql = "SELECT * FROM USERS WHERE email = ?";
$checkStmt = $conn->prepare($checkUserSql);
$checkStmt->bind_param("s", $email);
$checkStmt->execute();
$result = $checkStmt->get_result();

if ($result->num_rows == 0) {
    // User doesn't exist, so insert
    $insertSql = "INSERT INTO USERS (firstName, lastName, email, password) VALUES (?, ?, ?, ?)";
    $insertStmt = $conn->prepare($insertSql);
    $insertStmt->bind_param("ssss", $firstName, $lastName, $email, $hashedPassword);
    
    if ($insertStmt->execute()) {
        // User successfully inserted
        $error = "New user account created.";
    } else {
        $error = "Error creating user: " . $conn->error;
    }
    $insertStmt->close();
}
$checkStmt->close();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form inputs
    $inputEmail = $conn->real_escape_string($_POST['email']);
    $inputPassword = $_POST['password'];

    // Prepare SQL to prevent SQL injection
    $sql = "SELECT id, firstName, lastName, password FROM USERS WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $inputEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($inputPassword, $user['password'])) {
            // Password is correct, start a session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['first_name'] = $user['firstName'];
            $_SESSION['last_name'] = $user['lastName'];
            $_SESSION['logged_in'] = true;

            // Redirect to addpost.php
            header("Location: addpost.php");
            exit();
        } else {
            // Invalid password
            $error = "Invalid email or password";
        }
    } else {
        // User not found
        $error = "Invalid email or password";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Amirmahdi Ghasabioroji</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/portfolio.css">
    <link rel="stylesheet" href="../css/addpost.css">
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
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="hero-section">
            <div class="blog-form-container">
                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                    <h1 class="form-title">Welcome, <?php echo htmlspecialchars($_SESSION['first_name']); ?>!</h1>
                    <p style="text-align: center; color: white;">You are already logged in.</p>
                    <div class="form-buttons">
                        <a href="addpost.php" class="form-button">Go to Add Post</a>
                        <a href="logout.php" class="form-button clear">Logout</a>
                    </div>
                <?php else: ?>
                    <h1 class="form-title">Login to Your Account</h1>
                    <?php
                    if (!empty($error)) {
                        echo "<p style='color: red; margin-bottom: 1rem; text-align: center;'>$error</p>";
                    }
                    ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-field">
                            <input type="email" name="email" placeholder="Email" required 
                                value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                        </div>
                        <div class="form-field">
                            <input type="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="form-buttons">
                            <button type="submit" class="form-button">Login</button>
                        </div>
                    </form>
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