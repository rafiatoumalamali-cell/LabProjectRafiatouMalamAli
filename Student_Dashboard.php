<?php
session_start();
// Add authentication check here
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="Style.css">
</head>
<body>
    <header>
        <nav>
            <h1>Student Dashboard</h1>
            <a href="#my_Courses">My Courses</a>
            <a href="#Session_Schedule">Sessions Schedule</a>
            <a href="#Grades_Reports">Grades/Reports</a>
            <a href="#auditors">Auditor Options</a>
            <a href="index.php">Logout</a>
        </nav>
    </header>

    <main>
        <section id="my_Courses">
            <h3>My Courses</h3>
            <p>Here student can view list of his courses</p>
            <div class="my_Courses-box">
                <article class="course_card">
                    <h4>Financial Accounting</h4>
                    <p>Instructor: Dr Theodora</p>
                    <p><strong>Actions:</strong> View details | Join as auditor</p>
                </article>
            </div>
        </section>

        <section id="Session_Schedule">
            <h3>Session Schedule</h3>
            <p>Here student can view his Session Schedule</p>
            <div class="Session_Schedule-box">
                <article class="sessions_card">
                    <h4>Session 1: System Analysis and Design</h4>
                    <p>Date: 12/01/26, Time: 1:40 PM</p>
                    <p><strong>Status:</strong> Upcoming</p>
                </article>
            </div>
        </section>

        <section id="Grades_Reports">
            <h3>Grades Reports</h3>
            <p>Here student can view Grades Reports</p>
            <div class="Grades_Reports-box">
                <article class="Grades_Reports-card">
                    <h4>Financial Accounting | Final Exam</h4>
                    <p>Grade: A+ | Faculty Feedback: Excellent job!</p>
                    <p><strong>Actions:</strong> View details</p>
                </article>
            </div>
        </section>

        <section id="auditors">
            <h3>Auditors & Observers</h3>
            <p>Student can be an auditor or observer</p>
            <div class="auditors-box">
                <article class="auditors_card">
                    <h4>Join a Course</h4>
                    <button>Join as Auditor</button>
                    <button>Join as Observer</button>
                </article>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Student Dashboard</p>
    </footer>
</body>
</html>