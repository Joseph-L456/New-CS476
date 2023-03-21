<?php

require_once("database.php");


class Upload {
    var $g_profileName = "g_password";
    var $g_userid = "rewq";

  
    function setProf(){
        session_start();
        $proname = $_SESSION["name_of_user"];
        $userid = $_SESSION["user_id"];

        $pfselect = "SELECT Usernames.uid, Usernames.profileName FROM Usernames WHERE uid = '$userid'";
        $pfresult = $this->g_conn->query($pfselect);
        $row = $pfresult->fetch();

        $this->g_userid = $userid;
        $this->g_profileName = $row["profileName"];

    }
    function genPage(){
        $fp=fopen("uploadartwork.html","r");
        $str=fread($fp,filesize("uploadartwork.html"));
        $str=str_replace("{profileName}",$this->g_profileName,$str);
        $str=str_replace("{userID}",$this->g_userid,$str);




        fclose($fp);
        $handle = fopen('uploadartwork1.html',"w");
        fwrite($handle,$str);
        fclose($handle);
        header("Location: uploadartwork1.html"); 
    }
}




$db = new Dbconn();
$db->setDb();
$db->openConnection();
$upl = new Upload();
$upl->g_conn=$db->g_conn;
$upl->setProf();
$upl->genPage();




?>















