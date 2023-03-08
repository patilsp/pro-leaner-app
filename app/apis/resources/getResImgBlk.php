<?php
require_once "../../configration/config.php";
require_once "../../functions/db_functions.php";
require_once "../../functions/common_functions.php";
try{
	$class_id = $_POST['class_id'];
	$topic_id = $_POST['topic_id'];
	$module = $_POST['module_type'];
	$getResourceImages = getImageResources($class_id, $topic_id, $module);
	echo $getResourceImages;
} catch(Exception $exp){
	echo "<pre/>";
	print_r($exp);
}
?>