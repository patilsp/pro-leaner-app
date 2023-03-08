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
		

		$query = "UPDATE users SET first_name = ?, last_name = ?, email=?, roles_id = ? where id = ? ";
		$result=$db->prepare($query);
		$result->execute(array($fname,$lname,$email,$role,$user_auto_id));
	    header('Location:userList.php');
	
	}
	
?>