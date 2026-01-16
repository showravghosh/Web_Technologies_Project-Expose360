<?php 



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Expose360 | Deleted Users</title>
    <link rel="stylesheet" href="../../../CSS/Admin/Users/deleted_user.css">
</head>

<body>

<!-- TOP BAR -->
<header class="top-bar">

    <div class="left">
        <h1>
            Expose<span class="highlight">360</span> / Deleted Users
        </h1>
    </div>

    <div class="right">
        <button class="btn back" onclick="history.back()">
            <img src="../../../../Resources/Photos/back.png" class="btn-icon"> Back
        </button>

        <button class="btn home" onclick="location.href='../dashboard.php'">
            <img src="../../../../Resources/Photos/home.png" class="btn-icon">
        </button>
    </div>

</header>


<!-- MAIN CONTAINER -->
<div class="container">

    <div class="card">

        <h2 class="title">
            <img src="../../../../Resources/Photos/delete.png" class="title-icon">
            Deleted Users Archive
        </h2>

        <!-- SEARCH & ACTIONS -->
        <div class="search-actions">

            <div class="search-box">
                <img src="../../../../Resources/Photos/search.png" class="search-icon">
                <input type="text" placeholder="Search Deleted Users">
            </div>

            <div class="action-buttons">
                <button class="btn restore">Restore</button>
                <button class="btn delete-all">Permanent Delete All</button>
            </div>

        </div>

        <!-- TABLE -->
        <div class="table-wrapper">
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

</div>

</body>
</html>
