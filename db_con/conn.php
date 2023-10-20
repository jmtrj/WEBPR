<?php
class Database
{
    private $host = 'localhost';
    private $dbname = 'dbtest';
    private $username = 'root';
    private $password = '';
    private $conn;
    public function __construct()
    {
        $dsn = "mysql:host={$this->host};dbname={$this->dbname}";
        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

        try {
            $this->conn = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
}

$db = new Database();
$conn = $db->getConnection();