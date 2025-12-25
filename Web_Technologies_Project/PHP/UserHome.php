<?php



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Home | Expose360</title>
    <link rel="stylesheet" href="../CSS/UserHome.css">
</head>

<body>

    <!-- TOP BAR -->
    <header class="topbar">
        <div class="left-section">
            <img src="../Photos/logo.png" class="logo">
            <h1 class="highlight">Expose<span>360</span></h1>

            <div class="search-box">
                <input type="text" placeholder="Search">
                <img src="../Photos/search.png" class="search-icon">
            </div>
        </div>

        <nav class="right-section">
            <button class="icon-btn"><a href="Login.php" class="home-btn"><img src="../Photos/home.png" class="nav-icon"></a></button>
            <button class="icon-btn"><img src="../Photos/bell.png" class="nav-icon"></button>
            <button class="icon-btn"><img src="../Photos/message.png" class="nav-icon"></button>

            <!-- PROFILE HOVER DROPDOWN -->
            <div class="profile-container">
                <button class="profile-btn">
                    <img src="profile.png" class="profileh">
                    <span class="profile-name">Showrav Ghosh</span>
                </button>

                <div class="profile-menu">
                    <a href="#">Settings</a>
                    <a href="#">Profile Page</a>
                    <div class="divider"></div>
                    <a href="#" class="logout">Logout</a>
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
                        <img src="../Photos/upload.png" class="small-icon"> Upload Photos
                    </button>

                    <button class="np-icon-btn live">
                        <img src="../Photos/live.png" class="small-icon"> Go Live
                    </button>
                </div>

                <button class="post-btn">
                    Post <img src="../Photos/post.png" class="post-icon">
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
                    <img src="../Photos/dots.png" class="dots-icon">
                </button>
            </div>

            <p class="post-text">Post content next time update</p>

            <div class="post-actions">
                <button class="post-act-btn">
                    <img src="../Photos/like.png" class="small-icon"> Likes
                </button>

                <button class="post-act-btn">
                    <img src="../Photos/comment.png" class="small-icon"> Comments
                </button>

                 <button class="post-act-btn">
                    <img src="../Photos/share.png" class="small-icon"> Share
                </button>
                
            </div>
            
        </div>


        <div class="load-more-wrap">
            <button class="load-more">Load More Posts</button>
        </div>

    </main>

</body>
</html>
