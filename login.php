<?php

require_once("database.php");

class Login {
    var $g_email = "g_email";
    var $g_password = "g_password";
  
    function setCred(){
        $email = $_POST['uname'];
        $password = $_POST['pswd'];
        $this->g_email = $email;
        $this->g_password = $password;
    }
  
    function genPage(){
        $fp=fopen("main.html","r");
        $str=fread($fp,filesize("main.html"));

        $queryselect = "SELECT * FROM Usernames WHERE (email = '$this->g_email' AND password = '$this->g_password');";
        $select = $this->g_conn->query($queryselect);
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
            $str=str_replace("{awnumber}",$awnumber,$str);
            $str=str_replace("{awimage}",$awimage,$str);
            $str=str_replace("{awname}",$awname,$str);
            $str=str_replace("{awdesc}",$awdesc,$str);

            $rowCount--;
            $loopCounter++;
        }

        $str=str_replace("{profileName}",$proname,$str);
        $str=str_replace("{profileName}",$proname,$str);

        fclose($fp);
        $handle = fopen('main1.html',"w");
        fwrite($handle,$str);
        fclose($handle);
    }
  
    function login(){
	    $queryselect = "SELECT * FROM Usernames WHERE (email = '$this->g_email' AND password = '$this->g_password');";
	    $select = $this->g_conn->query($queryselect);
	    if($select->rowCount() > 0)
	    {
	        $credential = $select->fetch();
	  
	        $userid = $credential["uid"];
	        $proname = $credential["profileName"];

            $usertype = $credential["accountType"];

            if($usertype == 0){
                session_start();
	  
                $_SESSION["user_id"] = $userid;
                $_SESSION["name_of_user"] = $proname; 
    
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
                $str=str_replace("{profileName}",$_SESSION["name_of_user"],$str);
                $str=str_replace("{userID}",$_SESSION["user_id"],$str);
    
                fclose($fp);
                $handle = fopen('main1.html',"w");
                fwrite($handle,$str);
                fclose($handle);
          
                header("Location: main1.html"); 

            }else if ($usertype == 1){

                session_start();
                $_SESSION["user_id"] = $userid;
                $_SESSION["name_of_user"] = $proname; 
    
                $fp=fopen("adminmain.html","r");
                $str=fread($fp,filesize("adminmain.html"));
            
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
                $str=str_replace("{profileName}",$_SESSION["name_of_user"],$str);
                $str=str_replace("{userID}",$_SESSION["user_id"],$str);
    
                fclose($fp);
                $handle = fopen('adminmain1.html',"w");
                fwrite($handle,$str);
                fclose($handle);
          
                header("Location: adminmain1.html"); 





            }else if ($usertype == 2){
                print("Banned account");


            }else{
                print("Invalid accountType");
            }

	    }
	    else{
		    print("Invalid credentials");
	    }
    }  
}


$db = new Dbconn();
$db->setDb();
$db->openConnection();
$login = new Login();
$login->g_conn=$db->g_conn;
$login->setCred();
$login->login();


?>















