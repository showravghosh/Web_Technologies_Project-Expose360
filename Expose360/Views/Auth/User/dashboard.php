<?php



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
            <button class="icon-btn"><a href="dashboard.php" class="home-btn"><img src="../../../Resources/Photos/home.png" class="nav-icon"></a></button>
            <button class="icon-btn"><img src="../../../Resources/Photos/bell.png" class="nav-icon"></button>
            <button class="icon-btn"><img src="../../../Resources/Photos/message.png" class="nav-icon"></button>

            <!-- PROFILE HOVER DROPDOWN -->
            <div class="profile-container" id="profileContainer">
                <button class="profile-btn" id="profileBtn">
                    <img src="../../../Resources/Photos/user.png" class="profileh">
                    <span class="profile-name"></span>
                </button>

                <div class="profile-menu" id="profileMenu">
                    <a href="profile.php">Profile Page</a>
                    <a href="../Auth/login.php" class="logout">Logout</a>
                </div>
            </div>
        </nav>
    </header>


    <main class="content">

        <h2 class="feed-title">Home Feed</h2>

        <!-- NEW POST BOX -->
        <div class="new-post-box">
            <p class="np-title">What's on your mind ?</p>

            <textarea placeholder="Start typing your post..." rows="3"></textarea>

            <div class="np-actions">
                <div class="np-left">
                    <button class="np-icon-btn">
                        <input type="file" class="photo"></input>
                        <img src="../../../Resources/Photos/upload.png" class="small-icon"> Upload Photos
                    </button>

                    <button class="np-icon-btn live">
                        <img src="../../../Resources/Photos/live.png" class="small-icon"> Go Live
                    </button>
                </div>

                <button class="post-btn">
                    Post <img src="../../../Resources/Photos/post.png" class="post-icon">
                </button>
            </div>
        </div>

        <!-- EMPTY POST CARD -->
        <div class="post-card">
            <div class="post-top">
                <div class="post-user">
                    <div class="avatar">SG</div>
                    <div>
                        <p class="u-name">User Name</p>
                        <p class="u-time">Time</p>
                    </div>
                </div>

                <button class="dots-btn">
                    <img src="../../../Resources/Photos/dots.png" class="dots-icon">
                </button>
            </div>

            <p class="post-text">Post content next time update</p>

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
        
        // Hover to hide menu (with delay)
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
    </script>
</body>
</html>