function logout() {
    fetch('logout.php')
        .then(response => response.json())
        .then(data => {
            if (data.logout) {
                alert('You have been logged out successfully!');
                window.location.href = 'index.php';
            }
        })
        .catch(error => {
            console.error('Error during logout:', error);
        });
}

// Attach to all logout buttons
document.addEventListener('DOMContentLoaded', function() {
    const logoutButtons = document.querySelectorAll('a[href="logout.php"]');
    logoutButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            logout();
        });
    });
});