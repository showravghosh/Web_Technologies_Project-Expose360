<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../../Auth/login.php');
    exit();
}

require_once '../../../../Models/Database.php';

$conn = null;
if (isset($GLOBALS['conn']) && $GLOBALS['conn']) {
    $conn = $GLOBALS['conn'];
}
if ($conn === null && class_exists('Database')) {
    $conn = Database::getInstance()->getConnection();
}
if ($conn === null) {
    die("Database connection not found. Check Models/Database.php");
}

/* Search handling */
$where = '';
if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $search = mysqli_real_escape_string($conn, trim($_GET['search']));
    $where = "WHERE full_name LIKE '%$search%' OR email LIKE '%$search%' OR phone LIKE '%$search%'";
}

/*  Actions */
if (isset($_POST['action'])) {

    // Restore  admin
    if ($_POST['action'] === 'restore_admin') {
        $admin_id = (int)($_POST['admin_id'] ?? 0);
        if ($admin_id > 0) {
            mysqli_query($conn, "UPDATE admin_account SET status='active' WHERE admin_id=$admin_id");
            mysqli_query($conn, "DELETE FROM deleted_admin WHERE admin_id=$admin_id");
        }
        header("Location: deleted_admin.php");
        exit();
    }

    // Delete forever  admin
    if ($_POST['action'] === 'delete_forever_admin') {
        $admin_id = (int)($_POST['admin_id'] ?? 0);
        if ($admin_id > 0) {
            mysqli_query($conn, "DELETE FROM admin_account WHERE admin_id=$admin_id");
            mysqli_query($conn, "DELETE FROM deleted_admin WHERE admin_id=$admin_id");
        }
        header("Location: deleted_admin.php");
        exit();
    }
}

$list = [];
$sql = "SELECT admin_id, full_name, email, phone, gender, deleted_at
        FROM deleted_admin $where
        ORDER BY deleted_at DESC";
$res = mysqli_query($conn, $sql);
if ($res) {
    while ($row = mysqli_fetch_assoc($res)) {
        $list[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Expose360 | Deleted Admins</title>
    <link rel="stylesheet" href="../../../CSS/Admin/Users/deleted_admin.css">
</head>
<body>

<!-- TOP BAR -->
<header class="top-bar">
    <div class="logo">
        <img src="../../../../Resources/Photos/logo.png" class="logo-img">
        <span>Expose<span class="highlight">360</span></span>
    </div>

    <div class="page-title">Deleted Admins</div>

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

    <div class="card">

        <h3 class="card-title">
            <img src="../../../../Resources/Photos/admin.png" class="title-icon">
            Deleted Admin Archive
        </h3>

        <!-- SEARCH & ACTION BAR -->
        <div class="search-actions">

            <!-- Basic search (same design) -->
            <form class="search-box" method="GET" action="">
                <img src="../../../../Resources/Photos/search.png" class="search-icon">
                <input type="text" id="deletedAdminSearch" name="search" placeholder="Search Deleted Admin" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            </form>



        </div>

        <!-- DELETED ADMINS TABLE -->
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Admin ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                <?php if (count($list) === 0) { ?>
                    <tr>
                        <td colspan="6" style="text-align:center; padding:18px;">No deleted admins found.</td>
                    </tr>
                <?php } ?>

                <?php foreach ($list as $a) { ?>
                    <tr>
                        <td><?php echo (int)$a['admin_id']; ?></td>
                        <td><?php echo htmlspecialchars($a['full_name']); ?></td>
                        <td><?php echo htmlspecialchars($a['email']); ?></td>
                        <td><?php echo htmlspecialchars($a['phone']); ?></td>
                        <td><?php echo htmlspecialchars($a['gender']); ?></td>
                        <td>
                            <!-- Restore single -->
                            <form method="POST" action="" style="display:inline;">
                                <input type="hidden" name="admin_id" value="<?php echo (int)$a['admin_id']; ?>">
                                <button class="btn restore" type="submit" name="action" value="restore_admin"
                                        onclick="return confirm('Restore this admin?');">
                                    <img src="../../../../Resources/Photos/restore.png" class="btn-icon"> Restore
                                </button>
                            </form>

                            <!-- Delete forever single -->
                            <form method="POST" action="" style="display:inline;">
                                <input type="hidden" name="admin_id" value="<?php echo (int)$a['admin_id']; ?>">
                                <button class="btn delete" type="submit" name="action" value="delete_forever_admin"
                                        onclick="return confirm('Permanently delete this admin?');">
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

<script src="../../../JavaScript/Admin/Users/deleted_admin.js" defer></script>

</body>
</html>