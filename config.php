<?php 
    class Database {

        private $host = "localhost";
        private $database_name = "masterqu_intranet";
        private $username = "masterqu_admin";
        private $password = "MASTER.2020";
        private $conn;

        public function connect(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $exception){
                echo "Database could not be connected: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }  

    class DatabasePed {
        private $host = "localhost";
        private $database_name = "masterqu_pedidos";
        private $username = "masterqu_admin";
        private $password = "MASTER.2020";

        public $connPed;

        public function getConnection(){
            $this->connPed = null;
            try{
                $this->connPed = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $exception){
                echo "Database could not be connected: " . $exception->getMessage();
            }
            return $this->connPed;
        }
    }
?>