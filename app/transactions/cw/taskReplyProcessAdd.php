<?php
	include_once "../../session_token/checksession.php";
	include "../../configration/config.php";
	include "../../functions/db_functions.php";
	require_once "../../functions/common_functions.php";
	$logged_user_id=$_SESSION['cms_userid'];
	try{

		//print_r($_POST);die;
		$task_assi_id = getSanitizedData($_POST['task_assi_id']);
		$cw_remarks = getSanitizedData($_POST['cw_remarks']);
		$rev_status = getSanitizedData($_POST['status']);
		$external_files = $_POST['external_files'];
		$gd_user_id = getSanitizedData($_POST['gd_users']);
		
		/*$html_css_img_path = array();
		$html_css_img_path[] = $external_files;
		$added_new_html_file = json_encode($html_css_img_path);*/


		$query = "UPDATE task_assign SET status = ? WHERE id = ?";
		$stmt = $db->prepare($query);
		$stmt->execute(array($rev_status, $task_assi_id));

		$autoid_status2 = InsertRecord("task_details", array("user_id" => $logged_user_id,
		"instructions" => $cw_remarks,
		"attachments" =>  '',
		"added_new_html_file" => $external_files,
		"task_assign_id" => $task_assi_id,
		"status" =>  $rev_status
		));

		if($rev_status == 20 && $gd_user_id != ""){
			$autoid_status2 = InsertRecord("task_details", array("user_id" => $gd_user_id,
			"instructions" => $cw_remarks,
			"attachments" =>  '',
			"added_new_html_file" => $external_files,
			"task_assign_id" => $task_assi_id,
			"status" =>  $rev_status,
			"duplicate" => 1
			));
		}
		
		$status =true;
		$message ="File Saved and Updated Successfully";

		$response = array("status"=>$status, "message"=>$message);
		echo json_encode($response);
	} catch(Exception $exp){
    print_r($exp);
	}
?>