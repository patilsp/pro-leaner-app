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
			$assign_to = $_POST['assign_to'];
			$title = "Edit exisiting task slides";
			$inputs = "Edit exisiting task slides inputs";
			$status_cw = $main_status;
			$user_cw = getSanitizedData($_POST['user_cw']);
			$inst_cw = getSanitizedData($_POST['inst_cw']);

			$status_vd = $main_status;
			$user_vd = getSanitizedData($_POST['user_vd']);
			$inst_vd = getSanitizedData($_POST['inst_vd']);

			$status_gd = $main_status;
			$user_gd = getSanitizedData($_POST['user_gd']);
			$inst_gd = getSanitizedData($_POST['inst_gd']);

			$status_tt = $main_status;
			$user_tt = getSanitizedData($_POST['user_tt']);
			$inst_tt = getSanitizedData($_POST['inst_tt']);

			$autoid_status = InsertRecord("tasks", array("task_name" => $title,
			"inputs" => $inputs,
			"class_id" => $class_id,
			"topics_id" => $topic_id,
			"slide_id" => $slide_id,
			"status_id" => $main_status,
			"users_id" => $logged_user_id
			));
			if($autoid_status > 0) {
				foreach ($assign_to as $key => $value) {
					if($value == "CW"){
						$autoid_status1 = InsertRecord("task_assign", array("user_id" => $user_cw,
						"status" => $status_cw,
						"assign_date" =>  $assign_date,
						"tasks_id" => $autoid_status
						));
						if($autoid_status1 > 0) {
							$autoid_status2 = InsertRecord("task_details", array("user_id" => $logged_user_id,
							"instructions" => $inst_cw,
							"attachments" =>  '',
							"task_assign_id" => $autoid_status1,
							"status" => $main_status
							));
							if($autoid_status2 == 0) {
								$status =false;
								$slide = "notok";
								$message ="Not able to insert the task_details";
							}

							//Upload Images
							$dir_path = "taskFiles/$autoid_status/$autoid_status1/$autoid_status2/";
							if(! file_exists($dir_path))
								mkdir($dir_path, 0777, true);
							$uploaded_files = upload_multiple_images("cw_files", $dir_path);
							if(count($uploaded_files) > 0) {
								$data = json_encode($uploaded_files);
								$query = "UPDATE task_details SET attachments = ? WHERE id = ?";
								$stmt = $db->prepare($query);
								$stmt->execute(array($data, $autoid_status2));
							}
						} else {
							$status =false;
							$slide = "notok";
							$message ="Not able to insert the task_assign";
						}
					}
					if($value == "VD"){
						$autoid_status1 = InsertRecord("task_assign", array("user_id" => $user_vd,
						"status" => $status_vd,
						"assign_date" =>  $assign_date,
						"tasks_id" => $autoid_status
						));
						if($autoid_status1 > 0) {
							$autoid_status2 = InsertRecord("task_details", array("user_id" => $logged_user_id,
							"instructions" => $inst_vd,
							"attachments" =>  '',
							"task_assign_id" => $autoid_status1,
							"status" => $main_status
							));
							if($autoid_status2 == 0) {
								$status =false;
								$slide = "notok";
								$message ="Not able to insert the task_details";
							}

							//Upload Images
							$dir_path = "taskFiles/$autoid_status/$autoid_status1/$autoid_status2/";
							if(isset($_FILES['vd_files'])){
								if(! file_exists($dir_path))
									mkdir($dir_path, 0777, true);
								$uploaded_files = upload_multiple_images("vd_files", $dir_path);
							}
							if(count($uploaded_files) > 0) {
								$data = json_encode($uploaded_files);
								$query = "UPDATE task_details SET attachments = ? WHERE id = ?";
								$stmt = $db->prepare($query);
								$stmt->execute(array($data, $autoid_status2));
							}
						} else {
							$status =false;
							$slide = "notok";
							$message ="Not able to insert the task_assign";
						}
					}
					if($value == "GD"){
						$autoid_status1 = InsertRecord("task_assign", array("user_id" => $user_gd,
						"status" => $status_gd,
						"assign_date" =>  $assign_date,
						"tasks_id" => $autoid_status
						));
						if($autoid_status1 > 0) {
							$autoid_status2 = InsertRecord("task_details", array("user_id" => $logged_user_id,
							"instructions" => $inst_gd,
							"attachments" =>  '',
							"task_assign_id" => $autoid_status1,
							"status" => $main_status
							));
							if($autoid_status2 == 0) {
								$status =false;
								$slide = "notok";
								$message ="Not able to insert the task_details";
							}

							//Upload Images
							$dir_path = "taskFiles/$autoid_status/$autoid_status1/$autoid_status2/";
							if(isset($_FILES['gd_files'])){
								if(! file_exists($dir_path))
									mkdir($dir_path, 0777, true);
								$uploaded_files = upload_multiple_images("gd_files", $dir_path);
							}
							if(count($uploaded_files) > 0) {
								$data = json_encode($uploaded_files);
								$query = "UPDATE task_details SET attachments = ? WHERE id = ?";
								$stmt = $db->prepare($query);
								$stmt->execute(array($data, $autoid_status2));
							}
						} else {
							$status =false;
							$slide = "notok";
							$message ="Not able to insert the task_assign";
						}
					}
					if($value == "TT"){
						$autoid_status1 = InsertRecord("task_assign", array("user_id" => $user_tt,
						"status" => $status_tt,
						"assign_date" =>  $assign_date,
						"tasks_id" => $autoid_status
						));
						if($autoid_status1 > 0) {
							$autoid_status2 = InsertRecord("task_details", array("user_id" => $logged_user_id,
							"instructions" => $inst_tt,
							"attachments" =>  '',
							"task_assign_id" => $autoid_status1,
							"status" => $main_status
							));
							if($autoid_status2 == 0) {
								$status =false;
								$slide = "notok";
								$message ="Not able to insert the task_details";
							}

							//Upload Images
							$dir_path = "taskFiles/$autoid_status/$autoid_status1/$autoid_status2/";
							$uploaded_files = "";
							if(isset($_FILES['ttfiles'])){
								if(! file_exists($dir_path))
									mkdir($dir_path, 0777, true);
								$uploaded_files = upload_multiple_images("ttfiles", $dir_path);
							}
							if(count($uploaded_files) > 0) {
								$data = json_encode($uploaded_files);
								$query = "UPDATE task_details SET attachments = ? WHERE id = ?";
								$stmt = $db->prepare($query);
								$stmt->execute(array($data, $autoid_status2));
							}
						} else {
							$status =false;
							$slide = "notok";
							$message ="Not able to insert the task_assign";
						}
					}
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

				$status =true;
				$slide = "notok";
				$slide_id_name = $slide_btnid;
				$message ="Task has been Created Successfully";
			} else {
				$status =false;
				$slide = "notok";
				$message ="Not able to create the task";
			}
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