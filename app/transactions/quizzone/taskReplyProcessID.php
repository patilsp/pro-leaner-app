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
			
			$autoid_status2 = InsertRecord("task_production_ready", array("task_id" => $task_id,
			"updated_by" => $logged_user_id
			));

			$status =true;
			$message ="Status Updated Successfully";
		} else {
			//Publish logic for pushing to skills4life
			
			/*foreach ($external_files as $value) {
				$copy_folder = cpyExternalFiles($value);
				if(strpos($value,".html") > 0) {
       	 			$html_file = str_replace($web_root."app/", "", $value);
              	}
			}*/
			$prev_slide_id = 0;
			$prev_lesson_id = 0;

			//getting topic id's of which we released for students
			$content4student_topic_ids = array();
          	$query = "SELECT courseid FROM $db_name.global_content_status WHERE content4student = 1";
          	$stmt = $db->query($query);
          	$rowcount = $stmt->rowCount();
          	if($rowcount){
            	while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
              		$content4student_topic_ids[] = $fetch['courseid'];
            	}
          	}
          	//Delete all the Slides
          	if( !in_array($topic_id, $content4student_topic_ids) ){
				$records = GetRecordsDistinct("add_slide_list", array("task_assign_id"=>$task_assi_id), "lesson_id");
				
				foreach($records as $record) {
					$lid = $record['lesson_id'];
					$querySch = "SELECT mysql_database FROM skillpre_schools.masters_school WHERE mysql_database = ? OR master_school_dbname = ? AND replicate = 1";
					$stmtSch = $db->prepare($querySch);
					$stmtSch->execute(array($master_db, $master_db));
					while($rowsSch = $stmtSch->fetch(PDO::FETCH_ASSOC))
					{
						$thisdb = $rowsSch['mysql_database'];
						DeleteRecord("$thisdb.mdl_lesson_pages", array("lessonid"=>$lid));
						DeleteRecord("$thisdb.mdl_lesson_answers", array("lessonid"=>$lid));
					}
					$query = "UPDATE add_slide_list SET skills4life_master_slide_id = NULL WHERE lesson_id = ?";
					$stmt = $db->prepare($query);
					$stmt->execute(array($lid));
				}
			}
			$records = GetRecords("add_slide_list", array("task_assign_id"=>$task_assi_id), array("lesson_id","sequence"));
			foreach($records as $record)
			{
				if($record['prev_slide_id'] > 0)
				{
					$prev_slide_id = $record['prev_slide_id'];
				}
				else if($record['lesson_id'] != $prev_lesson_id)
				{
					$prev_slide_id = 0;
				}

				$lesson_id = $record['lesson_id'];
				$html_file = $record['slide_file_path'];
				$html_file1 = str_replace($web_root."app","",$html_file);
				$title = $record['slide_title'];
				AddPopUp($record);
				
				CopyContentToSkills4life($html_file);
				$inserted_pageid_db = intval($record['skills4life_master_slide_id']);
				if($inserted_pageid_db > 0)
					continue;

				$inserted_pageid = insertUpdateSlide($lesson_id, $prev_slide_id, $html_file1, $title);
				if($inserted_pageid > 0)
				{
					$query = "UPDATE add_slide_list SET skills4life_master_slide_id = ?, status = ? WHERE id = ?";
					$stmt = $db->prepare($query);
					$stmt->execute(array($inserted_pageid, $up_status_cw, $record['id']));

					CopyContentToSkills4life($html_file);
				}
				$prev_slide_id = $inserted_pageid;
				$prev_lesson_id = $lesson_id;
			}
			$topic_info = GetRecord("course_folder_name", array("course_id"=>$topic_id));
			if(isset($topic_info['id']))
				$topic_name = $topic_info['folder_name'];
			else
				$topic_name = "";
			CopyCSSToSkills4life($html_file, $topic_name);
			CopyJSToSkills4life($html_file, $topic_name);
			CopyImagesToSkills4life($html_file, $topic_name);
			
			$autoid_status2 = InsertRecord("task_details", array("user_id" => $logged_user_id,
			"instructions" => "Task Published",
			"attachments" =>  '',
			"task_assign_id" => $task_assi_id,
			"status" => $up_status_cw
			));
			
			$query = "UPDATE task_assign SET status = ? WHERE tasks_id = ? AND user_id = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($up_status_cw, $task_assi_id, $task_userid));
			
			$query = "SELECT id FROM task_assign WHERE tasks_id = ? AND status != 13";
			$stmt = $db->prepare($query);
			$stmt->execute(array($task_assi_id));
			if($stmt->rowCount() == 0)
			{
				$query = "UPDATE tasks SET status_id = ? WHERE id = ?";
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