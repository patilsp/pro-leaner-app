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
		// $email 	= getSanitizedData($_POST['email']);
		// $phone =   getSanitizedData($_POST['phone']);
		$class =   getSanitizedData($_POST['class']);
		$section =   getSanitizedData($_POST['section']);
		$admission =   getSanitizedData($_POST['admission']);
		$password =   md5($_POST['password']);
		

		$query = "UPDATE users SET first_name = ?, last_name = ?,class=?,section=?,admission=?,username=? where id = ? ";
		$result=$db->prepare($query);
		$result->execute(array($fname,$lname,$class,$section,$admission,$admission,$user_auto_id));
		if ($password != '') {
			$query = "UPDATE users SET password = ? where id = ? ";
			$result=$db->prepare($query);
			$result->execute(array($password,$user_auto_id));
		}
	    header('Location:students.php');
	
	}
	
?>