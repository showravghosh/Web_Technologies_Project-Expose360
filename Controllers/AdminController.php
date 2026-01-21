<?php

session_start();

require_once '../Models/Admin.php';
require_once '../Models/User.php';

function go($path) {
    header("Location: $path");
    exit();
}

// admin protection
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    go('../Views/Auth/Auth/login.php');
}

$adminModel = new Admin();
$userModel = new User();

// Add admin
if (isset($_POST['action']) && $_POST['action'] === 'add_admin') {
    $data = [
        'full_name' => $_POST['full_name'] ?? '',
        'email' => $_POST['email'] ?? '',
        'phone' => $_POST['phone'] ?? '',
        'gender' => $_POST['gender'] ?? 'Other',
        'password' => md5($_POST['password'] ?? ''),
        'role' => $_POST['role'] ?? 'Admin'
    ];
    $adminModel->registerAdmin($data);
    go('../Views/Auth/Admin/Users/admin_list.php');
}

// Delete admin
if (isset($_POST['action']) && $_POST['action'] === 'delete_admin') {
    $adminModel->deleteAdmin($_POST['admin_id'] ?? 0);
    go('../Views/Auth/Admin/Users/admin_list.php');
}

// Delete user
if (isset($_POST['action']) && $_POST['action'] === 'delete_user') {
    $userModel->deleteUser($_POST['id'] ?? 0);
    go('../Views/Auth/Admin/Users/user_list.php');
}

// Delete all users
if (isset($_POST['action']) && $_POST['action'] === 'delete_all_users') {
    $userModel->deleteAllUsers();
    go('../Views/Auth/Admin/Users/user_list.php');
}

// Add employee
if (isset($_POST['action']) && $_POST['action'] === 'add_employee') {
    $data = [
        'full_name' => $_POST['full_name'] ?? '',
        'date_joined' => $_POST['date_joined'] ?? '',
        'salary' => $_POST['salary'] ?? '',
        'gender' => $_POST['gender'] ?? 'Other',
        'phone' => $_POST['phone'] ?? ''
    ];
    $adminModel->addEmployee($data);
    go('../Views/Auth/Admin/Users/employee_list.php');
}

// Delete employee
if (isset($_POST['action']) && $_POST['action'] === 'delete_employee') {
    $adminModel->deleteEmployee($_POST['emp_id'] ?? 0);
    go('../Views/Auth/Admin/Users/employee_list.php');
}

// Update verification req status
if (isset($_POST['action']) && $_POST['action'] === 'update_verification') {
    $adminModel->updateVerificationStatus($_POST['id'] ?? 0, $_POST['status'] ?? 'Pending');
    go('../Views/Auth/Admin/Users/verification_request.php');
}

go('../Views/Auth/Admin/dashboard.php');

?>
