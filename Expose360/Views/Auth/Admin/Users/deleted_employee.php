<?php



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Expose360 | Deleted Employees</title>
    <link rel="stylesheet" href="../../../CSS/Admin/Users/deleted_employee.css">
</head>
<body>

<!-- TOP BAR -->
<header class="top-bar">
    <div class="logo">
        <img src="../../../../Resources/Photos/logo.png" class="logo-img">
        <span>Expose<span class="highlight">360</span></span>
    </div>

    <div class="page-title">Deleted Employees</div>

    <div class="nav-buttons">
        <button class="btn back" onclick ="history.back()">
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
            <img src="../../../../Resources/Photos/deleteEmp.png" class="title-icon">
            Deleted Employees Archive
        </h3>

        <!-- SEARCH & ACTION BAR -->
        <div class="search-actions">

            <div class="search-box">
                <img src="../../../../Resources/Photos/search.png" class="search-icon">
                <input type="text" placeholder="Search Deleted Employees">
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

        <!-- DELETED Employees TABLE -->
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Date Joined</th>
                        <th>Salary</th>
                        <th>Phone Number</th>
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
