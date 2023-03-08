<?php
	include_once "../session_token/checksession.php";
  	include_once "../configration/config.php";
  	//include_once "session_token/checktoken.php";
  	require_once "../functions/db_functions.php";
	try{
		$fname 	= getSanitizedData($_POST['fname']);
		$lname 	= getSanitizedData($_POST['lname']);
		$email 	= getSanitizedData($_POST['email']);
		$role =   10;
		// $cpassword =   getSanitizedData($_POST['cpassword']);
		// $username =   getSanitizedData($_POST['username']);
		$phone =   getSanitizedData($_POST['phone']);
		$class =   getSanitizedData($_POST['class']);
		$section =   getSanitizedData($_POST['section']);
		$admission =   getSanitizedData($_POST['admission']);
		$date_created = date("Y-m-d H:i:s");

		$autoid_status = InsertRecord("users", array("first_name" => $fname,
		"last_name" => $lname,
		"password" => md5($admission),
		 "email" => $admission,
		"date_created" => $date_created,
		"roles_id" => $role,
		"username" => $admission,
		// "phone" => $phone,
		"class" => $class,
		"section" => $section,
		"admission" => $admission,
		));
		if($autoid_status > 0)
			header('Location:students.php');
		else
			header('Location:students.php');
	} catch(Exception $exp){
		print_r($exp);
	}
?>