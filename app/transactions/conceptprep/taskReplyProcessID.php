<?php
	include_once "../../session_token/checksession.php";
	include "../../configration/config.php";
	include "../../configration/config_schools.php";
	include "../../functions/db_functions.php";
	require_once "functions/common_function.php";
	require_once "../../functions/common_functions.php";
	$logged_user_id=$_SESSION['cms_userid'];
	try{
		/*print_r($_POST);
		print_r($_FILES);die;*/
		$up_status_cw = getSanitizedData($_POST['up_status_cw']);
		$task_assi_id = getSanitizedData($_POST['task_assi_id']);
		$task_id = getSanitizedData($_POST['task_id']);
		$class_id = getSanitizedData($_POST['class_id']);
		$topic_id = getSanitizedData($_POST['topic_id']);
		$task_userid = getSanitizedData($_POST['task_userid']);
		$assign_date = date("Y-m-d H:i:s");
		$up_inst_cw = getSanitizedData($_POST['up_inst_cw']);
		//$up_cw_files = $_POST['up_cw_files'];

		$response = array();
		$status = "";
		$message = "";
		if($up_status_cw == 5){
			$query = "UPDATE cptask_assign SET status = ? WHERE id = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($up_status_cw, $task_assi_id));

			$autoid_status2 = InsertRecord("cptask_details", array("user_id" => $logged_user_id,
			"instructions" => $up_inst_cw,
			"attachments" =>  '',
			"task_assign_id" => $task_assi_id,
			"status" => $up_status_cw
			));

			//Upload Images
			$dir_path = $dir_root."app/transactions/id/taskFiles/task_details_id_".$autoid_status2."/";
			if(! file_exists($dir_path))
				mkdir($dir_path, 0777, true);
			$uploaded_files = upload_multiple_images("up_cw_files", $dir_path);
			if(count($uploaded_files) > 0) {
				$data = json_encode($uploaded_files);
				$query = "UPDATE task_details SET attachments = ? WHERE id = ?";
				$stmt = $db->prepare($query);
				$stmt->execute(array($data, $autoid_status2));
			}

			updateSlideStatus($task_assi_id, $up_status_cw);

			$status =true;
			$message ="Slide Status Updated Successfully";
		} elseif ($up_status_cw == 23) {
			
			$autoid_status2 = InsertRecord("cptask_production_ready", array("task_id" => $task_id,
			"updated_by" => $logged_user_id
			));

			$status =true;
			$message ="Status Updated Successfully";
		} else {
			//Publish logic
			
			$autoid_status2 = InsertRecord("cptask_details", array("user_id" => $logged_user_id,
			"instructions" => "Task Published",
			"attachments" =>  '',
			"task_assign_id" => $task_assi_id,
			"status" => $up_status_cw
			));
			
			$query = "UPDATE cptask_assign SET status = ? WHERE tasks_id = ? AND user_id = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($up_status_cw, $task_assi_id, $task_userid));
			
			$query = "SELECT id FROM cptask_assign WHERE tasks_id = ? AND status != 13";
			$stmt = $db->prepare($query);
			$stmt->execute(array($task_assi_id));
			if($stmt->rowCount() == 0)
			{
				$query = "UPDATE cptasks SET status_id = ? WHERE id = ?";
				$stmt = $db->prepare($query);
				$stmt->execute(array($up_status_cw, $task_assi_id));
			}
			$status =true;
			$message ="Slide Status Updated Successfully";
		}

		$response = array("status"=>$status, "message"=>$message);
		echo json_encode($response);
	} catch(Exception $exp){
    	echo "<pre/>";
    	print_r($exp);
    	die;
	}
?>