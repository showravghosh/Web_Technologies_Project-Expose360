<?php



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Expose360 | Deleted Employees</title>
    <link rel="stylesheet" href="../CSS/DeletedAdminsList.css">
</head>
<body>

<!-- TOP BAR -->
<header class="top-bar">
    <div class="logo">
        <img src="../Photos/logo.png" class="logo-img">
        <span>Expose<span class="highlight">360</span></span>
    </div>

    <div class="page-title">Deleted Employees</div>

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
            <img src="../Photos/deleteEmp.png" class="title-icon">
            Deleted Employees Archive
        </h3>

        <!-- SEARCH & ACTION BAR -->
        <div class="search-actions">

            <div class="search-box">
                <img src="../Photos/search.png" class="search-icon">
                <input type="text" placeholder="Search Deleted Employees">
            </div>

            <div class="action-buttons">
                <button class="btn restore">
                    <img src="../Photos/restore.png" class="btn-icon"> Restore
                </button>
                <button class="btn delete">
                    <img src="../Photos/delete.png" class="btn-icon"> Permanent Delete All
                </button>
            </div>

        </div>

        <!-- DELETED Employees TABLE -->
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Date Joined</th>
                        <th>Salary</th>
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
