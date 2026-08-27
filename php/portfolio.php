<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amirmahdi Ghasabioroji's Portfolio</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" media="screen and (max-width: 1024px)" href="../css/mobile.css">
    <link rel="stylesheet" href="../css/portfolio.css">
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
                <li><a href="#about">About</a></li>
                <li><a href="#education">Education</a></li>
                <li><a href="../experience.html">Experience</a></li>
                <li><a href="../skills.html">Skills</a></li>
                <li><a href="blog.php">Blog</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="hero" class="hero-section">
            <div class="grid-container">
                <div class="left-column">
                    <div class="social-links">
                        <a href="https://linkedin.com/in/amirmahdi-ghasabioroji" class="social-icon linkedin">
                            <i class="fab fa-linkedin"></i>
                            <span>LinkedIn</span>
                        </a>
                        <a href="https://instagram.com/amirghasabi_" class="social-icon instagram">
                            <i class="fab fa-instagram"></i>
                            <span>Instagram</span>
                        </a>
                    </div>
                    <div class="mission-box">
                        <h3>Mission</h3>
                        <p>
                            Pursuing greatness in my field through hard work and dedication.<br>
                            Driven to inspire change with leadership and innovation.<br>
                            Shaping a brighter tomorrow through collaboration and motivation.
                        </p>
                    </div>
                    <div class="mission-box">
                        <h3>My CV</h3>
                        <p>You can access my CV through this link: <a href="../Amirmahdi Ghasabioroji.pdf"><em class="CV">Amirmahdi_Ghasabioroji's CV</em></a></p>
                    </div>
                </div>

                <div class="right-column">
                    <article class="about-me" id="about">
                        <div class="about-content">
                            <h2>About</h2>
                            <br>
                            <br>
                            <p>
                                My name is Amirmahdi Ghasabioroji, a Computer Science and AI student at Queen Mary University of London. I am a natural leader and critical thinker, passionate about solving complex problems and driving teams toward outstanding results.
                                Hardworking and dedicated, I constantly seek opportunities to learn, grow, and add to my knowledge with every challenge I encounter.
                            </p>
                        </div>
                        <div class="profile-image">
                            <figure>
                                <img src="../images/amir.jpg" alt="Amirmahdi Ghasabioroji">
                                <figcaption>Computer Science and AI Student</figcaption>
                            </figure>
                        </div>
                    </article>

                    <div class="education-box" id="education">
                        <h2>Education</h2>
                        <div class="education-content">
                            <div class="education-text">
                                <p>
                                    After graduating from my foundation program with a Distinction, I chose to study Computer Science and AI to pursue my passion for developing intelligent systems and robots. 
                                    Currently in my second semester, I am committed to achieving a First-Class degree through dedication and continuous learning. 
                                </p>
                            </div>
                            <div class="education-image">
                                <figure>
                                    <img src="../images/qmul.jpg" alt="Education">
                                    <figcaption>Queen Mary University of London</figcaption>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>

                <aside class="blog-sidebar">
                    <div class="login-form">
                        <h3>Login</h3>
                        <form action="login.php" method="post">
                            <div class="form-group">
                                <input type="email" name="email" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" placeholder="Password" required>
                            </div>
                            <button type="submit" class="btn">Login</button>
                        </form>
                    </div>
                    <div class="sidebar-image">
                        <img src="../images/robot.jpg" alt="Coding">
                        <p>
                            AI and machine learning are revolutionizing daily life by increasing efficiency, paving the way for a more seamless future. 
                            I aim to be at the forefront of this innovation, developing solutions that not only simplify everyday routines but also empower individuals, enhancing their experiences and improving their lives.
                        </p>
                    </div>
                </aside>
            </div>
            <div class="photo-break">
                <img src="../images/AI.jpg" alt="The Journey">
            </div>
        </section>

        <section>
            <div class="portfolio-button-container">
                <a href="../skills.html" class="portfolio-button">
                    <span>Skills Portfolio</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </section>

        <section>
            <div class="portfolio-button-container">
                <a href="../experience.html" class="portfolio-button">
                    <span>Experience Portfolio</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </section>

        <section>
            <div class="portfolio-button-container">
                <a href="../detailed-portfolio.html" class="portfolio-button">
                    <span>Detailed Experiences and Skills Portfolio</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </section>

        <section>
            <div class="portfolio-button-container">
                <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                    <a href="logout.php" class="portfolio-button">
                        <span>Logout</span>
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                <?php else: ?>
                    <a href="login.php" class="portfolio-button">
                        <span>Login</span>
                        <i class="fas fa-sign-in-alt"></i>
                    </a>
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