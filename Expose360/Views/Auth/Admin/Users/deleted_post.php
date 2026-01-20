<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Deleted Posts | Expose360</title>
    <link rel="stylesheet" href="../../../CSS/Admin/Users/deleted_post.css">
</head>

<body>

<!-- TOP BAR -->
<header class="topbar">
    <div class="left-section">
        <img src="../../../../Resources/Photos/logo.png" class="logo">
        <h1 class="highlight">Expose<span>360</span></h1>

        <div class="search-box">
            <input type="text" placeholder="Search by name">
            <img src="../../../../Resources/Photos/search.png" class="search-icon">
        </div>
    </div>

   <div class="nav-buttons">
        <button class="btn back" onclick="history.back()">
            <img src="../../../../Resources/Photos/back.png" class="btn-icon"> Back
        </button>

        <button class="btn home" onclick ="location.href='../dashboard.php'">
            <img src="../../../../Resources/Photos/homei.png" class="btn-icon"> Home
        </button>
    </div>
</header>

<main class="content">

    <h2 class="feed-title">Deleted Posts Archive</h2>

    <!-- POST CARD -->
    <div class="post-card">

        <div class="post-top">
            <div class="post-user">
                <div class="avatar">SG</div>
                <div>
                    <p class="u-name">Showrav Ghosh</p>
                    <p class="u-time">Deleted on 2023-11-24 14:30</p>
                    <span class="delete-status user">Deleted by User</span>
                </div>
            </div>
        </div>

        <p class="post-text">
            Initial project drafts for the Expose360.
        </p>

        <div class="post-actions">
            <span class="stat">
                <img src="../../../../Resources/Photos/like.png" class="small-icon"> 42
            </span>

            <span class="stat">
                <img src="../../../../Resources/Photos/comment.png" class="small-icon"> 12
            </span>

            <span class="stat">
                <img src="../../../../Resources/Photos/share.png" class="small-icon"> 8
            </span>

            <button class="restore-btn">
                <img src="../../../../Resources/Photos/restore.png" class="small-icon"> Restore
            </button>
        </div>

    </div>

    <div class="empty-box">
        <img src="../../../../Resources/Photos/search.png" class="empty-icon">
        <p>No deleted posts found</p>
    </div>

</main>

</body>
</html>
