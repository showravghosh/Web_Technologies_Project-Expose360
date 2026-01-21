<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../../Auth/login.php');
    exit();
}

require_once '../../../../Models/Post.php';
$postModel = new Post();

/* Approve/Reject action  */
if (isset($_POST['action']) && $_POST['action'] === 'update_status') {

    $post_id = (int)($_POST['post_id'] ?? 0);
    $new_status = $_POST['new_status'] ?? '';

    if ($post_id > 0 && ($new_status === 'Approved' || $new_status === 'Rejected')) {
        $postModel->updateStatus($post_id, $new_status);
    }

    header("Location: verification_request.php");
    exit();
}

/*  Search  */
$q = $_GET['q'] ?? '';

/*  Load Pending Posts */
$list = $postModel->getPendingPosts($q);

/*  Details  */
$selected_id = (int)($_GET['id'] ?? 0);
$details = null;

if ($selected_id > 0) {
    foreach ($list as $r) {
        if ((int)$r['post_id'] === $selected_id) {
            $details = $r;
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verification Requests | Expose360</title>
    <link rel="stylesheet" href="../../../CSS/Admin/Users/verification_request.CSS">
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

        <button class="btn home" onclick="location.href='../dashboard.php'">
            <img src="../../../../Resources/Photos/homei.png" class="btn-icon"> Home
        </button>
    </div>
</header>

<div class="container">

    <!-- TABLE SECTION -->
    <div class="table-card">

        <form class="search-box" method="GET" action="">
            <img src="../../../../Resources/Photos/search.png" class="search-icon">
            <input type="text" name="q" placeholder="Search by name, ID or role" value="<?php echo htmlspecialchars($q); ?>">
            <button class="btn clear" type="button" onclick="location.href='verification_request.php'">Clear</button>
        </form>

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
                <?php if (count($list) === 0) { ?>
                    <tr>
                        <td colspan="9" style="text-align:center; padding:18px;">No requests found.</td>
                    </tr>
                <?php } ?>

                <?php foreach ($list as $r) { ?>
                    <tr>
                        <td><?php echo (int)$r['post_id']; ?></td>
                        <td><?php echo htmlspecialchars($r['user_id']); ?></td>
                        <td><?php echo htmlspecialchars($r['email']); ?></td>
                        <td><?php echo "Post Verification"; ?></td>
                        <td><?php echo "High"; ?></td>
                        <td><?php echo "Pending"; ?></td>
                        <td><?php echo htmlspecialchars($r['created_at']); ?></td>
                        <td><?php echo "-"; ?></td>
                        <td>
                            <div class="actions">
                                <a class="action-btn edit" href="verification_request.php?id=<?php echo (int)$r['post_id']; ?>&q=<?php echo urlencode($q); ?>">
                                    View
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>

            </table>
        </div>

    </div>

    <!-- DETAILS PANEL -->
    <div class="details-card">
        <h3>Request Details</h3>

        <?php if ($details == null) { ?>
            <p style="font-size:13px; color:#666;">Click <b>View</b> to see details here.</p>
        <?php } else { ?>

            <div class="detail-box">
                <label>Submitted On</label>
                <div class="detail-value"><?php echo htmlspecialchars($details['created_at']); ?></div>
            </div>

            <div class="detail-box">
                <label>User</label>
                <div class="detail-value"><?php echo htmlspecialchars($details['full_name']); ?> (<?php echo htmlspecialchars($details['email']); ?>)</div>
            </div>

            <div class="detail-box">
                <label>Post Text</label>
                <div class="detail-value"><?php echo htmlspecialchars($details['content']); ?></div>
            </div>

            <div class="detail-box">
                <label>Photo</label>
    <div class="detail-value">
                    <?php if (!empty($details['photo'])) { ?>
                        <a href="../../../../Upload/Photos/<?php echo htmlspecialchars($details['photo']); ?>" target="_blank">View Photo</a>
                    <?php } else { ?>
                        No Photo
                    <?php } ?>
                </div>
            </div>

            <form method="POST" action="">
                <input type="hidden" name="action" value="update_status">
                <input type="hidden" name="post_id" value="<?php echo (int)$details['post_id']; ?>">

                <div class="detail-actions">
                    <button class="btn approve" type="submit" name="new_status" value="Approved"
                            onclick="return confirm('Approve this post?');">
                        Approve
                    </button>

                    <button class="btn reject" type="submit" name="new_status" value="Rejected"
                            onclick="return confirm('Reject this post?');">
                        Reject
                    </button>
                </div>
            </form>

            <p class="note">
                Once approved, the post will appear in user dashboard feed.
            </p>

        <?php } ?>
    </div>

</div>

<script src="../../../JavaScript/Admin/Users/verification_request.js" defer></script>

</body>
</html>
