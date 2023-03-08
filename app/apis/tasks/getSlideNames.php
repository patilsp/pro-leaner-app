<?php
	//include_once "../session_token/checksession.php";
  require_once "../../configration/config.php";
  require_once "../../transactions/addSlides/functions/common_function.php";
  require_once "../../functions/db_functions.php";

  $class_id = getSanitizedData($_POST['classes']);
  $topic_id = getSanitizedData($_POST['topic_id']);
  $getReviewSlides = getSlideNames($class_id, $topic_id);
  echo json_encode($getReviewSlides);
?>