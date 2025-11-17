<?php
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['Username']);
    $password = trim($_POST['password']);
    
    // Add your authentication logic here
    // For example: check against database
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="Style.css">
</head>
<body>
    <form id="loginForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateLogin()">
        <h1>Login Form</h1>
        <div class="input_datacontainer">
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

            <button type="Submit" class="btn">Login</button><br>

            <a href="Signup.php">Go to Signup Page</a><br>
            <a href="FI_Dashboard.php">Faculty Intern Dashboard</a><br>
            <a href="Student_Dashboard.php">Student Dashboard</a><br>
            <a href="Faculty_Dashboard.php">Faculty Dashboard</a><br>

            <p class="msg"> 
                Don't have an account?
                <a href="Signup.php">register here</a>
            </p>
        </div>
    </form>

    <script src="validateScript.js"></script>
</body>
</html>