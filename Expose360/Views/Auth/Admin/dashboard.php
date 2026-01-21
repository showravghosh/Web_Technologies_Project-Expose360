<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../Auth/login.php');
    exit();
}

require_once '../../../Models/Database.php';

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

/* Counts */
$totalUsers = 0;
$totalEmployees = 0;
$totalAdmins = 0;

$res = mysqli_query($conn, "SELECT COUNT(*) AS total FROM user_account WHERE status <> 'Deleted'");
if ($res) { $row = mysqli_fetch_assoc($res); $totalUsers = (int)$row['total']; }

$res = mysqli_query($conn, "SELECT COUNT(*) AS total FROM emp_account WHERE status <> 'Deleted'");
if ($res) { $row = mysqli_fetch_assoc($res); $totalEmployees = (int)$row['total']; }

$res = mysqli_query($conn, "SELECT COUNT(*) AS total FROM admin_account WHERE status <> 'Deleted'");
if ($res) { $row = mysqli_fetch_assoc($res); $totalAdmins = (int)$row['total']; }

/* Pending Verification Requests */
$pendingReq = [];

$sql = "
    SELECT
        p.post_id,
        p.user_id,
        u.email AS user_gmail,
        'Post Verification' AS request_type,
        'High' AS priority,
        p.status,
        p.created_at AS request_at
    FROM posts p
    INNER JOIN user_account u ON u.id = p.user_id
    WHERE p.status = 'Pending'
    ORDER BY p.post_id DESC
    LIMIT 10
";

$res = mysqli_query($conn, $sql);
if ($res) {
    while ($r = mysqli_fetch_assoc($res)) {
        $pendingReq[] = $r;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Expose360</title>
    <link rel="stylesheet" href="../../CSS/Admin/dashboard.css?v=1.0">

</head>
<body>
    <!-- Top Navigation Bar -->
    <div class="topnav">
        <div class="topnav-content">
            <div class="nav-left">
                <h1 class="logo">Expose<span>360</span> Admin</h1>
            </div>
            <div class="nav-right">
                <span class="welcome-text">Welcome, <?php echo $_SESSION['admin_name'] ?? 'Admin'; ?></span>
                <button class="nav-btn" onclick="location.href='dashboard.php'" title="Home">
                    <img src="../../../Resources/Photos/homei.png" alt="Home" class="nav-icon">
                </button>
                <button class="logout-btn" onclick ="location.href='../../../Controllers/AuthController.php?action=logout'" title="Logout">
                    <img src="../../../Resources/Photos/logout.png" alt="Logout" class="nav-icon"> Logout
                </button>
            </div>
        </div>
    </div>

    <div class="dashboard-container">
        <!-- Mobile Sidebar Toggle -->
        <button class="sidebar-toggle">
            <img src="../../../Resources/Photos/menu.png" alt="Menu" class="menu-toggle-icon">
        </button>

        <!-- Sidebar -->
        <div class="sidebar">
            <nav class="sidebar-nav">
                <h3 class="sidebar-title">Management</h3>
                <a href="dashboard.php" class="menu-item active">
                    <img src="../../../Resources/Photos/homei.png" alt="News Feed" class="menu-icon"> News Feed
                </a>
                <a href="Users/user_list.php" class="menu-item">
                    <img src="../../../Resources/Photos/user.png" alt="Users" class="menu-icon"> Users List
                </a>
                <a href="Users/deleted_user.php" class="menu-item">
                    <img src="../../../Resources/Photos/delete.png" alt="Deleted Users" class="menu-icon"> Deleted Users List
                </a>
                <a href="Users/employee_list.php" class="menu-item">
                    <img src="../../../Resources/Photos/employee.png" alt="Employees" class="menu-icon"> Employees List
                </a>
                <a href="Users/deleted_employee.php" class="menu-item">
                    <img src="../../../Resources/Photos/delete.png" alt="Deleted Employees" class="menu-icon"> Deleted Employees List
                </a>
                <a href="Users/reg_admin.php" class="menu-item">
                    <img src="../../../Resources/Photos/addAdmin.png" alt="Add Admin" class="menu-icon"> Add New Admin
                </a>
                <a href="Users/admin_list.php" class="menu-item">
                    <img src="../../../Resources/Photos/coni.png" alt="Admin" class="menu-icon"> Admin List
                </a>
                <a href="Users/deleted_admin.php" class="menu-item">
                    <img src="../../../Resources/Photos/delete.png" alt="Deleted Admins" class="menu-icon"> Deleted Admins List
                </a>
                <a href="Users/verification_request.php" class="menu-item">
                    <img src="../../../Resources/Photos/compliant.png" alt="Verification" class="menu-icon"> Verification Request List
                </a>
                <a href="Users/deleted_post.php" class="menu-item">
                    <img src="../../../Resources/Photos/delete.png" alt="Deleted Posts" class="menu-icon"> Deleted Post
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <main class="main-content">
            <h2 class="content-title">Dashboard Overview</h2>

            <div class="content-area">
                <div class="news-feed-content">

                    <!--UPDATED STATS -->
                    <div class="stats-grid">
                        <div class="detail-card">
                            <div>
                                <p class="stat-value"><?php echo $totalUsers; ?></p>
                                <p class="stat-title">Total Users</p>
                            </div>
                            <img src="../../../Resources/Photos/alluser.png" alt="Users" class="stat-icon">
                        </div>

                        <div class="detail-card">
                            <div>
                                <p class="stat-value"><?php echo $totalEmployees; ?></p>
                                <p class="stat-title">Total Employees</p>
                            </div>
                            <img src="../../../Resources/Photos/employee.png" alt="Employees" class="stat-icon">
                        </div>

                        <div class="detail-card">
                            <div>
                                <p class="stat-value"><?php echo $totalAdmins; ?></p>
                                <p class="stat-title">Total Admins</p>
                            </div>
                            <img src="../../../Resources/Photos/coni.png" alt="Admins" class="stat-icon">
                        </div>
                    </div>

                    <!--Pending Verification Table -->
                    <div class="table-section">
                        <div class="table-header">
                            <h3 class="table-title">Pending Verification Requests</h3>
                            <button class="nav-btn" onclick="location.href='Users/verification_request.php'" title="Open Verification Page">
                                <img src="../../../Resources/Photos/compliant.png" alt="Verification" class="nav-icon">
                            </button>
                        </div>

                        <div class="table-wrapper">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>User Id</th>
                                        <th>User Gmail</th>
                                        <th>Request Type</th>
                                        <th>Priority</th>
                                        <th>Status</th>
                                        <th>Request At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if (count($pendingReq) === 0) { ?>
                                    <tr>
                                        <td colspan="7" style="padding:14px; text-align:center; color:rgb(148,163,184);">
                                            No pending requests found.
                                        </td>
                                    </tr>
                                <?php } ?>

                                <?php foreach ($pendingReq as $r) { ?>
                                  <tr>
                                    <td><?php echo htmlspecialchars($r['post_id']); ?></td>
                                    <td><?php echo htmlspecialchars($r['user_id']); ?></td>
                                    <td><?php echo htmlspecialchars($r['user_gmail']); ?></td>
                                    <td><?php echo htmlspecialchars($r['request_type']); ?></td>
                                    <td><?php echo htmlspecialchars($r['priority']); ?></td>
                                    <td><?php echo htmlspecialchars($r['status']); ?></td>
                                    <td><?php echo htmlspecialchars($r['request_at']); ?></td>
                                    </tr>
                                <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>
</body>
</html>
