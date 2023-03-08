<?php
include_once "../../session_token/checksession.php";
include "../../configration/config.php";
include "../../functions/db_functions.php";
include "../../functions/common_functions.php";
try{
	/*print_r($_POST);
	print_r($_FILES);*/
	$tags = getSanitizedData($_POST['tags']);
	$tags_array = explode(",", $tags);
	$class_id = $_REQUEST['class_id'];
	$topics_id = $_REQUEST['topics_id'];

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
		$dir_path = "../../resources/images/";
		if(isset($_FILES['img_res'])){
			if(! file_exists($dir_path))
				mkdir($dir_path, 0777, true);
			$uploaded_files = upload_multiple_images("img_res", $dir_path);
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