document.getElementById("loginForm").addEventListener("submit", function(event) {
    let username = document.getElementById("userName").value.trim();
    let password = document.getElementById("password").value.trim();

    let usernamePattern = /^[a-zA-Z0-9_.]{2,50}$/;
    
    if (!usernamePattern.test(username)) {
        alert("Invalid username. It must be 2-50 characters long and can only contain letters, numbers, underscores, or dots.");
        event.preventDefault();
        return false;
    }
    
    if (password.length < 8) {
        alert("Invalid password. It must be at least 8 characters long.");
        event.preventDefault();
        return false;
    }

    // If validation passes, form submits naturally to your PHP file
    return true;
});