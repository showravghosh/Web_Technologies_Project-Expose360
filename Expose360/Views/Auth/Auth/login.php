<?php
// PHP code to handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if role is selected
    if (isset($_POST['role'])) {
        $role = $_POST['role'];
        
        // If role is "user", redirect to dashboard.php
        if ($role == "user") {
            header("Location: ../User/dashboard.php");
            exit();
        }
         elseif ($role == "admin") {
             header("Location: ../Admin/dashboard.php");
             exit();
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../../CSS/Auth/login.css">
</head>
<body>
    <div class="page">
        <!-- Updated back button to point to home/index.php -->
        

        <!-- Left Section -->
        <div class="login-box">

            <div class="back-btn-area">
                <a href="../../../index.php" class="back-btn">Back</a>
            </div>
            <div class="header">
                <h1>Expose<span>360</span></h1>
            </div>
            
            <h2>Welcome Back</h2>
            <p>Please enter your details to access your dashboard.</p>

            <form method="POST" action="">
                <div class="input-group">
                    <img src="../../../Resources/Photos/useri.png" class="input-icon" alt="User">
                    <label>Phone or Email</label>
                    <input type="text" name="email" placeholder="user@gmail.com" required>
                </div>

                <div class="input-group">
                    <img src="../../../Resources/Photos/passi.png" class="input-icon" alt="Pass">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>

                <div class="input-group">
                    <img src="../../../Resources/Photos/rolei.png" class="input-icon" alt="Role">
                    <label>Role</label>
                    <select name="role" required>
                        <option value="">Select a Role</option>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div class="actions">
                    <a href="forgot_password.php" class="forgot">Forgot Password?</a>
                    <a href="register.php" class="create">Create New</a>
                        
                </div>
                <div class="spacer">
                    <a href="reset_password.php" class="reset-link">Reset Password</a>
                </div>
                

                <!-- Button container for better positioning -->
                <div class="button-container">
                    <button type="submit">Sign In to Account</button>
                </div>
            </form>

            <div class="footer">
                <a href="../../contribution.php"><img src="../../../Resources/Photos/coni.png" class="footer-icon" alt="Con">Contributions</a>
            </div>
        </div>

        <!-- Right Section -->
        <div class="image-box">
            <img src="../../../Resources/Photos/background.png" alt="Background">
        </div>
    </div>
</body>
</html>