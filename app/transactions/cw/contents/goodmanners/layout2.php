<?php
	$dir_root = "C:/xampp/htdocs/cms/app/contents/class1/goodmanners/";
	$output = $_POST['data1'];
	$slideName = "../"."app/".$_POST['slide_path'];

	//Show filename with file extension
	$file_name = basename($slideName);
	$slideName = str_replace($file_name, "", $slideName);
	$output_fn = "edited-".$file_name;
	file_put_contents($dir_root.$output_fn, $output);
?>