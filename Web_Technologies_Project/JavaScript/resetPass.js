function togglePassword(inputId) {
    var input = document.getElementById(inputId);
    var icon = document.getElementById('eye-icon-' + inputId);
    
    if (input.type === "password") {
        input.type = "text";
        icon.className = "fas fa-eye-slash";
    } else {
        input.type = "password";
        icon.className = "fas fa-eye";
    }
}

function handleFormSubmit(event) {
    event.preventDefault();
    
    // Get values
    var pass = document.getElementById("password").value;
    var conf = document.getElementById("confirm").value;

    // Simple validation process
    if (pass !== conf) {
        alert("Passwords do not match!");
        return false;
    }

    if (pass.length < 8) {
        alert("Password must be at least 8 characters long.");
        return false;
    }

    // Check for uppercase and digit
    if (!/[A-Z]/.test(pass) || !/\d/.test(pass)) {
        alert("Password must contain at least one uppercase letter and one digit.");
        return false;
    }

    // Show loading state
    document.getElementById("formContent").style.display = "none";
    document.getElementById("loadingMessage").style.display = "flex";

    // Simulate server processing delay
    setTimeout(function() {
        document.getElementById("loadingMessage").style.display = "none";
        document.getElementById("formContent").style.display = "block";
        alert("Password updated successfully!");
        // Here you would typically redirect using window.location.href
        // Example: window.location.href = "login.php";
    }, 2000);

    return false;
}

// Add event listener for confirm password field to show validation
document.addEventListener('DOMContentLoaded', function() {
    var confirmInput = document.getElementById('confirm');
    var passwordInput = document.getElementById('password');
    
    confirmInput.addEventListener('input', function() {
        if (passwordInput.value !== confirmInput.value && confirmInput.value.length > 0) {
            confirmInput.style.borderColor = 'rgb(220, 38, 38)';
        } else {
            confirmInput.style.borderColor = 'rgb(51, 65, 85)';
        }
    });
    
    passwordInput.addEventListener('input', function() {
        if (passwordInput.value !== confirmInput.value && confirmInput.value.length > 0) {
            confirmInput.style.borderColor = 'rgb(220, 38, 38)';
        } else {
            confirmInput.style.borderColor = 'rgb(51, 65, 85)';
        }
    });
});