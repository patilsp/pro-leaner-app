<?php
session_start();
include_once $_SESSION['dir_root']."app/session_token/checksession.php";
include $_SESSION['dir_root']."app/configration/config.php";
include $_SESSION['dir_root']."app/functions/db_functions.php";
try{
	//print_r($_POST);die;
	$checked = getSanitizedData($_POST['checked']);
	$topics_id = getSanitizedData($_POST['topic_id']);
	$school_id = getSanitizedData($_POST['school_id']);
	$autoIncId = getSanitizedData($_POST['autoIncId']);
	$logged_user_id=$_SESSION['cms_userid'];

	if($checked == 'false' && $autoIncId != '') {
		DeleteRecord("b2b_task_production_ready",array("id"=>$autoIncId));
		echo "success";
	} else {
		$lastInsertId = InsertRecord("b2b_task_production_ready", array("topic_id" => $topics_id,
			"school_id" => $school_id,
			"updated_by" => $logged_user_id
		));
		echo $lastInsertId;
	}
} catch (Exception $exp) {
	echo "<pre/>";
	print_r($exp);
}