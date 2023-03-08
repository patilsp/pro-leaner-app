<?php session_start();
include "../../configration/config.php";
require_once "../../functions/db_functions.php";
require_once "../../functions/subjects.php";

$type = $_POST['type'];
$output = array();
$output['status'] = false;
$output['message'] = "";
$status = false;
$message = "";
$login_userid = $_SESSION['cms_userid'];
//$snackbar = true;

if($type == "getSubject") {
	if(isset($_POST['classcode'])) {
		$subjects = getSubject($_POST['classcode']);
		$output['subject'] = $subjects;
		$status = true;
		$message = "success";
	}
} else if($type == "getAssignedSubjects") {
	if(isset($_POST['classcode'])) {
		$module = $_POST['for'];
		$subjects = getAssignedSubjects($_POST['classcode'], $login_userid, $module);
		$output['subject'] = $subjects;
		$status = true;
		$message = "success";
	} else {
		$status = false;
		$message = "Mandatory fields are missing";
	}
}


$output['status'] = $status;
$output['message'] = $message;
/*if($snackbar && $output['status']) {
	if($status) {
		$_SESSION['sb_heading'] = "Success!";
	} else {
		$_SESSION['sb_heading'] = "Notice!";
	}
	$_SESSION['sb_message'] = $message;
	if(strlen($message) > 50) {
		$_SESSION['sb_time'] = 15000;
	} else {
		$_SESSION['sb_time'] = 10000;
	}
}*/
echo json_encode($output);