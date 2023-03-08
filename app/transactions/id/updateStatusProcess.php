<?php
	include_once "../../session_token/checksession.php";
	include "../../configration/config.php";
	include "../../functions/db_functions.php";
	require_once "../../functions/common_functions.php";
	$logged_user_id=$_SESSION['cms_userid'];
	try{
		/*print_r($_POST);
		print_r($_FILES);
		die;*/
		$task_id = getSanitizedData($_POST['task_id']);
		$task_assi_id = getSanitizedData($_POST['task_assi_id']);
		$up_inst_cw = getSanitizedData($_POST['up_inst_cw']);
		//$up_cw_files = getSanitizedData($_POST['up_cw_files']);
		$up_status_cw = getSanitizedData($_POST['up_status_cw']);
		$assign_date = date("Y-m-d H:i:s");

		//$response = array();
		if(isset($up_status_cw)) {
			$query = "UPDATE tasks SET status_id=? WHERE id=?";
	  		$stmt = $db->prepare($query);
	  		$stmt->execute(array($up_status_cw, $task_id));
	  		$rowcount = $stmt->rowCount();
	  		if($rowcount > 0){
	  			$query1 = "UPDATE task_assign SET status=? WHERE id=? AND tasks_id=?";
		  		$stmt1 = $db->prepare($query1);
		  		$stmt1->execute(array($up_status_cw, $task_assi_id, $task_id));
		  		$rowcount1 = $stmt1->rowCount();
		  		if($rowcount1 > 0){
	  				$autoid_status2 = InsertRecord("task_details", array("user_id" => $logged_user_id,
					"instructions" => $up_inst_cw,
					"attachments" =>  '',
					"task_assign_id" => $task_assi_id,
					"status" => $up_status_cw
					));

	  				//Upload Images
					$dir_path = "taskFiles/autoid_status2/";
					if(isset($_FILES['up_cw_files'])){
						if(! file_exists($dir_path))
							mkdir($dir_path, 0777, true);
						$uploaded_files = upload_multiple_images("up_cw_files", $dir_path);
					}
					if(count($uploaded_files) > 0) {
						$data = json_encode($uploaded_files);
						$query = "UPDATE task_details SET attachments = ? WHERE id = ?";
						$stmt = $db->prepare($query);
						$stmt->execute(array($data, $autoid_status2));
					}

					if($autoid_status2){
						$status =true;
						$message ="Status updated and inserted successfully";
					}
					$status =true;
					$message ="Status updated only on task and task_assign table";
	  			}
	  			$status =true;
				$message ="Status updated only on task table";
  			}

			$status =true;
			$message ="Updated only on task table";
		} else {
			$status =false;
			$message ="Not able to create the task";
		}

		$response = array("status"=>$status, "message"=>$message);
		echo json_encode($response);
	} catch(Exception $exp){
    print_r($exp);
	}
?>