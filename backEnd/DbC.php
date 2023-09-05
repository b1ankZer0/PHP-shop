<?php
class sql{
    private $host="localhost";
    private $username="root";
    private $password="";
    private $db="wd-my";

    public function connect(){
        
        $conn = new mysqli($this->host,$this->username,$this->password,$this->db);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return($conn);
    }
    
}
?>