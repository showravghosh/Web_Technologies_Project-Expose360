<?php
session_start();

// If already logged in, go to correct dashboard
if (isset($_SESSION['role']) && $_SESSION['role'] === 'user') {
    header('Location: ../User/dashboard.php');
    exit();
}
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    header('Location: ../Admin/dashboard.php');
    exit();
}

$err = $_SESSION['auth_error'] ?? '';
unset($_SESSION['auth_error']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../../CSS/Auth/login.css">
</head>
<body>
    <div class="page">
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

            <form method="POST" action="../../../Controllers/AuthController.php">
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

                <?php if ($err != '') { ?>
                    <p style="color:#ff4d4d; margin: 10px 0;"><?php echo $err; ?></p>
                <?php } ?>

                <div class="actions">
                    <a href="forgot_password.php" class="forgot">Forgot Password?</a>
                    <a href="register.php" class="create">Create New</a>
                        
                </div>
                <div class="button-container">
                    <input type="hidden" name="action" value="user_login" id="login_action">
                    <button type="submit">Sign In to Account</button>
                </div>
            </form>

            <script>
                const roleSel = document.querySelector('select[name="role"]');
                const actionInp = document.getElementById('login_action');
                roleSel.addEventListener('change', function(){
                    if (this.value === 'admin') actionInp.value = 'admin_login';
                    else actionInp.value = 'user_login';
                });
            </script>

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