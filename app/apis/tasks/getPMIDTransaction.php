<?php
	//include_once "../session_token/checksession.php";
  include "../../configration/config.php";
  include "../../functions/common_functions.php";
  include "../../functions/db_functions.php";
try{
  $task_id = getSanitizedData($_POST['task_id']);
  $task_ass_id = getSanitizedData($_POST['task_ass_id']);
  $getTaskStatus = getTaskStatus($task_id, $task_ass_id);
  echo json_encode($getTaskStatus);
}catch(Exception $exp){
	print_r($exp);
	return "false";
}
?>