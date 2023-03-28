<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../../headersValidation.php";

require "../../../functions/db_functions.php";

require "../../../functions/common_functions.php";

include '../validate_token.php';

if($request_method == "POST") {
	$response = array();
	$response['status'] = false;
	$input = json_decode(file_get_contents('php://input'), true);
	if(isset($input['assignmentid'])) {
		
		global $DB, $USER, $CFG;
		//print_r($USER);
		// require_once($CFG->libdir.'/datalib.php');
		// require "../../loginSessionValidation.php";
		// require "../../common_functions.php";
		// require "../../db_functions.php";
		require('../../../configration/config.php');
		$courseviewid = $input['assignmentid'];
		// $userid = $USER->id;
		$userid = $userData->id;
		//$eligibleStatus = CheckCMIDAccess($courseviewid);
		//Common Data for all Slides

		$query = "SELECT   assignment_assign.grade as totlamarks, assignment_assign.name, assignment_assign.id, assign_submission.grade,assign_submission.marks, assign_submission.teacher_remarks, assign_submission.status, assignment_assign.evaluate_type  FROM assignment_assign, assign_submission WHERE assignment_assign.id = assign_submission.assignment AND assignment_assign.id = ?  and assign_submission.userid = ?  ";
		$stmt = $db->prepare($query);
		$stmt->execute(array($courseviewid,    $userid));
		 $assignmetstatus = array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
 

			$response['status'] = true;
			$response['Result']['Comments'] =  $row['teacher_remarks'];
			$response['Result']['Files'] = "";
			// $response['Result']['Files'] = $send_files;
			if($row['evaluate_type'] == "Marks"){
				$response['Result']['Grade'] = $row['marks'];
		
			}elseif($row['evaluate_type'] == "Grade"){
				$response['Result']['Grade'] = $row['grade'];
		
			}else{
				$response['Result']['Grade'] = "N/A";
		
			}
			$response['Result']['TotalMarks'] = $row['totlamarks'];
			$response['Result']['Title'] = $row['name'];
			$response['Result']['Type'] = $row['evaluate_type'];

			$message = "Success";
		}


		// $cm = $DB->get_record_sql("SELECT id, course, instance FROM assignment_assign WHERE id=:courseviewid AND module = 1",array("courseviewid"=>$courseviewid));
		// if($cm ) {
		// 	$assignment_id = $cm->instance;
		// 	$courseid = $cm->course;
		// 	$assignmentInfo = $DB->get_record('assign', array("id"=>$assignment_id));
		// 	$title = $assignmentInfo->name;
		// 	$instructions = strip_tags($assignmentInfo->intro);
		// 	$duedate = $assignmentInfo->duedate;
		// 	$ctime = time();
		// 	$max_grade = $assignmentInfo->grade;
		// 	$send_files = array();
		// 	$grade = "N/A";
		// 	$teacherRemarks = "";
		// 	$submission = $DB->get_record('assign_submission', array("assignment"=>$assignment_id, "userid"=>$userid));
		// 	if($submission) {
		// 		$gradeInfo = $DB->get_record('assign_grades', array("assignment"=>$assignment_id, "userid"=>$userid));
		// 		if($max_grade > 0) {
		// 			$grade = floatval($gradeInfo->grade);
		// 		} else {
		// 			$grade = "N/A";
		// 		}
		// 		$grade_id = $gradeInfo->id;
		// 		$teacherRemarks = $DB->get_record('assignfeedback_comments', array("assignment"=>$assignment_id, "grade"=>$grade_id))->commenttext;
		// 		//Feedback Files
		// 		//Files
		// 		if($headers['Host'] == "test.skillprep.co" || $headers['Host'] == "skillprep.co" || $headers['Host'] == "prepmyskills.com") {
		// 			$protocol = "https";
		// 		} else {
		// 			$protocol = "http";
		// 		}
		// 		$base_url = $protocol."://".$_SERVER['HTTP_HOST']."/".$ilp_project_folder."/";
				
		// 		$files = GetRecords("pms_assignment_files", array("assignment_id"=>$assignment_id, "student_id"=>$userid, "type"=>"feedback"));
		// 		foreach($files as $file) {
		// 			$filename = $file['upload_filename'];
		// 			if(strlen($filename) > 10) {
		// 				$filename = substr($filename, 0, 10)."...";
		// 			}
		// 			$send_files[] = array("path"=>$base_url.$file['upload_path'], "filename"=>$filename);
		// 		}
		// 	}

		// 	$response['status'] = true;
		// 	$response['Result']['Comments'] = $teacherRemarks;
		// 	$response['Result']['Files'] = $send_files;
		// 	$response['Result']['Grade'] = $grade;
		// 	$response['Result']['Title'] = $title;

		// 	$message = "Success";

		// } else if(!$eligibleStatus) {
		// 	$response['status'] = false;
		// 	$response['cmid'] = $courseviewid;
		// 	$message = "You dont have access to this lesson";
		// } else {
		// 	http_response_code(422);
		// 	$message = "Incorrect Course View ID";
		// }
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