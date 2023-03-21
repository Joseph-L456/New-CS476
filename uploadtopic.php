<?php

require_once("database.php");


class UploadTopic {
    var $g_email = "g_email";
    var $g_profileName = "g_password";
    var $g_description = "g_email";
    var $g_avatar = "g_password";
    var $g_topicCount = "g_email";
    var $g_replyCount = "g_password";
    var $g_artworkCount = "g_password";
    var $g_userid = "rewq";
	var $g_tid = "g_email";
    var $g_topicDate = "g_password";
    var $g_topicTitle = "g_email";
    var $g_topicContent = "g_password";
    var $g_replyNumber = "g_email";
    var $g_isDeleted = "";

  
	function setProf(){
        session_start();
        $proname = $_SESSION["name_of_user"];
        $userid = $_SESSION["user_id"];

        $pfselect = "SELECT Usernames.uid, Usernames.profileName FROM Usernames WHERE uid = '$userid'";
        $pfresult = $this->g_conn->query($pfselect);
        $row = $pfresult->fetch();

        $this->g_userid = $userid;
        $this->g_profileName = $row["profileName"];

        $queryselect = "SELECT topicCount FROM Usernames WHERE Usernames.uid = $userid;";
        $select = $this->g_conn->query($queryselect);
        $row = $select->fetch();
        $postcounter = $row["topicCount"];
        $postcounter++;


        $topictitle = $_POST['uploadtopic'];
        $topiccontent = $_POST['uploadcontent'];


        $queryinsert = "INSERT INTO Topics(topicDate, topicTitle, topicContent, uid) VALUES (NOW(), '$topictitle', '$topiccontent', '$userid');";
        $insert = $this->g_conn->query($queryinsert);

        $queryupdate = "UPDATE Usernames 
        SET topicCount = '$postcounter'
        WHERE Usernames.uid = $userid;";
        $update = $this->g_conn->query($queryupdate);


        header("Location: uploadartwork1.html");

    }

















    function genPage(){
        $fp=fopen("uploadartwork.html","r");
        $str=fread($fp,filesize("uploadartwork.html"));
        $str=str_replace("{profileName}",$this->g_profileName,$str);
        $str=str_replace("{email}",$this->g_email,$str);
        $str=str_replace("{description}",$this->g_description,$str);
        $str=str_replace("{avatar}",$this->g_avatar,$str);
        $str=str_replace("{topicCount}",$this->g_topicCount,$str);
        $str=str_replace("{replyCount}",$this->g_replyCount,$str);
        $str=str_replace("{artworkCount}",$this->g_artworkCount,$str);
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
$uplt = new UploadTopic();
$uplt->g_conn=$db->g_conn;
$uplt->setProf();





?>















