<?php
	session_start();
  include "../../configration/config.php";
  require_once "../../functions/db_functions.php";

	/*echo "<pre/>";
	print_r($_POST);
	echo "<pre/>";
	$questions =  json_decode($_POST['questions']);
	$marks =  json_decode($_POST['marks']);
	print_r($questions);
	print_r($marks);
	die;*/

	$title = $_POST['title'];
	$catId = "";
	if(isset($_POST['catId'])){
		$catId = $_POST['catId'];
	}
	$classId = "";
	$course = "";
	$topic = "";
	$subtopic = "";
	$section = "";
	$qType = "";
	$qEvaluation = "";
	$qPaperType = "";
	$qdueby = "";
	$qpublishdate = "";
	if(isset($_POST['classId'])){
		$classId = $_POST['classId'];
	}
	if(isset($_POST['course'])){
		$course = $_POST['course'];
	}
	if(isset($_POST['topic'])){
		$topic = $_POST['topic'];
	}
	if(isset($_POST['subtopic'])){
		$subtopic = $_POST['subtopic'];
	}
	if(isset($_POST['selectedSection'])){
		$section = $_POST['selectedSection'];
	}
	// if(isset($_POST['qType'])){
	// 	$qType = $_POST['qType'];
	// }
	if(isset($_POST['qEvaluation'])){
		$qEvaluation = $_POST['qEvaluation'];
	}
	if(isset($_POST['qPaperType'])){
		$qPaperType = $_POST['qPaperType'];
	}
	if(isset($_POST['dueby'])){
		$qdueby = date("H:i:s",strtotime($_POST['dueby']));
	}
	if(isset($_POST['publishdate'])){
		$qpublishdate = date("Y-m-d",strtotime($_POST['publishdate']));
	}
	$qpublishdate = $qpublishdate.' '.$qdueby;
	$qpType = $_POST['qpType'];
	$subjectId = $_POST['classSubjectId'];
	$timeAllow = $_POST['timeAllow'];
	$st = $_POST['st'];
	$sh = $_POST['sh'];
	$sm = $_POST['sm'];
	$qustIds =  json_decode($_POST['questions']);
	$qustMark =  json_decode($_POST['marks']);
	
	$totMarks = 0;
	$totQusts = 0;
	$secMarks = [];
	foreach ($qustMark as $key => $value) {
		$secMarks[$key] = 0;
		foreach ($value as $key1 => $mark) {
			$totMarks += $mark;
			$totQusts++;
			$secMarks[$key] += $mark;
		}
	}

	$query = "INSERT INTO qp_qustpaper (title, qpType, totMarks, total_question, time_allowed, publishStatus) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->execute(array($title, $qpType, $totMarks, $totQusts, $timeAllow, 'yet to publish'));
    $qustpaperId = $db->lastInsertId();

    $query = "INSERT INTO qp_qustpaperclasssubid (qustPaperId, catId, classId, subId,chapId,topicId,subtopicId,sectionId,qEvaluation,qPaperType,due_by,publish_date) VALUES (?, ?, ?, ?, ?, ? ,?,?,?,?,?,?)";
    $stmt = $db->prepare($query);
    $stmt->execute(array($qustpaperId, $catId, $classId, $subjectId,$course,$topic,$subtopic,$section,$qEvaluation,$qPaperType,$qdueby,$qpublishdate));

	foreach ($sh as $key => $secHeading) {
		$query = "INSERT INTO qp_qustpapersections (qustPaperId, secHeading, secTitle, secMarks) VALUES (?, ?, ?, ? )";
	    $stmt = $db->prepare($query);
	    $stmt->execute(array($qustpaperId, $secHeading, $st[$key], $secMarks[$key]));
	    $qustsecId = $db->lastInsertId();

	    foreach ($qustIds[$key] as $key1 => $qustId) {
			$query1 = "INSERT INTO qp_qustpapersectionquestions (qustPaperSectionId, questionsId, qustMark) VALUES (?, ?, ?)";
		    $stmt1 = $db->prepare($query1);
		    $stmt1->execute(array($qustsecId, $qustId, $qustMark[$key][$key1]));
	    }
	}

	echo $qustpaperId
?>