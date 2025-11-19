<?php
// Simple admin approval page (for testing)
session_start();
require_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();

// Get pending users
$query = "SELECT user_id, first_name, last_name, email, role FROM users WHERE status = 'pending'";
$stmt = $db->prepare($query);
$stmt->execute();
$pending_users = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['approve_user'])) {
    $user_id = $_POST['user_id'];
    $updateQuery = "UPDATE users SET status = 'approved' WHERE user_id = :user_id";
    $stmt = $db->prepare($updateQuery);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    
    header('Location: admin_approve.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Approval</title>
    <link rel="stylesheet" href="CSS/Style.css">
</head>
<body>
    <div class="input_datacontainer">
        <h1>Pending User Approvals</h1>
        
        <?php if (empty($pending_users)): ?>
            <p>No pending approvals.</p>
        <?php else: ?>
            <?php foreach ($pending_users as $user): ?>
                <div style="border: 1px solid #ccc; padding: 10px; margin: 10px 0;">
                    <p><strong>Name:</strong> <?php echo $user['first_name'] . ' ' . $user['last_name']; ?></p>
                    <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
                    <p><strong>Role:</strong> <?php echo $user['role']; ?></p>
                    <form method="POST">
                        <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                        <button type="submit" name="approve_user">Approve</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        
        <br>
        <a href="index.php">Back to Login</a>
    </div>
</body>
</html>