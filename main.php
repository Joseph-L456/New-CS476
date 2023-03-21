<?php

require_once("database.php");



class MainPage {
    var $g_email = "g_email";
    var $g_profileName = "g_password";
    var $g_description = "g_email";
    var $g_avatar = "g_password";
    var $g_topicCount = "g_email";
    var $g_replyCount = "g_password";
    var $g_artworkCount = "g_password";
    var $g_userid = "rewq";
  
    function genPage(){

		$fp=fopen("main.html","r");
		$str=fread($fp,filesize("main.html"));
	
		$awselect = "SELECT Artworks.aid, Artworks.artworkName, Artworks.artworkDescription, Artworks.artworkImage FROM Artworks ORDER BY Artworks.aid DESC;";

		$awresult = $this->g_conn->query($awselect);
		$rowCount = $awresult->rowCount();
		$aid = 0;
		$loopCounter = 0;

		while($rowCount > 0 && $loopCounter < 12){
			$row = $awresult->fetch();
				if($aid != $row["aid"]){
				$aid = $row["aid"];
				$awnumber = $row["aid"];
				$awimage = $row["artworkImage"];
				$awname = $row["artworkName"];
				$awdesc = $row["artworkDescription"];
				}
			$str=str_replace("{awnumber$loopCounter}",$awnumber,$str);
			$str=str_replace("{awimage$loopCounter}",$awimage,$str);
			$str=str_replace("{awname$loopCounter}",$awname,$str);
			$str=str_replace("{awdesc$loopCounter}",$awdesc,$str);
				 
			$rowCount--;
			$loopCounter++;
		}
		$str=str_replace("{userID}",$this->g_userid,$str);
        $str=str_replace("{profileName}",$this->g_profileName,$str);


		fclose($fp);
		$handle = fopen('main1.html',"w");
		fwrite($handle,$str);
		fclose($handle);
  
		header("Location: main1.html"); 
    }


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

}


$db = new Dbconn();
$db->setDb();
$db->openConnection();
$main = new MainPage();
$main->g_conn=$db->g_conn;
$main->setProf();
$main->genPage();




?>















