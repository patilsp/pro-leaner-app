<?php
include_once "../../session_token/checksession.php";
include_once "../../configration/config.php";
//include_once "session_token/checktoken.php";
require_once "../../functions/db_functions.php";

	/*echo "<pre/>";
	print_r($_POST);
	echo "<pre/>";die;*/
	$updated_on = date("Y-m-d H:i:s");
	$logged_user_id=$_SESSION['assess_userid'];
	$type = getSanitizedData($_POST['type']);
	$question_details_id = getSanitizedData($_POST['question_details_id']);
	
	$status = false;
	if($type == 'deleteQuestion') {
		$sql2 ="UPDATE qp_questiondetails SET deleted=1, updatedBy=?, updatedOn=? WHERE id = ?";
		$query2 = $db->prepare($sql2);
		$query2->execute(array($logged_user_id, $updated_on, $question_details_id));
		$rowcount2 = $query2->rowCount();
		if($rowcount2) {
			$status = true;
		} else {
			$status = false;
		}

		echo $status;
	} else {
		$question_id = getSanitizedData($_POST['question_id']);
		$classId = $_POST['classId'];
		$subjectId = $_POST['classSubjectId'];
		
		$course = $_POST['course'];
		$topic = $_POST['topic'];
		$subtopic = $_POST['subtopic'];
		$difficultyId = $_POST['difficultyType'];
		$noTimes = $_POST['noTimes'];
		$quesMarks = $_POST['quesMarks']; 
		$assesTypearr = $_POST['assesType']; 
		$assesType = implode(",", $assesTypearr);
		// $getCatId = GetRecord("setup_map_class_category", array("classId"=>$classId));
		// $catId = '';
		// if(!empty($getCatId)) {
		// 	$catId = $getCatId['catId'];
		// }

		
	
		$catId = 0;
		$qustType = $_POST['qustType'];
		$qustIp = $_POST['qustIp'];

		$sql2 ="UPDATE qp_questiondetails SET catId=?, classId=?, subId=?, updatedBy=?, updatedOn=?, chapId=?, topicId=?, subTopicId=?, difficultyId=?, assesType=?, noTimes=?, quesMarks=? WHERE id = ?";
		$query2 = $db->prepare($sql2);
		$query2->execute(array($catId, $classId, $subjectId, $logged_user_id, $updated_on,  $course,$topic,$subtopic, $difficultyId, $assesType, $noTimes,$quesMarks, $question_details_id));
		$rowcount2 = $query2->rowCount();	

		if($qustType == 1 || $qustType == 2) {
			$optionContent = explode("\n,", $_POST['options']);
			$optionStatus = $_POST['optionStatus'];

			// $sql2 ="UPDATE qp_questiondetails SET catId=?, classId=?, subId=?, updatedBy=?, updatedOn=? WHERE id = ?";
			// $query2 = $db->prepare($sql2);
			// $query2->execute(array($catId, $classId, $subjectId, $logged_user_id, $updated_on, $question_details_id));
			// $rowcount2 = $query2->rowCount();	
		
			$sql2 ="UPDATE qp_questions SET question=? WHERE id = ?";
			$query2 = $db->prepare($sql2);
			$query2->execute(array($qustIp, $question_details_id));
			$rowcount2 = $query2->rowCount();

			$query = "DELETE FROM qp_mcqoptions WHERE qId = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($question_id));

			foreach($optionContent as $key=>$value){
		    	$optionRes = $optionStatus[$key];
		    	$query1 = "INSERT INTO qp_mcqoptions (qId, optionContent, correctAns) VALUES (?, ?, ?)";
			    $stmt1 = $db->prepare($query1);
			    $stmt1->execute(array($question_id, $value, $optionRes));
		    }
	    } else if($qustType == 3) {
	    	// $sql2 ="UPDATE qp_questiondetails SET catId=?, classId=?, subId=?, updatedBy=?, updatedOn=? WHERE id = ?";
			// $query2 = $db->prepare($sql2);
			// $query2->execute(array($catId, $classId, $subjectId, $logged_user_id, $updated_on, $question_details_id));
			// $rowcount2 = $query2->rowCount();	
			
			$sql2 ="UPDATE qp_questions SET question=? WHERE id = ?";
			$query2 = $db->prepare($sql2);
			$query2->execute(array($qustIp, $question_details_id));
			$rowcount2 = $query2->rowCount();
	    } else if($qustType == 4) {
	    	$qustTb = $_POST['editorTbQust'];
			$ansTb = $_POST['editorAns'];

	    	// $sql2 ="UPDATE qp_questiondetails SET catId=?, classId=?, subId=?, updatedBy=?, updatedOn=? WHERE id = ?";
			// $query2 = $db->prepare($sql2);
			// $query2->execute(array($catId, $classId, $subjectId, $logged_user_id, $updated_on, $question_details_id));
			// $rowcount2 = $query2->rowCount();	
			
			$sql2 ="UPDATE qp_questions SET question=? WHERE id = ?";
			$query2 = $db->prepare($sql2);
			$query2->execute(array($qustIp, $question_details_id));
			$rowcount2 = $query2->rowCount();

			$query = "DELETE FROM qp_shortansertable WHERE qId = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($question_id));

			foreach($qustTb as $key=>$qust){
		    	$query1 = "INSERT INTO qp_shortansertable (qid, qustTd, ansTd) VALUES (?, ?, ?)";
			    $stmt1 = $db->prepare($query1);
			    $stmt1->execute(array($question_id, $qust, $ansTb[$key]));
		    }
	    } else if($qustType == 5) {
	    	$qustCol = $_POST['editorDDTbQust'];
			$ansCol = $_POST['editorDDAns'];

	    	// $sql2 ="UPDATE qp_questiondetails SET catId=?, classId=?, subId=?, updatedBy=?, updatedOn=? WHERE id = ?";
			// $query2 = $db->prepare($sql2);
			// $query2->execute(array($catId, $classId, $subjectId, $logged_user_id, $updated_on, $question_details_id));
			// $rowcount2 = $query2->rowCount();	
			
			$sql2 ="UPDATE qp_questions SET question=? WHERE id = ?";
			$query2 = $db->prepare($sql2);
			$query2->execute(array($qustIp, $question_details_id));
			$rowcount2 = $query2->rowCount();

			$query = "SELECT * FROM qp_ddmatchqust WHERE qId=?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($question_id));
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$query1 = "DELETE FROM qp_ddmatchans WHERE ddMatchQustId = ?";
				$stmt1 = $db->prepare($query1);
				$stmt1->execute(array($row['id']));
			}

			$query = "DELETE FROM qp_ddmatchqust WHERE qId = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($question_id));

			foreach($qustCol as $key=>$qust){
		    	$query1 = "INSERT INTO qp_ddmatchqust (qid, qustCol) VALUES (?, ?)";
			    $stmt1 = $db->prepare($query1);
			    $stmt1->execute(array($question_id, $qust));
			    $ddmatchqustId = $db->lastInsertId();

			    $query1 = "INSERT INTO qp_ddmatchans (ddMatchQustId, ansCol) VALUES (?, ?)";
			    $stmt1 = $db->prepare($query1);
			    $stmt1->execute(array($ddmatchqustId, $ansCol[$key]));
			    $ddmatchqustId = $db->lastInsertId();
		    }
	    } else if($qustType == 6) {
	    	$qustTb = $_POST['editorFillInTheBlankQust'];

	    	// $sql2 ="UPDATE qp_questiondetails SET catId=?, classId=?, subId=?, updatedBy=?, updatedOn=? WHERE id = ?";
			// $query2 = $db->prepare($sql2);
			// $query2->execute(array($catId, $classId, $subjectId, $logged_user_id, $updated_on, $question_details_id));
			// $rowcount2 = $query2->rowCount();	
			
			$sql2 ="UPDATE qp_questions SET question=? WHERE id = ?";
			$query2 = $db->prepare($sql2);
			$query2->execute(array($qustIp, $question_details_id));
			$rowcount2 = $query2->rowCount();

			$query = "DELETE FROM qp_fillintheblank WHERE qId = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($question_id));

			foreach($qustTb as $key=>$qust){
				$qust = strip_tags($qust);
		    	$query1 = "INSERT INTO qp_fillintheblank (qId, qustFill) VALUES (?, ?)";
			    $stmt1 = $db->prepare($query1);
			    $stmt1->execute(array($question_id, $qust));
		    }
	    } else if($qustType == 7) {
			$nestedQuestion = object_to_array(json_decode($_POST['questions']));

			// $sql2 ="UPDATE qp_questiondetails SET catId=?, classId=?, subId=?, updatedBy=?, updatedOn=? WHERE id = ?";
			// $query2 = $db->prepare($sql2);
			// $query2->execute(array($catId, $classId, $subjectId, $logged_user_id, $updated_on, $question_details_id));
			// $rowcount2 = $query2->rowCount();	
			
			$sql2 ="UPDATE qp_questions SET question=? WHERE id = ?";
			$query2 = $db->prepare($sql2);
			$query2->execute(array($qustIp, $question_details_id));
			$rowcount2 = $query2->rowCount();

			$query = "DELETE FROM qp_nestedshortanser WHERE qId = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($question_id));

			$nestedmcqquestions = GetRecords("qp_nestedmcqquestions", array("qId"=>$question_id));
			foreach ($nestedmcqquestions as $nestedmcqquestion) {
				$query = "DELETE FROM qp_nestedmcqoptions WHERE nestedmcqqId = ?";
				$stmt = $db->prepare($query);
				$stmt->execute(array($nestedmcqquestion['id']));
			}

			$query = "DELETE FROM qp_nestedmcqquestions WHERE qId = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($question_id));

			foreach($nestedQuestion as $key=>$value){

		    	if($value['qTypeText'] == 'SA') {
		    		$query1 = "INSERT INTO qp_nestedshortanser (qid, question) VALUES (?, ?)";
				    $stmt1 = $db->prepare($query1);
				    $stmt1->execute(array($question_id, $value['qText']));
		    	} else if($value['qTypeText'] == 'MCQ') {
		    		$query1 = "INSERT INTO qp_nestedmcqquestions (qid, question) VALUES (?, ?)";
				    $stmt1 = $db->prepare($query1);
				    $stmt1->execute(array($question_id, $value['qText']));
				    $nestedmcqquestionsId = $db->lastInsertId();

				    foreach ($value['qOptionText'] as $key1 => $value1) {
				    	$query2 = "INSERT INTO qp_nestedmcqoptions (nestedmcqqId, 	optionContent, correctAns) VALUES (?, ?, ?)";
					    $stmt2 = $db->prepare($query2);
					    $stmt2->execute(array($nestedmcqquestionsId, $value1, $value['qOptionStatus'][$key1]));
				    }
	    		}
		    }
		}

	    echo $question_details_id;
	}

	function object_to_array($data)
	{
	    if (is_array($data) || is_object($data))
	    {
	    	$result = [];
	        foreach ($data as $key => $value)
	        {
	            $result[$key] = (is_array($data) || is_object($data)) ? object_to_array($value) : $value;
	        }
	        return $result;
	    }
	    return $data;
	}
?>