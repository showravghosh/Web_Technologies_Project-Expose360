<?php

session_start();
header('Content-Type: application/json; charset=utf-8');

require_once '../Models/Post.php';
require_once '../Models/User.php';
require_once '../Models/Admin.php';

function json_out($arr) {
    echo json_encode($arr);
    exit();
}


$action = $_POST['action'] ?? '';

// USER: create post (AJAX)
if ($action === 'create_post') {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
        json_out(['ok' => false, 'message' => 'Unauthorized']);
    }

    $content = $_POST['content'] ?? '';
    $photoName = '';

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
        $original = basename($_FILES['photo']['name']);
        $ext = pathinfo($original, PATHINFO_EXTENSION);
        $safeExt = preg_replace('/[^a-zA-Z0-9]/', '', $ext);

        $photoName = 'post_' . time() . '_' . rand(1000, 9999) . ($safeExt ? ('.' . $safeExt) : '');
        if (!is_dir('../Upload')) { @mkdir('../Upload'); }
        if (!is_dir('../Upload/Photos')) { @mkdir('../Upload/Photos', 0777, true); }
        if (!is_dir('../Upload/Text')) { @mkdir('../Upload/Text', 0777, true); }
        @move_uploaded_file($_FILES['photo']['tmp_name'], '../Upload/Photos/' . $photoName);
    }

    $userId = $_SESSION['user_id'] ?? 0;
    $postModel = new Post();
    $postId = $postModel->createPost($userId, $content, $photoName);

    if ($postId) {
        $txtFile = '../Upload/Text/post_' . $postId . '.txt';
        @file_put_contents($txtFile, $content);
        json_out(['ok' => true, 'message' => 'Posted', 'post_id' => $postId]);
    }

    json_out(['ok' => false, 'message' => 'Failed']);
}

//only admin can use these actions
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    json_out(['ok' => false, 'message' => 'Unauthorized']);
}

//Approve / Reject pending posts
if ($action === 'post_update_status') {
    $postId = (int)($_POST['post_id'] ?? 0);
    $status = $_POST['status'] ?? 'Pending';

    $postModel = new Post();
    $ok = $postModel->updateStatus($postId, $status);

    if ($ok) {
        json_out(['ok' => true, 'message' => 'Updated']);
    }
    json_out(['ok' => false, 'message' => 'Failed']);
}

//Toggle post visibility
if ($action === 'post_toggle_visibility') {
    $postId = (int)($_POST['post_id'] ?? 0);
    $visible = $_POST['is_visible'] ?? 'Yes';

    $postModel = new Post();
    $ok = $postModel->setVisibility($postId, $visible);

    if ($ok) {
        json_out(['ok' => true, 'message' => 'Updated']);
    }
    json_out(['ok' => false, 'message' => 'Failed']);
}


//Toggle user account status
if ($action === 'user_update_status') {
    $id = (int)($_POST['id'] ?? 0);
    $status = $_POST['status'] ?? '';

    $userModel = new User();
    $ok = $userModel->updateStatus($id, $status);

    if ($ok) {
        json_out(['ok' => true, 'message' => 'Updated']);
    }
    json_out(['ok' => false, 'message' => 'Failed']);
}

//Toggle admin account status
if ($action === 'admin_update_status') {
    $id = (int)($_POST['id'] ?? 0);
    $status = $_POST['status'] ?? '';

    $adminModel = new Admin();
    $ok = $adminModel->updateStatus($id, $status);

    if ($ok) {
        json_out(['ok' => true, 'message' => 'Updated']);
    }
    json_out(['ok' => false, 'message' => 'Failed']);
}

//Delete a user
if ($action === 'user_delete') {
    $id = (int)($_POST['id'] ?? 0);
    $userModel = new User();
    $ok = $userModel->deleteUser($id);
    if ($ok) {
        json_out(['ok' => true, 'message' => 'Deleted']);
    }
    json_out(['ok' => false, 'message' => 'Failed']);
}

//Delete all users
if ($action === 'user_delete_all') {
    $userModel = new User();
    $ok = $userModel->deleteAllUsers();
    if ($ok) {
        json_out(['ok' => true, 'message' => 'Deleted']);
    }
    json_out(['ok' => false, 'message' => 'Failed']);
}

// Delete an admin 
if ($action === 'admin_delete') {
    $id = (int)($_POST['admin_id'] ?? 0);
    $adminModel = new Admin();
    $ok = $adminModel->deleteAdmin($id);
    if ($ok) {
        json_out(['ok' => true, 'message' => 'Deleted']);
    }
    json_out(['ok' => false, 'message' => 'Failed']);
}

// Delete an employee 
if ($action === 'employee_delete') {
    $id = (int)($_POST['emp_id'] ?? 0);
    $adminModel = new Admin();
    $ok = $adminModel->deleteEmployee($id);
    if ($ok) {
        json_out(['ok' => true, 'message' => 'Deleted']);
    }
    json_out(['ok' => false, 'message' => 'Failed']);
}

// Add/Update employee 
if ($action === 'employee_save') {
    $empId = (int)($_POST['emp_id'] ?? 0);
    $data = [
        'full_name' => $_POST['full_name'] ?? '',
        'date_joined' => $_POST['date_joined'] ?? '',
        'salary' => $_POST['salary'] ?? '',
        'gender' => $_POST['gender'] ?? 'Other',
        'phone' => $_POST['phone'] ?? ''
    ];

    $adminModel = new Admin();
    if ($empId > 0) {
        $ok = $adminModel->updateEmployee($empId, $data);
    } else {
        $ok = $adminModel->addEmployee($data);
    }

    if ($ok) {
        json_out(['ok' => true, 'message' => 'Saved']);
    }
    json_out(['ok' => false, 'message' => 'Failed']);
}

// Search User
if ($action === 'user_search') {

    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        json_out([]);
    }

    $q = trim($_POST['q'] ?? '');

    $userModel = new User();
    $users = $userModel->getAllUsers();

    $result = [];

    foreach ($users as $u) {
        if (
            stripos($u['full_name'], $q) !== false ||
            stripos($u['phone'], $q) !== false
        ) {
            $result[] = $u;
        }
    }

    json_out($result);
}

// Search Deleted user
if ($action === 'deleted_user_search') {

    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        json_out([]);
    }

    $q = trim($_POST['q'] ?? '');

    require_once '../Models/Database.php';
    $conn = Database::getInstance()->getConnection();

    $qSafe = mysqli_real_escape_string($conn, $q);

    $sql = "SELECT id, full_name, birth_date, address, division, postal_code,
                   phone, email, gender, photo, document, status
            FROM deleted_user
            WHERE full_name LIKE '%$qSafe%'
               OR phone LIKE '%$qSafe%'
               OR email LIKE '%$qSafe%'
            ORDER BY deleted_at DESC";

    $res = mysqli_query($conn, $sql);

    $out = [];
    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            $out[] = $row;
        }
    }

    json_out($out);
}

// Search deleted employees
if ($action === 'deleted_employee_search') {

    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        json_out([]);
    }

    $q = trim($_POST['q'] ?? '');

    require_once '../Models/Database.php';
    $conn = Database::getInstance()->getConnection();

    $qSafe = mysqli_real_escape_string($conn, $q);

    $sql = "SELECT emp_id, full_name, date_joined, salary, gender
            FROM deleted_emp
            WHERE full_name LIKE '%$qSafe%'
               OR emp_id LIKE '%$qSafe%'
            ORDER BY deleted_at DESC";

    $res = mysqli_query($conn, $sql);

    $out = [];
    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            $out[] = $row;
        }
    }

    json_out($out);
}

json_out(['ok' => false, 'message' => 'Invalid action']);

