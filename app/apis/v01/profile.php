<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../headersValidation.php";

require "../../functions/db_functions.php";

require "../../functions/common_functions.php";

include 'validate_token.php';

if($request_method == "POST") {
	$response = array();
	$response['status'] = false;
	$message = "";
	$input = json_decode(file_get_contents('php://input'), true);
	if(isset($input['type'])) {

		$userid = $userData->id;
  		require('../../configration/config.php');
		try {
		 
		// global $DB, $USER, $CFG;
		 
		$type = $input['type'];
		if($type == "getAudioSettings") {

				$userid = $userData->id;
				$classid = $userData->class;


		 
			$query = "SELECT * FROM users WHERE id = ? limit 1";
			$stmt = $db->prepare($query);
			$stmt->execute(array($userid));
			$userInfo = $stmt->fetch(PDO::FETCH_OBJ); 
			 

			$response['status'] = true;

			$result['bgMusicStatus'] = boolval($userInfo->bg_music_status);
			$bgMusicID = $userInfo->bg_music_id;
			$result['narrativeVoice'] = boolval($userInfo->narrative_voice);
			$result['narrativeAudioEnable'] = boolval(1);
			if(intval($classid) > 10) {
				$result['narrativeAudioEnable'] = boolval(0);
			}
			$voices = array();
			if($bgMusicID == 0) {
				$selected = true;
			} else {
				$selected = false;
			}
			$voices[] = array("id"=>0, "audio_ref"=>"None", "audio_path"=>"", "selected"=>$selected);


			$query = "SELECT * FROM masters_background_musics WHERE active = ?   ORDER BY audio_ref";
			$stmt = $db->prepare($query);
			$stmt->execute(array(1));
			while($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
				if($bgMusicID == $rows['id']) {
					$selected = true;
				} else {
					$selected = false;
				}
				$voices[] = array("id"=>$rows['id'], "audio_ref"=>$rows['audio_ref'], "audio_path"=>$rows['audio_path'], "selected"=>$selected);
			}
			$result['bgMusics'] = $voices;
		} else {
			$message = "Invalid Type";
		}

		} catch(Exception $exp) {
			print_r($exp);
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