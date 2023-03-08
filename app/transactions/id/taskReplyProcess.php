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
		//$up_cw_files = $_POST['up_cw_files'];

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
			$query = "UPDATE $master_db.mdl_lesson_pages SET status = ? WHERE id = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($up_status_cw, $slide_id));

			$autoid_status = InsertRecord("review_status", array("class_id" => $class_id,
			"topic_id" => $topic_id,
			"slide_id" => $slide_id,
			"status" => $up_status_cw,
			"updated_by" => $logged_user_id,
			"updated_on" => $assign_date
			));

			$query = "UPDATE task_assign SET status = ? WHERE id = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($up_status_cw, $task_assi_id));

			$autoid_status2 = InsertRecord("task_details", array("user_id" => $logged_user_id,
			"instructions" => $up_inst_cw,
			"attachments" =>  '',
			"task_assign_id" => $task_assi_id,
			"status" => $up_status_cw
			));

			if ($up_status_cw == 13) {
				$records = GetRecords("$master_db.mdl_lesson_pages", array("id"=>$slide_id));
				if (count($records) != 0) {
					foreach($records as $record)
			      	{
				        $slide_path = DecryptContent($record['contents']);
			        }
				}
				/** Start Function copying all images from source to destination **/
				$source = pathinfo($slide_path);
				$source = $dir_root."app/".$source['dirname']."/images";
				$dest = pathinfo($slide_path);
				$dest = $dir_root_production.$dest['dirname']."/images";
				$copy_folder = cpy($source, $dest);
				/** End Function copying all images from source to destination **/

				$data = file_get_contents($web_root."app/".$slide_path);
				$data = str_replace($web_root."app/contents/assets", "../../../../assets", $data);
				$info = pathinfo($slide_path);
				$dir_path = $info['dirname'];
			  	$data = str_replace($web_root."app/".$dir_path."/", "", $data);
			  	file_put_contents($dir_root_production.$slide_path, $data);
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