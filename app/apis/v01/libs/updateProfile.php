<?php
require_once "../headersValidation.php";

if($request_method == "PUT") {
	$response = array();
	$response['status'] = false;
	$input = json_decode(file_get_contents('php://input'), true);
	if(isset($input['type'])) {
		require('../../../config.php');
		global $DB, $USER, $CFG;
		require_once($CFG->libdir.'/datalib.php');
		require "../loginSessionValidation.php";
		require_once "../db_functions.php";
		$type = $input['type'];
		
		$userid = $USER->id;
		if($type == "updateProfile") {
			$profileLock = false;
			//Check Profile should be locked or not
			$schoolcode = $_COOKIE['school_code'];
			$prefix = "../../../Certificates/$schoolcode/";
			$student_name = ucwords(strtolower(trim($USER->firstname." ".$USER->lastname)));
			$student_name = trim($student_name, ".");
			$student_name = trim($student_name);
          	$student_name = trim(str_replace(".", "", $student_name));
			/*$filename = $student_name."_".$USER->class."_".$USER->section."_".$USER->id;
			$certificate_path = "$prefix".$USER->class."/".$USER->section."/".$filename.".pdf";
			$check = GetRecord("certificate_data", array("user_id"=>$USER->id, "profile_confirmed"=> 1));
			if(file_exists($certificate_path) || $check) {
				$profileLock = true;
			}*/
			$profileLock = false;
			if($profileLock) {
				$status = false;
				$message = "Sorry! You cannot change your profile details as you have completed the program.";
			} else {
				$firstname = getSanitizedData($input['firstname']);
				if(! isset($input['lastname'])) {
					$input['lastname'] = ".";
				}
				$lastname = getSanitizedData($input['lastname']);
				if($lastname == "")
				 $lastname = ".";
				// $section = getSanitizedData($input['section']);
				$dob = strtotime(getSanitizedData($input['dateOfBirth']));
				$mothersname = getSanitizedData($input['mothersname']);
				$gender = getSanitizedData($input['gender']);
				
				$query = "UPDATE mdl_user SET firstname = ?, lastname = ?, icq = ? WHERE id = ?";
				$stmt = $db->prepare($query);
				$stmt->execute(array($firstname, $lastname, $gender, $userid));
				if($USER->firstname != $firstname) {
					$data = [
						'user_id' => $USER->id,
						'field' => "First Name",
						"old_value" => $USER->firstname,
						'new_value' => $firstname,
						'updated_by' => $USER->id,
						'updated_on' => date("Y-m-d H:i:s"),
						'ip_address' => $_SERVER['REMOTE_ADDR']
					];
					InsertRecord("profile_changes_audit", $data);
				}
				if($USER->lastname != $lastname) {
					$data = [
						'user_id' => $USER->id,
						'field' => "Last Name",
						"old_value" => $USER->lastname,
						'new_value' => $lastname,
						'updated_by' => $USER->id,
						'updated_on' => date("Y-m-d H:i:s"),
						'ip_address' => $_SERVER['REMOTE_ADDR']
					];
					InsertRecord("profile_changes_audit", $data);
				}
				if($USER->icq != $gender) {
					$data = [
						'user_id' => $USER->id,
						'field' => "Gender",
						"old_value" => $USER->icq,
						'new_value' => $gender,
						'updated_by' => $USER->id,
						'updated_on' => date("Y-m-d H:i:s"),
						'ip_address' => $_SERVER['REMOTE_ADDR']
					];
					InsertRecord("profile_changes_audit", $data);
				}
				
				/*Update Section
				$query = "SELECT * FROM mdl_user_info_data WHERE userid = ? AND fieldid = ?";
				$stmt = $db->prepare($query);
				$stmt->execute(array($userid, "2"));
				if($stmt->rowCount())
				{
					$query = "UPDATE mdl_user_info_data SET data = ? WHERE userid = ? AND fieldid = ?";
					$stmt = $db->prepare($query);
					$stmt->execute(array($section, $userid, "2"));
				}
				else
				{
					$query = "INSERT INTO mdl_user_info_data (id, userid, fieldid, data, dataformat) VALUES (NULL, ?, ?, ?, ?)";
					$stmt = $db->prepare($query);
					$stmt->execute(array($userid, "2", $section, "0"));
				}
				if($USER->profile['Section'] != $section) {
					$data = [
						'user_id' => $USER->id,
						'field' => "Last Name",
						"old_value" => $USER->profile['Section'],
						'new_value' => $section,
						'updated_by' => $USER->id,
						'updated_on' => date("Y-m-d H:i:s"),
						'ip_address' => $_SERVER['REMOTE_ADDR']
					];
					InsertRecord("profile_changes_audit", $data);
				} */
				
				//Update Mother Name
				$query = "SELECT * FROM mdl_user_info_data WHERE userid = ? AND fieldid = ?";
				$stmt = $db->prepare($query);
				$stmt->execute(array($userid, "5"));
				if($stmt->rowCount())
				{
					$query = "UPDATE mdl_user_info_data SET data = ? WHERE userid = ? AND fieldid = ?";
					$stmt = $db->prepare($query);
					$stmt->execute(array($mothersname, $userid, "5"));
					$stmt->rowCount();
				}
				else
				{
					$query = "INSERT INTO mdl_user_info_data (id, userid, fieldid, data, dataformat) VALUES (NULL, ?, ?, ?, ?)";
					$stmt = $db->prepare($query);
					$stmt->execute(array($userid, "5", $mothersname, "0"));
					$stmt->rowCount();
				}
				if($USER->profile['MotherName'] != $mothersname) {
					$data = [
						'user_id' => $USER->id,
						'field' => "Mothers Name",
						"old_value" => $USER->profile['MotherName'],
						'new_value' => $mothersname,
						'updated_by' => $USER->id,
						'updated_on' => date("Y-m-d H:i:s"),
						'ip_address' => $_SERVER['REMOTE_ADDR']
					];
					InsertRecord("profile_changes_audit", $data);
				}
				
				//Update DOB
				$query = "SELECT * FROM mdl_user_info_data WHERE userid = ? AND fieldid = ?";
				$stmt = $db->prepare($query);
				$stmt->execute(array($userid, "7"));
				if($stmt->rowCount())
				{
					$query = "UPDATE mdl_user_info_data SET data = ? WHERE userid = ? AND fieldid = ?";
					$stmt = $db->prepare($query);
					$stmt->execute(array($dob, $userid, "7"));
				}
				else
				{
					$query = "INSERT INTO mdl_user_info_data (id, userid, fieldid, data, dataformat) VALUES (NULL, ?, ?, ?, ?)";
					$stmt = $db->prepare($query);
					$stmt->execute(array($userid, "7", $dob, "0"));
				}
				if($USER->profile['SEC01'] != $dob) {
					$data = [
						'user_id' => $USER->id,
						'field' => "Date of Birth",
						"old_value" => date("Y-m-d", $USER->profile['SEC01']),
						'new_value' => date("Y-m-d", $dob),
						'updated_by' => $USER->id,
						'updated_on' => date("Y-m-d H:i:s"),
						'ip_address' => $_SERVER['REMOTE_ADDR']
					];
					InsertRecord("profile_changes_audit", $data);
				}

				$USER->firstname = $firstname;
				$USER->lastname = $lastname;
				$USER->icq = $gender;
				// $USER->profile['Section'] = $section;
				$USER->profile['SEC01'] = $dob;
				$USER->profile['MotherName'] = $mothersname;
				$response['status'] = true;
				$message = "Proflie data updated successfully";				
			}

		} else if($type == "updatePassword") {
			$password = getSanitizedData($input['password']);
			if(strlen($password) > 0)
			{
				$md5_password = md5($password);
				$query = "UPDATE mdl_user SET password = ? WHERE id = ?";
				$stmt = $db->prepare($query);
				$stmt->execute(array($md5_password, $userid));
			}
			$response['status'] = true;
			$message = "Password has changed successfully";
		} else if($type == "updatePicture") {
			$picture = $input['picture'];
			$query = "UPDATE mdl_user SET imagealt = ? WHERE id = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($picture, $USER->id));
			$USER->imagealt = $picture;
			$response['status'] = true;
			$message = "Profile Picture updated successfully";
		} else if($type == "acceptTAC") {
			$userid = $USER->id;
			$query = "UPDATE mdl_user SET url = 1 WHERE id = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($userid));
			$USER->url = 1;
			add_to_log(0, 'user', 'accept', 'acceptTAC.php', "tandc", 0, $USER->id);
			$response['status'] = true;
			$result['userPlan'] = $USER->aim;
			$message = "Success";
		} else if($type == "TourCompleted") {
			$userid = $USER->id;
			if($userid != 7) {
				$query = "UPDATE mdl_user SET msn = 1 WHERE id = ?";
				$stmt = $db->prepare($query);
				$stmt->execute(array($userid));
				$USER->url = 1;
				add_to_log(0, 'user', 'accept', 'quickTour.php', "tour", 0, $USER->id);
			}
			$response['status'] = true;
			$result['userPlan'] = $USER->aim;
			$message = "Success";
		} else if($type == "CoursePrologueCompleted") {
			$userid = $USER->id;
			if($userid != 7) {
				$query = "UPDATE mdl_user SET institution = 1 WHERE id = ?";
				$stmt = $db->prepare($query);
				$stmt->execute(array($userid));
				$USER->institution = 1;
				add_to_log(0, 'user', 'accept', 'coursePrologue.php', "CoursePrologue", 0, $USER->id);
			}
			$response['status'] = true;
			$result['userPlan'] = $USER->aim;
			$message = "Success";
		} else if($type == "updateFCMToken") {
			$userid = $USER->id;
			$fcmtoken = $input['fcmtoken'];
			$query = "UPDATE mdl_user SET fcmtoken = ? WHERE id = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($fcmtoken, $userid));
			$USER->url = 1;
			add_to_log(0, 'user', 'fcmtoken', 'fcm.php', $fcmtoken, 0, $USER->id);
			$response['status'] = true;
			$result['userPlan'] = $USER->aim;
			$message = "Success";
		} else if($type == "updateAudioSettings") {
			$bgMusicStatus = intval($input['bgMusicStatus']);
			$bgMusicID = getSanitizedData($input['bgMusicID']);
			$narrativeVoice = intval($input['narrativeVoice']);

			$query = "UPDATE mdl_user SET bg_music_status = ?, bg_music_id = ?, narrative_voice = ? WHERE id = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($bgMusicStatus, $bgMusicID, $narrativeVoice, $userid));
			$response['status'] = true;
			$message = "Success";

			$USER->bg_music_status = $bgMusicStatus;
			$USER->bg_music_id = $bgMusicID;
			$USER->narrative_voice = $narrativeVoice;

		} else if($type == "updateName") {
			$firstname = trim(getSanitizedData($input['firstname']));
			$lastname = getSanitizedData($input['lastname']);
			if($lastname == "")
			 $lastname = " ";
			//If name changed, insert into audit
			if($USER->firstname != $firstname) {
				$data = [
					'user_id' => $USER->id,
					'field' => "First Name",
					"old_value" => $USER->firstname,
					'new_value' => $firstname,
					'updated_by' => $USER->id,
					'updated_on' => date("Y-m-d H:i:s"),
					'ip_address' => $_SERVER['REMOTE_ADDR']
				];
				InsertRecord("profile_changes_audit", $data);
			}
			if($USER->lastname != $lastname) {
				$data = [
					'user_id' => $USER->id,
					'field' => "Last Name",
					"old_value" => $USER->lastname,
					'new_value' => $lastname,
					'updated_by' => $USER->id,
					'updated_on' => date("Y-m-d H:i:s"),
					'ip_address' => $_SERVER['REMOTE_ADDR']
				];
				InsertRecord("profile_changes_audit", $data);
			}

			$query = "UPDATE mdl_user SET firstname = ?, lastname = ? WHERE id = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($firstname, $lastname, $userid));

			$USER->firstname = $firstname;
			$USER->lastname = $lastname;

			//Insert into certificate_data
			$check = GetRecord("certificate_data", array("user_id"=>$userid));
			if($check) {
				$query = "UPDATE certificate_data SET profile_confirmed = 1, profile_confirmed_on = NOW() WHERE id = ?";
				$stmt = $db->prepare($query);
				$stmt->execute(array($userid));
			} else {
				$data = [
					'user_id' => $userid,
					'profile_confirmed' => 1,
					'profile_confirmed_on' => date("Y-m-d H:i:s")
				];
				InsertRecord("certificate_data", $data);
			}

			$response['status'] = true;
			$message = "Success";
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