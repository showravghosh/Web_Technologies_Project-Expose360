<?php
session_start();
// Only admin can access
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../../Auth/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Registration | Expose360</title>
    <link rel="stylesheet" href="../../../CSS/Admin/Users/reg_admin.css">
</head>
<body>


<header class="top-bar">
    <div class="logo">
        <img src="../../../../Resources/Photos/logo.png" class="logo-img">
        <span>Expose<span class="highlight">360</span></span>
    </div>

    <div class="page-title">Admin Registration</div>

    <div class="nav-buttons">
        <button class="btn back" onclick="history.back()">
            <img src="../../../../Resources/Photos/back.png" class="btn-icon"> Back
        </button>
        <button class="btn home" onclick="location.href='../dashboard.php'">
            <img src="../../../../Resources/Photos/home.png" class="btn-icon"></a>Home
        </button>
    </div>
</header>


<div class="container">

    <div class="card">

        <h3 class="card-title">
            <img src="../../../../Resources/Photos/admin.png" class="title-icon">
            New Administrator Setup
        </h3>

        <form action="../../../../Controllers/AdminController.php" method="POST">
            <input type="hidden" name="action" value="add_admin">

            <label>Full Name</label>
            <div class="input-box">
                <img src="../../../../Resources/Photos/useri.png" class="input-icon">
                <input type="text" name="full_name" placeholder="Full Name" required>
            </div>

            <label>Email Address</label>
            <div class="input-box">
                <img src="../../../../Resources/Photos/emaili.png" class="input-icon">
                <input type="email" name="email" placeholder="Email Address" required>
            </div>

            <label>Phone Number</label>
            <div class="input-box">
                <img src="../../../../Resources/Photos/phni.png" class="input-icon">
                <input type="tel" name="phone" placeholder="Phone Number" required>
            </div>

            <label>Temporary Password</label>
            <div class="input-box">
                <img src="../../../../Resources/Photos/passir.png" class="input-icon">
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <label>Gender</label>
            <div class="radio-group">
                <label>
                    <input type="radio" name="gender" value="Male"> Male
                </label>
                <label>
                    <input type="radio" name="gender" value="Female"> Female
                </label>
                <label>
                     <input type="radio" name="gender" value="Other"> Other
                </label>
            </div>


            <div class="form-buttons">
                <button class="btn add" type="submit">
                    <img src="../../../../Resources/Photos/add.png" class="btn-icon"> Add Admin
                </button>
                <button class="btn reset" type="reset">
                    <img src="../../../../Resources/Photos/reset.png" class="btn-icon"> Reset
                </button>
            </div>

        </form>

    </div>

</div>

</body>
</html>
