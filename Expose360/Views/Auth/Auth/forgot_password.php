<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password - Expose360</title>
    <link rel="stylesheet" href="../../CSS/Auth/forgot_password.css">
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="../../../Resources/Photos/logo.png" alt="Expose360 Logo" class="logo-image">
            <h1>Expose360</h1>
        </div>
        
        <h2>Forgot Password</h2>
        
        <div class="card">
            <button id="backButton" class="back-btn">
                <a href="login.php" class="back-btn">Back to Login</a>
            </button>
            
            <div class="info-box">
                Enter your registered email address to receive a one-time password (OTP) for account verification.
            </div>
            
            <!-- Add action and method to form -->
            <form id="forgotPasswordForm" action="otp_verify.php" method="POST">
                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <div class="input-with-icon">
                        <input type="email" id="email" name="email" placeholder="user@example.com" required>
                    </div>
                </div>
                
                <button type="submit" class="submit-btn">
                    Send OTP
                </button>
            </form>
        </div>
    </div>
</body>
</html>