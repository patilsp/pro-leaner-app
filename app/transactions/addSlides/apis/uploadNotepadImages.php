<?php
session_start();
include_once $_SESSION['dir_root']."app/session_token/checksession.php";
include $_SESSION['dir_root']."app/configration/config.php";
include "../functions/common_function.php";
include $_SESSION['dir_root']."app/functions/db_functions.php";
include $_SESSION['dir_root']."app/functions/common_functions.php";
try{
	/*print_r($_REQUEST);
	print_r($_FILES);die;*/
	$logged_user_id=$_SESSION['cms_userid'];
	$folder_path = $_SESSION['dir_root']."app/notepadimages/task_assign_id_".$_REQUEST['task_assign_id'];

	if(isset($_FILES['file'])){
		if(! file_exists($folder_path))
			mkdir($folder_path, 0777, true);
		$extension = explode('.', $_FILES['file']['name']);
		$new_name = rand() . '.' . $extension[1];
		$destination = $folder_path.'/'.$new_name;
		$uploaded_files = move_uploaded_file($_FILES['file']['tmp_name'], $destination);
		$file_path = str_replace($dir_root, $web_root, $destination);
		echo $file_path;
	} else {
		$query = "SELECT * FROM add_slide_notepad WHERE task_assign_id = ?";
		$stmt = $db->prepare($query);
		$stmt->execute(array($_REQUEST['task_assign_id']));

		if($stmt->rowCount()){
			$query = "UPDATE add_slide_notepad SET notepad = ?, updated_by=? WHERE task_assign_id = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($_REQUEST['notepad'], $logged_user_id, $_REQUEST['task_assign_id']));
		} else {
			$autoid_status2 = InsertRecord("add_slide_notepad", array("task_assign_id" => $_REQUEST['task_assign_id'],
			"notepad" => $_REQUEST['notepad'],
			"updated_by" => $logged_user_id
			));
		}

		echo "1";
	}
} catch (Exception $exp) {
	echo "<pre/>";
	print_r($exp);
}