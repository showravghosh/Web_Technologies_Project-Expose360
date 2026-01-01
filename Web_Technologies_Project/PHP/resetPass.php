<?php

?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/resetPass.css">
</head>
<body>

    <div class="container">
        
        <!-- Left Panel -->
        <div class="left-panel">
            <div>
                <div class="brand-header">
                    <div class="icon-box">
                        <i class="fas fa-bolt fa-lg"></i>
                    </div>
                    <span class="brand-title">EXPOSE360</span>
                </div>
                
                <div class="hero-text">
                    <h2>Manage your enterprise <br> <span>with precision.</span></h2>
                    <p>The all-in-one ecosystem for employee management, administrative control, and real-time business intelligence.</p>
                </div>
            </div>

            <div class="feature-list">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <span>Enterprise Grade Security</span>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-globe"></i>
                    </div>
                    <span>Global Access Control</span>
                </div>
            </div>
        </div>

        <!-- Right Panel -->
        <div class="right-panel">
            
            <div class="top-nav">
                <button class="nav-btn" onclick="window.history.back()">
                    <i class="fas fa-chevron-left"></i> Back
                </button>
            </div>

            <div class="form-header">
                <h3>Reset Password</h3>
                <p>Securely update your account access</p>
            </div>

            <div id="loadingMessage" style="display:none; text-align:center; height: 200px; justify-content: center; align-items: center; flex-direction: column;">
                <div class="loader"></div>
                <p style="color: rgb(148, 163, 184); margin-top: 15px;">Establishing secure connection...</p>
            </div>

            <div id="formContent">
                <div class="alert-box">
                    <div class="alert-icon">
                        <i class="fas fa-check-shield"></i>
                    </div>
                    <div class="alert-content">
                        <strong>Identity Verified</strong>
                        <p>You can now create your new password.</p>
                    </div>
                </div>

                <form id="resetForm" onsubmit="return handleFormSubmit(event)">
                    <div class="input-group">
                        <label class="input-label">New Password</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" id="password" class="form-control" placeholder="New secure password" required>
                            <button type="button" class="toggle-password" onclick="togglePassword('password')">
                                <i class="fas fa-eye" id="eye-icon-password"></i>
                            </button>
                        </div>
                    </div>

                    <div class="input-group">
                        <label class="input-label">Confirm Password</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" id="confirm" class="form-control" placeholder="Repeat password" required>
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
                        <li class="req-item"><div class="dot"></div> Must not match previous 3 passwords</li>
                    </ul>
                </div>

                <div class="footer">
                    <span>©Expose360</span>
                </div>
            </div>
        </div>
    </div>

    <script src="../JavaScript/resetPass.js"></script>
</body>
</html>