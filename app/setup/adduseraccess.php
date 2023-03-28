<?php
	include_once "../session_token/checksession.php";
	include_once "../configration/config.php";
	//include_once "session_token/checktoken.php";
	require_once "../functions/db_functions.php";

  
    $created_by = $_SESSION['cms_userid'];
    //$user_id = "1";
    $role = getSanitizedData($_POST['role']);
    $user_id = $_POST["user_id"];
	


	$query9 = "DELETE FROM users_module_access WHERE user_id = ?";
    $result9=$db->prepare($query9);
    $result9->execute(array($user_id));

    

	foreach($_POST['useraccess'] as $index =>$id)
    {
    	$useraccess = getSanitizedData($_POST['useraccess'][$index]);


        $query = "INSERT INTO users_module_access (user_id, permission_id, created_by, created_on) VALUES (?, ?, ?,NOW())";
		$result=$db->prepare($query);
		$result->execute(array($user_id,$useraccess,$created_by));
    }	


	header('Location:add_permissionnew.php?user_id='.$user_id.'&role='.$role);

	
	
?>