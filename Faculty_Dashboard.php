<?php
require_once 'config/auth_check.php';
checkRole(['faculty']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Dashboard</title>
    <link rel="stylesheet" href="CSS/Style.css">
    <script src="js/logout.js"></script>
</head>
<body>
    <header> 
        <nav>
            <h1>Welcome to Faculty Dashboard</h1>
            <a href="#course-management">Course Management</a>
            <a href="#session-overview">Session Overview</a>
            <a href="#attendance-reports">Attendance Report</a>
            <a href="#student-performance">Student Performance</a>
           <a href="logout.php" class="logout-btn">Logout</a>
        </nav>
    </header>
    
    <main>
        <section id="course-management">
            <h3>Course Management</h3>
            <p>Here faculty can create, update or delete course</p>
            <div class="course_management-box">
                <article class="course_card">
                    <h4>Manage Your Courses</h4>
                    <button id="createCourseBtn">Create New Course</button>
                    <button id="viewCoursesBtn">View Existing Courses</button>
                </article>
            </div>
        </section>
        
        <section id="session-overview">
            <h3>Session Overview</h3>
            <p>Here Faculty can view session Overview</p>
            <div class="session-overview-box">
                <article class="sessions_card">
                    <h4>Upcoming Sessions</h4>
                    <p>Next Session: Advanced Web Development</p>
                    <p><strong>Date:</strong> 12/15/25</p>
                </article>
            </div>
        </section>

        <section id="attendance-reports">
            <h3>Attendance Reports</h3>
            <p>Here Faculty can view attendance report</p>
            <div class="attendance-report-box">
                <article class="reports_card">
                    <h4>Current Attendance Statistics</h4>
                    <p>Overall Attendance: 85%</p>
                    <p><strong>Action:</strong> Generate Detailed Report</p>
                </article>
            </div>
        </section>

        <section id="student-performance">
            <h3>Student Performance</h3>
            <p>Here Faculty can view student performance</p>
            <div class="student-performance-box">
                <article class="reports_card">
                    <h4>Performance Overview</h4>
                    <p>Average Grade: B+</p>
                    <p><strong>Action:</strong> View Detailed Analytics</p>
                </article>
            </div>
        </section>
    </main>

   

    <!-- Create Course Modal -->
    <div id="createCourseModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Create New Course</h2>
            <form id="createCourseForm">
                <div class="form-group">
                    <label for="courseCode">Course Code:</label>
                    <input type="text" id="courseCode" name="courseCode" required 
                           placeholder="e.g., CS101">
                </div>
                <div class="form-group">
                    <label for="courseName">Course Name:</label>
                    <input type="text" id="courseName" name="courseName" required 
                           placeholder="e.g., Introduction to Programming">
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" 
                             placeholder="Course description..."></textarea>
                </div>
                <div class="form-group">
                    <label for="creditHours">Credit Hours:</label>
                    <input type="number" id="creditHours" name="creditHours" 
                           min="1" max="6" value="3">
                </div>
                <div class="form-group">
                    <label for="scheduleDays">Schedule Days:</label>
                    <input type="text" id="scheduleDays" name="scheduleDays" 
                           placeholder="e.g., Mon, Wed, Fri">
                </div>
                <div class="form-group">
                     <label for="scheduleTime">Schedule Time:</label>
                    <input type="time" id="scheduleTime" name="scheduleTime" required>
                </div>
                <button type="submit" class="btn-primary">Create Course</button>
            </form>
            <div id="courseMessage" style="margin-top: 15px;"></div>
        </div>
    </div>

            <!-- Existing Courses Section -->
        <section id="existing-courses">
            <h3>Your Courses</h3>
            <div id="coursesList" class="courses-list">
                <!-- Courses will be loaded here via AJAX -->
                <p>Loading your courses...</p>
            </div>
        </section>


    <script src="js/faculty_courses.js"></script>

     <footer>
        <p>&copy; 2025 Faculty Dashboard</p>
    </footer>
</body>
</html>