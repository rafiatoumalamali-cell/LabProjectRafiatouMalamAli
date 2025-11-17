<?php
session_start();
// Add authentication check here
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Dashboard</title>
    <link rel="stylesheet" href="Style.css">
</head>
<body>
    <header> 
        <nav>
            <h1>Welcome to Faculty Dashboard</h1>
            <a href="#course-management">Course Management</a>
            <a href="#session-overview">Session Overview</a>
            <a href="#attendance-reports">Attendance Report</a>
            <a href="#student-performance">Student Performance</a>
            <a href="index.php">Logout</a>
        </nav>
    </header>
    
    <main>
        <section id="course-management">
            <h3>Course Management</h3>
            <p>Here faculty can create, update or delete course</p>
            <div class="course_management-box">
                <article class="course_card">
                    <h4>Manage Your Courses</h4>
                    <button>Create New Course</button>
                    <button>View Existing Courses</button>
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

    <footer>
        <p>&copy; 2025 Faculty Dashboard</p>
    </footer>
</body>
</html>