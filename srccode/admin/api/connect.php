<?php
    class DBconnect{
        private $dbName = "laptrinhweb_db";
        private $server = "localhost";
        private $userName = "root";
        private $password = "";
        public function connect(){
            try{
                $conn = new PDO("mysql:host=$this->server; dbname=$this->dbName", $this->userName, $this->password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conn;
            } catch (PDOException $e){
                echo "Connection failed: " . $e->getMessage();
            }
        }
    }
    // echo "Connected successfully";
?>