<?php
	include_once "../../session_token/checksession.php";
	include "../../configration/config.php";
	include "../../functions/db_functions.php";
	$logged_user_id=$_SESSION['cms_userid'];
	try{
		/*print_r($_POST);
		print_r($_FILES);die;*/
		$slide_id = getSanitizedData($_POST['slide_id']);
		$class_id = getSanitizedData($_POST['slide_classid']);
		$topic_id = getSanitizedData($_POST['slide_topicid']);
		$slide_path = getSanitizedData($_POST['slide_path']);
		$feedbackType = implode(",", $_POST['feedbackType']);
		$feedback = getSanitizedData($_POST['feedback']);
		$assign_date = date("Y-m-d H:i:s");
		$feedback_role = getSanitizedData($_POST['feedback_role']);
		if($feedback_role == "CR")
			$feedback_role = getSanitizedData($_POST['feedback_role']);
		else
			$feedback_role = "";
		
		$autoid_status = InsertRecord("slidefeedback", array("classId" => $class_id,
			"topicId" => $topic_id,
			"slideId" => $slide_id,
			"slidepath" => $slide_path,
			"feedbackType" => $feedbackType,
			"feedback" => $feedback,
			"role" => $feedback_role,
			"updatedBy" => $logged_user_id,
			"updatedOn" => $assign_date,
		));
		if($autoid_status) {
			$status =true;
			$message ="Updated Successfully";
		} else {
			$status =false;
			$message ="Fail to update feedback";
		}
			
		$response = array("status"=>$status, "message"=>$message);
		echo json_encode($response);
	} catch(Exception $exp){
    print_r($exp);
	}
?>