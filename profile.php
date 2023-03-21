<?php

require_once("database.php");



class Profile {
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

        $pfselect = "SELECT Usernames.email, Usernames.profileName, Usernames.description, Usernames.avatar, Usernames.topicCount, Usernames.replyCount, Usernames.artworkCount FROM Usernames WHERE uid = '$userid';";
        $pfresult = $this->g_conn->query($pfselect);
        $row = $pfresult->fetch();
        $email = $row["email"];
        $profileName = $row["profileName"];
        $description = $row["description"];
        $avatar = $row["avatar"];
        $topicCount = $row["topicCount"];
        $replyCount = $row["replyCount"];
        $artworkCount = $row["artworkCount"];

        $this->g_email = $email;
        $this->g_profileName = $profileName;
        $this->g_description = $description;
        $this->g_avatar = $avatar;
        $this->g_topicCount = $topicCount;
        $this->g_replyCount = $replyCount;
        $this->g_artworkCount = $artworkCount;
        $this->g_userid = $userid;
    }

    function genPage(){
        $fp=fopen("profile.html","r");
        $str=fread($fp,filesize("profile.html"));

        $str=str_replace("{profileName}",$this->g_profileName,$str);
        $str=str_replace("{email}",$this->g_email,$str);
        $str=str_replace("{description}",$this->g_description,$str);
        $str=str_replace("{avatar}",$this->g_avatar,$str);
        $str=str_replace("{topicCount}",$this->g_topicCount,$str);
        $str=str_replace("{replyCount}",$this->g_replyCount,$str);
        $str=str_replace("{artworkCount}",$this->g_artworkCount,$str);
        $str=str_replace("{userID}",$this->g_userid,$str);




        fclose($fp);
        $handle = fopen('profile1.html',"w");
        fwrite($handle,$str);
        fclose($handle);

        
        header("Location: profile1.html"); 
    }

}


$db = new Dbconn();
$db->setDb();
$db->openConnection();
$prof = new Profile();
$prof->g_conn=$db->g_conn;
$prof->setProf();
$prof->genPage();



?>















