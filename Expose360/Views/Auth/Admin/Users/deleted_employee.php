<?php

require_once '../../../../Models/Database.php';

$conn = Database::getInstance()->getConnection();

$deletedEmployees = [];
$sql = "SELECT emp_id, full_name, date_joined, salary, gender, phone FROM deleted_emp ORDER BY deleted_at DESC";
$result = mysqli_query($conn, $sql);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $deletedEmployees[] = $row;
    }
}
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
                <input type="text" id="deletedEmpSearch" placeholder="Search Deleted Employees">
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
                    </tr>
                </thead>

                <tbody id="deletedEmpTbody">
                    <?php if (!empty($deletedEmployees)) { ?>
                        <?php foreach ($deletedEmployees as $e) { ?>
                            <tr>
                                <td><?php echo (int)$e['emp_id']; ?></td>
                                <td><?php echo htmlspecialchars($e['full_name']); ?></td>
                                <td><?php echo htmlspecialchars($e['date_joined']); ?></td>
                                <td><?php echo htmlspecialchars($e['salary']); ?></td>
                                <td><?php echo htmlspecialchars($e['phone'] ?? '-'); ?></td>
                                <td><?php echo htmlspecialchars($e['gender']); ?></td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="7" style="text-align:center; padding:18px;">No deleted employees found.</td>
                        </tr>
                    <?php } ?>
            </tbody>
            </table>
        </div>

    </div>

</div>

<script src="../../../JavaScript/Admin/Users/deleted_employee.js" defer></script>

</body>
</html>
