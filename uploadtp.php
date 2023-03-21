<?php

require_once("database.php");


class UpdateTopic {
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
        $fp=fopen("uploadtopic.html","r");
        $str=fread($fp,filesize("uploadtopic.html"));
        $str=str_replace("{profileName}",$this->g_profileName,$str);
        $str=str_replace("{userID}",$this->g_userid,$str);




        fclose($fp);
        $handle = fopen('uploadtopic1.html',"w");
        fwrite($handle,$str);
        fclose($handle);
        header("Location: uploadtopic1.html"); 
    }
}




$db = new Dbconn();
$db->setDb();
$db->openConnection();
$upd = new UpdateTopic();
$upd->g_conn=$db->g_conn;
$upd->setProf();
$upd->genPage();




?>















