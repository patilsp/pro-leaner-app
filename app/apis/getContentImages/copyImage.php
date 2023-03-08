<?php
	include_once "../../session_token/checksession.php";
	include "../../configration/config.php";
	try{

		$imagePath = $_POST['imgpath'];
		$imgetc = pathinfo($imagePath);
		$slidePath = $_POST['dest_path'];
		$slidePath = pathinfo($slidePath);
		$newPath = $slidePath['dirname'];
		$newPath = str_replace($web_root, $dir_root, $newPath);
		if (!file_exists($newPath.'/images')) {
			$mkdir_val = mkdir($newPath.'/images', 0777, true);
		}
		$dest_file_name = $imgetc['filename']."_".time();
		$newName  = $newPath."/images/".$dest_file_name.".".$imgetc['extension'];
		$copied = copy($imagePath , $newName);
		if ((!$copied)) 
		{
		    echo "error";
		}
		else
		{ 
		    $img_file = $newPath."/images/".$dest_file_name.".".$imgetc['extension'];
		    $img_file = str_replace($dir_root, $web_root, $img_file);
		    echo $img_file;
		}
	} catch (Exception $exp) {
		echo "<pre/>";
		print_r($exp);
	}
?>