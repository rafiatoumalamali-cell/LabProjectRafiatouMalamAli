<?php
class Database {
    private $host;
    private $db_name;
    private $username;
    private $password;
    public $conn;

    public function __construct() {
        // Load environment variables
        $env_file = __DIR__ . '/../.env';
        if (file_exists($env_file)) {
            $env_vars = parse_ini_file($env_file);
            $this->host = $env_vars['DB_HOST'] ?? 'localhost';
            $this->db_name = $env_vars['DB_NAME'] ?? 'webtech_2025A_rafiatou_ali';
            $this->username = $env_vars['DB_USER'] ?? 'root';
            $this->password = $env_vars['DB_PASS'] ?? '';
        } else {
            // Fallback to default values
            $this->host = 'localhost';
            $this->db_name = 'webtech_2025A_rafiatou_ali';
            $this->username = 'root';
            $this->password = '';
        }
    }

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name, 
                $this->username, 
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>