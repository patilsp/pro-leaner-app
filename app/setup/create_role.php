<?php
	include_once "../session_token/checksession.php";
	include_once "../configration/config.php";
	//include_once "session_token/checktoken.php";
	require_once "../functions/db_functions.php";

	$user_id = $_SESSION['cms_userid'];
    $role 	= getSanitizedData($_POST['role']);

	
	$query = "INSERT INTO roles (id, name, created_by, created_on) VALUES (NULL, ?, ?,NOW())";
	$result=$db->prepare($query);
	$result->execute(array($role,$user_id));

	header('Location:role_creation.php');
	
	
?>