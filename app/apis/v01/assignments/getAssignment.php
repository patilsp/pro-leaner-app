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
		// require_once($CFG->libdir.'/datalib.php');
		// require "../../loginSessionValidation.php";
		// require "../../common_functions.php";
		// require "../../db_functions.php";

		$courseviewid = $input['chapterid'];
		// $eligibleStatus = CheckCMIDAccess($courseviewid);
		$userid = $userData->id;
		//Common Data for all Slides
		// $cm = $DB->get_record_sql("SELECT id, course, instance FROM {course_modules} WHERE id=:courseviewid AND module = 1",array("courseviewid"=>$courseviewid));
		// $assignmentInfo = $DB->get_record('assignment_assign', array("id"=>$assignment_id));
		$query = "SELECT * FROM assignment_assign WHERE id = ?";
  		$stmt = $db->prepare($query);
  		$stmt->execute(array($assignment_id));
  		$cm = $stmt->fetch(PDO::FETCH_ASSOC);
		if($cm) {
			$assignment_id = $cm["id"];
			$courseid = $cm["course"];
			// $assignmentInfo = $DB->get_record('assign', array("id"=>$assignment_id));
			$title = $cm["name"];
			$instructions = strip_tags($cm["intro"]);
			$duedate = $cm["duedate"];
			$ctime = time();
			$grade = $cm["grade"];
			if($duedate < $ctime) {
				$duedateOver = true;
			} else {
				$duedateOver = false;
			}

			$protocol = "https";
			//Files
			// if($headers['Host'] == "test.skillprep.co" || $headers['Host'] == "skillprep.co" || $headers['Host'] == "prepmyskills.com") {
			// 	$protocol = "https";
			// } else {
			// 	$protocol = "http";
			// }
			// $base_url = $protocol."://".$_SERVER['HTTP_HOST']."/".$ilp_project_folder."/";
			$base_url = $web_root;
			$send_files = array();
			$files = GetRecords("pms_assignment_files", array("assignment_id"=>$assignment_id, "type"=>"assignment"));
			foreach($files as $file) {
				$send_files[] = array("path"=>$base_url.$file['upload_path'], "filename"=>$file['upload_filename']);
			}

			//Links
			$send_links = array();
			// $links = GetRecords("pms_assignment_links", array("assignment_id"=>$assignment_id));
			// foreach($links as $link) {
			// 	if($link['link'] == '') {
			// 		continue;
			// 	}
			// 	// $send_links[] = array("link"=>$link['link']);
			// 	$send_links[] = array("link"=>'');
			// }
			$send_links[] = array("link"=>'');
			//Submission Status
			$response['Result']['SubmissionOver'] = false;
			// $submission = $DB->get_record('assign_submission', array("assignment"=>$assignment_id, "userid"=>$userid));
			// if($submission) {
			// 	$response['Result']['SubmissionOver'] = true;
			// } else {
			// 	$response['Result']['SubmissionOver'] = false;
			// }

			$response['status'] = true;
			$response['Result']['InstanceName'] = $title;
			$response['Result']['Files'] = $send_files;
			$response['Result']['Links'] = $send_links;
			$response['Result']['DueDate'] = $duedate;
			$response['Result']['DueDateOver'] = $duedateOver;
			$response['Result']['Instructions'] = $instructions;
			// $response['Result']['L2Category'] = Encrypt(getL1CategoryID($courseid));
			$response['Result']['L2Category'] = '';
			$message = "Success";

			// add_to_log($courseid, 'assign', 'view', 'view.php?id='. $cm->id, $assignment_id, $cm->id, $userid);

			
			// $response['Result']['L2Category'] = Encrypt(getL1CategoryID($courseid));
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