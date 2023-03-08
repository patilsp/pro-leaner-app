<?php session_start();
  include "../../configration/config.php";
  require_once "../../functions/db_functions.php";
  $status = false;
  $message = "";
  $snackbar = false;
  $login_userid = $_SESSION['cms_userid'];
  if(isset($_FILES['file'])) {
  	$orginal_name = $_FILES['file']['name'];
  	$data = [
  		"orginal_name" => $orginal_name,
  		"uploaded_by" => $login_userid,
  		"uploaded_on" => date("Y-m-d H:i:s")
  	];
  	$autoid = InsertRecord("question_images", $data);
  	$new_file_name = $login_userid.$autoid;
  	$ext = pathinfo($orginal_name, PATHINFO_EXTENSION);
  	$new_folder = "../../questionImages/";
  	if(! file_exists($new_folder)) {
  		mkdir($new_folder, 0777, true);
  	}
  	$new_path = $new_folder.$new_file_name.".$ext";
  	move_uploaded_file($_FILES["file"]["tmp_name"], $new_path);
  	$save_path = "questionImages/".$new_file_name.".".$ext;
  	$query = "UPDATE question_images SET final_path = ? WHERE id = ?";
  	$stmt = $db->prepare($query);
  	$stmt->execute(array($save_path, $autoid));
  	$status = true;
  	$output['Result'] = $save_path;
  }
	$output['status'] = $status;
	$output['message'] = $message;
	echo json_encode($output);
?>