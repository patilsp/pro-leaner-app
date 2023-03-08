<?php
  include_once "../../../session_token/checksession.php";
  include "../../../configration/config.php";
  include "../../../functions/common_functions.php";
  include "../../../functions/db_functions.php";

  //print_r($_POST);die;

  $page_id = getSanitizedData($_POST['page_id']);
  $desti_course_id = getSanitizedData($_POST['desti_course_id']);
  $desti_lesson_id = getSanitizedData($_POST['desti_lesson_id']);
  $desti_destprevid = getSanitizedData($_POST['desti_destprevid']);
  $getMHCS = moveSlide($master_db, $page_id,$desti_course_id, $desti_lesson_id, $desti_destprevid);
  echo json_encode($getMHCS);
?>