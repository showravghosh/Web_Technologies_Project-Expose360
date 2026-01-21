<?php

class Database {
    private static $instance = null;
    private $conn = null;

    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db   = "expose360_db";

    private function __construct() {
        $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
        if (!$this->conn) {
            die("Database connection failed: " . mysqli_connect_error());
        }
        mysqli_set_charset($this->conn, "utf8mb4");
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }

    public function esc($value) {
        return mysqli_real_escape_string($this->conn, $value);
    }
}

?>
