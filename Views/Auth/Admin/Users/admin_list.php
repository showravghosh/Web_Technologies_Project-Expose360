<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../../Auth/login.php');
    exit();
}
require_once '../../../../Models/Admin.php';
$adminModel = new Admin();
$admins = $adminModel->getAllAdmins();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Expose360 | Admins List</title>
    <link rel="stylesheet" href="../../../CSS/Admin/Users/admin_list.css">
</head>
<body>

<!-- TOP BAR -->
<header class="top-bar">
    <div class="logo">
        <img src="../../../../Resources/Photos/logo.png" class="logo-img">
        <span>Expose<span class="highlight">360</span></span>
    </div>

    <div class="page-title">Admins List</div>

    <div class="nav-buttons">
        <button class="btn back" onclick="history.back()">
            <img src="../../../../Resources/Photos/back.png" class="btn-icon"> Back
        </button>
        <button class="btn home" onclick="location.href='../dashboard.php'">
            <img src="../../../../Resources/Photos/homei.png" class="btn-icon"> Home
        </button>
    </div>
</header>

<!-- MAIN CONTAINER -->
<div class="container">

    <div class="card">

        <h3 class="card-title">
            <img src="../../../../Resources/Photos/admin.png" class="title-icon">
            Admin Account Management
        </h3>

        <!-- SEARCH & ACTION BAR -->
        <div class="search-actions">

            <div class="search-box">
                <img src="../../../../Resources/Photos/search.png" class="search-icon">
                <input type="text" id="adminSearch" placeholder="Search Name, Email, Phone or ID">
            </div>

            <div class="action-buttons">

                <button class="btn delete">
                    <img src="../../../../Resources/Photos/delete.png" class="btn-icon"> Delete All
                </button>
            </div>

        </div>

        <!-- ADMINS TABLE -->
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Admin ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Password</th>
                        <th>Gender</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody id="adminTbody">
                <?php foreach ($admins as $a) { ?>
                    <tr class="admin-row" data-id="<?php echo $a['admin_id']; ?>" data-status="<?php echo $a['status']; ?>">
                        <td><?php echo $a['admin_id']; ?></td>
                        <td><?php echo $a['full_name']; ?></td>
                        <td><?php echo $a['email']; ?></td>
                        <td><?php echo $a['phone']; ?></td>
                        <td><?php echo $a['password']; ?></td>
                        <td><?php echo $a['gender']; ?></td>
                        <td>
                            <form action="../../../../Controllers/AdminController.php" method="POST" style="display:inline;">
                                <input type="hidden" name="action" value="delete_admin">
                                <input type="hidden" name="admin_id" value="<?php echo $a['admin_id']; ?>">
                                <button type="submit" class="btn delete" onclick="return confirm('Delete this admin?');">
                                    <img src="../../../../Resources/Photos/delete.png" class="btn-icon"> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

    </div>

</div>

<script src="../../../JavaScript/Admin/Users/admin_list.js" defer></script>

</body>
</html>
