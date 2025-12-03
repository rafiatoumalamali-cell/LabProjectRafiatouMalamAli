<?php
session_start();
require_once '../config/database.php';
require_once '../config/auth_check.php';

checkRole(['faculty']);

header('Content-Type: application/json');

$response = ['success' => false, 'courses' => []];

try {
    $database = new Database();
    $db = $database->getConnection();

    // Get courses for this faculty member
    $query = "SELECT c.*, 
                     COUNT(DISTINCT er.request_id) as pending_requests,
                     COUNT(DIST EXISTS (SELECT 1 FROM course_student_list WHERE course_id = c.course_id)) as enrolled_students
              FROM courses c 
              LEFT JOIN enrollment_requests er ON c.course_id = er.course_id AND er.status = 'pending'
              WHERE c.faculty_id = :faculty_id 
              GROUP BY c.course_id 
              ORDER BY c.created_at DESC";
    
    $stmt = $db->prepare($query);
    $stmt->bindParam(':faculty_id', $_SESSION['user_id']);
    $stmt->execute();

    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $response['success'] = true;
    $response['courses'] = $courses;

} catch (Exception $e) {
    $response['error'] = 'Database error: ' . $e->getMessage();
}

echo json_encode($response);
?>