<?php 
include_once "../session_token/checksession.php";
include_once "../configration/config.php";
//include_once "session_token/checktoken.php";
require_once "../functions/db_functions.php"; 
include "functions/common_function.php";

$userid=$_GET['user_id'];
$classesAssigned = getClassesAssigned($userid);

echo $classesAssigned;
?>

