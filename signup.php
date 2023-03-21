<?php

require_once("database.php");

class Register {
    var $g_email = "1";
    var $g_password = "2";
    var $g_proname = "3";
  
    function setReg(){
        $email = $_POST['uname1'];
        $password = $_POST['pswd1'];
        $proname = $_POST['pname1'];

        $this->g_email = $email;
        $this->g_password = $password;
        $this->g_proname = $proname;
    }
  
    function Reg(){
        $querycheck = "SELECT * FROM Usernames WHERE email = '$this->g_email';";
        $response = $this->g_conn->query($querycheck);
    
        if($response->rowCount() > 0){
            
            echo "User exist.";
            header("Location: warning.php");

        }
        else{ 

            $queryinsert = "INSERT INTO Usernames(email, password, profileName) VALUES ('$this->g_email', '$this->g_password', '$this->g_proname');";
            $insert = $this->g_conn->query($queryinsert);
            header("Location: index.html");
        }
    }  
}


$db = new Dbconn();
$db->setDb();
$db->openConnection();
$reg = new Register();
$reg->g_conn=$db->g_conn;
$reg->setReg();
$reg->Reg();


?>















