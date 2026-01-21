<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../../Auth/login.php');
    exit();
}
require_once '../../../../Models/User.php';
$userModel = new User();
$users = $userModel->getAllUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Management | Expose360</title>
    <link rel="stylesheet" href="../../../CSS/Admin/Users/user_list.css">
</head>
<body>

<!-- HEADER -->
<header class="top-bar">
    <div class="logo">
        <img src="../../../../Resources/Photos/logo.png" class="logo-img">
        <span>Expose<span class="highlight">360</span></span>
    </div>

    <div class="page-title">User Account Management</div>

    <div class="nav-buttons">
        <button class="btn back" onclick="history.back()">
            <img src="../../../../Resources/Photos/back.png" class="btn-icon"> Back
        </button>
        <button class="btn home" onclick="location.href='../dashboard.php'">
            <img src="../../../../Resources/Photos/home.png" class="btn-icon"> Home
        </button>
    </div>
</header>

<!-- MAIN CONTAINER -->
<div class="container">

    <!-- SEARCH & ACTIONS -->
    <div class="search-actions">
        <div class="search-box">
            <img src="../../../../Resources/Photos/search.png" class="search-icon">
            <input type="text" id="userSearch" placeholder="Search Name, Email, Phone or ID">
        </div>

        <div class="action-buttons">
            <form action="../../../../Controllers/AdminController.php" method="POST" style="display:inline;">
                <input type="hidden" name="action" value="delete_all_users">
                <button class="btn delete-all" type="submit" onclick="return confirm('Delete ALL users?');">Delete All</button>
            </form>
        </div>
    </div>


    <!-- TABLE CARD -->
    <div class="table-card">
    <h3>Registered Users</h3>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Birth Date</th>
                <th>Address</th>
                <th>Division</th>
                <th>Postal</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Photo</th>
                <th>Document</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($users as $u) { ?>
                <tr class="user-row" data-id="<?php echo $u['id']; ?>" data-status="<?php echo $u['status']; ?>">
                    <td><?php echo $u['id']; ?></td>
                    <td><?php echo $u['full_name']; ?></td>
                    <td><?php echo $u['birth_date']; ?></td>
                    <td><?php echo $u['address']; ?></td>
                    <td><?php echo $u['division']; ?></td>
                    <td><?php echo $u['postal_code']; ?></td>
                    <td><?php echo $u['phone']; ?></td>
                    <td><?php echo $u['email']; ?></td>
                    <td><?php echo $u['gender']; ?></td>
                    <td><?php echo $u['photo']; ?></td>
                    <td><?php echo $u['document']; ?></td>
                    <td class="status-cell"><?php echo $u['status']; ?></td>
                    <td>
                        <form action="../../../../Controllers/AdminController.php" method="POST" style="display:inline;">
                            <input type="hidden" name="action" value="delete_user">
                            <input type="hidden" name="id" value="<?php echo $u['id']; ?>">
                            <button type="submit" class="btn delete-all" onclick="return confirm('Delete this user?');">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</div>

<script src="../../../JavaScript/Admin/Users/user_list.js" defer></script>

</body>
</html>
