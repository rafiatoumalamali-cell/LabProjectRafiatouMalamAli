<?php
session_start();
require_once 'config/database.php';

$login_response = ['success' => false, 'message' => ''];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['Username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $login_response['message'] = 'Username and password are required.';
    } else {
        $database = new Database();
        $db = $database->getConnection();

        // Check if user exists
        $query = "SELECT user_id, username, password_hash, role, status FROM users WHERE username = :username";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Verify password
            if (password_verify($password, $user['password_hash'])) {
                // Login successful - create session
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['status'] = $user['status'];
                $_SESSION['loggedin'] = true;

                $login_response['success'] = true;
                $login_response['message'] = 'Login successful!';
                $login_response['username'] = $user['username'];
                $login_response['user_id'] = $user['user_id'];
                $login_response['role'] = $user['role'];
                
                // REDIRECT TO DASHBOARD
                switch ($_SESSION['role']) {
                    case 'student':
                        header('Location: Student_Dashboard.php');
                        exit;
                    case 'faculty':
                        header('Location: Faculty_Dashboard.php');
                        exit;
                    case 'faculty_intern':
                        header('Location: FI_Dashboard.php');
                        exit;
                    default:
                        header('Location: index.php');
                        exit;
                }
            } else {
                $login_response['message'] = 'Invalid password.';
            }
        } else {
            $login_response['message'] = 'User not found.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="CSS/Style.css">
</head>
<body>
    <form id="loginForm" method="POST" action="index.php">
        <h1>Login Form</h1>
        <div class="input_datacontainer">
            
            <?php if (!empty($login_response['message']) && !$login_response['success']): ?>
                <div class="error-message" style="color: red; padding: 10px; background: #ffe6e6; border-radius: 5px;">
                    <?php echo $login_response['message']; ?>
                </div>
            <?php endif; ?>

            <label for="userName">Username:</label>
            <input type="text" id="userName" name="Username" 
            placeholder="User Name:" 
            required
            minlength="2"
            maxlength="50"
            title="username must contain only letters, numbers or underscores">

            <label for="password">Password:</label>
            <input type="password" id="password" name="password"
             placeholder="Password" required
             minlength="8"
             title="Password must be at least 8 characters long">

            <button type="submit" class="btn">Login</button><br>
            <p class="msg"> 
                Don't have an account?
                <a href="Signup.php">register here</a>
            </p>
        </div>
    </form>

    <script src="js/validateScript.js"></script>
</body>
</html>