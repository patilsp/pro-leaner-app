<?php
	include_once "../session_token/checksession.php";
  	include_once "../configration/config.php";
  	//include_once "session_token/checktoken.php";
  	require_once "../functions/db_functions.php";

	$type = $_POST['type'];
	$output = array();
	$output['status'] = false;
	$output['message'] = "";
	$status = false;
	$message = "";
	$snackbar = false;
	$login_userid = isset($_SESSION['cms_userid'])?$_SESSION['cms_userid']:NULL;

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
		
 
		$query = "UPDATE users SET first_name = ?, last_name = ?,class=?,section=?,admission=?,username=?, email=? where id = ? ";
		$result=$db->prepare($query);
		$result->execute(array($fname,$lname,$class,$section,$admission,$admission,$admission,$user_auto_id));
		if ($password != '') {
			$query = "UPDATE users SET password = ? where id = ? ";
			$result=$db->prepare($query);
			$result->execute(array($password,$user_auto_id));
		}

		$status = true;
		$snackbar = true;
		$message = "Student Updated successfully";
			
	    header('Location:students.php');
	
	}
	$output['status'] = $status;
	$output['message'] = $message;
	if($snackbar && $output['status']) {
		if($status) {
			$_SESSION['sb_heading'] = "Success!";
		} else {
			$_SESSION['sb_heading'] = "Notice!";
		}
		$_SESSION['sb_message'] = $message;
		if(strlen($message) > 50) {
			$_SESSION['sb_time'] = 1000;
		} else {
			$_SESSION['sb_time'] = 1000;
		}
	}
	echo json_encode($output);
	
?>