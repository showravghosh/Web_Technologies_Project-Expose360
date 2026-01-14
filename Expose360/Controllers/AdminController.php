<?php
session_start();
require_once '../models/Admin.php';
require_once '../models/User.php';

class AdminController {
    private $adminModel;
    private $userModel;

    public function __construct() {
        $this->adminModel = new Admin($_SESSION['user_id'] ?? null);
        $this->userModel = new User();
    }

    // Check if user is admin
    private function checkAdminAccess() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header('Location: ../views/auth/login.php');
            exit();
        }
    }

    // Display dashboard
    public function dashboard() {
        $this->checkAdminAccess();

        $stats = $this->adminModel->getDashboardStats();
        $recentActivities = $this->adminModel->getRecentActivities();
        $categoryStats = $this->adminModel->getCategoryStats();
        $monthlyGrowth = $this->adminModel->getMonthlyGrowth();

        // Get admin profile
        $adminProfile = $this->userModel->getUserById($_SESSION['user_id']);

        include '../views/admin/dashboard.php';
    }

    // Get dashboard data via AJAX
    public function getDashboardData() {
        $this->checkAdminAccess();

        $response = [];

        // Get stats
        $stats = $this->adminModel->getDashboardStats();
        if ($stats['success']) {
            $response['stats'] = $stats['data'];
        }

        // Get recent activities
        $activities = $this->adminModel->getRecentActivities();
        if ($activities['success']) {
            $response['activities'] = $activities['data'];
        }

        // Get category stats
        $categories = $this->adminModel->getCategoryStats();
        if ($categories['success']) {
            $response['categories'] = $categories['data'];
        }

        // Get monthly growth
        $growth = $this->adminModel->getMonthlyGrowth();
        if ($growth['success']) {
            $response['growth'] = $growth['data'];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    // Logout
    public function logout() {
        session_destroy();
        header('Location: ../views/auth/login.php');
        exit();
    }
}

// Handle requests
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_GET['action'] ?? 'dashboard';
    $controller = new AdminController();

    switch ($action) {
        case 'dashboard':
            $controller->dashboard();
            break;
        case 'getData':
            $controller->getDashboardData();
            break;
        case 'logout':
            $controller->logout();
            break;
        default:
            $controller->dashboard();
    }
}
?>