<?php
// Empty PHP section - add database code here
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Profile - Expose360</title>
    <link rel="stylesheet" href="../../CSS/User/profile.css">
</head>
<body> 
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
                <button class="nav-btn logout-btn" title="Logout" onclick="window.location.href='../Auth/login.php'">
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
                <button class="cover-btn" onclick="uploadCover()">
                    <img src="../../../Resources/Photos/camera.png" alt="Upload" class="btn-icon"> Upload Cover
                </button>
            </div>
            
            <!-- Profile Header -->
            <div class="profile-header">
                <div class="profile-top">
                    <!-- Profile Picture -->
                    <div class="profile-pic-section">
                        <div class="profile-pic">
                            <span class="initials">JD</span>
                            <button class="pic-btn" onclick="uploadProfilePic()">
                                <img src="../../../Resources/Photos/camera.png" alt="Upload" class="btn-icon">
                            </button>
                        </div>
                    </div>
                    
                    <!-- Profile Info -->
                    <div class="profile-info">
                        <h2>John Doe</h2>
                        <p class="speciality">Creative Director & Photographer</p>
                        <p class="user-bio">Passionate about sustainable urban development and creative photography.</p>
                        
                        <!-- Stats -->
                        <div class="stats">
                            <div class="stat-item">
                                <span class="stat-number">78</span>
                                <span class="stat-label">Posts</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">1.2k</span>
                                <span class="stat-label">Followers</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">348</span>
                                <span class="stat-label">Following</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button class="btn btn-primary" onclick="editProfile()">
                        <img src="../../../Resources/Photos/edit.png" alt="Edit" class="btn-icon"> Edit Profile
                    </button>
                    <button class="btn" onclick="uploadPhotos()">
                        <img src="../../../Resources/Photos/photoup.png" alt="Photos" class="btn-icon"> Upload Photos
                    </button>
                    <button class="btn" onclick="uploadVideos()">
                        <img src="../../../Resources/Photos/videoup.png" alt="Videos" class="btn-icon"> Upload Videos
                    </button>
                    <button class="btn btn-live" onclick="goLive()">
                        <img src="../../../Resources/Photos/live.png" alt="Live" class="btn-icon"> Go Live
                    </button>
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
                            <p class="contact-value">Creative Director</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <img src="../../../Resources/Photos/location.png" alt="Location" class="contact-icon">
                        <div>
                            <p class="contact-label">Location</p>
                            <p class="contact-value">Dhaka Division, 1000</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <img src="../../../Resources/Photos/email.png" alt="Email" class="contact-icon">
                        <div>
                            <p class="contact-label">Email</p>
                            <a href="mailto:john.doe@expose360.com" class="contact-value">
                                john.doe@expose360.com
                            </a>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <img src="../../../Resources/Photos/phone.png" alt="Phone" class="contact-icon">
                        <div>
                            <p class="contact-label">Phone</p>
                            <a href="tel:+8801712345678" class="contact-value">
                                +880 17 1234 5678
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Content Section -->
            <div class="content-section">
                <h3>User Content</h3>
                
                <!-- Filter Buttons -->
                <div class="filter-buttons">
                    <button class="filter-btn active" onclick="filterContent('all')">All Content</button>
                    <button class="filter-btn" onclick="filterContent('photo')">Photos</button>
                    <button class="filter-btn" onclick="filterContent('video')">Videos</button>
                </div>
                
                <!-- Posts Grid -->
                <div class="posts-grid">
                    <div class="post-card" data-type="photo">
                        <div class="post-image">
                            <div class="post-placeholder">
                                <p>Photo 1</p>
                            </div>
                            <button class="delete-btn" onclick="deletePost(1)">
                                <img src="../../../Resources/Photos/delete.png" alt="Delete" class="delete-icon">
                            </button>
                        </div>
                        <div class="post-info">
                            <h4>Sunset View</h4>
                            <div class="post-meta">
                                <span>45 likes</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="post-card" data-type="video">
                        <div class="post-image">
                            <div class="post-placeholder">
                                <p>Video 1</p>
                            </div>
                            <button class="delete-btn" onclick="deletePost(2)">
                                <img src="../../../Resources/Photos/delete.png" alt="Delete" class="delete-icon">
                            </button>
                        </div>
                        <div class="post-info">
                            <h4>City Tour</h4>
                            <div class="post-meta">
                                <span>128 likes</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="post-card" data-type="photo">
                        <div class="post-image">
                            <div class="post-placeholder">
                                <p>Photo 2</p>
                            </div>
                            <button class="delete-btn" onclick="deletePost(3)">
                                <img src="../../../Resources/Photos/delete.png" alt="Delete" class="delete-icon">
                            </button>
                        </div>
                        <div class="post-info">
                            <h4>Portrait Session</h4>
                            <div class="post-meta">
                                <span>67 likes</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="post-card" data-type="photo">
                        <div class="post-image">
                            <div class="post-placeholder">
                                <p>Photo 3</p>
                            </div>
                            <button class="delete-btn" onclick="deletePost(4)">
                                <img src="../../../Resources/Photos/delete.png" alt="Delete" class="delete-icon">
                            </button>
                        </div>
                        <div class="post-info">
                            <h4>Nature Walk</h4>
                            <div class="post-meta">
                                <span>89 likes</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>