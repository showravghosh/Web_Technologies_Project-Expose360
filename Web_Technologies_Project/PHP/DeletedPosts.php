<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Deleted Posts | Expose360</title>
    <link rel="stylesheet" href="../CSS/DeletedPosts.css">
</head>

<body>

<!-- TOP BAR -->
<header class="topbar">
    <div class="left-section">
        <img src="../Photos/logo.png" class="logo">
        <h1 class="highlight">Expose<span>360</span></h1>

        <div class="search-box">
            <input type="text" placeholder="Search by name">
            <img src="../Photos/search.png" class="search-icon">
        </div>
    </div>

    <nav class="right-section">
        <button class="icon-btn">
            <img src="../Photos/back.png" class="nav-icon">
        </button>
        <button class="icon-btn">
            <img src="../Photos/home.png" class="nav-icon">
        </button>
    </nav>
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
                <img src="../Photos/like.png" class="small-icon"> 42
            </span>

            <span class="stat">
                <img src="../Photos/comment.png" class="small-icon"> 12
            </span>

            <span class="stat">
                <img src="../Photos/share.png" class="small-icon"> 8
            </span>

            <button class="restore-btn">
                <img src="../Photos/restore.png" class="small-icon"> Restore
            </button>
        </div>

    </div>

    <div class="empty-box">
        <img src="../Photos/search.png" class="empty-icon">
        <p>No deleted posts found</p>
    </div>

</main>

</body>
</html>
