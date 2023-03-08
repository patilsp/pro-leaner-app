<?php
	include_once "../session_token/checksession.php";
  	include_once "../configration/config.php";
  	//include_once "session_token/checktoken.php";
  	require_once "../functions/db_functions.php";
	try{
		$fname 	= getSanitizedData($_POST['fname']);
		$lname 	= getSanitizedData($_POST['lname']);
		$email 	= getSanitizedData($_POST['email']);
		$role =   getSanitizedData($_POST['role']);
		$cpassword =   getSanitizedData($_POST['cpassword']);
		$date_created = date("Y-m-d H:i:s");

		$autoid_status = InsertRecord("users", array("first_name" => $fname,
		"last_name" => $lname,
		"password" => md5($cpassword),
		"email" => $email,
		"date_created" => $date_created,
		"roles_id" => $role,
		));
		if($autoid_status > 0)
			header('Location:user_creation.php?status=success');
		else
			header('Location:user_creation.php?status=fail');
	} catch(Exception $exp){
		print_r($exp);
	}
?>