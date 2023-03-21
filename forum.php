<?php

require_once("database.php");



class Forum {
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


		$fp=fopen("forum.html","r");
		$str=fread($fp,filesize("forum.html"));
	
		$tpselect = "SELECT Topics.tid, Topics.topicDate, Topics.topicTitle, Topics.topicContent, Topics.replyNumber, Topics.isDeleted, Usernames.uid, Usernames.profileName FROM Topics 
		INNER JOIN Usernames ON (Topics.uid = Usernames.uid)
	  	ORDER BY Topics.tid DESC;";

		

		$tpresult = $this->g_conn->query($tpselect);
		$rowCount = $tpresult->rowCount();
		$tid = 0;
		$loopCounter = 0;

		while($rowCount > 0 && $loopCounter < 12){
			$row = $tpresult->fetch();
				if($tid != $row["tid"]){
				$tid = $row["tid"];
				$topicDate = $row["topicDate"];
				$topicTitle = $row["topicTitle"];
				$topicContent = substr($row["topicContent"], 0, 30);
				$replyNumber = $row["replyNumber"];
				$isDeleted = $row["isDeleted"];
				$author = $row["profileName"];
				}
				
			$str=str_replace("{tid$loopCounter}",$tid,$str);
			$str=str_replace("{awnumber$loopCounter}",$awnumber,$str);
			$str=str_replace("{topicDate$loopCounter}",$topicDate,$str);
			$str=str_replace("{topicTitle$loopCounter}",$topicTitle,$str);
			$str=str_replace("{topicContent$loopCounter}",$topicContent,$str);
			$str=str_replace("{replyNumber$loopCounter}",$replyNumber,$str);
			$str=str_replace("{author$loopCounter}",$author,$str);
				 
			$rowCount--;
			$loopCounter++;
		}


		$str=str_replace("{userID}",$this->g_userid,$str);
        $str=str_replace("{profileName}",$this->g_profileName,$str);


		fclose($fp);
		$handle = fopen('forum1.html',"w");
		fwrite($handle,$str);
		fclose($handle);
  
		header("Location: forum1.html"); 
    }


}


$db = new Dbconn();
$db->setDb();
$db->openConnection();
$forum = new Forum();
$forum->g_conn=$db->g_conn;
$forum->setProf();
$forum->genPage();



?>















