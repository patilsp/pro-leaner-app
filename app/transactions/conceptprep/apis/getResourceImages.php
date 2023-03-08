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
    $subjectid = getSanitizedData($_POST['subject_id']);
    
    $getResourceImages = getResourceImages($classid, $subjectid);
    echo $getResourceImages;
  }	catch(Exception $exp) {
  	echo "<pre/>";
  	print_r($exp);
  }

?>