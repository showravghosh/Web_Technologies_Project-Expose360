<?php



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Registration | Expose360</title>
    <link rel="stylesheet" href="../CSS/AdminRegistration.css">
</head>
<body>


<header class="top-bar">
    <div class="logo">
        <img src="../Photos/logo.png" class="logo-img">
        <span>Expose<span class="highlight">360</span></span>
    </div>

    <div class="page-title">Admin Registration</div>

    <div class="nav-buttons">
        <button class="btn back">
            <img src="../Photos/back.png" class="btn-icon"> Back
        </button>
        <button class="btn home"><a href="Login.php" class="home-btn">
            <img src="../Photos/home.png" class="btn-icon"></a>Home
        </button>
    </div>
</header>


<div class="container">

    <div class="card">

        <h3 class="card-title">
            <img src="../Photos/admin.png" class="title-icon">
            New Administrator Setup
        </h3>

        <form>

            <label>Full Name</label>
            <div class="input-box">
                <img src="../Photos/useri.png" class="input-icon">
                <input type="text" placeholder="Full Name">
            </div>

            <label>Email Address</label>
            <div class="input-box">
                <img src="../Photos/emaili.png" class="input-icon">
                <input type="email" placeholder="Email Address">
            </div>

            <label>Phone Number</label>
            <div class="input-box">
                <img src="../Photos/phni.png" class="input-icon">
                <input type="tel" placeholder="Phone Number">
            </div>

            <label>Temporary Password</label>
            <div class="input-box">
                <img src="../Photos/passir.png" class="input-icon">
                <input type="password" placeholder="Password">
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
                <button class="btn add">
                    <img src="../Photos/add.png" class="btn-icon"> Add Admin
                </button>
                <button class="btn reset">
                    <img src="../Photos/reset.png" class="btn-icon"> Reset
                </button>
            </div>

        </form>

    </div>

</div>

</body>
</html>
