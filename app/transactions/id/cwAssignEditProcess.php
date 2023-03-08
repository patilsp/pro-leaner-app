<?php
	include_once "../../session_token/checksession.php";
	include "../../configration/config.php";
	include "../../functions/db_functions.php";
	require_once "../../functions/common_functions.php";
	$logged_user_id=$_SESSION['cms_userid'];
	try{
		/*print_r($_POST);
		print_r($_FILES);die;*/
		$slide_id = getSanitizedData($_POST['slide_id']);
		$main_status = getSanitizedData($_POST['main_status']);
		$class_id = getSanitizedData($_POST['slide_classid']);
		$topic_id = getSanitizedData($_POST['slide_topicid']);
		$slide_btnid = getSanitizedData($_POST['slide_btnid']);
		$assign_date = date("Y-m-d H:i:s");

		//$response = array();
		$status = "";
		$message = "";
		if($main_status == 11){
			
		} else {
			$query = "UPDATE $master_db.mdl_lesson_pages SET status = ? WHERE id = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($main_status, $slide_id));

			$autoid_status = InsertRecord("review_status", array("class_id" => $class_id,
			"topic_id" => $topic_id,
			"slide_id" => $slide_id,
			"status" => $main_status,
			"updated_by" => $logged_user_id,
			"updated_on" => $assign_date
			));

			$status =true;
			$slide = "ok";
			$slide_id_name = $slide_btnid;
			$message ="Slide Status Updated Successfully";
		}

		$response = array("status"=>$status, "message"=>$message, "slide"=>$slide, "slide_id_name" => $slide_id_name);
		echo json_encode($response);
	} catch(Exception $exp){
    print_r($exp);
	}
?>