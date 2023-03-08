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
	$class_id = $_REQUEST['class_id'];
	$subject_id = $_REQUEST['subject_id'];
	$folder_path = getImageFolderName($class_id,$subject_id);
	$folder_path2 = $_SESSION['dir_root']."app/cpcontents/".$folder_path;

	$autoid = InsertRecord("resources", array("resource_type_id" =>  1,
	"class_id" => $class_id,
	"topics_id" => $subject_id,
	"status_id" => 1
	));
	if($autoid > 0) {
		if(! file_exists($folder_path2))
			mkdir($folder_path2, 0777, true);

		$fieldname = "file";

		// Get filename.
		$filename = explode(".", $_FILES[$fieldname]["name"]);

		// Validate uploaded files.
		// Do not use $_FILES["file"]["type"] as it can be easily forged.
		$finfo = finfo_open(FILEINFO_MIME_TYPE);

		// Get temp file name.
		$tmpName = $_FILES[$fieldname]["tmp_name"];

		// Get mime type. You must include fileinfo PHP extension.
		$mimeType = finfo_file($finfo, $tmpName);

		// Get extension.
		$extension = end($filename);

		// Allowed extensions.
		$allowedExts = array("png", "jpg", "jpeg", "gif", "mp4", "webm", "ogg");

		// Allowed mime types.
		$allowedMimeTypes = array("image/gif", "image/jpeg", "image/png", "video/mp4", "video/webm", "video/ogg");

		// Validate file.
		if (!in_array(strtolower($mimeType), $allowedMimeTypes) || !in_array(strtolower($extension), $allowedExts)) {
			throw new \Exception("File does not meet the validation.");
		}

		// Generate new random name.
		$name = sha1(microtime()) . "." . $extension;
		$fullNamePath = $folder_path2 . $name;

		// Check server protocol and load resources accordingly.
		if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] != "off") {
			$protocol = "https://";
		} else {
			$protocol = "http://";
		}

		// Save file in the uploads folder.
		move_uploaded_file($tmpName, $fullNamePath);

		// Generate response.
		$response = new \StdClass;
		$response->link = $protocol.$_SERVER["HTTP_HOST"]."/cms/app/cpcontents/".$folder_path . $name;

		$uploaded_files = array();
		array_push($uploaded_files, $response->link, array($_FILES[$fieldname]["name"]));
		if(count($uploaded_files) > 0) {
			$data = json_encode($uploaded_files);
			$query = "UPDATE resources SET filepath = ? WHERE id = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($data, $autoid));
		}

		// Send response.
		echo stripslashes(json_encode($response));
	}
} catch (Exception $exp) {
	echo "<pre/>";
	print_r($exp);
}