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


// Load faculty courses
function loadFacultyCourses() {
    const coursesList = document.getElementById('coursesList');
    if (!coursesList) return;

    coursesList.innerHTML = '<p>Loading your courses...</p>';

    fetch('./faculty/get_courses.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                displayCourses(data.courses);
            } else {
                coursesList.innerHTML = '<p class="empty-state">Error loading courses</p>';
            }
        })
        .catch(error => {
            console.error('Error loading courses:', error);
            coursesList.innerHTML = '<p class="empty-state">Error loading courses</p>';
        });
}

// Display courses in the list
function displayCourses(courses) {
    const coursesList = document.getElementById('coursesList');
    
    if (courses.length === 0) {
        coursesList.innerHTML = `
            <div class="empty-state">
                <h4>No Courses Yet</h4>
                <p>You haven't created any courses yet. Click "Create New Course" to get started!</p>
            </div>
        `;
        return;
    }

    coursesList.innerHTML = courses.map(course => `
        <div class="course-card">
            <div class="course-header">
                <span class="course-code">${course.course_code}</span>
            </div>
            <h4 class="course-name">${course.course_name}</h4>
            <p class="course-description">${course.description || 'No description provided.'}</p>
            <div class="course-details">
                <div class="course-detail-item">
                    <strong>Credits:</strong> ${course.credit_hours}
                </div>
                <div class="course-detail-item">
                    <strong>Schedule:</strong> ${course.schedule_days || 'Not set'} ${course.schedule_time || ''}
                </div>
                <div class="course-detail-item">
                    <strong>Students:</strong> ${course.enrolled_students || 0}
                </div>
                <div class="course-detail-item">
                    <strong>Pending:</strong> ${course.pending_requests || 0}
                </div>
            </div>
            <div class="course-actions">
                <button class="btn-small btn-view" onclick="viewCourse(${course.course_id})">View Details</button>
                <button class="btn-small btn-manage" onclick="manageCourse(${course.course_id})">Manage</button>
            </div>
        </div>
    `).join('');
}

// Placeholder functions for course actions
function viewCourse(courseId) {
    alert('View course details for ID: ' + courseId);
    // We'll implement this later
}

function manageCourse(courseId) {
    alert('Manage course for ID: ' + courseId);
    // We'll implement this later
}

// Load courses when page loads
document.addEventListener('DOMContentLoaded', function() {
    loadFacultyCourses();
    
    // ... your existing modal code ...
});