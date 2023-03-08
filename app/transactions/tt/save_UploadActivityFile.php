<?php
  include_once "../../session_token/checksession.php";
  require_once "../../configration/config.php";
  require_once "../../functions/db_functions.php";

$success = $failure = array();
if(count($_POST['path'])) {
	foreach ($_POST['path'] as $key => $path) {
		if(file_exists($path)) {
			$filename = $_FILES['files']["name"][$key];
			$source = $_FILES['files']["tmp_name"][$key];
			$type = $_FILES['files']["type"][$key];			
			$target = $path."/".$filename;
			if(file_exists($target)) {
				move_uploaded_file($source, $target);
				$success[] = array("path"=>$filename, "message"=>"File replaced successfully");
			}
			else
				$failure[] = array("path"=>$path."/".$filename, "message"=>"File does not exist to replace");
		} else if($path != "") {
			$failure[] = array("path"=>$path, "message"=>"Path does not exist");
		}
	}
}
echo json_encode(["success"=>$success, "failure"=>$failure]);
?>