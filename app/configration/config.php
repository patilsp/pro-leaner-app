<?php
//include "cms_config.php";

############### Code ###############
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=''; // Mysql password 
$db_name="cms-2023"; // Database name
$web_root = "http://localhost:81/e-learning-app/";
$dir_root = "c:/wamp/www/e-learning-app/";
$dir_root_production = "E:/wamp/www/skills4lifeadmin/";
$master_db = "sp_2122_master";

global $db;
try{
	$db = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
	// set the PDO error mode to exception
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
	//$db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND => "SET @creport_userid = '".$_SESSION['creport_userid']."'");

	// We are only allowing content-type of images
	$allowedMimes_image = array(
	    'jpg|jpeg|jpe' => 'image/jpeg',
	    'gif'          => 'image/gif',
	    'png'          => 'image/png',
	);

	// We are only allowing content-type of excel
	$allowedMimes_word = array(
	    'doc'  =>    'application/msword',
		'dot'  =>    'application/msword',

		'docx' =>    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
		'dotx' =>    'application/vnd.openxmlformats-officedocument.wordprocessingml.template',
		'docm' =>    'application/vnd.ms-worddocument.macroEnabled.12',
		'dotm' =>    'application/vnd.ms-word.template.macroEnabled.12'
	);
	$allowedMimes_pdf = array(
	    'doc'  =>    'application/pdf'
    );

	//Allowed extension for images and excel
	$allowed_img_ext =  array('gif','png' ,'jpg');
	$allowed_word_ext =  array('doc','docx','docm','dotx','dotm');
	$allowed_pdf_ext = array('pdf');

	//Hexa codes check
	$allowed_image_hexa = array('d8ffe0','504e47');
	$allowed_excel_hexa = array('cf11e0','4b0304');
	$allowed_word_hexa = array('cf11e0','4b0304');
	$allowed_pdf_hexa = array('504446');
} 
catch(PDOException $err) {
	echo "Error: " . $err->getMessage();
}

?>
