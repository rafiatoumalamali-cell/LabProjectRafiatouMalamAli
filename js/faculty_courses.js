// Faculty Courses JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Modal elements
    const modal = document.getElementById('createCourseModal');
    const createBtn = document.getElementById('createCourseBtn');
    const closeBtn = document.querySelector('.close');
    const courseForm = document.getElementById('createCourseForm');
    const messageDiv = document.getElementById('courseMessage');
    const submitBtn = courseForm.querySelector('.btn-primary');

    // Open modal
    createBtn.addEventListener('click', function() {
        modal.style.display = 'block';
        // Clear form and message when opening
        courseForm.reset();
        messageDiv.innerHTML = '';
    });

    // Close modal
    closeBtn.addEventListener('click', function() {
        modal.style.display = 'none';
        messageDiv.innerHTML = '';
    });

    // Close modal when clicking outside
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
            messageDiv.innerHTML = '';
        }
    });

    // Handle form submission
    courseForm.addEventListener('submit', function(event) {
        event.preventDefault();
        
        const formData = new FormData(courseForm);
        
        // Show loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Creating Course <span class="loading"></span>';
        messageDiv.innerHTML = '<p style="color: #667eea; background: #f0f4ff; padding: 10px; border-radius: 8px;">Creating your course...</p>';
        
        // AJAX request
        fetch('faculty/create_course.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                messageDiv.innerHTML = `<p style="color: #059669; background: #f0fff4; padding: 12px; border-radius: 8px; border-left: 4px solid #059669;">
                    ✅ ${data.message}
                </p>`;
                courseForm.reset();
                setTimeout(() => {
                    modal.style.display = 'none';
                    messageDiv.innerHTML = '';
                }, 2000);
            } else {
                messageDiv.innerHTML = `<p style="color: #dc2626; background: #fef2f2; padding: 12px; border-radius: 8px; border-left: 4px solid #dc2626;">
                    ❌ ${data.message}
                </p>`;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            messageDiv.innerHTML = `<p style="color: #dc2626; background: #fef2f2; padding: 12px; border-radius: 8px; border-left: 4px solid #dc2626;">
                ❌ Error creating course. Please try again.
            </p>`;
        })
        .finally(() => {
            // Reset button state
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Create Course';
        });
    });

    // Add input focus effects
    const inputs = courseForm.querySelectorAll('input, textarea');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
    });
});