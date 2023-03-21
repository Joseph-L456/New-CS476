<?php

require_once("database.php");

class DestroyS {

	function sessionDes(){

        session_start();

        if(isset($_SESSION))
        {
            unset($_SESSION);
        
       
        session_destroy();
           
        $pdo = null;
    
       header("Location: index.html");
       sleep(1);
       exit();
    }
	}
}
  
  $db = new Dbconn();
  $db->setDb();
  $db->openConnection();
  $logout = new DestroyS();
  $logout->sessionDes();


?>



