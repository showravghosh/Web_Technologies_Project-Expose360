<?php
session_start();
// You can add PHP logic here to verify email, user session, etc.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expose360 - OTP Verification</title>
    <link rel="stylesheet" href="../CSS/otpVerification.css">
</head>
<body>

    <div class="container">
        <!-- Logo Header -->
        <div class="logo-section">
            <!-- Simple SVG Icon -->
            <svg class="logo-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 10V6a1 1 0 011-1h0a1 1 0 011 1v4"></path>
            </svg>
            <h2 class="app-title">Expose360</h2>
        </div>

        <h2 class="page-title">OTP Verification</h2>

        <!-- Main Card -->
        <div class="card">
            <button class="back-button" onclick="goBack()">
                &#8592; Back
            </button>

            <div class="info-box">
                <p class="info-text-main">A 6-digit OTP has been sent to your email.</p>
                <p class="info-text-sub">Please check your inbox (and spam folder) to find the code.</p>
            </div>

            <form id="otpForm" onsubmit="verifyOTP(event)">
                <div class="otp-container">
                    <!-- 6 Input fields -->
                    <input type="text" class="otp-input" maxlength="1" id="otp-1" oninput="moveToNext(this, 'otp-2')" onkeydown="handleBackspace(event, this, null)">
                    <input type="text" class="otp-input" maxlength="1" id="otp-2" oninput="moveToNext(this, 'otp-3')" onkeydown="handleBackspace(event, this, 'otp-1')">
                    <input type="text" class="otp-input" maxlength="1" id="otp-3" oninput="moveToNext(this, 'otp-4')" onkeydown="handleBackspace(event, this, 'otp-2')">
                    <input type="text" class="otp-input" maxlength="1" id="otp-4" oninput="moveToNext(this, 'otp-5')" onkeydown="handleBackspace(event, this, 'otp-3')">
                    <input type="text" class="otp-input" maxlength="1" id="otp-5" oninput="moveToNext(this, 'otp-6')" onkeydown="handleBackspace(event, this, 'otp-4')">
                    <input type="text" class="otp-input" maxlength="1" id="otp-6" oninput="moveToNext(this, null)" onkeydown="handleBackspace(event, this, 'otp-5')">
                </div>

                <button type="submit" class="verify-btn">
                    Verify OTP
                    <span>&#10003;</span> 
                </button>

                <div class="resend-container">
                    <button type="button" class="resend-btn" onclick="resendOTP()">
                        &#8635; Resend OTP
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="../JavaScript/otpVerification.js"></script>
</body>
</html>