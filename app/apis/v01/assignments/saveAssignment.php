<?php
require_once "../../headersValidation.php";

require "../../../functions/db_functions.php";

require "../../../functions/common_functions.php";

include '../validate_token.php';
$request_method = "POST";
if($request_method == "POST") {
	$response = array();
	$response['status'] = false;
	$input = json_decode(file_get_contents('php://input'), true);
	if(isset($input['chapterid'])) {
		$assignment_id = $input['assignment_id'];
		require('../../../configration/config.php');
		global $DB, $USER, $CFG;
		//print_r($USER);
		$login_userid = $userData->id;
		$courseviewid = $input['chapterid'];
		// $eligibleStatus = CheckCMIDAccess($courseviewid);
		//Common Data for all Slides
		$query = "SELECT * FROM assignment_assign WHERE id = ?";
  		$stmt = $db->prepare($query);
  		$stmt->execute(array($assignment_id));
  		$cm = $stmt->fetch(PDO::FETCH_ASSOC);
		if($cm) {
			$assignment_id = $assignment_id;
			$courseid = $cm["course"];

			$queryi = "INSERT INTO assign_submission (assignment, userid, timecreated, timemodified, status, groupid) VALUES (?, ?, ?, ?, ?, ?)";
			$resulti=$db->prepare($queryi);
		  $resulti->execute(array($assignment_id, $login_userid, time(), time(), "submitted", 0));
		  $submission_id = $db->lastInsertId();

		  $comments = getSanitizedData($input['comments']);
		  $queryi = "INSERT INTO assignsubmission_onlinetext (assignment, submission, onlinetext, onlineformat) VALUES (?, ?, ?, ?)";
			$resulti=$db->prepare($queryi);
		  $resulti->execute(array($assignment_id, $submission_id, $comments, 0));

			$response['status'] = true;

			$message = "Assignment submitted successfully";

			// add_to_log($courseid, 'assign', 'view', 'view.php?id='. $cm->id, $assignment_id, $cm->id, $USER->id);
			
			$response['Result']['L2Category'] = '';
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