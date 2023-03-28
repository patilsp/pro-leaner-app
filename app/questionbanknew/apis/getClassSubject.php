<?php
include_once "../../../session_token/checksessionajax.php";
include "../../../configration/config.php";
include "../../../functions/db_functions.php";

$output= array();
$catId = getSanitizedData($_POST['catId']);

$classes = GetRecords("modulesetup", array("deleted"=>0, "classCatId"=>$catId, "type"=>'class'));
$data = array();
foreach ($classes as $classData) {
	$subjects = GetRecords("modulesetup", array("deleted"=>0, "parentId"=>$classData['id'], "type"=>'subject'));
	$class_sub_array = array();
	foreach ($subjects as $subject) {
		$class_sub_array['classSub'] = $classData['module'].'-'.$subject['module'];
		$class_sub_array['classSubId'] = $classData['id'].'-'.$subject['id'];
		
		$data[] = $class_sub_array;
	}
}
echo  json_encode($data);
