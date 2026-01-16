<?php



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
            <input type="text" placeholder="Search Name, Email, Phone or ID">
        </div>

        <div class="action-buttons">
            <button class="btn reset">Reset</button>
            <button class="btn delete-all">Delete All</button>
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

        
        </tbody>
    </table>
</div>
</div>

</body>
</html>
