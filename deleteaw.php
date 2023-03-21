<?php

require_once("database.php");


class DeleteArtwork {
    var $g_email = "g_email";
    var $g_profileName = "g_password";
    var $g_description = "g_email";
    var $g_avatar = "g_password";
    var $g_topicCount = "g_email";
    var $g_replyCount = "g_password";
    var $g_artworkCount = "g_password";
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

        if (isset($_GET["awNumber"])){
            $awnumber = $_GET['awNumber'];
            $querydelete = "DELETE FROM Artworks WHERE aid='$awnumber';";
            $delete = $this->g_conn->query($querydelete);
            header("Location: adminmain.php");
        }



    }

}




$db = new Dbconn();
$db->setDb();
$db->openConnection();
$dela = new DeleteArtwork();
$dela->g_conn=$db->g_conn;
$dela->setProf();








?>













