document.addEventListener('DOMContentLoaded', () => {
    const navToggle = document.getElementById('nav-toggle');
    const navLinks = document.querySelectorAll('nav a');

    if (!navToggle) {
        return;
    }

    const setMenuState = (open) => {
        navToggle.checked = open;
        document.body.classList.toggle('nav-open', open);
    };

    navToggle.addEventListener('change', () => {
        document.body.classList.toggle('nav-open', navToggle.checked);
    });

    navLinks.forEach((link) => {
        link.addEventListener('click', () => {
            setMenuState(false);
        });
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && navToggle.checked) {
            setMenuState(false);
        }
    });
});
