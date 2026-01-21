<?php
require_once 'Database.php';

class Post {
    private $conn;
    private $postTable = 'posts';

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function createPost($userId, $content, $photoName = '') {
        $userId = (int)$userId;
        $content = mysqli_real_escape_string($this->conn, $content);
        $photoName = mysqli_real_escape_string($this->conn, $photoName);

        if ($content === '') {
            return false;
        }

        $sql = "INSERT INTO {$this->postTable} (user_id, content, photo, status, is_visible)
                VALUES ($userId, '$content', '$photoName', 'Pending', 'Yes')";
                $ok = mysqli_query($this->conn, $sql);
        if ($ok) {
            return mysqli_insert_id($this->conn);
        }
        return false;
    }

    public function getFeedPosts($search = '') {
        $search = mysqli_real_escape_string($this->conn, $search);
        $whereSearch = '';
        if ($search !== '') {
            $whereSearch = " AND (u.full_name LIKE '%$search%' OR u.email LIKE '%$search%' OR p.content LIKE '%$search%')";
        }

        $sql = "SELECT p.*, u.full_name, u.email
                FROM {$this->postTable} p
                INNER JOIN user_account u ON u.id = p.user_id
                WHERE p.status='Approved' AND p.is_visible='Yes' AND u.status <> 'Deleted' $whereSearch
                ORDER BY p.post_id DESC";

        $result = mysqli_query($this->conn, $sql);
        $rows = [];
        if ($result) {
            while ($r = mysqli_fetch_assoc($result)) {
                $rows[] = $r;
            }
        }
        return $rows;
    }

    public function getPendingPosts($search = '') {
        $search = mysqli_real_escape_string($this->conn, $search);
        $whereSearch = '';
        if ($search !== '') {
            $whereSearch = " AND (u.full_name LIKE '%$search%' OR u.email LIKE '%$search%' OR p.content LIKE '%$search%')";
        }

        $sql = "SELECT p.*, u.full_name, u.email
                FROM {$this->postTable} p
                INNER JOIN user_account u ON u.id = p.user_id
                WHERE p.status='Pending' AND u.status <> 'Deleted' $whereSearch
                ORDER BY p.post_id DESC";

        $result = mysqli_query($this->conn, $sql);
        $rows = [];
        if ($result) {
            while ($r = mysqli_fetch_assoc($result)) {
                $rows[] = $r;
            }
        }
        return $rows;
    }

    public function getApprovedPosts($search = '') {
        $search = mysqli_real_escape_string($this->conn, $search);
        $whereSearch = '';
        if ($search !== '') {
            $whereSearch = " AND (u.full_name LIKE '%$search%' OR u.email LIKE '%$search%' OR p.content LIKE '%$search%')";
        }

        $sql = "SELECT p.*, u.full_name, u.email
                FROM {$this->postTable} p
                INNER JOIN user_account u ON u.id = p.user_id
                WHERE p.status='Approved' AND u.status <> 'Deleted' $whereSearch
                ORDER BY p.post_id DESC";

        $result = mysqli_query($this->conn, $sql);
        $rows = [];
        if ($result) {
            while ($r = mysqli_fetch_assoc($result)) {
                $rows[] = $r;
            }
        }
        return $rows;
    }

    // Deleted status
    public function updateStatus($postId, $status) {
        $postId = (int)$postId;
        $status = mysqli_real_escape_string($this->conn, $status);

        if ($status !== 'Approved' && $status !== 'Rejected' && $status !== 'Pending' && $status !== 'Deleted') {
            return false;
        }

        $sql = "UPDATE {$this->postTable} SET status='$status' WHERE post_id=$postId";
                $ok = mysqli_query($this->conn, $sql);
        if ($ok) {
            return mysqli_insert_id($this->conn);
        }
        return false;
    }

    public function setVisibility($postId, $isVisible) {
        $postId = (int)$postId;
        $isVisible = mysqli_real_escape_string($this->conn, $isVisible);

        if ($isVisible !== 'Yes' && $isVisible !== 'No') {
            return false;
        }

        $sql = "UPDATE {$this->postTable} SET is_visible='$isVisible' WHERE post_id=$postId";
                $ok = mysqli_query($this->conn, $sql);
        if ($ok) {
            return mysqli_insert_id($this->conn);
        }
        return false;
    }

    public function getPendingVerificationRequests($limit = 10)
{
    $conn = Database::getInstance()->getConnection();

    $sql = "
        SELECT
            vr.id,
            vr.user_id,
            vr.user_gmail,
            vr.request_type,
            vr.priority,
            vr.status,
            vr.request_at,
            p.post_id,
            p.content
        FROM verification_req vr
        JOIN posts p ON p.post_id = vr.post_id
        WHERE vr.status = 'Pending'
        ORDER BY vr.id DESC
        LIMIT ?
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $limit);
    $stmt->execute();

    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
}
?>
