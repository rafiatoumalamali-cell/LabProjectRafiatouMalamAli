<?php
session_start();
require_once 'config/database.php';

$response = ['success' => false, 'message' => ''];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $email = trim($_POST['email']);
    $username = trim($_POST['userName']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmpassword'];
    $role = $_POST['role'];

    // Basic validation
    if (empty($firstName) || empty($lastName) || empty($email) || empty($username) || empty($password)) {
        $response['message'] = 'All fields are required.';
    } elseif ($password !== $confirmPassword) {
        $response['message'] = 'Passwords do not match.';
    } else {
        // Database operations
        $database = new Database();
        $db = $database->getConnection();

        // Check if username or email already exists
        $checkQuery = "SELECT user_id FROM users WHERE username = :username OR email = :email";
        $stmt = $db->prepare($checkQuery);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $response['message'] = 'Username or email already exists.';
        } else {
            // Insert new user
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $insertQuery = "INSERT INTO users (first_name, last_name, email, username, password_hash, role) 
                           VALUES (:first_name, :last_name, :email, :username, :password_hash, :role)";
            
            $stmt = $db->prepare($insertQuery);
            $stmt->bindParam(':first_name', $firstName);
            $stmt->bindParam(':last_name', $lastName);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password_hash', $hashedPassword);
            $stmt->bindParam(':role', $role);

            if ($stmt->execute()) {
                $user_id = $db->lastInsertId();
                
                // Insert into role-specific table
                if ($role === 'student') {
                    $studentQuery = "INSERT INTO students (student_id, department) VALUES (:student_id, 'General')";
                    $stmt = $db->prepare($studentQuery);
                    $stmt->bindParam(':student_id', $user_id);
                    $stmt->execute();
                } elseif ($role === 'faculty' || $role === 'faculty_intern') {
                    $facultyQuery = "INSERT INTO faculty (faculty_id, department, position) VALUES (:faculty_id, 'Computer Science', :position)";
                    $stmt = $db->prepare($facultyQuery);
                    $position = ($role === 'faculty') ? 'Professor' : 'Intern';
                    $stmt->bindParam(':faculty_id', $user_id);
                    $stmt->bindParam(':position', $position);
                    $stmt->execute();
                }
                
                $response['success'] = true;
                $response['message'] = 'Registration submitted for approval! You will be notified once approved.';
                $response['user_id'] = $user_id;
            } else {
                $response['message'] = 'Registration failed. Please try again.';
            }
        }
    }
    
    // If it's an AJAX request, return JSON
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="CSS/Style.css">
</head>
<body>
    <form id="signupForm" method="POST" action="Signup.php">
        <div class="input_datacontainer">
            <h1>Sign Up</h1>

            <?php if (!empty($response['message']) && !$response['success']): ?>
                <div class="error-message" style="color: red; padding: 10px; background: #ffe6e6; border-radius: 5px;">
                    <?php echo $response['message']; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($response['message']) && $response['success']): ?>
                <div class="success-message" style="color: green; padding: 10px; background: #e6ffe6; border-radius: 5px;">
                    <?php echo $response['message']; ?>
                    <script>
                        setTimeout(function() {
                            window.location.href = 'index.php';
                        }, 2000);
                    </script>
                </div>
            <?php endif; ?>

            <label for="firstName">FirstName</label><br>
            <input type="text" id="firstName" name="firstName" placeholder="First Name" 
            required pattern="[A-Za-z\s]+$" title="only letters are allowed"><br>

            <label for="lastName">LastName</label><br>
            <input type="text" id="lastName" name="lastName"
             placeholder="Last Name" required pattern="[A-Za-z\s]+$" title="only letters are allowed"><br>

            <label for="email">Email</label><br>
            <input type="email" id="email" name="email" placeholder="Email" required><br>

            <label for="userName">UserName</label><br>
            <input type="text" id="userName" name="userName"
             placeholder="UserName" required
             minlength="5" maxlength="30"
             title="Username must be 5-30 characters long and include letters, numbers, and underscores"><br>

            <label for="password">Password</label><br>
            <input type="password" id="password" name="password"
            minlength="8" 
            title="Password must be at least 8 characters long"
            placeholder="password" required><br>

            <label for="confirmpassword">Confirm Password</label><br>
            <input type="password" id="confirmpassword" name="confirmpassword" placeholder="Confirm password" required><br>

            <label for="role">Role:</label>
            <select id="role" name="role" required>
            <option value="">Select your role</option>
            <option value="student">Student</option>
            <option value="faculty">Faculty</option>
            <option value="faculty_intern">Faculty Intern</option>
            </select><br><br>

            <button type="submit">Sign Up</button>

            <p class="message">
                Do you already have an account?
                <a href="index.php">Login in here</a>
            </p>
        </div>
    </form>

    <script src="js/validateSignup.js"></script>
</body>
</html>