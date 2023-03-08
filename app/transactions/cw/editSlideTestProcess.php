<?php
	require_once "../../session_token/checksession.php";
	require_once "../../configration/config.php";
	//require_once $dir_root."app/session_token/checktoken.php";
	
	$output = $_POST['data1'];
	//echo $output;die;
	$slideName = $_POST['slide_path'];
	$actual_path = str_replace($web_root, "", $slideName);
	$info = pathinfo($slideName);
	$dirpath = $info['dirname'];
	//Show filename with file extension
	$file_name = $info['basename'];
	$file_ext = $info['extension'];

	$newpath = $dirpath."/edited-".time()."-".$file_name;
	$newpath = str_replace($web_root, $dir_root, $newpath);

	rename($dir_root.$actual_path,$newpath);
	file_put_contents($dir_root.$actual_path, $output);
?>