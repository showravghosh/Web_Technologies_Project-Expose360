<?php


?>


<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password - Expose360</title>
    <link rel="stylesheet" href="../CSS/forgetPass.css">
    <script src="../JavaScript/fogetPass.js" ></script>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="../Photos/logo.png" alt="Expose360 Logo" class="logo-image">
            <h1>Expose360</h1>
        </div>
        
        <h2>Forgot Password</h2>
        
        <div class="card">
            <button id="backButton" class="back-btn" >
                ← Back to Login
            </button>
            
            <div class="info-box">
                Enter your registered email address to receive a one-time password (OTP) for account verification.
            </div>
            
            <form id="forgotPasswordForm">
                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <div class="input-with-icon">
                        <input type="email" id="email" placeholder="user@example.com" required>
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