<?php
require_once "../../headersValidation.php";

require "../../../functions/db_functions.php";

require "../../../functions/common_functions.php";

include '../validate_token.php';
require('../../../configration/config.php');


if($request_method == "POST") {

	$saveReslt= [];$saveReslt1= []; 
	
	$response = array();
	$response['status'] = false;
	$_POST['time_taken'] = 0;
	$input = json_decode(file_get_contents('php://input'), true);
	$assessmentid = $input['assessmentid'];
 
	$userid = $userData->id;
	$classid = $userData->class;
	if(isset($input['questResponses'])) {

		$saveReslt[]['section'][]['questions'] = $input['questResponses'];
	   	// $saveReslt1['section'][] = $saveReslt;
		$results =json_encode($saveReslt);
		 
		// global $DB, $USER, $CFG;
		// require_once($CFG->libdir.'/datalib.php');
		// require "../../loginSessionValidation.php";
		// require_once "../../db_functions.php";
		// require_once "../../common_functions.php";
		try{
		$feedback = array();
		$allFeedbacks = array();
		$score = 0;
		$status=false;
		$query1 = "SELECT * FROM qp_candidate_assess_response  WHERE assessId = ? AND userId=?";
		$stmt1 = $db->prepare($query1);
		$stmt1->execute([$assessmentid, $userid]);
		$row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
		
		if(!isset($row1['id'])){
			$query = "INSERT INTO qp_candidate_assess_response (userId, assessId, userResJson, submittedStatus,submittedBy, submittedOn,time_taken) VALUES (?, ?, ?, ?, ?, NOW(),?)";
			$stmt = $db->prepare($query);
			$stmt->execute(array($userid, $assessmentid, $results,'submitted',$userid,$_POST['time_taken']));  
			$id = $db->lastInsertId();
			if($id!=''){
				$status=true;
			} 
			$query2 = "SELECT * FROM qp_qustpaperclasssubid WHERE qustPaperId = ?";
			$stmt2 = $db->prepare($query2);
			$stmt2->execute([$assessmentid]);
			$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
			if ($row2["qEvaluation"] == 4) {
				getMarks($assessmentid,$results,$id);
			}

		}	

		 
		$feedback['DevProfile'] = $dev_prof_reports;
		$response['Feedback'] = $feedback;
		$response['status'] = true;
		} catch(Exception $exp) {
			print_r($exp);
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

function getMarks($assessmentid,$json,$id) {
	global $db;
	$responsearr = json_decode($json);
	foreach ($responsearr as $key => $value) {
		foreach ($value->section as $k => $val) {
			$marks = '';
			$questionwise = [];
			$marksobtained = 0;
			foreach ($val->questions as $k1 => $val1) {
				if ($val1) {
					$rec = GetQueryRecords("SELECT id, qId, optionContent,correctAns FROM qp_mcqoptions WHERE qId = '".$val1->qId."'");
					if (!empty($rec)) {
						foreach ($rec as $x => $y) {
							if ($val1->aId[0] == $y["id"]) {
								if ($y["correctAns"] == 1) {
									$marks = '"'.$val1->qId.'-1"';
									$marksobtained = $marksobtained+1;
									array_push($questionwise, $marks);
								} else {
									$marks = '"'.$val1->qId.'-0"';
									$marksobtained = $marksobtained+0;
									array_push($questionwise, $marks);
								}
							}
						}
						$ansid = $val1->aId[0];
						$qarr[] = $val1;
					}
					
				}
			}
		}

	}
	$questionwisestr = '['.implode(",", $questionwise).']';
	$query = "UPDATE qp_candidate_assess_response SET QuestionWiseMarksObtained = ?, evaluateStatus = ?, marksObtained =?,resultStatus = ?, evaluateBy= ? WHERE id=?";
	$stmt = $db->prepare($query);
	$stmt->execute(array($questionwisestr, 'Completed', $marksobtained,'Pass', 5 , $id));  
	
}