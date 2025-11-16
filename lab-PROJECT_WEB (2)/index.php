<!DOCTYPE html>
<html lang ="en">
    <head>
        <meta charset ="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login page</title>
        <link rel ="stylesheet" href="Style.css">
    </head>

    <body>
        <form  id= "loginForm" action="login.php" method= "post">
            <h1>Login Form</h1>
            <div class ="input_datacontainer">
                <label for ="userName">Username:</label>
                <input type ="text" id ="userName" name="Username" 
                placeholder ="User Name:" 
                required
                minlength="2"
                maxlength="50"
                title="usename must contain only letters, numbers or underscores">

                <label for ="password">password:</label>
                <input type ="password" id ="password" name="password"
                 placeholder="password" required
                 minlength="8"
                 title="Password must be at least 8 characters long">

                <button type ="Submit" class="btn">Login</button><br>

                <a href="Signup.html">Go to Signup Page</a><br>
                <a href="FI_Dashboard.html">Faculty Intern Dashboard</a><br>
                <a href= "Student_Dashboard.html">Student Dashboard</a><br>
                <a href="Faculty_Dashboard.html">Faculty Dashboard</a><br>

                <p class ="msg"> 
                    Don't have an account?
                    <a href ="Signup.html">register here</a>
                </p>
            </div>
        </form>

        <script src="validateScript.js"></script>
    </body>
</html>