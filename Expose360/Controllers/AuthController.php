<?php

session_start();

require_once '../Models/User.php';
require_once '../Models/Admin.php';

// Header Function
function go($path) {
    header("Location: $path");
    exit();
}

//USER LOGIN
if (isset($_POST['action']) && $_POST['action'] === 'user_login') {
    $emailOrPhone = $_POST['email'] ?? '';
    $password = md5($_POST['password'] ?? '');

    $user = new User();
    // Account Active/Inactive (but not Deleted)
    $any = $user->loginAnyStatus($emailOrPhone, $password);

    if ($any && ($any['status'] ?? '') === 'Inactive') {
        $_SESSION['auth_error'] = 'Login failed: account is inactive';
        go('../Views/Auth/Auth/login.php');
    }

    $row = $user->login($emailOrPhone, $password);

    if ($row) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['full_name'];
        $_SESSION['role'] = 'user';
        go('../Views/Auth/User/dashboard.php');
    }

    $_SESSION['auth_error'] = 'Invalid user credentials';
    go('../Views/Auth/Auth/login.php');
}

// ADMIN LOGIN 
if (isset($_POST['action']) && $_POST['action'] === 'admin_login') {
    $email = $_POST['email'] ?? '';
    $password = md5($_POST['password'] ?? '');

    $admin = new Admin();
    $any = $admin->loginAnyStatus($email, $password);

    if ($any && ($any['status'] ?? '') === 'Inactive') {
        $_SESSION['auth_error'] = 'Login failed: account is inactive';
        go('../Views/Auth/Auth/login.php');
    }

    $row = $admin->login($email, $password);

    if ($row) {
        $_SESSION['admin_id'] = $row['admin_id'];
        $_SESSION['admin_name'] = $row['full_name'];
        $_SESSION['role'] = 'admin';
        go('../Views/Auth/Admin/dashboard.php');
    }

    $_SESSION['auth_error'] = 'Invalid admin credentials';
    go('../Views/Auth/Auth/login.php');
}

//  USER REGISTER 
if (isset($_POST['action']) && $_POST['action'] === 'user_register') {
    $user = new User();

    // Basic password confirm check
    if (($_POST['password'] ?? '') !== ($_POST['confirm_password'] ?? '')) {
        $_SESSION['auth_error'] = 'Password and Re-enter Password do not match';
        go('../Views/Auth/Auth/register.php');
    }

    $email = $_POST['email'] ?? '';
    if ($user->checkEmail($email)) {
        $_SESSION['auth_error'] = 'This email is already registered';
        go('../Views/Auth/Auth/register.php');
    }

    // Uploads: Photo and Document
    $photoName = '';
    if (isset($_FILES['photo']) && $_FILES['photo']['name'] != '') {
        $photoName = time() . '_' . basename($_FILES['photo']['name']);
        @move_uploaded_file($_FILES['photo']['tmp_name'], '../Resources/Photos/' . $photoName);
    }

    $docName = '';
    if (isset($_FILES['document']) && $_FILES['document']['name'] != '') {
        $docName = time() . '_' . basename($_FILES['document']['name']);
        @move_uploaded_file($_FILES['document']['tmp_name'], '../Resources/Photos/' . $docName);
    }

    $data = [
        'full_name' => trim(($_POST['first_name'] ?? '') . ' ' . ($_POST['last_name'] ?? '')),
        'birth_date' => $_POST['birth_date'] ?? '',
        'address' => $_POST['address'] ?? '',
        'division' => $_POST['division'] ?? '',
        'postal_code' => $_POST['postal_code'] ?? '',
        'phone' => $_POST['phone'] ?? '',
        'email' => $_POST['email'] ?? '',
        'password' => md5($_POST['password'] ?? ''),
        'gender' => $_POST['gender'] ?? 'Other',
        'photo' => $photoName,
        'document' => $docName,
    ];

    $ok = $user->register($data);
    if ($ok) {
        go('../Views/Auth/Auth/login.php');
    }

    $_SESSION['auth_error'] = 'Registration failed (please check required fields)';
    go('../Views/Auth/Auth/register.php');
}

//  LOGOUT
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    go('../Views/Auth/Auth/login.php');
}

//  PASSWORD RESET (after OTP verification)
if (isset($_POST['action']) && $_POST['action'] === 'reset_password') {
    $email = $_SESSION['reset_email'] ?? '';
    $newPass = $_POST['password'] ?? '';
    $newPass = md5($_POST['password'] ?? '');

    if ($email == '') {
        $_SESSION['auth_error'] = 'Reset session expired. Please try again.';
        go('../Views/Auth/Auth/forgot_password.php');
    }

    if ($newPass == '' || $newPass !== $confirm) {
        $_SESSION['auth_error'] = 'Passwords do not match';
        go('../Views/Auth/Auth/reset_password.php');
    }

    $user = new User();
    if ($user->updatePasswordByEmail($email, $newPass)) {
        unset($_SESSION['reset_email']);
        unset($_SESSION['otp']);
        unset($_SESSION['otp_ok']);
        go('../Views/Auth/Auth/login.php');
    }

    $_SESSION['auth_error'] = 'Failed to update password';
    go('../Views/Auth/Auth/reset_password.php');
}

// If someone opens controller directly
go('../index.php');

?>
