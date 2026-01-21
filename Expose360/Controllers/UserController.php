<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user' || !isset($_SESSION['user_id'])) {
    header('Location: ../Views/Auth/Auth/login.php');
    exit();
}

if (!isset($_POST['action'])) {
    header('Location: ../Views/Auth/User/profile.php');
    exit();
}

$action = $_POST['action'];
$user_id = (int)$_SESSION['user_id'];

// DB connection
$conn = mysqli_connect('localhost', 'root', '', 'expose360_db');
if (!$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}
mysqli_set_charset($conn, 'utf8mb4');

// Upload profile photo and update user_account.photo
if ($action === 'upload_profile_photo') {

    if (!isset($_FILES['photo']) || $_FILES['photo']['error'] !== 0) {
        header('Location: ../Views/Auth/User/profile.php?msg=Photo upload failed');
        exit();
    }

    $name = $_FILES['photo']['name'];
    $tmp  = $_FILES['photo']['tmp_name'];

    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
    if ($ext !== 'jpg' && $ext !== 'jpeg' && $ext !== 'png') {
        header('Location: ../Views/Auth/User/profile.php?msg=Only JPG, JPEG, PNG allowed');
        exit();
    }

    // Create unique file name
    $newName = 'user_' . $user_id . '_' . time() . '.' . $ext;

    // Save into Resources/Photos
    $uploadPath = '../Resources/Photos/' . $newName;

    if (!move_uploaded_file($tmp, $uploadPath)) {
        header('Location: ../Views/Auth/User/profile.php?msg=Could not save photo');
        exit();
    }

    // Update SAME COLUMN
    $update_sql = "UPDATE user_account SET photo='$newName' WHERE id=$user_id";
    mysqli_query($conn, $update_sql);

    header('Location: ../Views/Auth/User/profile.php?msg=Profile photo updated');
    exit();
}

header('Location: ../Views/Auth/User/profile.php');
exit();
