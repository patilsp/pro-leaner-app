<?php
	include_once "../../session_token/checksession.php";
	include "../../configration/config.php";
	include "../../configration/config_schools.php";
	include "../../functions/db_functions.php";
	require_once "../../functions/common_functions.php";
	$logged_user_id=$_SESSION['cms_userid'];
	try{
		$content4student_topic_ids = array();
      	$query = "SELECT courseid FROM $db_name.global_content_status WHERE content4student = 1 AND released_on > '2019-09-01 00:00:00'";
      	$stmt = $db->query($query);
      	$rowcount = $stmt->rowCount();
      	if($rowcount){
	        while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
	          $content4student_topic_ids[] = $fetch['courseid'];
	        }
      	}
		$database = $master_db;

		foreach ($content4student_topic_ids as $key => $value) {
			$path = getCategoryInfo($value);
			$class_name = end($path);
			$topic_class = str_replace("Class ", "", $class_name);
			$query_mdl = "SELECT * FROM $database.mdl_course_sections WHERE sequence != '' AND course = ?";
          	$stmt_mdl = $db->prepare($query_mdl);
          	$stmt_mdl->execute(array($value));
          	$rowcount_mdl = $stmt_mdl->rowCount();
          	if($rowcount_mdl) {
      			$fetch_mdl = $stmt_mdl->fetch(PDO::FETCH_ASSOC);
				$lesson_id_imp = explode(",", $fetch_mdl['sequence']);
				$lesson_id =$lesson_id_imp[0];
				$updated_on = date("Y-m-d H:i:s");

				$autoid_status1 = InsertRecord("$db_name.global_notifications", array(
				"master_database" => $database,
				"class" =>  $topic_class,
				"course_id" => $value,
				"course_name" => $path[0],
				"link" =>  "lesson/".$lesson_id,
				"created_on" => $updated_on
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

	function getCategoryInfo($courseid)
	{
		try {
			global $master_db;
			$result = array();
			$courseInfo = GetRecord($master_db.'.mdl_course', array('id' => $courseid));
			if($courseInfo) {
				$result[] = $courseInfo['fullname'];
				$category = $courseInfo['category'];
				$categoryInfo = GetRecord($master_db.'.mdl_course_categories', array('id' => $category));
				if($categoryInfo) {
					$result[] = $categoryInfo['name'];
					$path = $categoryInfo['path'];
					$temp = explode("/", $path);
					unset($temp[count($temp)-1]);
					$temp = array_filter($temp);
					$temp = array_reverse($temp);
					foreach ($temp as $key => $value) {
						$record = GetRecord($master_db.'.mdl_course_categories', array('id' => $value));
						$result[] = $record['name'];
					}
				}
			}
			return $result;
		} catch(Exception $exp) {
			print_r($exp);
		}
	}
?>