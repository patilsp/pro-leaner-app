<?php
require_once "../../headersValidation.php";
require "../../../functions/db_functions.php";

require "../../../functions/common_functions.php";

include '../validate_token.php';
$request_method = "POST";
if($request_method == "POST") {
	$response = array();
	$response['status'] = false;
	$input = json_decode(file_get_contents('php://input'), true);
	if(isset($input['chapterid'])) {
		$assignment_id = $input['assignment_id'];
		require('../../../configration/config.php');
		global $DB, $USER, $CFG;
		// require_once($CFG->libdir.'/datalib.php');
		// require "../../loginSessionValidation.php";
		// require "../../common_functions.php";
		// require "../../db_functions.php";
		if(isset($input['chapterid']))
			$courseviewid = $input['chapterid'];
		else
			$courseviewid = $_POST['chapterid'];
		// $eligibleStatus = CheckCMIDAccess($courseviewid);
		$userid = $userData->id;
		//Common Data for all Slides
		$query = "SELECT * FROM assignment_assign WHERE id = ?";
  		$stmt = $db->prepare($query);
  		$stmt->execute(array($assignment_id));
  		$cm = $stmt->fetch(PDO::FETCH_ASSOC);
		if($cm) {
			$assignment_id = $assignment_id;
			$courseid = $input['chapterid'];

			foreach($_FILES["file"]["tmp_name"] as $key=>$filetmp1) {
				// $filetmp1 = $_FILES["file"]["tmp_name"];
				$filename1 = $_FILES["file"]["name"][$key];
				$filetype1 = $_FILES["file"]["type"][$key];
				//Using this function, find the image extension
				$ext = pathinfo($filename1, PATHINFO_EXTENSION);
				
				$fh = fopen ($filetmp1, "rb");
				$data = fread ($fh, 16);
				$header = unpack ("C1highbit/"."A3signature/"."C2lineendings/"."C1eof/"."C1eol", $data);
				$hexa_check = bin2hex($header['signature']);

				$new_path = "../../../StudentAssignmentFiles/$assignment_id/$userid";

				if(! file_exists($new_path)) {
					mkdir($new_path, 0777, true);
				}
				$new_filename = $assignment_id.$userid."-".rand().".".$ext;
				$save_path = "StudentAssignmentFiles/$assignment_id/$userid/".$new_filename;
				$org_filename = $_FILES["file"]["name"][$key];
				move_uploaded_file($_FILES["file"]["tmp_name"][$key], $new_path."/".$new_filename);
				
				$queryi = "INSERT INTO pms_assignment_files (assignment_id, type, student_id, upload_path, upload_filename, created_by, created_on) VALUES (?, ?, ?, ?, ?, ?, NOW())";
				$resulti=$db->prepare($queryi);
			  $resulti->execute(array($assignment_id, "submission", $userid, $save_path, $org_filename, $userid));
			  $file_id = $db->lastInsertId();
			  
			}
			$records = GetRecords("pms_assignment_files", array("assignment_id"=>$assignment_id, "student_id"=>$userid, "type"=>"submission"));
			foreach($records as $record){
				$response['Result']['Reference'][] = array("id"=>$record['id'], "name"=>$record['upload_filename']);
			}
		  $response['status'] = true;
		} else if(!$eligibleStatus) {
			$response['status'] = false;
			$response['cmid'] = $courseviewid;
			$message = "You dont have access to this lesson";
		} else {
			http_response_code(422);
			$message = "Incorrect Course View ID";
		}
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