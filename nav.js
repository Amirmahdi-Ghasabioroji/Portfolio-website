document.addEventListener('DOMContentLoaded', () => {
    const navToggle = document.getElementById('nav-toggle');
    const navLinks = document.querySelectorAll('nav a[href^="#"]');

    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            // Uncheck the nav toggle to close the menu
            navToggle.checked = false;
        });
    });
});