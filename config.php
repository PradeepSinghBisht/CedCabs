<?php 
    class Dbconnection {
        function __construct() {
            $this->conn = new mysqli("localhost", "root", "root", "CedCabs"); 
            if ($this->conn->connect_error) {
                die("connection failed " . $this->conn->connect_error);
            }
        }       
    }
?>