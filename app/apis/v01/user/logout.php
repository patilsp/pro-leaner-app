<?php
require_once "../../headersValidation.php";

if($request_method == "POST") {
	$response = array();
	$response['status'] = false;
	$data = json_decode(file_get_contents('php://input'), true);
	if(isset($data['action'])) {
		 
		$response['status'] = true;
		$message = "Logged out successfully";
	} else {
		http_response_code(401);
		$message = "Required parameters are not sent";
	}
	
	$response['Message'] = $message;
	echo json_encode($response);
} else {
	$response = array();
	$response['status'] = false;
	$response['Message'] = "Unexpected HTTP Request Method";
	http_response_code(405);
	echo json_encode($response);
}