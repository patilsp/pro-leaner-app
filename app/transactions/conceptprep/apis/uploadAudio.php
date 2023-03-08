<?php
session_start();
include_once $_SESSION['dir_root']."app/session_token/checksession.php";
include $_SESSION['dir_root']."app/configration/config.php";
include "../functions/common_function.php";
include $_SESSION['dir_root']."app/functions/db_functions.php";
include $_SESSION['dir_root']."app/functions/common_functions.php";
try{
	// print_r($_POST);
	// print_r($_FILES);die;
	$class_id = $_REQUEST['audioclass_id'];
	$topics_id = $_REQUEST['audioclass_id'];
	$resourceId = $_REQUEST['resourceId'];
	$cp_slide_id = $_REQUEST['audioslide_id'];
	$subject_id = $_REQUEST['audiosub_id'];
	$chapter_id = $_REQUEST['audiochapter'];
	$subtopic_id = $_REQUEST['audiosub_topic'];
	$folder_path = str_replace('images/graphics/', '', getFolderName($topics_id));
	// $folder_path2 = $_SESSION['dir_root']."app/contents/audio/c".$class_id.$folder_path;
	$filename = "C".$class_id."_Sub".$subject_id."_Chap".$chapter_id."_Top".$topics_id."_subTop".$subtopic_id;
	$folder_path2 = $_SESSION['dir_root']."app/cpcontents/audio/".$filename."/";
	
	$autoid = 0;
	$update = false;
	if($resourceId != "") {
		$getFile = GetRecord("resources", array("id"=>$resourceId));
		
		if(isset($getFile['filepath'])) {
			$file = json_decode($getFile['filepath']);
			$file = $file[0];
			unlink($file);
			$update = true;
			$resId = $resourceId;
			
		}
	} else {
		$autoid = InsertRecord("resources", array("resource_type_id" =>  3,
		"class_id" => $class_id,
		"topics_id" => $topics_id,
		"cp_slide_id" => $cp_slide_id,
		"status_id" => 1
		));
		$resId = $autoid;
	}

	
	if($autoid > 0 || $update) {
		//Upload Audio
		if(isset($_FILES['audio_res'])){
			if(! file_exists($folder_path2)) {
				mkdir($folder_path2, 0777, true);
			}
			$uploaded_files = upload_multiple_images("audio_res",$folder_path2,'_'.$resId);//'_'.$resId - sending resource table id for add end of the file name before saving into the folders and add slide table.
		}
		if(count($uploaded_files) > 0) {
			if($update) {
				$autoid = $resourceId;
			}
			// $arrexplode = explode(",",$uploaded_files);
			// $filename = '';
			// if (count($arrexplode) == 2) {
			// 	if (isset($arrexplode[1])) {
			// 		$filename = $arrexplode[1];
			// 	}
			// }
			$data = json_encode($uploaded_files);
			$query = "UPDATE resources SET filepath = ? WHERE id = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($data, $autoid));
			$audioSrc = str_replace($dir_root, $web_root, $uploaded_files[0]);

		}

		$status =true;
		$message ="Files Uploaded Successfully";
		
		$response = array("status"=>$status, "message"=>$message, "audioSrc"=>$audioSrc, "resId"=>$resId);
		echo json_encode($response);
	}
} catch (Exception $exp) {
	echo "<pre/>";
	print_r($exp);
}