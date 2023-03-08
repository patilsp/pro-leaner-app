<?php
	//include_once "../session_token/checksession.php";
  include "../../configration/config.php";
  include "../../functions/common_functions.php";
  include "../../functions/db_functions.php";

  $temp_id = getSanitizedData($_POST['temp_id']);
  $getLayouts = getLayouts($temp_id);
  echo $getLayouts;
?>