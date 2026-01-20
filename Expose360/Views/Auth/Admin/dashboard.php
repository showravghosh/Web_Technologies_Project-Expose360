<?php
// Admin Dashboard PHP file
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Expose360</title>
    <link rel="stylesheet" href="../../CSS/Admin/dashboard.css">
</head>
<body>
    <!-- Top Navigation Bar -->
    <div class="topnav">
        <div class="topnav-content">
            <div class="nav-left">
                <h1 class="logo">Expose<span>360</span> Admin</h1>
            </div>
            <div class="nav-right">
                <span class="welcome-text">Welcome, Admin!</span>
                <button class="nav-btn" onclick="location.href='dashboard.php'" title="Home">
                    <img src="../../../Resources/Photos/homei.png" alt="Home" class="nav-icon">
                </button>
                <button class="logout-btn" onclick ="location.href='../Auth/login.php'" title="Logout">
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
            <h2 class="content-title">News Feed</h2>
            
            <div class="content-area">
                <!-- News Feed Content -->
                <div class="news-feed-content">
                    <div class="stats-grid">
                        <div class="detail-card">
                            <div>
                                <p class="stat-value">5,240</p>
                                <p class="stat-title">Total Users</p>
                            </div>
                            <img src="../../../Resources/Photos/alluser.png" alt="Users" class="stat-icon">
                        </div>
                        
                        <div class="detail-card">
                            <div>
                                <p class="stat-value">12</p>
                                <p class="stat-title">Pending Verifications</p>
                            </div>
                            <img src="../../../Resources/Photos/contract.png" alt="Verifications" class="stat-icon">
                        </div>
                        
                        <div class="detail-card">
                            <div>
                                <p class="stat-value">3</p>
                                <p class="stat-title">Open Reports</p>
                            </div>
                            <img src="../../../Resources/Photos/report.png" alt="Reports" class="stat-icon">
                        </div>
                    </div>
                    
                    <div class="chart-placeholder">
                        Show Details by clicked button (Overview Chart/Graph)
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>