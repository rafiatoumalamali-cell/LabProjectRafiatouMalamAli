<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: /Attendance_manager/UpdatedFiles/index.php');
    exit;
}

// Check if user is approved
if (!isset($_SESSION['status']) || $_SESSION['status'] !== 'approved') {
    header('Location: /Attendance_manager/UpdatedFiles/pending_approval.php');
    exit;
}

// Strict role-based access control
function checkRole($allowed_roles) {
    if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], $allowed_roles)) {
        // Redirect to their actual dashboard based on their real role
        switch ($_SESSION['role']) {
            case 'student':
                header('Location: /Attendance_manager/UpdatedFiles/Student_Dashboard.php');
                break;
            case 'faculty':
                header('Location: /Attendance_manager/UpdatedFiles/Faculty_Dashboard.php');
                break;
            case 'faculty_intern':
                header('Location: /Attendance_manager/UpdatedFiles/FI_Dashboard.php');
                break;
            default:
                header('Location: /Attendance_manager/UpdatedFiles/index.php');
        }
        exit;
    }
}

// Page-specific role checks
function checkStudentAccess() {
    checkRole(['student']);
}

function checkFacultyAccess() {
    checkRole(['faculty']);
}

function checkFacultyInternAccess() {
    checkRole(['faculty_intern']);
}
?>