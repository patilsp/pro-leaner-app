<?php
	include_once "../session_token/checksession.php";
  	include_once "../configration/config.php";
  	//include_once "session_token/checktoken.php";
  	require_once "../functions/db_functions.php";
  	
	if(isset($_POST['update']))
	{	
		$user_auto_id = getSanitizedData($_POST['user_auto_id']);    
	    $fname 	= getSanitizedData($_POST['fname']);
		$lname 	= getSanitizedData($_POST['lname']);
		$email 	= getSanitizedData($_POST['email']);
		$role =   getSanitizedData($_POST['role']);
		// $username =   getSanitizedData($_POST['username']);
		$phone =   getSanitizedData($_POST['phone']);
		// $designation =   getSanitizedData($_POST['designation']);
		// $dept =   getSanitizedData($_POST['dept']);
		$password =   md5($_POST['password']);

		$query = "UPDATE users SET first_name = ?, last_name = ?, email=?, roles_id = ?,phone = ? where id = ? ";
		$result=$db->prepare($query);
		$result->execute(array($fname,$lname,$email,$role,$phone,$user_auto_id));

		if($password != '') {
			$query = "UPDATE users SET password = ? where id = ? ";
			$result=$db->prepare($query);
			$result->execute(array($password,$user_auto_id));
		}
	    header('Location:users.php');
	
	}
	
?>