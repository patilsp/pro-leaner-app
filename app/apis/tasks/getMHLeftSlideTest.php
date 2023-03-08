<?php
	//include_once "../session_token/checksession.php";
  include "../../configration/config.php";
  include "../../functions/common_functions.php";
  include "../../functions/db_functions.php";

  $class_id = getSanitizedData($_POST['class_id']);
  $topic_id = getSanitizedData($_POST['topic_id']);
  $getMHLeftSlides = getMHLeftSlidesTest($web_root, $class_id, $topic_id);
  echo json_encode($getMHLeftSlides);
?>