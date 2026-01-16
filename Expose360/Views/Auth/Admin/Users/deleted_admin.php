<?php



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

            <div class="search-box">
                <img src="../../../../Resources/Photos/search.png" class="search-icon">
                <input type="text" placeholder="Search Deleted Admin">
            </div>

            <div class="action-buttons">
                <button class="btn restore">
                    <img src="../../../../Resources/Photos/restore.png" class="btn-icon"> Restore
                </button>
                <button class="btn delete">
                    <img src="../../../../Resources/Photos/delete.png" class="btn-icon"> Permanent Delete All
                </button>
            </div>

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


            </tbody>
            </table>
        </div>

    </div>

</div>

</body>
</html>
