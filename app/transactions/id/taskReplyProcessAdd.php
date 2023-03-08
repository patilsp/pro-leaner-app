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
		$up_status_cw = getSanitizedData($_POST['up_status_cw']);
		$task_assi_id = getSanitizedData($_POST['task_assi_id']);
		$task_id = getSanitizedData($_POST['task_id']);
		$class_id = getSanitizedData($_POST['class_id']);
		$topic_id = getSanitizedData($_POST['topic_id']);
		$task_userid = getSanitizedData($_POST['task_userid']);
		$assign_date = date("Y-m-d H:i:s");
		$up_inst_cw = getSanitizedData($_POST['up_inst_cw']);
		$prev_slide_id = $_POST['prev_slide_id'];
		$lesson_id = $_POST['lesson_id'];
		$external_files = $_POST['file_path_html_css_imges'];
		

		$response = array();
		$status = "";
		$message = "";
		if($up_status_cw == 5){
			$query = "UPDATE task_assign SET status = ? WHERE id = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($up_status_cw, $task_assi_id));

			$autoid_status2 = InsertRecord("task_details", array("user_id" => $logged_user_id,
			"instructions" => $up_inst_cw,
			"attachments" =>  '',
			"task_assign_id" => $task_assi_id,
			"status" => $up_status_cw
			));

			//Upload Images
			$dir_path = "taskFiles/$autoid_status2/";
			if(! file_exists($dir_path))
				mkdir($dir_path, 0777, true);
			$uploaded_files = upload_multiple_images("up_cw_files", $dir_path);
			if(count($uploaded_files) > 0) {
				$data = json_encode($uploaded_files);
				$query = "UPDATE task_details SET attachments = ? WHERE id = ?";
				$stmt = $db->prepare($query);
				$stmt->execute(array($data, $autoid_status2));
			}

			$status =true;
			$message ="Slide Status Updated Successfully";
		} else {
			foreach ($external_files as $value) {
				$copy_folder = cpyExternalFiles($value);
				if(strpos($value,".html") > 0) {
       	 			$html_file = str_replace($web_root."app/", "", $value);
              	}
			}

			$response_mdl = insertUpdateSlide($lesson_id, $prev_slide_id, $html_file);
			if($response_mdl == "success"){
				$query = "UPDATE task_assign SET status = ? WHERE id = ?";
				$stmt = $db->prepare($query);
				$stmt->execute(array($up_status_cw, $task_assi_id));

				$autoid_status2 = InsertRecord("task_details", array("user_id" => $logged_user_id,
				"instructions" => $up_inst_cw,
				"attachments" =>  '',
				"task_assign_id" => $task_assi_id,
				"status" => $up_status_cw
				));
			}
			$status =true;
			$message ="Slide Status Updated Successfully";
		}

		$response = array("status"=>$status, "message"=>$message);
		echo json_encode($response);
	} catch(Exception $exp){
    print_r($exp);
	}
?>