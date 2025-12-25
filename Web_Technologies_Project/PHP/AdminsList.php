<?php



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Expose360 | Admins List</title>
    <link rel="stylesheet" href="../CSS/AdminsList.css">
</head>
<body>

<!-- TOP BAR -->
<header class="top-bar">
    <div class="logo">
        <img src="../Photos/logo.png" class="logo-img">
        <span>Expose<span class="highlight">360</span></span>
    </div>

    <div class="page-title">Admins List</div>

    <div class="nav-buttons">
        <button class="btn back">
            <img src="../Photos/back.png" class="btn-icon"> Back
        </button>
        <button class="btn home">
            <img src="../Photos/home.png" class="btn-icon"> Home
        </button>
    </div>
</header>

<!-- MAIN CONTAINER -->
<div class="container">

    <div class="card">

        <h3 class="card-title">
            <img src="../Photos/admin.png" class="title-icon">
            Admin Account Management
        </h3>

        <!-- SEARCH & ACTION BAR -->
        <div class="search-actions">

            <div class="search-box">
                <img src="../Photos/search.png" class="search-icon">
                <input type="text" placeholder="Search Name, Email, Phone or ID">
            </div>

            <div class="action-buttons">
                <button class="btn reset">
                    <img src="../Photos/reset.png" class="btn-icon"> Reset
                </button>
                <button class="btn delete">
                    <img src="../Photos/delete.png" class="btn-icon"> Delete All
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
