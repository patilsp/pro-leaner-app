<?php
//include "cms_config.php";

############### Code ###############
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=''; // Mysql password 
$db_name="skillpre_schools"; // Database name

global $db;
try{
	$dbs = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
	// set the PDO error mode to exception
	$dbs->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;
	$dbs->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
} 
catch(PDOException $err) {
	echo "Error: " . $err->getMessage();
}

?>
