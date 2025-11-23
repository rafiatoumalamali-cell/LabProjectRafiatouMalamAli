<?php
session_start();
require_once '../config/database.php';
require_once '../config/auth_check.php';

checkRole(['faculty']);

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$response = ['success' => false, 'message' => ''];

try {
    $courseCode = trim($_POST['courseCode'] ?? '');
    $courseName = trim($_POST['courseName'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $creditHours = intval($_POST['creditHours'] ?? 3);
    $scheduleDays = trim($_POST['scheduleDays'] ?? '');
    $scheduleTime = $_POST['scheduleTime'] ?? '';

    // Validation
    if (empty($courseCode) || empty($courseName)) {
        $response['message'] = 'Course code and name are required.';
        echo json_encode($response);
        exit;
    }

    $database = new Database();
    $db = $database->getConnection();

    // Check if course code already exists
    $checkQuery = "SELECT course_id FROM courses WHERE course_code = :course_code";
    $stmt = $db->prepare($checkQuery);
    $stmt->bindParam(':course_code', $courseCode);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $response['message'] = 'Course code already exists.';
        echo json_encode($response);
        exit;
    }

    // Insert new course
    $insertQuery = "INSERT INTO courses (course_code, course_name, description, credit_hours, faculty_id, schedule_days, schedule_time) 
                   VALUES (:course_code, :course_name, :description, :credit_hours, :faculty_id, :schedule_days, :schedule_time)";
    
    $stmt = $db->prepare($insertQuery);
    $stmt->bindParam(':course_code', $courseCode);
    $stmt->bindParam(':course_name', $courseName);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':credit_hours', $creditHours);
    $stmt->bindParam(':faculty_id', $_SESSION['user_id']);
    $stmt->bindParam(':schedule_days', $scheduleDays);
    $stmt->bindParam(':schedule_time', $scheduleTime);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Course created successfully!';
    } else {
        $errorInfo = $stmt->errorInfo();
        $response['message'] = 'Database error: ' . $errorInfo[2];
    }

} catch (Exception $e) {
    $response['message'] = 'Error: ' . $e->getMessage();
}

echo json_encode($response);
?>