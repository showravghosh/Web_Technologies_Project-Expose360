<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbName = "expose360_db";
$port = 3306;

function dbConnect()
{
    global $host, $user, $pass, $dbName, $port;
    $conn = mysqli_connect($host, $user, $pass, $dbName, $port);
    
    if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

function createDatabase()
{
    global $host, $user, $pass, $port;
    $conn = mysqli_connect($host, $user, $pass, "", $port);
    
    if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $sql = "CREATE DATABASE IF NOT EXISTS expose360_db";
    if(mysqli_query($conn, $sql)) {
        echo "Database created successfully<br>";
    } else {
        echo "Error creating database: " . mysqli_error($conn) . "<br>";
    }
    mysqli_close($conn);
}

function createTables()
{
    $conn = dbConnect();
    
    // 1. USERS TABLE
    $sql_users = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        phone VARCHAR(20) UNIQUE,
        password_hash VARCHAR(255) NOT NULL,
        status ENUM('active', 'inactive') DEFAULT 'active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    $sql_admins = "CREATE TABLE IF NOT EXISTS admins (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        phone VARCHAR(20) UNIQUE,
        password_hash VARCHAR(255) NOT NULL,
        is_master BOOLEAN DEFAULT FALSE,
        status ENUM('active', 'inactive') DEFAULT 'active',
        created_by INT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (created_by) REFERENCES admins(id) ON DELETE SET NULL
    )";
    
    $sql_employees = "CREATE TABLE IF NOT EXISTS employees (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        phone VARCHAR(20) UNIQUE,
        status ENUM('active', 'inactive') DEFAULT 'active',
        assigned_by INT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (assigned_by) REFERENCES admins(id) ON DELETE CASCADE
    )";
    
    $sql_posts = "CREATE TABLE IF NOT EXISTS posts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        title VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        category ENUM('crime', 'corruption', 'public_safety') NOT NULL,
        verification_status ENUM('pending', 'verified', 'rejected') DEFAULT 'pending',
        is_published BOOLEAN DEFAULT FALSE,
        is_deleted BOOLEAN DEFAULT FALSE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )";
    
    $sql_post_media = "CREATE TABLE IF NOT EXISTS post_media (
        id INT AUTO_INCREMENT PRIMARY KEY,
        post_id INT NOT NULL,
        media_type ENUM('photo', 'video', 'live') NOT NULL,
        file_path VARCHAR(500) NOT NULL,
        verification_status ENUM('pending', 'verified', 'rejected') DEFAULT 'pending',
        ai_check_result ENUM('real', 'ai_generated', 'uncertain') DEFAULT 'uncertain',
        is_duplicate BOOLEAN DEFAULT FALSE,
        uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
    )";
    
    $sql_verification_logs = "CREATE TABLE IF NOT EXISTS verification_logs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        media_id INT NOT NULL,
        verified_by VARCHAR(100),
        verification_method ENUM('ai_api', 'ml_model', 'manual', 'duplicate_check') NOT NULL,
        result ENUM('passed', 'failed') NOT NULL,
        notes TEXT,
        verified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (media_id) REFERENCES post_media(id) ON DELETE CASCADE
    )";
    
    $sql_toon_tokens = "CREATE TABLE IF NOT EXISTS toon_tokens (
        id INT AUTO_INCREMENT PRIMARY KEY,
        token_id VARCHAR(255) UNIQUE NOT NULL,
        post_id INT NOT NULL,
        user_id INT NOT NULL,
        content_hash VARCHAR(255) NOT NULL,
        is_immutable BOOLEAN DEFAULT TRUE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )";
    
    $sql_otp_requests = "CREATE TABLE IF NOT EXISTS otp_requests (
        id INT AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(100) NOT NULL,
        otp_code VARCHAR(6) NOT NULL,
        expires_at DATETIME NOT NULL,
        is_used BOOLEAN DEFAULT FALSE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    $sql_deleted_users = "CREATE TABLE IF NOT EXISTS deleted_users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        original_id INT NOT NULL,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        phone VARCHAR(20),
        password_hash VARCHAR(255) NOT NULL,
        status VARCHAR(20),
        deleted_by INT NOT NULL,
        deleted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        can_restore BOOLEAN DEFAULT TRUE,
        original_created_at TIMESTAMP
    )";
    
    $sql_deleted_admins = "CREATE TABLE IF NOT EXISTS deleted_admins (
        id INT AUTO_INCREMENT PRIMARY KEY,
        original_id INT NOT NULL,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        phone VARCHAR(20),
        password_hash VARCHAR(255) NOT NULL,
        is_master BOOLEAN,
        status VARCHAR(20),
        created_by INT,
        deleted_by INT NOT NULL,
        deleted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        can_restore BOOLEAN DEFAULT TRUE,
        original_created_at TIMESTAMP
    )";
    
    $sql_deleted_employees = "CREATE TABLE IF NOT EXISTS deleted_employees (
        id INT AUTO_INCREMENT PRIMARY KEY,
        original_id INT NOT NULL,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        phone VARCHAR(20),
        status VARCHAR(20),
        assigned_by INT,
        deleted_by INT NOT NULL,
        deleted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        can_restore BOOLEAN DEFAULT TRUE,
        original_created_at TIMESTAMP
    )";
    
    $sql_post_edits = "CREATE TABLE IF NOT EXISTS post_edits (
        id INT AUTO_INCREMENT PRIMARY KEY,
        post_id INT NOT NULL,
        user_id INT NOT NULL,
        field_changed VARCHAR(50) NOT NULL,
        old_value TEXT,
        new_value TEXT,
        edited_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )";
    
    $tables = [
        'users' => $sql_users,
        'admins' => $sql_admins,
        'employees' => $sql_employees,
        'posts' => $sql_posts,
        'post_media' => $sql_post_media,
        'verification_logs' => $sql_verification_logs,
        'toon_tokens' => $sql_toon_tokens,
        'otp_requests' => $sql_otp_requests,
        'deleted_users' => $sql_deleted_users,
        'deleted_admins' => $sql_deleted_admins,
        'deleted_employees' => $sql_deleted_employees,
        'post_edits' => $sql_post_edits
    ];
    
    foreach($tables as $table_name => $sql) {
        if(mysqli_query($conn, $sql)) {
            echo "Table '$table_name' created successfully<br>";
        } else {
            echo "Error creating table '$table_name': " . mysqli_error($conn) . "<br>";
        }
    }
    
    mysqli_close($conn);
}

function insertSampleData()
{
    $conn = dbConnect();

    $password = password_hash("admin123", PASSWORD_DEFAULT);
    $query = "INSERT INTO admins (name, email, phone, password_hash, is_master, status) 
              VALUES ('Master Admin', 'admin@expose360.com', '01700000000', '$password', TRUE, 'active')";
    
    if(mysqli_query($conn, $query)) {
        echo "Master Admin created successfully<br>";
        echo "Email: admin@expose360.com<br>";
        echo "Password: admin123<br><br>";
    } else {
        echo "Error creating master admin: " . mysqli_error($conn) . "<br>";
    }
    
    $password = password_hash("user123", PASSWORD_DEFAULT);
    $query = "INSERT INTO users (name, email, phone, password_hash, status) 
              VALUES ('Test User', 'user@test.com', '01800000000', '$password', 'active')";
    
    if(mysqli_query($conn, $query)) {
        echo "Sample User created successfully<br>";
        echo "Email: user@test.com<br>";
        echo "Password: user123<br>";
    } else {
        echo "Error creating sample user: " . mysqli_error($conn) . "<br>";
    }
    
    mysqli_close($conn);
}

function fetchAllUsers()
{
    $query = "SELECT * FROM users WHERE status='active'";
    $conn = dbConnect();
    $data = mysqli_query($conn, $query);
    
    echo "<h3>Active Users</h3>";
    if(mysqli_num_rows($data) > 0) {
        echo "<table border='1' cellpadding='10'>
              <tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Status</th><th>Created At</th></tr>";
        
        while($row = mysqli_fetch_assoc($data)) {
            echo "<tr>
                  <td>{$row['id']}</td>
                  <td>{$row['name']}</td>
                  <td>{$row['email']}</td>
                  <td>{$row['phone']}</td>
                  <td>{$row['status']}</td>
                  <td>{$row['created_at']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No users found<br>";
    }
    
    mysqli_close($conn);
}

function fetchAllAdmins()
{
    $query = "SELECT * FROM admins WHERE status='active'";
    $conn = dbConnect();
    $data = mysqli_query($conn, $query);
    
    echo "<h3>Active Admins</h3>";
    if(mysqli_num_rows($data) > 0) {
        echo "<table border='1' cellpadding='10'>
              <tr><th>ID</th><th>Name</th><th>Email</th><th>Master</th><th>Status</th><th>Created At</th></tr>";
        
        while($row = mysqli_fetch_assoc($data)) {
            $is_master = $row['is_master'] ? 'Yes' : 'No';
            echo "<tr>
                  <td>{$row['id']}</td>
                  <td>{$row['name']}</td>
                  <td>{$row['email']}</td>
                  <td>{$is_master}</td>
                  <td>{$row['status']}</td>
                  <td>{$row['created_at']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No admins found<br>";
    }
    
    mysqli_close($conn);
}

function softDeleteUser($user_id, $admin_id)
{
    $conn = dbConnect();
    
    $query = "SELECT * FROM users WHERE id = $user_id";
    $result = mysqli_query($conn, $query);
    
    if($user = mysqli_fetch_assoc($result)) {

        $insert = "INSERT INTO deleted_users (original_id, name, email, phone, password_hash, status, deleted_by, original_created_at) 
                   VALUES ({$user['id']}, '{$user['name']}', '{$user['email']}', '{$user['phone']}', 
                           '{$user['password_hash']}', '{$user['status']}', $admin_id, '{$user['created_at']}')";
        
        if(mysqli_query($conn, $insert)) {
           
            $delete = "DELETE FROM users WHERE id = $user_id";
            mysqli_query($conn, $delete);
            echo "User deleted successfully (moved to deleted_users)<br>";
        }
    }
    
    mysqli_close($conn);
}

function restoreUser($deleted_user_id)
{
    $conn = dbConnect();
    
    $query = "SELECT * FROM deleted_users WHERE id = $deleted_user_id AND can_restore = TRUE";
    $result = mysqli_query($conn, $query);
    
    if($user = mysqli_fetch_assoc($result)) {
        
        $insert = "INSERT INTO users (name, email, phone, password_hash, status, created_at) 
                   VALUES ('{$user['name']}', '{$user['email']}', '{$user['phone']}', 
                           '{$user['password_hash']}', 'active', '{$user['original_created_at']}')";
        
        if(mysqli_query($conn, $insert)) {
            
            $delete = "DELETE FROM deleted_users WHERE id = $deleted_user_id";
            mysqli_query($conn, $delete);
            echo "User restored successfully<br>";
        }
    }
    
    mysqli_close($conn);
}

echo "<h2>Expose360 Database Setup</h2>";
echo "<hr>";

createDatabase();
echo "<hr>";

createTables();
echo "<hr>";

insertSampleData();
echo "<hr>";

fetchAllAdmins();
echo "<br>";
fetchAllUsers();

?>
