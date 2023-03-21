<?php

require_once("database.php");



class AdminProfile {
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

    }



    function genPage(){

        $fp=fopen("adminprofile.html","r");
        $str=fread($fp,filesize("adminprofile.html"));


        $accselect = "SELECT Usernames.uid, Usernames.email, Usernames.profileName, Usernames.description, Usernames.accountType FROM Usernames WHERE Usernames.accountType != 1 ORDER BY Usernames.uid DESC;";

        $accresult = $this->g_conn->query($accselect);
		$rowCount = $accresult->rowCount();
		$uid = 0;
		$loopCounter = 0;

		while($rowCount > 0 && $loopCounter < 12){
			$row = $accresult->fetch();
				if($uid != $row["uid"]){
				$uid = $row["uid"];
                $profileName = $row["profileName"];
                $description = $row["description"];
                $email = $row["email"];
                $acctype = $row["accountType"];
				}
				
            $str=str_replace("{uid$loopCounter}",$uid,$str);
			$str=str_replace("{profileName$loopCounter}",$profileName,$str);
			$str=str_replace("{email$loopCounter}",$email,$str);
			$str=str_replace("{accountNumber$loopCounter}",$acctype,$str);
			$str=str_replace("{description$loopCounter}",$description,$str);
				 
			$rowCount--;
			$loopCounter++;
		}
        $str=str_replace("{userID}",$this->g_userid,$str);    
        $str=str_replace("{adminName}",$this->g_profileName,$str);


		fclose($fp);
		$handle = fopen('adminprofile1.html',"w");
		fwrite($handle,$str);
		fclose($handle);
        
        header("Location: adminprofile1.html"); 
    }

}


$db = new Dbconn();
$db->setDb();
$db->openConnection();
$adp = new AdminProfile();
$adp->g_conn=$db->g_conn;
$adp->setProf();
$adp->genPage();



?>















