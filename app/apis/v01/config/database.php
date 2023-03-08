<?php

// used to get mysql database connection
class Database{
 	$host="172.31.28.42";   
	$username="skillprep";  
	$password='$k1llPr3p12';  
	$db_name="vs";  
	public $con;

 	public function getConnection(){

		$this->conn = null;

		try{
		echo 	$this->conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
		exit;
		}catch(PDOException $excception){
			echo "Connection error: " . $excception->getMessage();
		}

		return $this->conn;
	}
}
