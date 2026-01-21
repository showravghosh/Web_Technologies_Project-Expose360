<?php
session_start();

require_once '../Models/Post.php';

$postModel = new Post();

// USER: create post
if (isset($_POST['action']) && $_POST['action'] === 'create_post') {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
        header('Location: ../Views/Auth/Auth/login.php');
        exit();
    }

    $content = $_POST['content'] ?? '';
    $photoName = '';

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
        $original = basename($_FILES['photo']['name']);
        $ext = pathinfo($original, PATHINFO_EXTENSION);
        $safeExt = preg_replace('/[^a-zA-Z0-9]/', '', $ext);

        $photoName = 'post_' . time() . '_' . rand(1000, 9999) . ($safeExt ? ('.' . $safeExt) : '');
        @move_uploaded_file($_FILES['photo']['tmp_name'], '../Upload/Photos/' . $photoName);
    }

    $userId = $_SESSION['user_id'] ?? 0;

    // Makes sure Upload folders exist
    if (!is_dir('../Upload')) { @mkdir('../Upload'); }
    if (!is_dir('../Upload/Photos')) { @mkdir('../Upload/Photos', 0777, true); }
    if (!is_dir('../Upload/Text')) { @mkdir('../Upload/Text', 0777, true); }

    // createPost now returns post_id (insert id)
    $postId = $postModel->createPost($userId, $content, $photoName);

    // Save post text in txt file
    if ($postId) {
        $txtFile = '../Upload/Text/post_' . $postId . '.txt';
        @file_put_contents($txtFile, $content);
    }

    if ($postId) {
        header('Location: ../Views/Auth/User/dashboard.php?posted=1');
        exit();
    } else {
        header('Location: ../Views/Auth/User/dashboard.php?posted=0');
        exit();
    }
}

//  ADMIN: delete post (status = Deleted)
if (isset($_POST['action']) && $_POST['action'] === 'delete_post') {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        header('Location: ../Views/Auth/Auth/login.php');
        exit();
    }

    $postId = $_POST['post_id'] ?? 0;
    $postModel->updateStatus($postId, 'Deleted');

    header('Location: ../Views/Auth/Admin/posts/moderation.php');
    exit();
}

// ADMIN: toggle visibility
if (isset($_POST['action']) && $_POST['action'] === 'toggle_visibility') {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        header('Location: ../Views/Auth/Auth/login.php');
        exit();
    }

    $postId = $_POST['post_id'] ?? 0;
    $visible = $_POST['is_visible'] ?? 'Yes';

    $postModel->setVisibility($postId, $visible);
    header('Location: ../Views/Auth/Admin/posts/moderation.php');
    exit();
}

// If nothing matched
header('Location: ../index.php');
exit();
