<?php
    class DBConnection{
        private $connection;

        public function __construct()
        {
            require_once("app/config//config.php");
            $this->connection= new mysql(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
            if($this->Connection->connect_error){
                die("Error al conectar a la base de datos : " . $this->Connection->connect_error);
            }
        }

        public function getConnection(){
            return $this->Connection;
        }
    
        public function closeConnection(){
            $this->Connection->close();
        }
    }
?>