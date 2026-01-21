<?php
session_start();
$err = $_SESSION['auth_error'] ?? '';
unset($_SESSION['auth_error']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Expose360 | Registration</title>
    <link rel="stylesheet" href="../../CSS/Auth/register.css">
</head>

<body>

    <div class="back-btn-area">
        <a href="../../../index.php" class="back-btn">Back to Home</a>
    </div>



    <div class="card">

        <div class="header">
            <img src="../../../Resources/Photos/logo.png" class="logo" alt="Logo">
            <h1>Expose<span class="highlight">360</span> Registration</h1>
            <h2>Create Your Professional Account</h2>
            <p>Join our network and gain access to exclusive contributor tools.</p>
        </div>

        <?php if ($err != '') { ?>
            <p style="color:#ff4d4d; margin: 10px 0; text-align:center;"><?php echo $err; ?></p>
        <?php } ?>


        <form class="form" action="../../../Controllers/AuthController.php" method="POST" enctype="multipart/form-data">


            <div class="grid">


                <div class="input-box">
                    <img src="../../../Resources/Photos/useri.png" class="userr" alt="User">
                    <label>First Name</label>
                    <input type="text" name="first_name" placeholder="Enter your first name" required>
                </div>

                <div class="input-box">
                    <img src="../../../Resources/Photos/useri.png" class="userr" alt="User">
                    <label>Last Name</label>
                    <input type="text" name="last_name" placeholder="Enter your last name" required>
                </div>



                <div class="input-box">
                    <img src="../../../Resources/Photos/birthi.png" class="birthr" alt="Birthday">
                    <label>Birth Date</label>
                    <input type="date" name="birth_date" placeholder="YYYY-MM-DD" required>
                </div>



                <div class="input-box">
                    <img src="../../../Resources/Photos/addrei.png" class="addrei" alt="Address">
                    <label>Address</label>
                    <input type="text" name="address" placeholder="123 Main Street" required>
                </div>


                <div class="input-box">
                    <img src="../../../Resources/Photos/divi.png" class="divi" alt="Division">
                    <label>Division</label>
                    <input type="text" name="division" placeholder="Dhaka Division" required>
                </div>


                <div class="input-box">
                    <img src="../../../Resources/Photos/posti.png" class="posti" alt="Postal">
                    <label>Postal Code</label>
                    <input type="text" name="postal_code" placeholder="1000" required>
                </div>


                <div class="input-box">
                    <img src="../../../Resources/Photos/phni.png" class="phni" alt="Phone">
                    <label>Phone Number</label>
                    <input type="text" name="phone" placeholder="+88 01234567891" required>
                </div>


                <div class="input-box">
                    <img src="../../../Resources/Photos/emaili.png" class="emaili" alt="Email">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="user@gmail.com" required>
                </div>


                <div class="input-box">
                    <img src="../../../Resources/Photos/genderi.png" class="genderi" alt="Gender">
                    <label>Gender</label>
                    <select name="gender" required>
                        <option value="select" class="opt">Select your gender</option>
                        <option value="Male" class="opt">Male</option>
                        <option value="Female" class="opt">Female</option>
                        <option value="Other" class="opt">Other</option>
                    </select>
                </div>


                <div class="input-box">
                    <img src="../../../Resources/Photos/photoi.png" class="photoi" alt="Photos">
                    <label>Upload your photo</label>
                    <input type="file" name="photo" accept="image/*" class="file-input" required>
                </div>

                

                <div class="input-box">
                    <img src="../../../Resources/Photos/passir.png" class="passir" alt="Password">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>


                <div class="input-box">
                    <img src="../../../Resources/Photos/filei.png" class="filei" alt="File">
                    <label>Upload a File (NID/Passport/Birth Certificate)</label>
                    <input type="file" name="document" accept=".pdf,.jpg" class="file-input" required>
                </div>


                <div class="input-box">
                    <img src="../../../Resources/Photos/passire.png" class="rpassir" alt="Password">
                    <label>Re-enter Password</label>
                    <input type="password" name="confirm_password" placeholder="••••••••" required>
                </div>

            </div>

            

            <div class="btn-row">
                <input type="hidden" name="action" value="user_register">
                <button class="btn-submit" type="submit">Register Account</button>
                <button type="reset" class="btn-reset">Reset Form</button>
            </div>

        </form>


        <div class="footer">
            Already have an account?
            <a href="login.php">Sign In Here</a>
        </div>

    </div>

</body>
</html>
