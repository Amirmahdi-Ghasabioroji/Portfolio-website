document.addEventListener('DOMContentLoaded', function() {
    // Get the preview button
    const previewBtn = document.getElementById('previewBtn');
    
    // Get form and its elements
    const form = document.getElementById('blogForm');
    const titleInput = document.getElementById('title');
    const contentInput = document.getElementById('content');
    
    // Function to validate form fields
    function validatePreview() {
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

        return isValid;
    }
    
    // Add event listener to preview button
    if (previewBtn) {
        previewBtn.addEventListener('click', function() {
            if (validatePreview()) {
                // Submit the form without an action parameter
                // The absence of action will trigger preview in the handler
                form.submit();
            }
        });
    }
    
    // Function to handle action submission in preview page
    window.submitAction = function(action) {
        document.getElementById('previewAction').value = action;
        document.getElementById('previewForm').submit();
    }
});