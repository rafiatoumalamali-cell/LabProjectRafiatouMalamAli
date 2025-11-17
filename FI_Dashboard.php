<?php
session_start();
// Add authentication check here
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Intern Dashboard</title>
    <link rel="stylesheet" href="Style.css">
</head>
<body>
    <header>
        <nav>
            <h1>Faculty Intern Dashboard</h1>
            <a href="#course-list">Course List</a>
            <a href="#sessions">Sessions</a>
            <a href="#reports">Reports</a>
            <a href="#auditors">Auditors</a>
            <a href="index.php">Logout</a>
        </nav>
    </header>

    <main>
        <section id="course-list">
            <h3>Course List</h3>
            <p>Here faculty Intern can view list of his courses</p>
            <div class="course-list-box">
                <article class="course_card">
                    <h4>Discrete Structures and Theory</h4>
                    <p>Instructor: Dr Govindha | Enrolled: 32</p>
                    <p><strong>Actions:</strong> View | Mark as auditor allowed</p>
                </article>
            </div>
        </section>

        <section id="sessions">
            <h3>Sessions</h3>
            <p>Here faculty Intern can view list of his sessions</p>
            <div class="sessions-box">
                <article class="session_card">
                    <h4>Session 1: Python Basics</h4>
                    <p>Date: 10/11/25, Time: 1:00 PM</p>
                    <p><strong>Status:</strong> Completed</p>
                </article>
            </div>
        </section>

        <section id="reports">
            <h3>Reports</h3>
            <p>Here faculty Intern can view reports</p>
            <div class="reports-box">
                <article class="reports_card">
                    <h4>Attendance Reports</h4>
                    <p>Last Update: 12/05/25</p>
                    <p><strong>Action:</strong> Review Reports</p>
                </article>
            </div>
        </section>

        <section id="auditors">
            <h3>Auditors & Observers</h3>
            <p>Faculty intern can manage auditors or observers</p>
            <div class="auditors-box">
                <article class="auditors_card">
                    <h4>Rafiatou Malam</h4>
                    <p>Role: Observer, Course: Data Science</p>
                    <p><strong>Action:</strong> Remove | View</p>
                </article>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Faculty Intern Dashboard</p>
    </footer>
</body>
</html>