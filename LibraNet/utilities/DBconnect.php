<?php
    class DBconnect {
        private $host;
        private $user;
        private $password;
        private $database;
        private $conn;

        public function __construct($host, $user, $password, $database) {
            $this->host = $host;
            $this->user = $user;
            $this->password = $password;
            $this->database = $database;

            try {
                $this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->user, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                throw new Exception("Connection failed: " . $e->getMessage());
            }
        }

        public function getConnection() {
            return $this->conn;
        }
        
    }
?>


