<?php
include_once "../../session_token/checksession.php";
include_once "../../configration/config.php";
include "../../functions/db_functions.php";

$subjects= array();

$classId = getSanitizedData($_POST['classId']);
$subjects = GetQueryRecords("SELECT id as sbuId, module as name FROM cpmodules  WHERE parentId='$classId' AND deleted=0  ");


echo  json_encode($subjects);
