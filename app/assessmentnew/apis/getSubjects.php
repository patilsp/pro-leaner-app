<?php
session_start();
  include "../../configration/config.php";
  require_once "../../functions/db_functions.php";
  // include "../functions/common_function.php";

$subjects= array();

if(isset($_POST['type']) && $_POST['type'] == 'getSubjectsForCat') {
	$catId = getSanitizedData($_POST['catId']);
	$subjects = GetQueryRecords("SELECT smsc.subId, ss.module FROM qp_setup_map_subject_category smsc, cpmodules ss WHERE catId='$catId' AND smsc.subId=ss.id");
} else {
	$classId = getSanitizedData($_POST['classId']);
	$subjects = GetQueryRecords("SELECT smsc.subId, ss.name FROM setup_map_subject_classes smsc, setup_subjects ss WHERE classId='$classId' AND smsc.subId=ss.id");
}

echo  json_encode($subjects);
