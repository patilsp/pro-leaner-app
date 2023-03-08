<?php
	include_once "../../session_token/checksession.php";
	include "../../configration/config.php";
	include "../../configration/config_schools.php";
	include "../../functions/db_functions.php";
	require_once "../../functions/common_functions.php";
	$logged_user_id=$_SESSION['cms_userid'];
	try{
		$updated_on = date("Y-m-d H:i:s");
		$class_name = $_POST['class_name'];
		$topic_name = $_POST['topic_name'];
		$topic_id_review_status = $_POST['topic_id_review'];
		$topic_id_student_status = $_POST['topic_id_student'];
		$database = $master_db;

		foreach ($topic_name as $key => $value) {
			$topic_name = getSanitizedData($value);
			$topic_class = explode(" ", $class_name[$key]);
			$topic_class = $topic_class[1];
			if(isset($topic_id_student_status[$key])) {
				$student = 1;
			} else {
				$student = 0;
			}
			if(isset($topic_id_review_status[$key])) {
				$review = 1;
			} else {
				$review = 0;
			}
			
			$query = "SELECT * FROM $db_name.global_content_status WHERE courseid = '$key'";
          	$stmt = $db->query($query);
          	$rowcount = $stmt->rowCount();
          	if($rowcount){
          		$rows = $stmt->fetch(PDO::FETCH_ASSOC);
          		if($rows['content4student'] == 0 && $student) {
          			$query = "UPDATE $db_name.global_content_status SET released_on = NOW() WHERE courseid = ?";
					$stmt = $db->prepare($query);
					$stmt->execute(array($key));

					$query_mdl = "SELECT * FROM $database.mdl_course_sections WHERE sequence != '' AND course = ?";
		          	$stmt_mdl = $db->prepare($query_mdl);
		          	$stmt_mdl->execute(array($key));
		          	$rowcount_mdl = $stmt_mdl->rowCount();
		          	if($rowcount_mdl){
	          			$fetch_mdl = $stmt_mdl->fetch(PDO::FETCH_ASSOC);
						$lesson_id_imp = explode(",", $fetch_mdl['sequence']);
						$lesson_id =$lesson_id_imp[0];

						$autoid_status1 = InsertRecord("$db_name.global_notifications", array("master_database" => $database,
						"master_database" => $db_name,
						"class" =>  $topic_class,
						"course_id" => $key,
						"course_name" => $topic_name,
						"link" =>  "lesson/".$lesson_id,
						"created_on" => $updated_on
						));
		          	}
          		}

          		$query = "UPDATE $db_name.global_content_status SET content4review = ?, content4student = ? WHERE courseid = ?";
				$stmt = $db->prepare($query);
				$stmt->execute(array($review, $student, $key));
			} else {
          		$autoid_status1 = InsertRecord("$db_name.global_content_status", array("master_database" => $database,
				"courseid" => $key,
				"coursename" =>  $topic_name,
				"content4review" => $review,
				"content4student" => $student,
				"updated_on" => $updated_on,
				"updated_by" => $logged_user_id
				));
          	}
		}

		$status =true;
		$message ="Updated Successfully";

		$response = array("status"=>$status, "message"=>$message);
		echo json_encode($response);
	} catch(Exception $exp){
		echo "<pre/>";
    	print_r($exp);
	}
?>