<?php
	include_once "../../session_token/checksession.php";
	include "../../configration/config.php";
	include "../../functions/db_functions.php";
	require_once "../../functions/common_functions.php";
	$logged_user_id=$_SESSION['cms_userid'];
	try{
		//print_r($_POST);
		$rev_status = 12;
		$task_assi_id = getSanitizedData($_POST['task_assi_id']);
		$cw_remarks = getSanitizedData($_POST['cw_remarks']);

		$status = "";
		$message = "";

		$query = "UPDATE task_assign SET status = ? WHERE id = ?";
		$stmt = $db->prepare($query);
		$stmt->execute(array($rev_status, $task_assi_id));

		$autoid_status2 = InsertRecord("task_details", array("user_id" => $logged_user_id,
		"instructions" => $cw_remarks,
		"attachments" =>  '',
		"task_assign_id" => $task_assi_id,
		"status" =>  $rev_status
		));
		
		$status =true;
		$message ="File Saved and Updated Successfully";

		$response = array("status"=>$status, "message"=>$message);
		echo json_encode($response);

	} catch(Exception $exp){
    print_r($exp);
	}
?>