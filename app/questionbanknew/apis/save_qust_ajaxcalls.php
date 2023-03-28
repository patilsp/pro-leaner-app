<?php



include_once "../../session_token/checksession.php";
include_once "../../configration/config.php";
//include_once "session_token/checktoken.php";
require_once "../../functions/db_functions.php";
require('../../configration/config.php');
 
   
	/*echo "<pre/>";
	print_r($_POST);die;*/
 
	$updated_on = date("Y-m-d H:i:s");
	$logged_user_id=$_SESSION['cms_userid'];
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
	$catId = 0;
	// $getCatId = GetRecord("setup_map_class_category", array("classId"=>$classId));
	// $catId = '';
	// if(!empty($getCatId)) {
	// 	$catId = $getCatId['catId'];
	// }

	
	$qustType = $_POST['qustType'];
	$qustIp = $_POST['qustIp'];
	
	$qustDetId = '';

	$query = "INSERT INTO qp_questiondetails (catId, classId, subId, qustType, createdBy, chapId, topicId, subTopicId, difficultyId, assesType, noTimes, quesMarks ) VALUES (?, ?, ?, ?, ?,?,?,?,?,?,?,?)";
	    $stmt = $db->prepare($query);
	    $stmt->execute(array($catId, $classId, $subjectId, $qustType, $logged_user_id,$course,$topic,$subtopic, $difficultyId, $assesType, $noTimes,$quesMarks));
	    $qustDetId = $db->lastInsertId();


	if($qustType == 3) {
		//$saAnsIp = getSanitizedData($_POST['saAnsIp']);
		//$saKeywords = getSanitizedData($_POST['saKeywords']);
		//$saKeywords = explode(",", $saKeywords);

		$saAnsIp = '';
		 
		
		
	    if( $stmt ) {
	    	$query = "INSERT INTO qp_questions (qustDetailsId, question) VALUES (?, ?)";
		    $stmt = $db->prepare($query);
		    $stmt->execute(array($qustDetId, $qustIp));
		    $qustId = $db->lastInsertId();

		    $query = "INSERT INTO qp_shortanser (qId, ans) VALUES (?, ?)";
		    $stmt = $db->prepare($query);
		    $stmt->execute(array($qustDetId, $saAnsIp));
		    $qustId = $db->lastInsertId();

		    /*foreach($saKeywords as $value){
		    	$query1 = "INSERT INTO shortanserkeywords (qid, keyWords) VALUES (?, ?)";
			    $stmt1 = $db->prepare($query1);
			    $stmt1->execute(array($qustId, $value));
		    }*/
    	}
	} else if($qustType == 4) {
		$qustTb = $_POST['editorTbQust'];
		$ansTb = $_POST['editorAns'];
		//$ansTb = "";

		
		
	    if( $stmt ) {
	    	$query = "INSERT INTO qp_questions (qustDetailsId, question) VALUES (?, ?)";
		    $stmt = $db->prepare($query);
		    $stmt->execute(array($qustDetId, $qustIp));
		    $qustId = $db->lastInsertId();

		    foreach($qustTb as $key=>$qust){
		    	$query1 = "INSERT INTO qp_shortansertable (qid, qustTd, ansTd) VALUES (?, ?, ?)";
			    $stmt1 = $db->prepare($query1);
			    $stmt1->execute(array($qustId, $qust, $ansTb[$key]));
		    }
    	}
	} else if($qustType == 5) {
		$qustCol = $_POST['editorDDTbQust'];
		$ansCol = $_POST['editorDDAns'];

		
	    if( $stmt ) {
	    	$query = "INSERT INTO qp_questions (qustDetailsId, question) VALUES (?, ?)";
		    $stmt = $db->prepare($query);
		    $stmt->execute(array($qustDetId, $qustIp));
		    $qustId = $db->lastInsertId();

		    foreach($qustCol as $key=>$qust){
		    	$query1 = "INSERT INTO qp_ddmatchqust (qid, qustCol) VALUES (?, ?)";
			    $stmt1 = $db->prepare($query1);
			    $stmt1->execute(array($qustId, $qust));
			    $ddmatchqustId = $db->lastInsertId();

			    $query1 = "INSERT INTO qp_ddmatchans (ddMatchQustId, ansCol) VALUES (?, ?)";
			    $stmt1 = $db->prepare($query1);
			    $stmt1->execute(array($ddmatchqustId, $ansCol[$key]));
			    $ddmatchqustId = $db->lastInsertId();
		    }
    	}
	} else if($qustType == 6) {
		$qustFill = $_POST['editorFillInTheBlankQust'];

		/*foreach($qustFill as $key=>$qust){
	    	$qust = strip_tags($qust);
	    	echo $qust;die;
	    	$query1 = "INSERT INTO fillintheblank (qid, qustFill, ansFill) VALUES (?, ?, ?)";
		    $stmt1 = $db->prepare($query1);
		    $stmt1->execute(array($qustId, $qust, ''));
	    }*/
		
		
	    if( $stmt ) {
	    	$query = "INSERT INTO qp_questions (qustDetailsId, question) VALUES (?, ?)";
		    $stmt = $db->prepare($query);
		    $stmt->execute(array($qustDetId, $qustIp));
		    $qustId = $db->lastInsertId();

		    foreach($qustFill as $key=>$qust){
		    	$qust = strip_tags($qust);
		    	$query1 = "INSERT INTO qp_fillintheblank (qid, qustFill) VALUES (?, ?)";
			    $stmt1 = $db->prepare($query1);
			    $stmt1->execute(array($qustId, $qust));
		    }
    	}
	} else if($qustType == 7) {
		$nestedQuestion = object_to_array(json_decode($_POST['questions']));

		
	    if( $stmt ) {
	    	$query = "INSERT INTO qp_questions (qustDetailsId, question) VALUES (?, ?)";
		    $stmt = $db->prepare($query);
		    $stmt->execute(array($qustDetId, $qustIp));
		    $qustId = $db->lastInsertId();

		    foreach($nestedQuestion as $key=>$value){

		    	if($value['qTypeText'] == 'SA') {
		    		$query1 = "INSERT INTO qp_nestedshortanser (qid, question) VALUES (?, ?)";
				    $stmt1 = $db->prepare($query1);
				    $stmt1->execute(array($qustId, $value['qText']));
		    	} else if($value['qTypeText'] == 'MCQ') {
		    		$query1 = "INSERT INTO qp_nestedmcqquestions (qid, question) VALUES (?, ?)";
				    $stmt1 = $db->prepare($query1);
				    $stmt1->execute(array($qustId, $value['qText']));
				    $nestedmcqquestionsId = $db->lastInsertId();

				    foreach ($value['qOptionText'] as $key1 => $value1) {
				    	$query2 = "INSERT INTO qp_nestedmcqoptions (nestedmcqqId, 	optionContent, correctAns) VALUES (?, ?, ?)";
					    $stmt2 = $db->prepare($query2);
					    $stmt2->execute(array($nestedmcqquestionsId, $value1, $value['qOptionStatus'][$key1]));
				    }
	    		}
		    }
    	}
	} else {
		

		$optionContent = explode("\n,", $_POST['options']);
		$optionStatus = $_POST['optionStatus'];

		
	    if( $stmt ) {
			
	    	$query = "INSERT INTO qp_questions (qustDetailsId, question) VALUES (?, ?)";
		    $stmt = $db->prepare($query);
		    $stmt->execute(array($qustDetId, $qustIp));
		    $qustId = $db->lastInsertId();

		    foreach($optionContent as $key=>$value){
		    	$optionRes = $optionStatus[$key];
		    	$query1 = "INSERT INTO qp_mcqoptions (qId, optionContent, correctAns) VALUES (?, ?, ?)";
			    $stmt1 = $db->prepare($query1);
			    $stmt1->execute(array($qustId, $value, $optionRes));
		    }
		} 
	}

	echo $qustDetId;




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