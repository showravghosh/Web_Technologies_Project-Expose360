<?php
require_once 'Database.php';


class Admin {
    private $conn;
    private $adminTable = "admin_account";
    private $empTable   = "emp_account";  
    private $verTable   = "verification_req";

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    //  Admin login (simple)
    public function login($email, $password) {
        $email    = mysqli_real_escape_string($this->conn, $email);
        $password = mysqli_real_escape_string($this->conn, $password);

        $sql = "SELECT * FROM {$this->adminTable}
                WHERE email='$email' AND password='$password'
                AND status='Active'
                LIMIT 1";

        $result = mysqli_query($this->conn, $sql);
        if ($result && mysqli_num_rows($result) === 1) {
            return mysqli_fetch_assoc($result);
        }
        return false;
    }


    // Login check (returns admin even if Inactive, but not Deleted)
    public function loginAnyStatus($email, $password) {
        $email    = mysqli_real_escape_string($this->conn, $email);
        $password = mysqli_real_escape_string($this->conn, $password);

        $sql = "SELECT * FROM {$this->adminTable}
                WHERE email='$email' AND password='$password'
                AND status <> 'Deleted'
                LIMIT 1";

        $result = mysqli_query($this->conn, $sql);
        if ($result && mysqli_num_rows($result) === 1) {
            return mysqli_fetch_assoc($result);
        }
        return false;
    }

    public function registerAdmin($data) {
        $full_name = mysqli_real_escape_string($this->conn, $data['full_name'] ?? '');
        $email     = mysqli_real_escape_string($this->conn, $data['email'] ?? '');
        $phone     = mysqli_real_escape_string($this->conn, $data['phone'] ?? '');
        $gender    = mysqli_real_escape_string($this->conn, $data['gender'] ?? 'Other');
        $password  = mysqli_real_escape_string($this->conn, $data['password'] ?? '');
        $role      = mysqli_real_escape_string($this->conn, $data['role'] ?? 'Admin');

        $sql = "INSERT INTO {$this->adminTable} (full_name, email, phone, gender, password, role)
                VALUES ('$full_name', '$email', '$phone', '$gender', '$password', '$role')";
        return mysqli_query($this->conn, $sql);
    }

    public function getAllAdmins() {
        $sql = "SELECT * FROM {$this->adminTable} WHERE status <> 'Deleted' ORDER BY admin_id DESC";
        $result = mysqli_query($this->conn, $sql);
        $rows = [];
        if ($result) {
            while ($r = mysqli_fetch_assoc($result)) {
                $rows[] = $r;
            }
        }
        return $rows;
    }

    public function deleteAdmin($id) {
        $id = (int)$id;

        // Move to deleted_admin
        $sqlMove = "INSERT INTO deleted_admin (admin_id, full_name, email, phone, gender, password, role)
                    SELECT admin_id, full_name, email, phone, gender, password, role
                    FROM {$this->adminTable}
                    WHERE admin_id=$id LIMIT 1";
        mysqli_query($this->conn, $sqlMove);

        // Soft delete
        $sql = "UPDATE {$this->adminTable} SET status='Deleted' WHERE admin_id=$id";
        return mysqli_query($this->conn, $sql);
    }

    public function getAllEmployees() {
        $sql = "SELECT * FROM {$this->empTable} WHERE status <> 'Deleted' ORDER BY emp_id DESC";
        $result = mysqli_query($this->conn, $sql);
        $rows = [];
        if ($result) {
            while ($r = mysqli_fetch_assoc($result)) {
                $rows[] = $r;
            }
        }
        return $rows;
    }

    public function addEmployee($data) {
        $full_name   = mysqli_real_escape_string($this->conn, $data['full_name'] ?? '');
        $date_joined = mysqli_real_escape_string($this->conn, $data['date_joined'] ?? '');
        $salary      = mysqli_real_escape_string($this->conn, $data['salary'] ?? '0');
        $gender      = mysqli_real_escape_string($this->conn, $data['gender'] ?? 'Other');
        $phone      = mysqli_real_escape_string($this->conn, $data['phone'] ?? '');

        $sql = "INSERT INTO {$this->empTable} (full_name, date_joined, salary, gender, phone)
                VALUES ('$full_name', '$date_joined', '$salary', '$gender', '$phone')";
        return mysqli_query($this->conn, $sql);
    }

    public function deleteEmployee($id) {
        $id = (int)$id;

        $sqlMove = "INSERT INTO deleted_emp (emp_id, full_name, date_joined, salary, gender, phone)
                    SELECT emp_id, full_name, date_joined, salary, gender, phone
                    FROM {$this->empTable}
                    WHERE emp_id=$id LIMIT 1";
        mysqli_query($this->conn, $sqlMove);

        $sql = "UPDATE {$this->empTable} SET status='Deleted' WHERE emp_id=$id";
        return mysqli_query($this->conn, $sql);
    }

    // Update employee
    public function updateEmployee($id, $data) {
        $id = (int)$id;
        if ($id <= 0) {
            return false;
        }

        $full_name   = mysqli_real_escape_string($this->conn, $data['full_name'] ?? '');
        $date_joined = mysqli_real_escape_string($this->conn, $data['date_joined'] ?? '');
        $salary      = mysqli_real_escape_string($this->conn, $data['salary'] ?? '0');
        $gender      = mysqli_real_escape_string($this->conn, $data['gender'] ?? 'Other');
        $phone       = mysqli_real_escape_string($this->conn, $data['phone'] ?? '');

        $sql = "UPDATE {$this->empTable} SET full_name='$full_name', date_joined='$date_joined', salary='$salary', gender='$gender', phone='$phone' WHERE emp_id=$id";
        return mysqli_query($this->conn, $sql);
    }


    // Update admin status (Active/Inactive)
    public function updateStatus($id, $status) {
        $id = (int)$id;
        if ($status !== 'Active' && $status !== 'Inactive') {
            return false;
        }
        $status = mysqli_real_escape_string($this->conn, $status);
        $sql = "UPDATE {$this->adminTable} SET status='$status' WHERE admin_id=$id";
        return mysqli_query($this->conn, $sql);
    }

    public function getVerificationRequests() {
        $sql = "SELECT * FROM {$this->verTable} ORDER BY request_at DESC";
        $result = mysqli_query($this->conn, $sql);
        $rows = [];
        if ($result) {
            while ($r = mysqli_fetch_assoc($result)) {
                $rows[] = $r;
            }
        }
        return $rows;
    }

    public function updateVerificationStatus($id, $status) {
        $id = (int)$id;
        $status = mysqli_real_escape_string($this->conn, $status);
        $sql = "UPDATE {$this->verTable} SET status='$status' WHERE id=$id";
        return mysqli_query($this->conn, $sql);
    }
}
?>
