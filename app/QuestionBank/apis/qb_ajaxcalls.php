<?php session_start();
  include "../../configration/config.php";
  require_once "../../functions/db_functions.php";
  require_once "../../functions/common_functions.php";
  require_once "../../functions/students.php";
  require_once "../../functions/teachers.php";

  $type = $_POST['type'];
  $output = array();
  $output['status'] = false;
  $output['message'] = "";
  $status = false;
  $message = "";
  $snackbar = false;
  $login_userid = $_SESSION['ilp_loginid'];


	$output['status'] = $status;
	$output['message'] = $message;
	if($snackbar && $output['status']) {
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
	}
	echo json_encode($output);