<?php
	include_once "../../session_token/checksession.php";
	include "../../configration/config.php";
	include "../../functions/db_functions.php";
	require_once "../../functions/common_functions.php";
	$logged_user_id=$_SESSION['cms_userid'];
	try{
		//print_r($_POST);die;

		$task_id = $_POST['task_id'];
		$task_assi_id = $_POST['task_ass_id'];
		$status = $_POST['status'];
		$remarks = $_POST['remarks'];

		$query = "UPDATE tasks SET status_id = ? WHERE id = ?";
		$stmt = $db->prepare($query);
		$stmt->execute(array($status, $task_id));

		$query = "UPDATE task_assign SET status = ? WHERE id = ?";
		$stmt = $db->prepare($query);
		$stmt->execute(array($status, $task_assi_id));

		$autoid_status2 = InsertRecord("task_details", array("user_id" => $logged_user_id,
		"instructions" => $remarks,
		"attachments" =>  '',
		"task_assign_id" => $task_assi_id,
		"status" => $status
		));

		$status =true;
		$message ="Status Updated Successfully";

		$response = array("status"=>$status, "message"=>$message);
		echo json_encode($response);
	} catch(Exception $exp) {
		echo "<pre/>";
		print_r($exp);
	}
?>