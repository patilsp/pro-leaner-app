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
		$username =   getSanitizedData($_POST['username']);
		$phone =   getSanitizedData($_POST['phone']);
		$designation =   getSanitizedData($_POST['designation']);
		$dept =   getSanitizedData($_POST['dept']);
		$date_created = date("Y-m-d H:i:s");

		$autoid_status = InsertRecord("users", array("first_name" => $fname,
		"last_name" => $lname,
		"password" => md5($cpassword),
		"email" => $email,
		"date_created" => $date_created,
		"roles_id" => $role,
		"username" => $username,
		"phone" => $phone,
		"designation" => $designation,
		"dept" => $dept,
		));
		if($autoid_status > 0)
			header('Location:userCreation.php?status=success');
		else
			header('Location:userCreation.php?status=fail');
	} catch(Exception $exp){
		print_r($exp);
	}
?>