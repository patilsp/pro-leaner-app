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
	$qpublishdate = '';
	$qDueBy = '';
	$updated_on = date("Y-m-d H:i:s");
	$logged_user_id=$_SESSION['cms_userid'];
	$title = $_POST['title'];
	$catId = "";
	if(isset($_POST['catId'])){
		$catId = $_POST['catId'];
	}
	$classId = "";
	if(isset($_POST['classId'])){
		$classId = $_POST['classId'];
	}
	$qpType = $_POST['qpType'];
	// $qType = $_POST['qType'];
	$qEvaluation = $_POST['qEvaluation'];
	$qPaperType = $_POST['qPaperType'];
	// $qDueBy = $_POST['dueby'];
	// $qpublishdate = $_POST['publishdate'];
	if(isset($_POST['dueby'])){
		$qDueBy = date("H:i:s",strtotime($_POST['dueby']));
	}
	if(isset($_POST['publishdate'])){
		$qpublishdate = date("Y-m-d",strtotime($_POST['publishdate']));
	}
	$qpublishdate = $qpublishdate.' '.$qDueBy;
	// $subjectId = $_POST['classSubjectId'];
	$timeAllow = $_POST['timeAllow'];
	$st = $_POST['st'];
	$sh = $_POST['sh'];
	$sm = $_POST['sm'];
	$qustIds =  json_decode($_POST['questions']);
	$qustMark =  json_decode($_POST['marks']);


	//Delete Question Paper
	$qpID = $_POST['qpID'];

	$qustPaperSecs = GetRecords("qp_qustpapersections", array("qustPaperId"=>$qpID));

	/*$query1 = "DELETE FROM qustpaperclasssubid WHERE qustPaperId = ?";
	$stmt1 = $db->prepare($query1);
	$stmt1->execute(array($qpID));*/	

	foreach ($qustPaperSecs as $qustPaperSec) {
		$qustPaperSectionId = $qustPaperSec['id'];
		$query1 = "DELETE FROM qp_qustpapersections WHERE qustPaperId = ?";
		$stmt1 = $db->prepare($query1);
		$stmt1->execute(array($qpID));

		$query1 = "DELETE FROM qp_qustpapersectionquestions WHERE qustPaperSectionId = ?";
		$stmt1 = $db->prepare($query1);
		$stmt1->execute(array($qustPaperSectionId));		
	}

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

    $sql2 ="UPDATE qp_qustpaper SET title=?, qpType=?, totMarks=?, total_question=?, time_allowed=?, updatedBy=?, updatedOn=? WHERE id = ?";
	$query2 = $db->prepare($sql2);
	$query2->execute(array($title, $qpType, $totMarks, $totQusts, $timeAllow, $logged_user_id, $updated_on, $qpID));
	$rowcount2 = $query2->rowCount();
	$sql3 ="UPDATE qp_qustpaperclasssubid SET qEvaluation=?, qPaperType=?,publish_date=? WHERE qustPaperId = ?";
	$query3 = $db->prepare($sql3);
	$query3->execute(array($qEvaluation, $qPaperType,$qpublishdate,$qpID));

	/*$query = "INSERT INTO qustpaperclasssubid (qustPaperId, catId, classId, subId) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->execute(array($qustpaperId, $catId, $classId, $subjectId));*/

	foreach ($sh as $key => $secHeading) {
		$query = "INSERT INTO qp_qustpapersections (qustPaperId, secHeading, secTitle, secMarks) VALUES (?, ?, ?, ? )";
	    $stmt = $db->prepare($query);
	    $stmt->execute(array($qpID, $secHeading, $st[$key], $secMarks[$key]));
	    $qustsecId = $db->lastInsertId();

	    foreach ($qustIds[$key] as $key1 => $qustId) {
			$query1 = "INSERT INTO qp_qustpapersectionquestions (qustPaperSectionId, questionsId, qustMark) VALUES (?, ?, ?)";
		    $stmt1 = $db->prepare($query1);
		    $stmt1->execute(array($qustsecId, $qustId, $qustMark[$key][$key1]));
	    }
	}
?>