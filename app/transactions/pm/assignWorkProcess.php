<?php
	include_once "../../session_token/checksession.php";
	include "../../configration/config.php";
	include "../../functions/db_functions.php";
	require_once "../../functions/common_functions.php";
	$logged_user_id=$_SESSION['cms_userid'];
	try{
		/*print_r($_POST);
		print_r($_FILES);die;*/
		$class_id = $_POST['class_name'];
		$topic_id = $_POST['topic'];
		$status_id = 7;
		$assign_to = $_POST['users'];
		$inst = $_POST['inst'];
		$assign_date = date("Y-m-d H:i:s");

		$autoid_status = InsertRecord("tasks", array("class_id" => $class_id,
		"topics_id" => $topic_id,
		"status_id" => $status_id,
		"users_id" => $logged_user_id
		));
		if($autoid_status){
			$autoid_status1 = InsertRecord("task_assign", array("user_id" => $assign_to,
			"status" => $status_id,
			"assign_date" =>  $assign_date,
			"tasks_id" => $autoid_status
			));
			if($autoid_status1 > 0) {
				$autoid_status2 = InsertRecord("task_details", array("user_id" => $logged_user_id,
				"instructions" => $inst,
				"attachments" =>  '',
				"task_assign_id" => $autoid_status1,
				"status" => $status_id
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
				$uploaded_files = upload_multiple_images("ref_files", $dir_path);
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

		$status =true;
		$message ="Task created Successfully";

		$response = array("status"=>$status, "message"=>$message);
		echo json_encode($response);
	} catch(Exception $exp){
    print_r($exp);
	}
?>