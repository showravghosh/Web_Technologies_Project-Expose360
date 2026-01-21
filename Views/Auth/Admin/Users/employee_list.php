<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../../Auth/login.php');
    exit();
}
require_once '../../../../Models/Admin.php';
$adminModel = new Admin();
$emps = $adminModel->getAllEmployees();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Management | Expose360</title>
    <link rel="stylesheet" href="../../../CSS/Admin/Users/employee_list.css">
</head>
<body>

<!-- HEADER -->
<header class="top-bar">
    <div class="logo">
        <img src="../../../../Resources/Photos/logo.png" class="logo-img">
        <span>Expose<span class="highlight">360</span></span>
    </div>

    <div class="page-title">Employee Management</div>

    <div class="nav-buttons">
        <button class="btn back" onclick ="history.back()">
            <img src="../../../../Resources/Photos/back.png" class="btn-icon"> Back
        </button>
        <button class="btn home" onclick="location.href='../dashboard.php'">
            <img src="../../../../Resources/Photos/home.png" class="btn-icon"> Home
        </button>
    </div>
</header>

<div class="container">

    <!-- LEFT FORM -->
    <div class="form-card">
        <form action="../../../../Controllers/AdminController.php" method="POST" id="empForm">
            <input type="hidden" name="action" value="add_employee" id="formAction">
            <input type="hidden" name="emp_id" value="" id="empId">

            <label>Employee Name</label>
            <input type="text" name="full_name" placeholder="Employee Name" required id="full_name">

            <label>Date of Joining</label>
            <input type="date" name="date_joined" required id="date_joined">

            <label>Salary</label>
            <input type="number" name="salary" placeholder="Salary" required id="salary" >

            <label>Phone Number</label>
            <input type="tel" name="phone" placeholder="Phone Number"  id="phone">

            <label>Gender</label>
            <div class="radio-group">
                <label><input type="radio" name="gender" value="Male" required> Male</label>
                <label><input type="radio" name="gender" value="Female" required> Female</label>
                <label><input type="radio" name="gender" value="Other" required> Other</label>
            </div>

            <div class="form-buttons">
                <button class="btn add" type="submit" id="submitBtn">
                    <img src="../../../../Resources/Photos/add.png" class="btn-icon"> Add Employee
                </button>
                <button class="btn reset" type="reset" onclick="resetToAddMode()">
                    <img src="../../../../Resources/Photos/reset.png" class="btn-icon"> Reset
                </button>
                <button class="btn update" type="button" onclick="location.href='employee_list.php'">
                    <img src="../../../../Resources/Photos/update.png" class="btn-icon"> Refresh
                </button>
            </div>

        </form>
    </div>

    <div class="table-card">

        <div class="search-box">
            <img src="../../../../Resources/Photos/search.png" class="search-icon">
            <input type="text" id="empSearch" placeholder="Search by Name or Number">
            <button class="btn clear" type="button" id="clearSearch">Clear</button>
        </div>

        <h3>All Employees List</h3>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Date Joined</th>
                    <th>Salary</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($emps as $e) { ?>
                    <tr class="emp-row"
                        onclick="fillFormFromRow(this)"
                        data-emp_id="<?php echo $e['emp_id']; ?>"
                        data-full_name="<?php echo htmlspecialchars($e['full_name'], ENT_QUOTES); ?>"
                        data-date_joined="<?php echo $e['date_joined']; ?>"
                        data-salary="<?php echo $e['salary']; ?>"
                        data-gender="<?php echo $e['gender']; ?>"
                        data-phone="<?php echo isset($e['phone']) ? htmlspecialchars($e['phone'], ENT_QUOTES) : ''; ?>"
                        style="cursor:pointer;"
                    >
                        <td><?php echo $e['emp_id']; ?></td>
                        <td><?php echo htmlspecialchars($e['full_name']); ?></td>
                        <td><?php echo htmlspecialchars($e['date_joined']); ?></td>
                        <td><?php echo htmlspecialchars($e['salary']); ?></td>
                        <td><?php echo htmlspecialchars($e['gender']); ?></td>

                        <!-- PHONE -->
                        <td><?php echo isset($e['phone']) ? htmlspecialchars($e['phone']) : ''; ?></td>

                        <!-- ACTIONS -->
                        <td>
                            <div class="actions">
                                <form action="../../../../Controllers/AdminController.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="delete_employee">
                                    <input type="hidden" name="emp_id" value="<?php echo $e['emp_id']; ?>">
                                    <button class="action-btn delete" type="submit" onclick="return confirm('Delete this employee?');">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
</div>

<script src="../../../JavaScript/Admin/Users/Employee_list.js" defer></script>

</body>
</html>
