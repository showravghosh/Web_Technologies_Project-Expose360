<?php
session_start();
//email OTP verification for password reset
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $_SESSION['reset_email'] = $_POST['email'];
    // Create a 6-digit OTP (demo). In real use, send via email.
    $_SESSION['otp'] = strval(rand(100000, 999999));
    unset($_SESSION['otp_ok']);
}

// When verifying OTP
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['otp_code'])) {
    $otp = $_POST['otp_code'];
    if (isset($_SESSION['otp']) && $otp === $_SESSION['otp']) {
        $_SESSION['otp_ok'] = true;
        header('Location: reset_password.php');
        exit();
    } else {
        $_SESSION['auth_error'] = 'Invalid OTP. Please try again.';
    }
}

$err = $_SESSION['auth_error'] ?? '';
unset($_SESSION['auth_error']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expose360 - OTP Verification</title>
    <link rel="stylesheet" href="../../CSS/Auth/otp_verify.css">
</head>
<body>

    <div class="container">
        <!-- Logo Header -->
        <div class="logo-section">
            <h1>Expose<span>360</span></h1>
        </div>

        <h2 class="page-title">OTP Verification</h2>

        <!-- Main Card -->
        <div class="card">
            <button class="back-button" onclick="window.location.href='forgot_password.php'">
                Back
            </button>

            <div class="info-box">
                <p class="info-text-main">A 6-digit OTP has been sent to your email.</p>
                <p class="info-text-sub">Please check your inbox (and spam folder) to find the code.</p>
                <?php if (isset($_SESSION['otp'])) { ?>
                    <p class="info-text-sub">Demo OTP (for testing): <?php echo $_SESSION['otp']; ?></p>
                <?php } ?>
            </div>

            <?php if ($err != '') { ?>
                <p style="color:#ff4d4d; margin: 10px 0; text-align:center;"><?php echo $err; ?></p>
            <?php } ?>

            <form id="otpForm" method="POST" action="">
                <input type="hidden" name="otp_code" id="otp_code" value="">
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

    <script src="../../JavaScript/Auth/otp_verify.js" defer></script>
</body>
</html>