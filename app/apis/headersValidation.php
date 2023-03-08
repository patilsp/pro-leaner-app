<?php
define('AJAX_SCRIPT', true);
$request_method = $_SERVER['REQUEST_METHOD'];
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header('Access-Control-Allow-Credentials: true');

if ($request_method == 'OPTIONS') {
	ob_start();
	header("HTTP/1.1 204 NO CONTENT");
	header("Cache-Control: no-cache, no-store, must-revalidate");
	header("Pragma: no-cache");
	header("Expires: 0");
	ob_end_flush();
	die;
} else {
	header("Expires: 0");
	$response = array();
	$headers = apache_request_headers();
	//Authorization Code Validation
	if(! isset($headers['Authorization'])) {
		$response['status'] = false;
		$response['Message'] = "Authorization Parameter not sent";
		http_response_code(403);
		echo json_encode($response);
		die;
	} else if($headers['Authorization'] !== "my-auth-token") {
		$response['status'] = false;
		$response['Message'] = "Invalid Authorization Code";
		http_response_code(403);
	}

	//Domain Validation
	$valid_hosts = array("localhost", "skillprep.co", "test.skillprep.co", "192.168.45.62", "prepmyskills.com", "b2c.skillprep.co");
	if(! isset($headers['Host'])) {
		$response['status'] = false;
		$response['Message'] = "Host Parameter not sent";
		http_response_code(403);
	} else if(!in_array($headers['Host'], $valid_hosts)) {
		$response['status'] = false;
		$response['Message'] = "Request is not accepted from this host - ".$headers['Host'];
		http_response_code(403);
	}

	if(isset($response['status'])) {
		echo json_encode($response);
		die;
	}
}