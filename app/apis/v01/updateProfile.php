<?php

require_once "../headersValidation.php";


require "../../functions/db_functions.php";

require "../../functions/common_functions.php";

include 'validate_token.php';
 
	 
if($request_method == "POST") {
	$response = array();
	$response['status'] = false;
	$input = json_decode(file_get_contents('php://input'), true);
	
	
	if(isset($input['type'])) {
		require('../../configration/config.php');
		$type = $input['type'];
		
		$userid = $userData->id;
		$classid = $userData->class;
		
		if($type == "updateAudioSettings") {
			$bgMusicStatus = intval($input['bgMusicStatus']);
			$bgMusicID = getSanitizedData($input['bgMusicID']);
			$narrativeVoice = intval($input['narrativeVoice']);

			$query = "UPDATE users SET bg_music_status = ?, bg_music_id = ?, narrative_voice = ? WHERE id = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($bgMusicStatus, $bgMusicID, $narrativeVoice, $userid));
			$response['status'] = true;
			$message = "Success";

			$USER->bg_music_status = $bgMusicStatus;
			$USER->bg_music_id = $bgMusicID;
			$USER->narrative_voice = $narrativeVoice;

		
		} else {
			$message = "Invalid Type";
		}		
	} else {
		http_response_code(401);
		$message = "Required parameters are not sent";
	}
	if($response['status']) {
		$response['Result'] = $result;
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