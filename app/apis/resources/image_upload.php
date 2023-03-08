<?php
session_start();
include_once $_SESSION['dir_root']."app/session_token/checksession.php";
include $_SESSION['dir_root']."app/configration/config.php";
include $_SESSION['dir_root']."app/transactions/addSlides/functions/common_function.php";
include $_SESSION['dir_root']."app/functions/db_functions.php";
include $_SESSION['dir_root']."app/functions/common_functions.php";
try{
	/*print_r($_POST);
	print_r($_FILES);die;*/
	$tags = getSanitizedData($_POST['tags']);
	$tags_array = explode(",", $tags);
	$class_id = $_REQUEST['class_name'];
	$topics_id = $_REQUEST['topic'];
	
	$folder_type = $_REQUEST['folder_type'];
	if($folder_type == "images"){
		$resource_type_id = 1;
		$module_type = "";
	}
	else{
		$resource_type_id = 4;
		$module_type = $_REQUEST['module_type'];
	}
	$folder_path = getFolderName($topics_id);
	$folder_path2 = $_SESSION['dir_root']."app/contents/".$folder_path;

	if(isset($_FILES['img_res'])){
		$autoid = InsertRecord("resources", array("resource_type_id" =>  $resource_type_id,
		"class_id" => $class_id,
		"topics_id" => $topics_id,
		"status_id" => 1,
		"module" => $module_type
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
				$uploaded_files = upload_resource_multiple_images("img_res", $folder_path2);
			}
			/*print_r($uploaded_files[0]);
			print_r($uploaded_files[1]);die;*/
			if(count($uploaded_files[0]) > 0) {
				$data = json_encode($uploaded_files[0]);
				$query = "UPDATE resources SET filepath = ? WHERE id = ?";
				$stmt = $db->prepare($query);
				$stmt->execute(array($data, $autoid));
			}

			$getResourceImages = getImageResources($class_id, $topics_id);

			$status =true;
			$data = $getResourceImages;
			if(count($uploaded_files[0]))
				$suc_message ="Files Uploaded Successfully - ".implode(", ", $uploaded_files[0]);
			else
				$suc_message = "";
			if(count($uploaded_files[1]))
				$fail_message ="Files Uploaded Fail(The given files are already availlable in tis topic graphic folder. so, please change filename and try again.) - ".implode(", ", $uploaded_files[1]);
			else
				$fail_message = "";

			$response = array("status"=>$status, "suc_message"=>$suc_message, "fail_message"=>$fail_message, "data"=>$data);
			echo json_encode($response);
		}
	}
} catch (Exception $exp) {
	echo "<pre/>";
	print_r($exp);
}