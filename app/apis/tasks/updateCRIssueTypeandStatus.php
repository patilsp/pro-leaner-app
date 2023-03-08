<?php
	include_once "../../session_token/checksession.php";
	include "../../configration/config.php";
	include "../../functions/db_functions.php";
	$logged_user_id=$_SESSION['cms_userid'];
	try{
		/*print_r($_POST);
		print_r($_FILES);die;*/
		$type = getSanitizedData($_POST['type']);
		$id = getSanitizedData($_POST['id']);
		$updated_on = date("Y-m-d H:i:s");
		
		if($type == "issue_type_update"){
			$issue_type = getSanitizedData($_POST['issue_type']);
			$query = "UPDATE slidefeedback SET issue_type = ?, assignBy=?, assignOn=? WHERE id = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($issue_type, $logged_user_id, $updated_on, $id));
		} else {
			$issue_type_status = getSanitizedData($_POST['issue_type_status']);
			$query = "UPDATE slidefeedback SET issue_status = ?, fixed_by=?, fixed_on=? WHERE id = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($issue_type_status, $logged_user_id, $updated_on, $id));
		}
		echo "1";
	} catch(Exception $exp){
    	echo "<pre/>";
    	print_r($exp);
	}
?>