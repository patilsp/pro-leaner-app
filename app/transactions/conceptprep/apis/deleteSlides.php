<?php
  session_start();
  include_once $_SESSION['dir_root']."app/session_token/checksession.php";
  include $_SESSION['dir_root']."app/configration/config.php";
  include "../functions/common_function.php";
  include $_SESSION['dir_root']."app/functions/common_functions.php";
  include $_SESSION['dir_root']."app/functions/db_functions.php";

  try {
  	/*echo "<pre/>";
  	print_r($_POST);die;*/
    $logged_user_id=$_SESSION['cms_userid'];
    $id = getSanitizedData($_POST['slide_id']);
    $class = getSanitizedData($_POST['class']);
    $subject_id = getSanitizedData($_POST['subject_id']);
    
    $getSlidePath = GetRecord("cpadd_slide_list", array("id" => $id));
    if($getSlidePath['slide_file_path'] != ""){
      $pathInfo = pathinfo($getSlidePath['slide_file_path']);
      if(is_int($pathInfo['filename']))
        unlink(str_replace($web_root, $dir_root, $getSlidePath['slide_file_path']));
    }

    $DeleteSlide = DeleteRecord("cpadd_slide_list", array("id" => $id));
    $getSlides = getSlides($class, $subject_id);
    $status = true;

    $response = array("status"=>$status, "slides"=>$getSlides['data']);
    echo json_encode($response);
  }	catch(Exception $exp) {
  	echo "<pre/>";
  	print_r($exp);
  }

?>