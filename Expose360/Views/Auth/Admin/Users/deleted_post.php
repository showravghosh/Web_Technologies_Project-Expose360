<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../../Auth/login.php');
    exit();
}

require_once '../../../../Models/Database.php';

$conn = null;
if (isset($GLOBALS['conn']) && $GLOBALS['conn']) {
    $conn = $GLOBALS['conn'];
}
if ($conn === null && class_exists('Database')) {
    $conn = Database::getInstance()->getConnection();
}
if ($conn === null) {
    die("Database connection not found. Check Models/Database.php");
}

/*  Restore/Delete permanently actions */
if (isset($_POST['action'])) {

    $post_id = (int)($_POST['post_id'] ?? 0);

    if ($_POST['action'] === 'restore_post' && $post_id > 0) {
        mysqli_query($conn, "UPDATE posts SET status='Approved', is_visible='No' WHERE post_id=$post_id");
        header("Location: deleted_post.php");
        exit();
    }

    if ($_POST['action'] === 'delete_forever' && $post_id > 0) {
        mysqli_query($conn, "DELETE FROM posts WHERE post_id=$post_id");
        header("Location: deleted_post.php");
        exit();
    }
}

/*  Search  */
$q = $_GET['q'] ?? '';
$q_safe = mysqli_real_escape_string($conn, $q);

$where = "WHERE p.status='Deleted'";
if ($q_safe !== '') {
    $where .= " AND (u.full_name LIKE '%$q_safe%'
                OR u.email LIKE '%$q_safe%'
                OR p.content LIKE '%$q_safe%'
                OR p.post_id LIKE '%$q_safe%')";
}

/* list deleted posts */
$list = [];
$sql = "SELECT p.*, u.full_name, u.email
        FROM posts p
        LEFT JOIN user_account u ON u.id = p.user_id
        $where
        ORDER BY p.post_id DESC";
$res = mysqli_query($conn, $sql);
if ($res) {
    while ($row = mysqli_fetch_assoc($res)) {
        $list[] = $row;
    }
}

/* Details panel */
$selected_id = (int)($_GET['id'] ?? 0);
$details = null;

if ($selected_id > 0) {
    $sqlOne = "SELECT p.*, u.full_name, u.email
               FROM posts p
               LEFT JOIN user_account u ON u.id = p.user_id
               WHERE p.post_id=$selected_id AND p.status='Deleted'
               LIMIT 1";
    $resOne = mysqli_query($conn, $sqlOne);
    if ($resOne && mysqli_num_rows($resOne) === 1) {
        $details = mysqli_fetch_assoc($resOne);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Deleted Posts | Expose360</title>
    <link rel="stylesheet" href="../../../CSS/Admin/Users/deleted_post.css">
</head>
<body>

<header class="top-bar">
    <div class="logo">
        <img src="../../../../Resources/Photos/logo.png" class="logo-img">
        <span>Expose<span class="highlight">360</span></span>
    </div>

    <div class="page-title">Deleted Posts</div>

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
            <input type="text" name="q" placeholder="Search by post id, user, email, post text" value="<?php echo htmlspecialchars($q); ?>">
            <button class="btn clear" type="button" onclick="location.href='deleted_post.php'">Clear</button>
        </form>

        <h3>All Deleted Posts</h3>

        <div class="table-wrapper">
            <table>
                <thead>
                <tr>
                    <th>Post ID</th>
                    <th>User</th>
                    <th>Email</th>
                    <th>Post</th>
                    <th>Photo</th>
                    <th>Deleted At</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody>
                <?php if (count($list) === 0) { ?>
                    <tr>
                        <td colspan="7" style="text-align:center; padding:18px;">No deleted posts found.</td>
                    </tr>
                <?php } ?>

                <?php foreach ($list as $r) {
                    $short = $r['content'];
                    if (strlen($short) > 60) { $short = substr($short, 0, 60) . '...'; }
                ?>
                    <tr>
                        <td><?php echo (int)$r['post_id']; ?></td>
                        <td><?php echo htmlspecialchars($r['full_name'] ?? '-'); ?></td>
                        <td><?php echo htmlspecialchars($r['email'] ?? '-'); ?></td>
                        <td title="<?php echo htmlspecialchars($r['content']); ?>"><?php echo htmlspecialchars($short); ?></td>
                        <td>
                            <?php if (!empty($r['photo'])) { ?>
                                <a href="../../../../Resources/Photos/<?php echo htmlspecialchars($r['photo']); ?>" target="_blank">View</a>
                            <?php } else { ?>
                                -
                            <?php } ?>
                        </td>
                        <td><?php echo htmlspecialchars($r['created_at']); ?></td>
                        <td>
                            <div class="actions">
                                <a class="action-btn view" href="deleted_post.php?id=<?php echo (int)$r['post_id']; ?>&q=<?php echo urlencode($q); ?>">View</a>
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
        <h3>Post Details</h3>

        <?php if ($details == null) { ?>
            <p class="empty-note">Click <b>View</b> to see details here.</p>
        <?php } else { ?>

            <div class="detail-box">
                <label>Post ID</label>
                <div class="detail-value"><?php echo (int)$details['post_id']; ?></div>
            </div>

            <div class="detail-box">
                <label>User</label>
                <div class="detail-value"><?php echo htmlspecialchars($details['full_name'] ?? '-'); ?></div>
            </div>

            <div class="detail-box">
                <label>Email</label>
                <div class="detail-value"><?php echo htmlspecialchars($details['email'] ?? '-'); ?></div>
            </div>

            <div class="detail-box">
                <label>Post Content</label>
                <div class="detail-value"><?php echo htmlspecialchars($details['content']); ?></div>
            </div>

            <div class="detail-box">
                <label>Photo</label>
                <div class="detail-value">
                    <?php if (!empty($details['photo'])) { ?>
                        <a href="../../../../Resources/Photos/<?php echo htmlspecialchars($details['photo']); ?>" target="_blank">Open Photo</a>
                    <?php } else { ?>
                        No photo
                    <?php } ?>
                </div>
            </div>

            <form method="POST" action="">
                <input type="hidden" name="post_id" value="<?php echo (int)$details['post_id']; ?>">

                <div class="detail-actions">
                    <button class="btn approve" type="submit" name="action" value="restore_post"
                            onclick="return confirm('Restore this post? It will be Approved but Hidden.');">
                        Restore
                    </button>

                    <button class="btn reject" type="submit" name="action" value="delete_forever"
                            onclick="return confirm('Delete permanently? This cannot be undone.');">
                        Delete Forever
                    </button>
                </div>
            </form>

            <p class="note">
                Restore will set status to <b>Approved</b> but keep <b>hidden</b> (is_visible = No). You can enable it from moderation.
            </p>

        <?php } ?>
    </div>

</div>

</body>
</html>
