<?php
// index.php - Expose360 Landing Page
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expose360 - Secure Crime Reporting Platform</title>
    <link rel="stylesheet" href="Views/CSS/home.css">
</head>
<body>
    <!-- Navigation Header -->
    <header class="header">
        <div class="container">
            <nav class="navbar">
                <!-- Logo -->
                <div class="logo">
                    <h1>Expose<span class="logo-number">360</span></h1>
                    <p class="tagline">Truth Through Technology</p>
                </div>
                
                <!-- Main Navigation -->
                <div class="nav-menu">
                    <a href="#home" class="nav-link active">Home</a>
                    <a href="#how-it-works" class="nav-link">How It Works</a>
                    <a href="#footer" class="nav-link">Contact</a>
                </div>
                
                <!-- Auth Buttons -->
                <div class="auth-buttons">
                    <a href="Views/Auth/Auth/login.php" class="btn btn-login">Login</a>
                    <a href="Views/Auth/Auth/register.php" class="btn btn-signup">Sign Up</a>
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h2 class="hero-title">Secure Crime & Corruption Reporting Platform</h2>
                    <p class="hero-subtitle">Expose the truth while preventing fake news and AI-generated misinformation</p>
                    
                    <div class="hero-buttons">
                        <a href="Views/Auth/Auth/register.php" class="btn btn-primary">Report Incident</a>
                        <a href="#how-it-works" class="btn btn-secondary">Learn More</a>
                    </div>
                </div>
                
                <div class="hero-image">
                    <div class="image-placeholder">
                        <div class="shield-icon">🛡️</div>
                        <h3>Secure & Verified Reporting</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <h2 class="section-title">Key Features</h2>
            
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">📱</div>
                    <h3>Easy Reporting</h3>
                    <p>Report crime, corruption, and public safety issues with text, photos, or videos</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">✅</div>
                    <h3>AI Verification</h3>
                    <p>Advanced verification system to detect fake or AI-generated content</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">🔒</div>
                    <h3>Secure Platform</h3>
                    <p>TOON integration ensures data integrity and prevents tampering</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">👥</div>
                    <h3>Three-Tier System</h3>
                    <p>Separate interfaces for Users, Admins, and Verification Employees</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="how-it-works" id="how-it-works">
        <div class="container">
            <h2 class="section-title">How It Works</h2>
            
            <div class="steps">
                <div class="step">
                    <div class="step-number">1</div>
                    <h3>Register & Login</h3>
                    <p>Create your secure account with email verification</p>
                </div>
                
                <div class="step">
                    <div class="step-number">2</div>
                    <h3>Submit Report</h3>
                    <p>Upload incident details with supporting evidence</p>
                </div>
                
                <div class="step">
                    <div class="step-number">3</div>
                    <h3>Verification</h3>
                    <p>Our system checks for authenticity and AI-generated content</p>
                </div>
                
                <div class="step">
                    <div class="step-number">4</div>
                    <h3>Publication</h3>
                    <p>Verified reports are published with TOON security tokens</p>
                </div>
            </div>
        </div>
    </section>

    <!-- User Types Section -->
    <section class="user-types">
        <div class="container">
            <h2 class="section-title">Platform User Types</h2>
            
            <div class="user-cards">
                <div class="user-card">
                    <h3>Users</h3>
                    <ul>
                        <li>Register and create account</li>
                        <li>Submit crime reports</li>
                        <li>Edit published posts</li>
                        <li>Delete own account</li>
                    </ul>
                </div>
                
                <div class="user-card">
                    <h3>Admins</h3>
                    <ul>
                        <li>Manage all user accounts</li>
                        <li>Add/remove employees</li>
                        <li>Content verification control</li>
                        <li>System management</li>
                    </ul>
                </div>
                
                <div class="user-card">
                    <h3>Employees</h3>
                    <ul>
                        <li>Added by admins only</li>
                        <li>Offline verification tasks</li>
                        <li>Manual content review</li>
                        <li>No login access</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <section class="footer" id="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Expose360</h3>
                    <p>A secure platform for reporting and verifying crime and corruption incidents while combating misinformation.</p>
                </div>
                
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <a href="#home">Home</a>
                    <a href="Views/Auth/Auth/login.php">Login</a>
                    <a href="Views/Auth/Auth/register.php">Register</a>
                    <a href="Views/contribution.php">About Us</a>
                </div>
                
                <div class="contact-section">
                    <h3>Contact</h3>
                    <p>23-50010-1@student.aiub.com</p>
                    <p>23-50666-1@student.aiub.com</p>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; Expose360. Department of Computer Science - Web Technologies Project.</p>
            </div>
        </div>
    </section>
</body>
</html>