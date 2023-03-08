<?php
	include_once "../session_token/checksession.php";
	include_once "../configration/config.php";
	//include_once "session_token/checktoken.php";
	require_once "../functions/db_functions.php";

	if(isset($_POST['update']))
	{	
		$user_auto_id = getSanitizedData($_POST['user_auto_id']);    
	    $rolename 	= getSanitizedData($_POST['rolename']);
		
		$query = "UPDATE roles SET name = ?, created_by = ?, created_on = NOW() where id = ? ";
		$result=$db->prepare($query);
		$result->execute(array($rolename,1,$user_auto_id));
	    header('Location:roleList.php');
	}
?>