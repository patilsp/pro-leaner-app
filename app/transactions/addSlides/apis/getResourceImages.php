<?php
  session_start();
  include_once $_SESSION['dir_root']."app/session_token/checksession.php";
  include $_SESSION['dir_root']."app/configration/config.php";
  include "../functions/common_function.php";
  include $_SESSION['dir_root']."app/functions/db_functions.php";

  try {
    /*echo "<pre/>";
    print_r($_POST);die;*/
  	$logged_user_id=$_SESSION['cms_userid'];
    $classid = getSanitizedData($_POST['class_id']);
    $topicid = getSanitizedData($_POST['topic_id']);
    
    $getResourceImages = getResourceImages($classid, $topicid);
    echo $getResourceImages;
  }	catch(Exception $exp) {
  	echo "<pre/>";
  	print_r($exp);
  }

?>