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
	if(isset($input['subectid'])) {
		$assessmentid = $input['assessmentid'];		 
		require('../../../configration/config.php');
		$subjectid = $input['subectid'];	 
		$userid = $userData->id;
		$classid = $userData->class;
		$allScenarios = array();
		$today = date('Y-m-d H:i:s');
		$sectiondata=array();
		$qarr = []; 
		$message="";
		 $query = "SELECT qp_qustpaper.id, qp_qustpaper.title, qp_qustpaper.totMarks, qp_qustpaper.total_question, qp_qustpaper.time_allowed, qp_master_qp_types.name as type,qp_master_questiontypes.code as question_type,qp_qustpaperclasssubid.qPaperType  FROM qp_qustpaper, qp_qustpaperclasssubid, qp_master_qp_types, qp_master_questiontypes 
		 WHERE qp_qustpaper.id = qp_qustpaperclasssubid.qustPaperId and qp_qustpaper.qpType = qp_master_qp_types.id and qp_qustpaperclasssubid.qPaperType = qp_master_questiontypes.id and classId = ? AND subId = ? AND publishStatus = 'published' and qp_qustpaper.id = ? ";
		 
		 //AND qp_qustpaperclasssubid.publish_date >= ?";
  		$stmt = $db->prepare($query);
  		$stmt->execute(array($classid, $subjectid, $assessmentid));
		 // $stmt->execute(array($classid, $subjectid, $assessmentid,$today));
  		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if($row) {
			
			$response['courseID'] = $row['id'];
			$response['L2Category'] = $row['id'];
			$response['TopicName'] = $row['title'];
			$response['QPType'] = $row['type'];
			$response['timeAllowed'] = $row['time_allowed'];
			$response['QuestionType'] = $row['question_type'];
			$response['qPaperType'] = $row['qPaperType'];

			$response_q = "SELECT userResJson,submittedStatus,marksObtained FROM qp_candidate_assess_response WHERE userId = ? AND assessId = ? LIMIT 1";
			$stmt1 = $db->prepare($response_q);
  			$stmt1->execute(array($userid, $row['id']));
  			$newrow = $stmt1->fetch(PDO::FETCH_ASSOC);
  			if ($newrow) {
  				$response['userStatus'] = $newrow['submittedStatus'];
  				$response['userResponse'] = $newrow['userResJson'];
  				$response['marksObtained'] = $newrow['marksObtained'];
  				$responsearr = json_decode($newrow['userResJson']);
  				foreach ($responsearr as $key => $value) {
					foreach ($value->section as $k => $val) {
						foreach ($val->questions as $k1 => $val1) {
							if ($val1) {
								$ansid = $val1->aId[0];
								$qarr[] = $val1;
							}
						}
					}
				}
  			} else {
  				$response['userStatus'] = 'New';
  				// $response['userResponse'] = '';
  			}
			
			//get sections
			$query3 = "SELECT id, secHeading,secTitle, secMarks FROM qp_qustpapersections   where  qustPaperId=?";
			$stmt3 = $db->prepare($query3);
			$stmt3->execute([$row['id']]);
			$row3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
			foreach($row3 as $sectionrow){
			
				$sectiondata = null;
				$sectiondata['secHeading'] = $sectionrow['secHeading'];
				$sectiondata['secTitle'] = $sectionrow['secTitle'];
				$sectiondata['secMarks'] = $sectionrow['secMarks'];
				$sectiondata['questions'] = [];


				//get question and answer
				$query1 = "SELECT qp_questions.id as QuestionId, qp_questions.question as QuestionText,qp_questiondetails.qustType, qp_qustpapersectionquestions.qustMark FROM qp_qustpapersections,qp_qustpapersectionquestions, qp_questions,qp_questiondetails
				WHERE qp_qustpapersections.id = qp_qustpapersectionquestions.qustPaperSectionId
				AND qp_qustpapersectionquestions.questionsId = qp_questions.id
				AND qp_questiondetails.id = qp_questions.qustDetailsId
				AND qp_qustpapersections.qustPaperId = ? AND qp_qustpapersections.id = ?";
				$stmt1 = $db->prepare($query1);
				$stmt1->execute(array($row['id'], $sectionrow['id']));
				while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
					$Question = null;
					$selectedAnswer = '';
					$Question['QuestionId'] =  $row1['QuestionId'];
					foreach ($qarr as $key => $value) {
						if ($value->qId == $row1['QuestionId']) {
							$selectedAnswer = $value->aId[0];
						}
					}
					$Question['QuestionLength'] = 0;
					$Question['ResponseId'] =0;
					$Question['QuestionText'] = $row1['QuestionText'];
					$Question['OptionIcon'] =  array();
					$Question['interactive'] = false;
					$Question['QuestionHeader'] = $row1['QuestionText'];
					$Question['QuestionHeaderTextClass'] = "globalStyleQustHeaderorange";
					$Question['QuestionFooter'] = "";
					$Question['QuestionBody'] = array();
					// $Question['QuestionType'] = "Radio Buttons";
					$Question['QuestionType'] = $row1['qustType'];
					$Question['ImageSource'] = array();
					$Question['QuesMarks'] =$row1['qustMark'];
					//get answers
					$query2 = "SELECT id, qId, optionContent,correctAns FROM qp_mcqoptions WHERE qId = ? ";
					$stmt2 = $db->prepare($query2);
					$stmt2->execute(array($row1['QuestionId']));
					$options_array = array();
					while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
						$options = array();
						$options['id'] = $row2['id']; 
						$options['question_id'] = $row2['qId']; 
						$options['content'] = $row2['optionContent']; 
						$options['value'] = null;
						if ($row2['correctAns'] == 1 && $response['userStatus'] != 'New') { 
							$options['correctAns'] = true; 
						} else {
							$options['correctAns'] = false;
						}
						if ($selectedAnswer == $row2['id'] && $response['userStatus'] != 'New') {
							$options['selectedAnswer'] = true; 
						} else {
							$options['selectedAnswer'] = false; 
						}
						array_push($options_array, $options);
					}


					$Question['QuestionOptions'] = $options_array;
				

					array_push($sectiondata['questions'],$Question);
					
					
				}
				array_push($allScenarios,$sectiondata);
			}	
			$response['Result'] = $allScenarios;
			$response['status'] = true;
			$response['Message'] = "";
		}	

		 
	} else {
		http_response_code(401);
		$message = "Required parameters are not sent";
	}
	// $response['TopicName'] = $questionnarie_name;
	$response['Message'] = $message;
	echo json_encode($response);
} else {
	$response = array();
	$response['status'] = false;
	$response['Message'] = "Unexpected HTTP Request Method";
	http_response_code(405);
	echo json_encode($response);
}