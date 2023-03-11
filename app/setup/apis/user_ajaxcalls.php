<?php session_start();
  include "../../configration/config.php";
  require_once "../../functions/db_functions.php";
  require_once "../../functions/common_functions.php";
 

  $type = $_POST['type'];
  $output = array();
  $output['status'] = false;
  $output['message'] = "";
  $status = false;
  $message = "";
  $snackbar = false;


  if($type == "DeleteUser") {
	$stuID = $_POST['stuID'];    
	
	$sql2 ="UPDATE users SET deleted=1 WHERE id = ?";
	$query2 = $db->prepare($sql2);
	$query2->execute(array($stuID));
	$rowcount2 = $query2->rowCount();
	
	// $system_ip = $_SERVER['REMOTE_ADDR'];
	// $info = "User details delete of ".$stuID;
	// $time = time();
	// $url = "";
	// $query = "INSERT INTO mdl_log (id, time, userid, ip, course, module, cmid, action, url, info) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
	// $result = $db->prepare($query);
	// $result->execute(array($time, $login_userid, $system_ip, 1, 'user', 0, 'student details delete', $url, $info));

	$status = true;
	$message = "Deleted Successfully";
} 

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