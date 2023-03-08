<?php
  include_once "../../../session_token/checksession.php";
  include "../../../configration/config.php";
  include "../../../functions/common_functions.php";
  include "../../../functions/db_functions.php";

  $class_id = getSanitizedData($_POST['class_id']);
  $topic_id = getSanitizedData($_POST['topic_id']);
  $topic_name = getSanitizedData($_POST['topic_name']);
  $slide_id = intval($_POST['slide_id']);
  $getMHCS = getMHCS($master_db, $web_root,$class_id, $topic_id, $slide_id, $topic_name);
  echo $getMHCS;
?>