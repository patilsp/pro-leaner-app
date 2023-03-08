<?php
	//include_once "../session_token/checksession.php";
  include "../../configration/config.php";
  include "../../functions/common_functions.php";
  include "../../functions/db_functions.php";

  $classes = getSanitizedData($_POST['classes']);
  $getTopics = getTopicsRMVisible($classes);
  echo json_encode($getTopics);
?>