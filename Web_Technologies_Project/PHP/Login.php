<?php



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Expose360</title>

    <link rel="stylesheet" href="../CSS/Login.css">
</head>
<body>

    <div class="page">

        <!-- Left Section -->
        <div class="login-box">

            <div class="header">
                <img src="../Photos/logo.png" class="logo" alt="Logo">
                <h1>Expose<span>360</span></h1>
            </div>

            <h2>Welcome Back</h2>
            <p>Please enter your details to access your dashboard.</p>

            <form>

                <img src="../Photos/useri.png" class="useri" alt="User">
                <label>Phone or Email</label>
                <input type="text" placeholder="user@gmail.com" required>

                <img src="../Photos/passi.png" class="passi" alt="Pass">
                <label>Password</label>
                <input type="password" placeholder="••••••••" required>

                <img src="../Photos/rolei.png" class="rolei" alt="Role">
                <label>Role</label>
                <select>
                    <option>Select a Role</option>
                    <option>User</option>
                    <option>Admin</option>
                </select>

                <div class="actions">
                    <a href="#" class="forgot">Forgot Password?</a>
                    <a href="registration.php" class="create">Create New</a>
                </div>

                <button type="submit">Sign In to Account</button>

            </form>

            <div class="footer">
                <a href="#"><img src="../Photos/coni.png" class="coni" alt="Con">Contributions</a>
                <a href="#"><img src="../Photos/helpi.png" class="helpi" alt="Help">Help & Support</a>
            </div>

        </div>

        <!-- Right Section -->
        <div class="image-box">
            <img src="../Photos/background.png" alt="Background">
            
        </div>

    </div>

</body>
</html>
