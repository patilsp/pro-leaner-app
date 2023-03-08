<?php
	include_once "../session_token/checksession.php";
	include_once "../configration/config.php";
	//include_once "session_token/checktoken.php";
	require_once "../functions/db_functions.php";

  
    $user_id = $_SESSION['cms_userid'];
    //$user_id = "1";
    $role = getSanitizedData($_POST['role']);
	


	$query9 = "DELETE FROM role_permission WHERE roles_id = ?";
    $result9=$db->prepare($query9);
    $result9->execute(array($role));

    

	foreach($_POST['useraccess'] as $index =>$id)
    {
    	$useraccess = getSanitizedData($_POST['useraccess'][$index]);

    

        $query = "INSERT INTO role_permission (roles_id, permission_id, created_by, created_on) VALUES (?, ?, ?,NOW())";
		$result=$db->prepare($query);
		$result->execute(array($role,$useraccess,$user_id));
    }	


	header('Location:add_permission.php');

	
	
?>