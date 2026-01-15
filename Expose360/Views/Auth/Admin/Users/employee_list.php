<?php



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
        <button class="btn home"><a href="../dashboard.php" class="home-btn">
            <img src="../../../../Resources/Photos/home.png" class="btn-icon"></a> Home
        </button>
    </div>
</header>


<div class="container">

    <!-- LEFT FORM -->
    <div class="form-card">
        <form>

            <label>Employee Name</label>
            <input type="text" placeholder="Employee Name">

            <label>Date of Joining</label>
            <input type="date">

            <label>Salary</label>
            <input type="number" placeholder="Salary">

            <label>Phone Number</label>
            <input type="tel" placeholder="Phone Number">

            <label>Gender</label>
            <div class="radio-group">
                <label><input type="radio" name="gender"> Male</label>
                <label><input type="radio" name="gender"> Female</label>
                <label><input type="radio" name="gender"> Other</label>
            </div>

            <div class="form-buttons">
                <button class="btn add">
                    <img src="../../../../Resources/Photos/add.png" class="btn-icon"> Add Employee
                </button>
                <button class="btn reset">
                    <img src="../../../../Resources/Photos/reset.png" class="btn-icon"> Reset
                </button>
                 <button class="btn update">
                    <img src="../../../../Resources/Photos/update.png" class="btn-icon"> Update
                </button>
            </div>

        </form>
    </div>


    <div class="table-card">


    <div class="search-box">
            <img src="../../../../Resources/Photos/search.png" class="search-icon">
            <input type="text" placeholder="Search by Name or Number">
            <button class="btn clear">Clear</button>
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
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <div class="actions">
                            <button class="action-btn edit">Edit</button>
                            <button class="action-btn delete">Delete</button>
                        </div>
                    </td>
                </tr>

            </tbody>
        </table>

    </div>
</div>

</body>
</html>
