<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/Auth/reset_password.css">
</head>
<body>

    <div class="container">
        
        <!-- Left Panel -->
        <div class="left-panel">
            <div>
                <div class="brand-header">
                    <a href="../../../index.php" class="logo-link">
                        <div class="icon-box">
                            <img src="../../../Resources/Photos/logo.png" alt="Expose360 Logo" class="logo-image">
                        </div>
                    </a>
                    <div class="logo-text">
                        <h1>Expose<span>360</span></h1>
                    </div>
                </div>
                
                <div class="hero-text">
                    <h2>Manage your enterprise <br> <span>with precision.</span></h2>
                    <p>The all-in-one ecosystem for employee management, administrative control, and real-time business intelligence.</p>
                </div>
                
                <div class="feature-list">
                    <div class="feature-item">
                            <div class="feature-icon">
                                <img src="../../../Resources/Photos/lock.png" alt="Logo" class="logo-image">
                            </div>
                        <div>
                            <strong>Enterprise Security</strong>
                            <p>Encryption Data</p>
                        </div>
                    </div>
                    <div class="feature-item">
                            <div class="feature-icon"> 
                                <img src="../../../Resources/Photos/real-time.png" alt="Logo" class="logo-image">
                            </div>
                        <div>
                            <strong>Real-time Analytics</strong>
                            <p>Data-driven insights</p>
                        </div>
                    </div>
                    <div class="feature-item">
                            <div class="feature-icon">
                                <img src="../../../Resources/Photos/planning.png" alt="Logo" class="logo-image">
                            </div>
                        <div>
                            <strong>Team Management</strong>
                            <p>Unified control panel</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Panel -->
        <div class="right-panel">
            
            <div class="top-nav">
                <a href="login.php" class="nav-btn">
                    <i class="fas fa-chevron-left"></i> Back to Login
                </a>
            </div>

            <div class="form-header">
                <h3>Reset Password</h3>
                <p>Securely update your account access</p>
            </div>

            <div id="formContent">
                <div class="alert-box">
                    <div class="alert-content">
                        <strong>Identity Verified</strong>
                        <p>You can now create your new password.</p>
                    </div>
                </div>

                <form id="resetForm" action="login.php" method="POST">
                    <div class="input-group">
                        <label class="input-label">New Password</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" id="password" name="password" class="form-control" placeholder="New secure password" required>
                            <button type="button" class="toggle-password" onclick="togglePassword('password')">
                                <i class="fas fa-eye" id="eye-icon-password"></i>
                            </button>
                        </div>
                    </div>

                    <div class="input-group">
                        <label class="input-label">Confirm Password</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" id="confirm" name="confirm_password" class="form-control" placeholder="Repeat password" required>
                            <button type="button" class="toggle-password" onclick="togglePassword('confirm')">
                                <i class="fas fa-eye" id="eye-icon-confirm"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">
                        <i class="fas fa-sync-alt"></i> Update Password
                    </button>
                </form>

                <div class="requirements">
                    <p class="req-title">Security Requirements:</p>
                    <ul class="req-list">
                        <li class="req-item"><div class="dot"></div> Minimum 8 characters in length</li>
                        <li class="req-item"><div class="dot"></div> At least one uppercase letter & one digit</li>
                    </ul>
                </div>

                <div class="footer">
                    <span>&copy; Expose360</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>