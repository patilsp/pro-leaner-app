<?php
	include_once "../../session_token/checksession.php";
	include "../../configration/config.php";
	include "../../functions/db_functions.php";
	require_once "../../functions/common_functions.php";
	$logged_user_id=$_SESSION['cms_userid'];
	try{
		/*print_r($_POST);
		print_r($_FILES);die;*/
		$title = "Edit exisiting task slides";
		$inputs = "Edit exisiting task slides inputs";
		$rev_status = 12;
		$slide_id = getSanitizedData($_POST['slide_id']);
		$main_status = getSanitizedData($_POST['main_status']);
		$class_id = getSanitizedData($_POST['slide_classid']);
		$topic_id = getSanitizedData($_POST['slide_topicid']);
		$slide_btnid = getSanitizedData($_POST['slide_btnid']);
		$assign_date = date("Y-m-d H:i:s");

		$status = "";
		$message = "";

		$autoid_status = InsertRecord("tasks", array("task_name" => $title,
		"inputs" => $inputs,
		"class_id" => $class_id,
		"topics_id" => $topic_id,
		"slide_id" => $slide_id,
		"status_id" => $main_status,
		"users_id" => $logged_user_id
		));
		if($autoid_status > 0) {
			$autoid_status1 = InsertRecord("task_assign", array("user_id" => $logged_user_id,
			"status" => $rev_status,
			"assign_date" =>  $assign_date,
			"tasks_id" => $autoid_status
			));
			if($autoid_status1 > 0) {
				$autoid_status2 = InsertRecord("task_details", array("user_id" => $logged_user_id,
				"task_assign_id" => $autoid_status1,
				"status" => $main_status
				));
			}


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
		}

		$status =true;
		$slide = "slideEdited";
		$slide_id_name = $slide_btnid;
		$message ="File Saved and Updated Successfully";

		$response = array("status"=>$status, "message"=>$message, "slide"=>$slide, "slide_id_name" => $slide_id_name);
		echo json_encode($response);

	} catch(Exception $exp){
    	$response = array("status"=>fail, "message"=>json_encode($exp));
	}
?>