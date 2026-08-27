document.addEventListener('DOMContentLoaded', function() {
    // Get form and its elements
    const form = document.querySelector('form');
    const titleInput = document.getElementById('title');
    const contentInput = document.getElementById('content');
    const clearButton = document.querySelector('.form-button.clear');

    // Function to validate form fields
    function validateForm(event) {
        // Reset previous error states
        titleInput.classList.remove('error');
        contentInput.classList.remove('error');

        let isValid = true;

        // Check title
        if (titleInput.value.trim() === '') {
            titleInput.classList.add('error');
            isValid = false;
        }

        // Check content
        if (contentInput.value.trim() === '') {
            contentInput.classList.add('error');
            isValid = false;
        }

        // Prevent form submission if validation fails
        if (!isValid) {
            event.preventDefault();
        }
    }

    // Function to handle clear button click
    function handleClearClick(event) {
        event.preventDefault();
        
        // Confirm before clearing
        const confirmClear = confirm('Are you sure you want to clear the form? All entered information will be lost.');
        
        if (confirmClear) {
            titleInput.value = '';
            contentInput.value = '';
            document.getElementById('category').selectedIndex = 0;
        }
    }

    // Add event listeners
    form.addEventListener('submit', validateForm);
    clearButton.addEventListener('click', handleClearClick);
});