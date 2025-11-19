document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault();

    let username = document.getElementById("userName").value.trim();
    let password = document.getElementById("password").value.trim();

    let usernamePattern = /^[a-zA-Z0-9_.]{2,50}$/;
    let passwordPattern = /.{8,}/;
    

    if (!usernamePattern.test(username)) {
        alert("Invalid username. It must be 2-50 characters long and can only contain letters, numbers, underscores, or dots.");
        return false;
    }
    if (!passwordPattern.test(password)) {
        alert("Invalid password. It must be at least 8 characters long.");
        return false;
    }

    let strongPasswordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    if (!strongPasswordPattern.test(password)) {
        alert("Weak password. Consider using a mix of uppercase and lowercase letters, numbers, and special characters for a stronger password.");
        return false;
    }

    // If validation passes, submit the form
    this.submit();
    return true;
});