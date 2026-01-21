<?php
session_start();

// Must be logged in as user
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user' || !isset($_SESSION['user_id'])) {
    header('Location: ../Auth/login.php');
    exit();
}

$user_id = (int)$_SESSION['user_id'];

// DB connection
$conn = mysqli_connect('localhost', 'root', '', 'expose360_db');
if (!$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}
mysqli_set_charset($conn, 'utf8mb4');

// Fetch user
$user_sql = "SELECT * FROM user_account WHERE id = $user_id LIMIT 1";
$user_res = mysqli_query($conn, $user_sql);
$user = $user_res ? mysqli_fetch_assoc($user_res) : null;
if (!$user) {
    header('Location: ../Auth/login.php');
    exit();
}

$full_name   = $user['full_name'] ?? '';
$division    = $user['division'] ?? '';
$address     = $user['address'] ?? '';
$postal_code = $user['postal_code'] ?? '';
$email       = $user['email'] ?? '';
$phone       = $user['phone'] ?? '';
$photo       = $user['photo'] ?? '';

// Initials
$initials = '';
$parts = preg_split('/\s+/', trim($full_name));
if (count($parts) >= 1 && $parts[0] !== '') $initials .= strtoupper(substr($parts[0], 0, 1));
if (count($parts) >= 2 && $parts[1] !== '') $initials .= strtoupper(substr($parts[1], 0, 1));
if ($initials === '' && $email !== '') $initials = strtoupper(substr($email, 0, 2));

// Profile photo exists?
$photoFile = '';
if ($photo !== '' && file_exists(__DIR__ . '/../../../Resources/Photos/' . $photo)) {
    $photoFile = $photo;
}

// Posts count
$count_sql = "SELECT COUNT(*) AS total FROM posts WHERE user_id = $user_id";
$count_res = mysqli_query($conn, $count_sql);
$count_row = $count_res ? mysqli_fetch_assoc($count_res) : ['total' => 0];
$postCount = (int)($count_row['total'] ?? 0);

// User posts
$posts_sql = "SELECT * FROM posts WHERE user_id = $user_id ORDER BY post_id DESC";
$posts_res = mysqli_query($conn, $posts_sql);

// Alert message
$alert = '';
if (isset($_GET['msg'])) $alert = $_GET['msg'];

// Video / Live alert
if (isset($_POST['video']) || isset($_POST['live'])) {
    $alert = 'This feature will be available later';
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Profile - Expose360</title>
    <link rel="stylesheet" href="../../CSS/User/profile.css">
</head>
<body>

<?php if ($alert !== '') { ?>
    <script>alert("<?php echo addslashes($alert); ?>");</script>
<?php } ?>

    <!-- Top Navigation Bar -->
    <div class="topnav">
        <div class="topnav-content">
            <div class="nav-left">
                <button class="back-btn" onclick="window.location.href='dashboard.php'">
                    <img src="../../../Resources/Photos/back.png" alt="Back" class="nav-icon"> Back Home
                </button>
                <h1 class="logo">Expose<span>360</span></h1>
            </div>
            <div class="nav-right">
                <button class="nav-btn" title="Home" onclick="window.location.href='dashboard.php'">
                    <img src="../../../Resources/Photos/homei.png" alt="Home" class="nav-icon">
                </button>
                <button class="nav-btn logout-btn" title="Logout" onclick="window.location.href='../../../Controllers/AuthController.php?action=logout'">
                    <img src="../../../Resources/Photos/logout.png" alt="Logout" class="nav-icon">
                </button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Profile Card -->
        <div class="profile-card">

            <!-- Cover Photo -->
            <div class="cover-section">
                <div class="cover-image">
                    <div class="cover-placeholder">
                        <p>Cover Photo</p>
                    </div>
                </div>
                <button class="cover-btn" onclick="alert('This feature will be available later');">
                    <img src="../../../Resources/Photos/camera.png" alt="Upload" class="btn-icon"> Upload Cover
                </button>
            </div>

            <!-- Profile Header -->
            <div class="profile-header">
                <div class="profile-top">

                    <!-- Profile Picture -->
                    <div class="profile-pic-section">
                        <div class="profile-pic" style="overflow:hidden;">

                            <?php if ($photoFile !== '') { ?>
                                <img src="../../../Resources/Photos/<?php echo htmlspecialchars($photoFile); ?>" alt="Profile" style="width:120px;height:120px;object-fit:cover;">
                            <?php } else { ?>
                                <span class="initials"><?php echo htmlspecialchars($initials); ?></span>
                            <?php } ?>

                            <!-- Upload profile picture -->
                            <form action="../../../Controllers/UserController.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="action" value="upload_profile_photo">

                                <!-- Hidden file input -->
                                <input id="profilePhotoInput" type="file" name="photo" accept="image/*" style="display:none" onchange="this.form.submit()" required>

                                <!-- Camera button opens file chooser -->
                                <label for="profilePhotoInput" class="pic-btn" title="Upload Profile Photo">
                                    <img src="../../../Resources/Photos/camera.png" alt="Upload" class="btn-icon">
                                </label>
                            </form>

                        </div>
                    </div>

                    <!-- Profile Info -->
                    <div class="profile-info">
                        <h2><?php echo htmlspecialchars($full_name); ?></h2>
                        <p class="speciality"><?php echo htmlspecialchars($division); ?></p>
                        <p class="user-bio"><?php echo htmlspecialchars($address); ?></p>

                        <!-- Stats -->
                        <div class="stats">
                            <div class="stat-item">
                                <span class="stat-number"><?php echo $postCount; ?></span>
                                <span class="stat-label">Posts</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">0</span>
                                <span class="stat-label">Followers</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">0</span>
                                <span class="stat-label">Following</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">

                    <button class="btn btn-primary" onclick="alert('Edit Profile will be available later');">
                        <img src="../../../Resources/Photos/edit.png" alt="Edit" class="btn-icon"> Edit Profile
                    </button>

                    <!-- Upload Photos -->
                    <form action="../../../Controllers/UserController.php" method="POST" enctype="multipart/form-data" style="display:inline;">
                        <input type="hidden" name="action" value="upload_profile_photo">
                        <input id="uploadPhotosInput" type="file" name="photo" accept="image/*" style="display:none" onchange="this.form.submit()" required>
                        <label for="uploadPhotosInput" class="btn" style="cursor:pointer;">
                            <img src="../../../Resources/Photos/photoup.png" alt="Photos" class="btn-icon"> Upload Photos
                        </label>
                    </form>

                    <!-- Upload Videos-->
                    <form method="POST" style="display:inline;">
                        <button class="btn" type="submit" name="video">
                            <img src="../../../Resources/Photos/videoup.png" alt="Videos" class="btn-icon"> Upload Videos
                        </button>
                    </form>

                    <!-- Go Live -->
                    <form method="POST" style="display:inline;">
                        <button class="btn btn-live" type="submit" name="live">
                            <img src="../../../Resources/Photos/live.png" alt="Live" class="btn-icon"> Go Live
                        </button>
                    </form>

                </div>
            </div>

            <!-- Contact Section -->
            <div class="contact-section">
                <h3>Contact & Location</h3>

                <div class="contact-grid">
                    <div class="contact-item">
                        <img src="../../../Resources/Photos/role.png" alt="Role" class="contact-icon">
                        <div>
                            <p class="contact-label">Role</p>
                            <p class="contact-value">User</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <img src="../../../Resources/Photos/location.png" alt="Location" class="contact-icon">
                        <div>
                            <p class="contact-label">Location</p>
                            <p class="contact-value"><?php echo htmlspecialchars($division); ?>, <?php echo htmlspecialchars($postal_code); ?></p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <img src="../../../Resources/Photos/email.png" alt="Email" class="contact-icon">
                        <div>
                            <p class="contact-label">Email</p>
                            <a href="mailto:<?php echo htmlspecialchars($email); ?>" class="contact-value">
                                <?php echo htmlspecialchars($email); ?>
                            </a>
                        </div>
                    </div>

                    <div class="contact-item">
                        <img src="../../../Resources/Photos/phone.png" alt="Phone" class="contact-icon">
                        <div>
                            <p class="contact-label">Phone</p>
                            <a href="tel:<?php echo htmlspecialchars($phone); ?>" class="contact-value">
                                <?php echo htmlspecialchars($phone); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="content-section">
                <h3>User Content</h3>

                <!-- Create Post -->
                <div style="margin: 15px 0;">
                    <form action="../../../Controllers/PostController.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="create_post">
                        <input type="hidden" name="redirect" value="../Views/Auth/User/profile.php">

                        <textarea name="content" rows="3" placeholder="Write something..." style="width:100%; padding:10px; border-radius:6px; border:1px solid rgb(68, 68, 68); background:rgb(26, 26, 26); color:white;" required></textarea>
                        <div style="display:flex; gap:10px; flex-wrap:wrap; margin-top:10px;">
                            <input type="file" name="photo" accept="image/*" style="color:rgb(204, 204, 204);">
                            <button class="btn btn-primary" type="submit">Post</button>
                        </div>
                    </form>
                </div>

                <!-- Filter Buttons -->
                <div class="filter-buttons">
                    <button class="filter-btn active" type="button">All Content</button>
                    <button class="filter-btn" type="button">Photos</button>
                    <button class="filter-btn" type="button">Videos</button>
                </div>

                <!-- Posts Grid -->
                <div class="posts-grid">

                    <?php if ($posts_res && mysqli_num_rows($posts_res) > 0) { ?>
                        <?php while ($p = mysqli_fetch_assoc($posts_res)) { ?>

                            <?php
                                $pPhoto = $p['photo'] ?? '';
                                $hasPhoto = ($pPhoto !== '' && file_exists(__DIR__ . '/../../../Resources/Photos/' . $pPhoto));
                                $type = $hasPhoto ? 'photo' : 'all';
                                $title = $p['content'] ?? '';
                                if (strlen($title) > 28) { $title = substr($title, 0, 28) . '...'; }
                            ?>

                            <div class="post-card" data-type="<?php echo $type; ?>">
                                <div class="post-image">

                                    <?php if ($hasPhoto) { ?>
                                        <img src="../../../Resources/Photos/<?php echo htmlspecialchars($pPhoto); ?>" alt="Post" style="width:100%; height:100%; object-fit:cover;">
                                    <?php } else { ?>
                                        <div class="post-placeholder">
                                            <p>Post</p>
                                        </div>
                                    <?php } ?>

                                    <button class="delete-btn" type="button" onclick="alert('Delete will be available later');">
                                        <img src="../../../Resources/Photos/delete.png" alt="Delete" class="delete-icon">
                                    </button>
                                </div>
                                <div class="post-info">
                                    <h4><?php echo htmlspecialchars($title); ?></h4>
                                    <div class="post-meta">
                                        <span>Status: <?php echo htmlspecialchars($p['status'] ?? ''); ?></span>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>
                    <?php } else { ?>

                        <!-- if no posts -->
                        <div class="post-card" data-type="photo">
                            <div class="post-image">
                                <div class="post-placeholder">
                                    <p>No posts yet</p>
                                </div>
                            </div>
                            <div class="post-info">
                                <h4>Start posting</h4>
                                <div class="post-meta">
                                    <span>0 likes</span>
                                </div>
                            </div>
                        </div>

                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</body>
</html>
