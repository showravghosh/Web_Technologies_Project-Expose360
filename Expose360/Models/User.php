<?php
require_once 'Database.php';


class User {
    private $conn;
    private $table = "user_account";

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    // Register new user 
    public function register($data) {

        $full_name   = $data['full_name'] ?? '';
        $birth_date  = $data['birth_date'] ?? '';
        $address     = $data['address'] ?? '';
        $division    = $data['division'] ?? '';
        $postal_code = $data['postal_code'] ?? '';
        $phone       = $data['phone'] ?? '';
        $email       = $data['email'] ?? '';
        $password    = $data['password'] ?? '';
        $gender      = $data['gender'] ?? '';
        $photo       = $data['photo'] ?? '';
        $document    = $data['document'] ?? '';

        $full_name   = mysqli_real_escape_string($this->conn, $full_name);
        $birth_date  = mysqli_real_escape_string($this->conn, $birth_date);
        $address     = mysqli_real_escape_string($this->conn, $address);
        $division    = mysqli_real_escape_string($this->conn, $division);
        $postal_code = mysqli_real_escape_string($this->conn, $postal_code);
        $phone       = mysqli_real_escape_string($this->conn, $phone);
        $email       = mysqli_real_escape_string($this->conn, $email);
        $password    = mysqli_real_escape_string($this->conn, $password);
        $gender      = mysqli_real_escape_string($this->conn, $gender);
        $photo       = mysqli_real_escape_string($this->conn, $photo);
        $document    = mysqli_real_escape_string($this->conn, $document);

        $sql = "INSERT INTO {$this->table} 
                (full_name, birth_date, address, division, postal_code, phone, email, password, gender, photo, document)
                VALUES
                ('$full_name', '$birth_date', '$address', '$division', '$postal_code', '$phone', '$email', '$password', '$gender', '$photo', '$document')";

        return mysqli_query($this->conn, $sql);
    }

    // Login user
    public function login($emailOrPhone, $password) {
        $emailOrPhone = mysqli_real_escape_string($this->conn, $emailOrPhone);
        $password     = mysqli_real_escape_string($this->conn, $password);

        $sql = "SELECT * FROM {$this->table}
                WHERE (email='$emailOrPhone' OR phone='$emailOrPhone')
                AND password='$password'
                AND status='Active'
                LIMIT 1";

        $result = mysqli_query($this->conn, $sql);
        if ($result && mysqli_num_rows($result) === 1) {
            return mysqli_fetch_assoc($result);
        }
        return false;
    }

    // Login check (returns user even if Inactive, but not Deleted)
    public function loginAnyStatus($emailOrPhone, $password) {
        $emailOrPhone = mysqli_real_escape_string($this->conn, $emailOrPhone);
        $password     = mysqli_real_escape_string($this->conn, $password);

        $sql = "SELECT * FROM {$this->table}
                WHERE (email='$emailOrPhone' OR phone='$emailOrPhone')
                AND password='$password'
                AND status <> 'Deleted'
                LIMIT 1";

        $result = mysqli_query($this->conn, $sql);
        if ($result && mysqli_num_rows($result) === 1) {
            return mysqli_fetch_assoc($result);
        }
        return false;
    }

    public function checkEmail($email) {
        $email = mysqli_real_escape_string($this->conn, $email);
        $sql = "SELECT id FROM {$this->table} WHERE email='$email' LIMIT 1";
        $result = mysqli_query($this->conn, $sql);
        return ($result && mysqli_num_rows($result) > 0);
    }

    public function getAllUsers() {
        $sql = "SELECT * FROM {$this->table} WHERE status <> 'Deleted' ORDER BY id DESC";
        $result = mysqli_query($this->conn, $sql);
        $rows = [];
        if ($result) {
            while ($r = mysqli_fetch_assoc($result)) {
                $rows[] = $r;
            }
        }
        return $rows;
    }

    public function deleteUser($id) {
        $id = (int)$id;

        // Move to deleted_user table
        $sqlMove = "INSERT INTO deleted_user
                    (id, full_name, birth_date, address, division, postal_code, phone, email, gender, photo, document)
                    SELECT id, full_name, birth_date, address, division, postal_code, phone, email, gender, photo, document
                    FROM {$this->table}
                    WHERE id=$id LIMIT 1";
        mysqli_query($this->conn, $sqlMove);

        // Soft delete
        $sql = "UPDATE {$this->table} SET status='Deleted' WHERE id=$id";
        return mysqli_query($this->conn, $sql);
    }

    public function deleteAllUsers() {
        // Move all active users to deleted_user
        $sqlMove = "INSERT INTO deleted_user
                    (id, full_name, birth_date, address, division, postal_code, phone, email, gender, photo, document)
                    SELECT id, full_name, birth_date, address, division, postal_code, phone, email, gender, photo, document
                    FROM {$this->table}
                    WHERE status <> 'Deleted'";
        mysqli_query($this->conn, $sqlMove);

        // Soft delete all
        $sql = "UPDATE {$this->table} SET status='Deleted' WHERE status <> 'Deleted'";
        return mysqli_query($this->conn, $sql);
    }

    public function updatePasswordByEmail($email, $newPassword) {
        $email = mysqli_real_escape_string($this->conn, $email);
        $newPassword = mysqli_real_escape_string($this->conn, $newPassword);
        $sql = "UPDATE {$this->table} SET password='$newPassword' WHERE email='$email'";
        return mysqli_query($this->conn, $sql);
    }

    


    // Update status (Active/Inactive)
    public function updateStatus($id, $status) {
        $id = (int)$id;
        if ($status !== 'Active' && $status !== 'Inactive') {
            return false;
        }
        $status = mysqli_real_escape_string($this->conn, $status);
        $sql = "UPDATE {$this->table} SET status='$status' WHERE id=$id";
        return mysqli_query($this->conn, $sql);
    }
}

?>
