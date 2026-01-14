<?php
require_once 'Database.php';

class User {
    private $conn;
    private $table = "users";
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    
    // Register new user with MD5 password
    public function register($full_name, $email, $phone, $password) {
        $query = "INSERT INTO " . $this->table . " 
                 (full_name, email, phone, password) 
                 VALUES (:full_name, :email, :phone, MD5(:password))";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":full_name", $full_name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":password", $password);
        
        return $stmt->execute();
    }
    
    // Login user with MD5 password
    public function login($email, $password) {
        $query = "SELECT * FROM " . $this->table . " 
                 WHERE email = :email AND password = MD5(:password)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Check if email exists
    public function checkEmail($email) {
        $query = "SELECT id FROM " . $this->table . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
}
?>