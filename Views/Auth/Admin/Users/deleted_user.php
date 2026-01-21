<?php
require_once '../../../../Models/Database.php';

$conn = Database::getInstance()->getConnection();

$deletedUsers = [];
$sql = "SELECT id, full_name, birth_date, address, division, postal_code, phone, email, gender, photo, document, status
        FROM deleted_user
        ORDER BY deleted_at DESC";

$result = mysqli_query($conn, $sql);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $deletedUsers[] = $row;
    }
}
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
                <input type="text" id="deletedUserSearch" placeholder="Search Deleted Users">
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
                <?php if (!empty($deletedUsers)) { ?>
                    <?php foreach ($deletedUsers as $u) { ?>
                        <tr>
                            <td><?php echo (int)$u['id']; ?></td>
                            <td><?php echo htmlspecialchars($u['full_name']); ?></td>
                            <td><?php echo htmlspecialchars($u['birth_date']); ?></td>
                            <td><?php echo htmlspecialchars($u['address']); ?></td>
                            <td><?php echo htmlspecialchars($u['division']); ?></td>
                            <td><?php echo htmlspecialchars($u['postal_code']); ?></td>
                            <td><?php echo htmlspecialchars($u['phone']); ?></td>
                            <td><?php echo htmlspecialchars($u['email']); ?></td>
                            <td><?php echo htmlspecialchars($u['gender']); ?></td>

                            <td style="text-align:center;">
                                <?php if (!empty($u['photo'])) { ?>
                                    <a href="../../../../Resources/Photos/<?php echo htmlspecialchars($u['photo']); ?>" target="_blank">View</a>
                                <?php } else { echo "-"; } ?>
                            </td>

                            <td style="text-align:center;">
                                <?php if (!empty($u['document'])) { ?>
                                    <a href="../../../../Resources/Photos/<?php echo htmlspecialchars($u['document']); ?>" target="_blank">View</a>
                                <?php } else { echo "-"; } ?>
                            </td>

                            <td><?php echo htmlspecialchars($u['status']); ?></td>
                            <td style="text-align:center;">-</td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="13" style="text-align:center; padding:18px;">No deleted users found.</td>
                    </tr>
                <?php } ?>
                </tbody>

            </table>
        </div>

    </div>

</div>

<script src="../../../JavaScript/Admin/Users/deleted_user.js" defer></script>

</body>
</html>
