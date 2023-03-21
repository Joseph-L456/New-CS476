<?php

class Dbconn {
	/* 成员变量 */
	var $g_db_host = "1";
	var $g_db_username = "2";
	var $g_db_password = "3";
	var $g_db_dbname = "4";
	var $g_charset = "5";
	var $g_attr = "6";
	var $g_options = "7";
	var $g_conn = "8";
	
	/* 成员函数 */
	function setDb(){
		$db_host = "localhost";
		$db_username = "liu676";
		$db_password = "Bl2ck.5";
		$db_dbname = "liu676";
		$charset = "utf8mb4";
		$options = [
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES   => false,
		];

	  $this->g_db_host = $db_host;
	  $this->g_db_username = $db_username;
	  $this->g_db_password = $db_password;
	  $this->g_db_dbname = $db_dbname;
	  $this->g_charset = $charset;
	  $this->g_options = $options;
	}
	




	function dbConn(){

		print_r ($this->g_conn);
  
  
	}
	function openConnection() {
		// Setting $con to null

	  // If $con is not NULL make it NULL
	  
		try {
		  // Establish DSN
			$g_attr = "mysql:host={$this->g_db_host};dbname={$this->g_db_username};charset={$this->g_charset}";
		  // Complete the PDO connection
			$this->g_conn = new PDO($g_attr, $this->g_db_username, $this->g_db_password,$this->g_options);
		  // Return the connection and store it in $con
			return $this->g_conn;
			// Catch any exceptions and store in $e
		} 
		catch(PDOExeption $e){
		  // Echo error and Exception message
			throw new PDOException($e->getMessage(), (int)$e->getCode());
			}
		// If the try/catch block fails, echo that no connection was established
	  
	}
  
  }


  
?>
