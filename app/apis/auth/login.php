<?php
require_once "../headersValidation.php";
 
if($request_method == "POST") {
	//  http_response_code(200);
	//  echo json_encode(array("message" => "Login successful."));
	$response = array();
	$response['status'] = false;
	$data = json_decode(file_get_contents('php://input'), true);
	// if (isset($data['username'], $data['password'])) {
	// 	$username      = $data["username"];//$_POST['username'];//required_param('username', PARAM_ALPHANUMEXT);
	// 	$password  = $data['password'];//required_param('password', PARAM_ALPHANUMEXT);
	// 	try {
	// 		// include_once "../../session_token/checksession.php";
	// 		include "../../configration/config.php";
	// 		$context = context_system::instance();
	// 		$query = "SELECT id FROM $smartgram_db.masters_multipleschools WHERE CONCAT(schoolname,', ', branch) = ?";
	// 		$stmt = $dbs->prepare($query);
	// 		$stmt->execute(array($_COOKIE['school_name']));
	// 		$rows = $stmt->fetch(PDO::FETCH_ASSOC);
	// 		$sch_id = $rows['id'];
	// 		$sch_id = str_pad($sch_id,3,0,STR_PAD_LEFT);
	// 		$username = $sch_id.$username;

	// 		$user = authenticate_user_login($username, $password);
	// 		if($user){
	// 			setMoodleUserLoginCookie($user);
	// 			$response['status'] = true;
	// 			$user->displayName = trim($user->firstname." ".trim($user->lastname,"."));
	// 			$response['User'] = $user;
	// 			UpdateAccessValue($user);
	// 			$message = "Login Successfull";
	// 		} else {
	// 			$user = authenticate_user_login($username, strtolower($password));
	// 			if($user){
	// 				setMoodleUserLoginCookie($user);
	// 				$response['status'] = true;
	// 				$user->displayName = trim($user->firstname." ".trim($user->lastname,"."));
	// 				$response['User'] = $user;
	// 				UpdateAccessValue($user);
	// 				$message = "Login Successfull";
	// 			} else {
	// 				$user = authenticate_user_login($username, strtoupper($password));
	// 				if($user){
	// 					$response['status'] = true;
	// 					setMoodleUserLoginCookie($user);
	// 					$user->displayName = trim($user->firstname." ".trim($user->lastname,"."));
	// 					$response['User'] = $user;
	// 					UpdateAccessValue($user);
	// 					$message = "Login Successfull";
	// 				} else {
	// 					//echo $username;
	// 					$message = "Invalid Login Details";
	// 					$admission_format = getAdmissionNumberFormat($CFG->dbname);
	// 					http_response_code(401);
	// 					if(strlen($admission_format) > 0)
	// 						$message .= ". Please enter the username in the format: $admission_format";
	// 				}
	// 			}
	// 		}
			
	// 	} catch (Exception $e){
	// 		$message = $e;//"false";
	// 	}
	// } else {
	// 	http_response_code(401);
	// 	$message = "Required parameters are not sent";
	// }
	$response['status'] = true;
	if(isset($data['username'])) {
		$newUserObject = new stdClass();
		$newUserObject->id = 3;
		$newUserObject->username = "demo";
		$newUserObject->firstname = "demo";
		$newUserObject->Class = 1;
		$newUserObject->displayClassName ="Class 1";
		$newUserObject->classCategoryID = 138;
		$newUserObject->userPlan = "";
		$newUserObject->profile_pic = "a-3.svg";
		$newUserObject->tandc =1;
		$newUserObject->tour_status = 1;
		$newUserObject->course_prologue = 1;
		$newUserObject->unread_notifications = true;
		$newUserObject->lastaccess = 1677003198;
		$newUserObject->showCoursePrologue = false;
		$newUserObject->fullFreetopics = false;
	   
		$response['User'] = $newUserObject;
	}
	$response['Message'] = "Login Successfull";
	echo json_encode($response);

} else {
	$response = array();
	$response['status'] = false;
	$response['Message'] = "Unexpected HTTP Request Method";
	http_response_code(405);
	echo json_encode($response);
}