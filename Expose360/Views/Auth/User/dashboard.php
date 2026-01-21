<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header('Location: ../Auth/login.php');
    exit();
}


require_once '../../../Models/Post.php';
$postModel = new Post();
$feedPosts = $postModel->getFeedPosts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Home | Expose360</title>
    <link rel="stylesheet" href="../../CSS/User/dashboard.css">
</head>

<body>

    <!-- TOP BAR -->
    <header class="topbar">
        <div class="left-section">
            <img src="../../../Resources/Photos/logo.png" class="logo">
            <h1 class="highlight">Expose<span>360</span></h1>

            <div class="search-box">
                <input type="text" placeholder="Search">
                <img src="../../../Resources/Photos/search.png" class="search-icon">
            </div>
        </div>

        <nav class="right-section">
            <button class="icon-btn"><a href="dashboard.php" class="home-btn"><img src="../../../Resources/Photos/homei.png" class="nav-icon"></a></button>


            <!-- PROFILE HOVER DROPDOWN -->
            <div class="profile-container" id="profileContainer">
                <button class="profile-btn" id="profileBtn">
                    <img src="../../../Resources/Photos/user.png" class="profileh">
                    <span class="profile-name"><?php echo $_SESSION['user_name'] ?? ''; ?></span>
                </button>

                <div class="profile-menu" id="profileMenu">
                    <a href="profile.php">Profile Page</a>
                    <a href="../../../Controllers/AuthController.php?action=logout" class="logout">Logout</a>
                </div>
            </div>
        </nav>
    </header>


    <main class="content">

        <h2 class="feed-title">Home Feed</h2>

        <!-- NEW POST BOX -->
        <form method="POST" action="../../../Controllers/PostController.php" enctype="multipart/form-data">
        <input type="hidden" name="action" value="create_post">
        <div class="new-post-box">
            <p class="np-title">What's on your mind ?</p>

            <textarea name="content" placeholder="Start typing your post..." rows="3"></textarea>

            <div class="np-actions">
                <div class="np-left">
                    <button class="np-icon-btn">
                        <input type="file" name="photo" class="photo"></input>
                        <img src="../../../Resources/Photos/upload.png" class="small-icon"> Upload Photos
                    </button>

                    <button class="np-icon-btn live">
                        <img src="../../../Resources/Photos/live.png" class="small-icon"> Go Live
                    </button>
                </div>

                <button class="post-btn" type="submit">
                    Post <img src="../../../Resources/Photos/post.png" class="post-icon">
                </button>
            </div>
        </div>
    </form>

        <?php if (count($feedPosts) == 0) { ?>
            <div class="post-card">
                <p class="post-text" style="text-align:center;">No approved posts yet.</p>
            </div>
        <?php } ?>

        <?php foreach ($feedPosts as $p) { ?>
            <div class="post-card">
                <div class="post-top">
                    <div class="post-user">
                        <div class="avatar"><?php echo strtoupper(substr($p['full_name'], 0, 2)); ?></div>
                        <div>
                            <p class="u-name"><?php echo htmlspecialchars($p['full_name']); ?></p>
                            <p class="u-time"><?php echo htmlspecialchars($p['created_at']); ?></p>
                        </div>
                    </div>

                    <button class="dots-btn">
                        <img src="../../../Resources/Photos/dots.png" class="dots-icon">
                    </button>
                </div>

                <p class="post-text"><?php echo nl2br(htmlspecialchars($p['content'])); ?></p>

                <?php if (!empty($p['photo'])) { ?>
                    <div style="margin-top:10px;">
                        <img src="../../../Upload/Photos/<?php echo htmlspecialchars($p['photo']); ?>" style="max-width:100%; border-radius:10px;">
                    </div>
                <?php } ?>

                <div class="post-actions">
                    <button class="post-act-btn">
                        <img src="../../../Resources/Photos/like.png" class="small-icon"> Likes
                    </button>

                    <button class="post-act-btn">
                        <img src="../../../Resources/Photos/comment.png" class="small-icon"> Comments
                    </button>

                     <button class="post-act-btn">
                        <img src="../../../Resources/Photos/share.png" class="small-icon"> Share
                    </button>
                </div>
            </div>
        <?php } ?>


        <div class="load-more-wrap">
            <button class="load-more">Load More Posts</button>
        </div>

    </main>

    <script>
        const profileContainer = document.getElementById('profileContainer');
        const profileMenu = document.getElementById('profileMenu');
        const profileBtn = document.getElementById('profileBtn');
        
        let isMenuLocked = false;
        let hoverTimeout;
        
        // Function to show menu
        function showMenu() {
            profileMenu.style.display = 'flex';
        }
        
        // Function to hide menu
        function hideMenu() {
            if (!isMenuLocked) {
                profileMenu.style.display = 'none';
            }
        }
        
        // Hover to show menu
        profileContainer.addEventListener('mouseenter', function() {
            clearTimeout(hoverTimeout);
            showMenu();
        });
        
        // Hover to hide menu 
        profileContainer.addEventListener('mouseleave', function(e) {
            // Only hide if mouse leaves the entire container
            if (!e.relatedTarget || !profileContainer.contains(e.relatedTarget)) {
                hoverTimeout = setTimeout(function() {
                    hideMenu();
                }, 300); // Small delay
            }
        });
        
        // Click to lock/unlock menu
        profileBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            
            if (isMenuLocked) {
                // If already locked, unlock and hide
                isMenuLocked = false;
                profileMenu.style.display = 'none';
            } else {
                // If not locked, lock it and show
                isMenuLocked = true;
                showMenu();
            }
        });
        
        // Keep menu open when clicking inside menu
        profileMenu.addEventListener('click', function(e) {
            e.stopPropagation();
            isMenuLocked = true;
        });
        
        // Click outside to close locked menu
        document.addEventListener('click', function(e) {
            if (isMenuLocked && !profileContainer.contains(e.target)) {
                isMenuLocked = false;
                profileMenu.style.display = 'none';
            }
        });

        // Create post and avoids reload on submit
        var postForm = document.querySelector('form input[name="action"][value="create_post"]');
        if (postForm) {
            var mainForm = postForm.closest('form');
            if (mainForm) {
                mainForm.addEventListener('submit', function(e){
                    e.preventDefault();
                    var fd = new FormData(mainForm);
                    fd.append('action', 'create_post');
                    fetch('../../../Controllers/AjaxController.php', { method: 'POST', body: fd })
                        .then(function(r){ return r.json(); })
                        .then(function(data){
                            if (data.ok) {
                                location.href = 'dashboard.php?posted=1';
                            } else {
                                alert(data.message || 'Failed');
                            }
                        })
                        .catch(function(){ alert('Failed'); });
                });
            }
        }
    </script>
</body>
</html>