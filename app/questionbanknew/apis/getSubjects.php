<?php
 

 include_once "../../session_token/checksession.php";
 include_once "../../configration/config.php";
 //include_once "session_token/checktoken.php";
 require_once "../../functions/db_functions.php";
 

$subjects= array();

// if(isset($_POST['type']) && $_POST['type'] == 'getSubjectsForCat') {
// 	$catId = getSanitizedData($_POST['catId']);
// 	$subjects = GetQueryRecords("SELECT smsc.subId, ss.name FROM setup_map_subject_category smsc, setup_subjects ss WHERE catId='$catId' AND smsc.subId=ss.id");
// } else {
// 	$classId = getSanitizedData($_POST['classId']);
// 	$subjects = GetQueryRecords("SELECT smsc.subId, ss.name FROM setup_map_subject_classes smsc, setup_subjects ss WHERE classId='$classId' AND smsc.subId=ss.id");
// }

 
	$classId = getSanitizedData($_POST['classId']);
	$subjects = GetQueryRecords("SELECT id as subId, module as name FROM cpmodules WHERE parentId='$classId'");
 

echo  json_encode($subjects);
