<?php




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verification Requests | Expose360</title>
    <link rel="stylesheet" href="../../../CSS/Admin/Users/verification_request.css">
</head>
<body>

<!-- HEADER -->
<header class="top-bar">
    <div class="logo">
        <img src="../../../../Resources/Photos/logo.png" class="logo-img">
        <span>Expose<span class="highlight">360</span></span>
    </div>

    <div class="page-title">Verification Requests</div>

    <div class="nav-buttons">
        <button class="btn back" onclick="history.back()">
            <img src="../../../../Resources/Photos/back.png" class="btn-icon"> Back
        </button>

        <button class="btn home" onclick ="location.href='../dashboard.php'">
            <img src="../../../../Resources/Photos/homei.png" class="btn-icon"> Home
        </button>
    </div>
</header>

<div class="container">

    <!-- TABLE SECTION -->
    <div class="table-card">

        <div class="search-box">
            <img src="../../../../Resources/Photos/search.png" class="search-icon">
            <input type="text" placeholder="Search by name, ID or role">
            <button class="btn clear">Clear</button>
        </div>

        <h3>All Verification Requests</h3>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>User Id</th>
                        <th>User Gmail</th>
                        <th>Request Type</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Request At</th>
                        <th>Updated At</th>
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
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <div class="actions">
                                <button class="action-btn edit">View</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    <!-- DETAILS PANEL -->
    <div class="details-card">
        <h3>Request Details</h3>

        <div class="detail-box">
            <label>Submitted On</label>
            <div class="detail-value"></div>
        </div>

        <div class="detail-box">
            <label>Attached Evidence</label>
            <div class="detail-value"></div>
        </div>

        <div class="detail-actions">
            <button class="btn approve">Approve</button>
            <button class="btn reject">Reject</button>
        </div>

        <p class="note">
            Once approved, the user will receive immediate access.
        </p>
    </div>

</div>

</body>
</html>
