<?php
session_start();
include_once $_SESSION['dir_root']."app/session_token/checksession.php";
include $_SESSION['dir_root']."app/configration/config.php";
include "../functions/common_function.php";
include $_SESSION['dir_root']."app/functions/db_functions.php";
include $_SESSION['dir_root']."app/functions/common_functions.php";
try{
	/*print_r($_POST);
	print_r($_FILES);*/
	$tags = getSanitizedData($_POST['tags']);
	$tags_array = explode(",", $tags);
	$class_id = $_REQUEST['class_id'];
	$topics_id = $_REQUEST['topics_id'];
	$folder_path = getFolderName($topics_id);
	$folder_path2 = $_SESSION['dir_root']."app/contents/".$folder_path;

	$autoid = InsertRecord("resources", array("resource_type_id" =>  1,
	"class_id" => $class_id,
	"topics_id" => $topics_id,
	"status_id" => 1
	));
	if($autoid > 0) {
		foreach ($tags_array as $tag) {
			$autoid1 = InsertRecord("resource_tags", array("tag" => $tag,
			"resources_id" => $autoid
			));
		}

		//Upload Images
		if(isset($_FILES['img_res'])){
			if(! file_exists($folder_path2))
				mkdir($folder_path2, 0777, true);
			$uploaded_files = upload_multiple_images("img_res", $folder_path2);
		}
		if(count($uploaded_files) > 0) {
			$data = json_encode($uploaded_files);
			$query = "UPDATE resources SET filepath = ? WHERE id = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($data, $autoid));
		}

		$status =true;
		$message ="Files Uploaded Successfully";

		$response = array("status"=>$status, "message"=>$message);
		echo json_encode($response);
	}
} catch (Exception $exp) {
	echo "<pre/>";
	print_r($exp);
}