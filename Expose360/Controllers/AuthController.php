<?php
require_once '../models/User.php';
require_once '../models/Admin.php';

class AuthController {
    
    // Handle user registration
    // In the handleRegister() method, add more validation:

// Update the handleRegister method in AuthController.php

public function handleRegister() {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get and sanitize inputs
        $full_name = trim($_POST['full_name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $password = $_POST['password'] ?? '';
        
        // Validate inputs
        $errors = [];
        
        // Validate full name
        if(empty($full_name)) {
            $errors[] = "Full name is required";
        } elseif(strlen($full_name) < 2) {
            $errors[] = "Full name must be at least 2 characters";
        } elseif(strlen($full_name) > 100) {
            $errors[] = "Full name cannot exceed 100 characters";
        }
        
        // Validate email
        if(empty($email)) {
            $errors[] = "Email is required";
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Please enter a valid email address";
        } elseif(strlen($email) > 100) {
            $errors[] = "Email cannot exceed 100 characters";
        }
        
        // Validate phone (optional)
        if(!empty($phone) && strlen($phone) > 20) {
            $errors[] = "Phone number cannot exceed 20 characters";
        }
        
        // Validate password
        if(empty($password)) {
            $errors[] = "Password is required";
        } elseif(strlen($password) < 8) {
            $errors[] = "Password must be at least 8 characters";
        }
        
        // If there are validation errors
        if(!empty($errors)) {
            echo json_encode([
                "success" => false,
                "message" => implode("<br>", $errors)
            ]);
            return;
        }
        
        // Create User model instance
        $user = new User();
        
        // Check if email already exists
        if($user->checkEmail($email)) {
            echo json_encode([
                "success" => false,
                "message" => "This email is already registered. Please use a different email or login."
            ]);
            return;
        }
        
        // Attempt to register user
        try {
            if($user->register($full_name, $email, $phone, $password)) {
                echo json_encode([
                    "success" => true,
                    "message" => "Registration successful! You will be redirected to login page."
                ]);
            } else {
                echo json_encode([
                    "success" => false,
                    "message" => "Registration failed due to server error. Please try again."
                ]);
            }
        } catch(Exception $e) {
            echo json_encode([
                "success" => false,
                "message" => "An error occurred during registration. Please try again."
            ]);
        }
    }
}
    
    // Handle user login
    public function handleUserLogin() {
        session_start();
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $user = new User();
            $result = $user->login($email, $password);
            
            if($result) {
                $_SESSION['user_id'] = $result['id'];
                $_SESSION['user_name'] = $result['full_name'];
                $_SESSION['user_email'] = $result['email'];
                $_SESSION['role'] = 'user';
                
                echo json_encode(array(
                    "success" => true,
                    "message" => "Login successful",
                    "redirect" => "index.php?page=user_dashboard"
                ));
            } else {
                echo json_encode(array(
                    "success" => false,
                    "message" => "Invalid email or password"
                ));
            }
        }
    }
    
    // Handle admin login
    public function handleAdminLogin() {
        session_start();
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $admin = new Admin();
            $result = $admin->login($email, $password);
            
            if($result) {
                $_SESSION['admin_id'] = $result['id'];
                $_SESSION['admin_name'] = $result['full_name'];
                $_SESSION['admin_email'] = $result['email'];
                $_SESSION['role'] = 'admin';
                
                echo json_encode(array(
                    "success" => true,
                    "message" => "Admin login successful",
                    "redirect" => "index.php?page=admin_dashboard"
                ));
            } else {
                echo json_encode(array(
                    "success" => false,
                    "message" => "Invalid admin credentials"
                ));
            }
        }
    }
}
?>