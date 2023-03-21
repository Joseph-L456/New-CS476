<?php

require_once("database.php");


class Update {
    var $g_profileName = "g_password";
    var $g_userid = "rewq";

  
    function setProf(){
        session_start();
        $proname = $_SESSION["name_of_user"];
        $userid = $_SESSION["user_id"];
        $this->g_profileName = $proname;
        $this->g_userid = $userid;

    }
    function genPage(){
        $fp=fopen("Updateprofile.html","r");
        $str=fread($fp,filesize("Updateprofile.html"));
        $str=str_replace("{profileName}",$this->g_profileName,$str);
        $str=str_replace("{userID}",$this->g_userid,$str);




        fclose($fp);
        $handle = fopen('Updateprofile1.html',"w");
        fwrite($handle,$str);
        fclose($handle);
        header("Location: Updateprofile1.html"); 
    }
}




$db = new Dbconn();
$db->setDb();
$db->openConnection();
$upd = new Update();
$upd->g_conn=$db->g_conn;
$upd->setProf();
$upd->genPage();




?>















