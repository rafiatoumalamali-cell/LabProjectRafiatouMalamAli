<?php
session_start();
require_once 'config/database.php';

// If user is not logged in, redirect to login
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit;
}

// Check current status in database
$database = new Database();
$db = $database->getConnection();
$query = "SELECT status FROM users WHERE user_id = :user_id";
$stmt = $db->prepare($query);
$stmt->bindParam(':user_id', $_SESSION['user_id']);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// If status changed to approved, redirect to dashboard
if ($user['status'] === 'approved') {
    $_SESSION['status'] = 'approved'; // Update session
    header('Location: ' . getDashboardUrl($_SESSION['role']));
    exit;
}

function getDashboardUrl($role) {
    switch ($role) {
        case 'student': return 'Student_Dashboard.php';
        case 'faculty': return 'Faculty_Dashboard.php';
        case 'faculty_intern': return 'FI_Dashboard.php';
        default: return 'index.php';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Approval</title>
    <link rel="stylesheet" href="CSS/Style.css">
</head>
<body>
    <div class="input_datacontainer">
        <h1>Account Pending Approval</h1>
        <p>Your account registration has been received and is waiting for administrator approval.</p>
        <p>You will be able to access the system once your account has been reviewed and activated.</p>
        <p>Status will update automatically. <a href="pending_approval.php">Refresh page</a> to check.</p>
        <br>
        <a href="logout.php" style="display: inline-block; padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 5px;">Logout</a>
    </div>
    
    <script>
        // Auto-refresh every 30 seconds to check status
        setTimeout(function() {
            window.location.reload();
        }, 30000);
    </script>
</body>
</html>