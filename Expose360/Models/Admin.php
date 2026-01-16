<?php
require_once 'Database.php';

class Admin {
    private $db;
    private $userId;

    public function __construct($userId = null) {
        $this->db = Database::getInstance()->getConnection();
        $this->userId = $userId;
    }

    // Get dashboard statistics
    public function getDashboardStats() {
        try {
            $stats = [];

            // Total users count
            $stmt = $this->db->prepare("SELECT COUNT(*) as total_users FROM users WHERE role = 'user'");
            $stmt->execute();
            $stats['total_users'] = $stmt->fetch(PDO::FETCH_ASSOC)['total_users'];

            // Total admins count
            $stmt = $this->db->prepare("SELECT COUNT(*) as total_admins FROM users WHERE role = 'admin'");
            $stmt->execute();
            $stats['total_admins'] = $stmt->fetch(PDO::FETCH_ASSOC)['total_admins'];

            // Total employees count
            $stmt = $this->db->prepare("SELECT COUNT(*) as total_employees FROM users WHERE role = 'employee'");
            $stmt->execute();
            $stats['total_employees'] = $stmt->fetch(PDO::FETCH_ASSOC)['total_employees'];

            // Total posts count
            $stmt = $this->db->prepare("SELECT COUNT(*) as total_posts FROM posts");
            $stmt->execute();
            $stats['total_posts'] = $stmt->fetch(PDO::FETCH_ASSOC)['total_posts'];

            // Pending posts count
            $stmt = $this->db->prepare("SELECT COUNT(*) as pending_posts FROM posts WHERE status = 'pending'");
            $stmt->execute();
            $stats['pending_posts'] = $stmt->fetch(PDO::FETCH_ASSOC)['pending_posts'];

            // Approved posts count
            $stmt = $this->db->prepare("SELECT COUNT(*) as approved_posts FROM posts WHERE status = 'approved'");
            $stmt->execute();
            $stats['approved_posts'] = $stmt->fetch(PDO::FETCH_ASSOC)['approved_posts'];

            // Rejected posts count
            $stmt = $this->db->prepare("SELECT COUNT(*) as rejected_posts FROM posts WHERE status = 'rejected'");
            $stmt->execute();
            $stats['rejected_posts'] = $stmt->fetch(PDO::FETCH_ASSOC)['rejected_posts'];

            // Total contributions count
            $stmt = $this->db->prepare("SELECT COUNT(*) as total_contributions FROM contributions");
            $stmt->execute();
            $stats['total_contributions'] = $stmt->fetch(PDO::FETCH_ASSOC)['total_contributions'];

            return [
                'success' => true,
                'data' => $stats
            ];
        } catch (PDOException $e) {
            return [
                'success' => false,
                'error' => 'Failed to fetch dashboard statistics: ' . $e->getMessage()
            ];
        }
    }

    // Get recent activities
    public function getRecentActivities($limit = 10) {
        try {
            $query = "
                SELECT 
                    'post' as type,
                    p.title,
                    p.created_at as date,
                    u.username as user,
                    p.status
                FROM posts p
                JOIN users u ON p.user_id = u.id
                UNION ALL
                SELECT 
                    'user' as type,
                    CONCAT('New ', u.role) as title,
                    u.created_at as date,
                    u.username as user,
                    'active' as status
                FROM users u
                ORDER BY date DESC
                LIMIT :limit
            ";

            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            
            return [
                'success' => true,
                'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)
            ];
        } catch (PDOException $e) {
            return [
                'success' => false,
                'error' => 'Failed to fetch recent activities: ' . $e->getMessage()
            ];
        }
    }

    // Get category-wise post distribution
    public function getCategoryStats() {
        try {
            $query = "
                SELECT 
                    category,
                    COUNT(*) as count,
                    (COUNT(*) * 100.0 / (SELECT COUNT(*) FROM posts)) as percentage
                FROM posts 
                WHERE status = 'approved'
                GROUP BY category
                ORDER BY count DESC
            ";

            $stmt = $this->db->prepare($query);
            $stmt->execute();
            
            return [
                'success' => true,
                'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)
            ];
        } catch (PDOException $e) {
            return [
                'success' => false,
                'error' => 'Failed to fetch category statistics: ' . $e->getMessage()
            ];
        }
    }

    // Get monthly post growth
    public function getMonthlyGrowth($months = 6) {
        try {
            $query = "
                SELECT 
                    DATE_FORMAT(created_at, '%Y-%m') as month,
                    COUNT(*) as post_count
                FROM posts
                WHERE created_at >= DATE_SUB(NOW(), INTERVAL :months MONTH)
                GROUP BY DATE_FORMAT(created_at, '%Y-%m')
                ORDER BY month
            ";

            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':months', $months, PDO::PARAM_INT);
            $stmt->execute();
            
            return [
                'success' => true,
                'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)
            ];
        } catch (PDOException $e) {
            return [
                'success' => false,
                'error' => 'Failed to fetch monthly growth: ' . $e->getMessage()
            ];
        }
    }
}
?>