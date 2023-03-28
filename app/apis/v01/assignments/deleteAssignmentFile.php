<?php

require_once "../../headersValidation.php";
require "../../../functions/db_functions.php";
require "../../../functions/common_functions.php";
include '../validate_token.php';
if($request_method == "POST") {
	$response = array();
	$response['status'] = false;
	$input = json_decode(file_get_contents('php://input'), true);
	if(isset($input['assignmentid'])) {
		require('../../../configration/config.php');
		global $DB, $USER, $CFG;
		//print_r($USER);
		// require_once($CFG->libdir.'/datalib.php');
		// require "../../loginSessionValidation.php";
		// require "../../common_functions.php";
		// require "../../db_functions.php";
		// $courseviewid = Decrypt($input['assignmentid']);
		$courseviewid =  $input['assignmentid'] ;
		$assignment_id =  $input['assignmentid'] ;
		// $eligibleStatus = CheckCMIDAccess($courseviewid);
		$file_ref = $input['file_ref'];
		// $userid = $USER->id;
		$userid = $userData->id;
		//Common Data for all Slides
		//$cm = $DB->get_record_sql("SELECT id, course, instance FROM {course_modules} WHERE id=:courseviewid AND module = 1",array("courseviewid"=>$courseviewid));
		// if($cm && $eligibleStatus) {
		$query = "SELECT * FROM pms_assignment_files WHERE id = ? and assignment_id =? and student_id = ?";
		$stmt = $db->prepare($query);
		$stmt->execute(array($file_ref, $assignment_id,$userid));
		$cm = $stmt->fetch(PDO::FETCH_ASSOC);
		if($cm) {	
			// $assignment_id = $cm->instance;
			// $courseid = $cm->course;

			$file_data = GetRecord("pms_assignment_files", array("id"=>$file_ref));
			if($file_data) {
				$new_path = "../../../".$file_data['upload_path'];
				if(file_exists($new_path)) {
					unlink($new_path);
				}
				DeleteRecord("pms_assignment_files", array("id"=>$file_ref));
				$response['status'] = true;
				$message = "File deleted successfully";
			} else {
				$response['status'] = false;
				$message = "Invalid File Reference";
			}
		} else if(!$eligibleStatus) {
			$response['status'] = false;
			$response['cmid'] = $courseviewid;
			$message = "You dont have access to this lesson";
		} else {
			http_response_code(422);
			$message = "Incorrect Course View ID";
		}
	} else {
		http_response_code(401);
		$message = "Required parameters are not sent";
	}
	
	$response['Message'] = $message;
	echo json_encode($response);
} else {
	$response = array();
	$response['status'] = false;
	$response['Message'] = "Unexpected HTTP Request Method";
	http_response_code(405);
	echo json_encode($response);
}