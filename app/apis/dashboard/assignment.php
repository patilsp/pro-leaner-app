<?php
require_once "../../headersValidation.php";

require "../../../functions/db_functions.php";

require "../../../functions/common_functions.php";

include '../validate_token.php';

if($request_method == "POST") {
	$response = array();
	$status = false;
	$message = "";
	$input = json_decode(file_get_contents('php://input'), true);
	if(isset($input['type'])) {
		require('../../../configration/config.php');

		 echo "abc";
		 exit;

		 
	} else {
		http_response_code(401);
		$response['status'] = false;
		$message = "Required parameters are not sent";
	}
	if($status) {
		$response['Result'] = $result;
	}
	$response['status'] = $status;
	$response['Message'] = $message;
	echo json_encode($response);
} else {
	$response = array();
	$response['status'] = false;
	$response['Message'] = "Unexpected HTTP Request Method";
	http_response_code(405);
	echo json_encode($response);
}