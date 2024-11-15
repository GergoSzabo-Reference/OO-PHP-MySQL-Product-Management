<?php
    class Database{
        private $host = "localhost";
        private $dbName = "product_management";
        private $username = "";
        private $password = "";
        public $conn;

        public function getConnection(){
            $this->conn = null;

            try{
                $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->username, $this->password); # connects to sql
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); # better error handling
                $this->createTable(); # tries to create a table
            
            } catch (PDOException $e){
                echo "Connection Error: " . $e->getMessage();
            }
            return $this->conn;
        }

        public function createTable(){
            $query = "CREATE TABLE IF NOT EXISTS products (
                id INT(16) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(256) NOT NULL,
                price DECIMAL(16,2) NOT NULL,
                description VARCHAR(256) NOT NULL
            )";

            try {
                $this->conn->exec($query);
                echo "Table created successfully";

            } catch (PDOException $e){
                echo "Error while creating table: " . $e->getMessage();
            }
        }
    }

?>