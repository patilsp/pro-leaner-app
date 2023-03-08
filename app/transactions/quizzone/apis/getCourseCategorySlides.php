<?php
  session_start();
  include_once $_SESSION['dir_root']."app/session_token/checksession.php";
  include $_SESSION['dir_root']."app/configration/config.php";
  include $_SESSION['dir_root']."app/functions/common_functions.php";
  include "../functions/common_function.php";
  include $_SESSION['dir_root']."app/functions/db_functions.php";

  try {
    /*echo "<pre/>";
    print_r($_POST);die;*/
  	$class_id = getSanitizedData($_POST['class_id']);
    $topic_id = getSanitizedData($_POST['topic_id']);
    $getAWNS = getAssignSlidesID($web_root, $class_id, $topic_id);
    echo json_encode($getAWNS);
  }	catch(Exception $exp) {
  	echo "<pre/>";
  	print_r($exp);
  }
?>