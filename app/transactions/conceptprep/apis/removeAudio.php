<?php
session_start();
include_once $_SESSION['dir_root']."app/session_token/checksession.php";
include $_SESSION['dir_root']."app/configration/config.php";
include "../functions/common_function.php";
include $_SESSION['dir_root']."app/functions/db_functions.php";
include $_SESSION['dir_root']."app/functions/common_functions.php";
try{
	/*print_r($_POST);
	print_r($_FILES);*/
	$resourceId = $_REQUEST['resourceId'];

	$status =false;
	$message ="Failed to delete the file";

	$data = GetRecord("resources", array("id"=>$resourceId));
	if(isset($data['filepath'])) {
		$file = json_decode($data['filepath']);
		$file = $file[0];
		unlink($file);
		//delete Audio File from folder as well as table
		$delete = DeleteRecord("resources",array("id"=>$resourceId));
		if($delete) {
			$status =true;
			$message ="Successfully Deleted";
		}
	}

	$response = array("status"=>$status, "message"=>$message, "resId"=>"");
	echo json_encode($response);
} catch (Exception $exp) {
	echo "<pre/>";
	print_r($exp);
}