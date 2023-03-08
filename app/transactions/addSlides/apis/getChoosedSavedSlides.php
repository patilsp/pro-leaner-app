<?php
  session_start();
  include_once $_SESSION['dir_root']."app/session_token/checksession.php";
  include $_SESSION['dir_root']."app/configration/config.php";
  include "../functions/common_function.php";
  include $_SESSION['dir_root']."app/functions/db_functions.php";

  try {
  	$logged_user_id=$_SESSION['cms_userid'];
    $slideid = getSanitizedData($_POST['slideid']);
    $layoutid = getSanitizedData($_POST['layoutid']);
    
    $getSlideJson = GetRecord("add_slide_list", array("id"=>$slideid));
    $slideJSON = $getSlideJson['slide_json'];
    $slide_title = $getSlideJson['slide_title'];
    $generated_slide = $getSlideJson['slide_file_path'];
    $getSlideLayoutHTML = GetRecord("resources", array("id"=>$layoutid));
    $slideLayoutHTML = $web_root.$getSlideLayoutHTML['layoutfilepath_html'];
    $slideLayoutPHP = $web_root.$getSlideLayoutHTML['layoutfilepath_html'];
    $slideLayoutPHP = str_replace("html", "php", $slideLayoutPHP);
    if($layoutid == 0){
      $slideLayoutHTML = $getSlideJson['slide_file_path'];
    }

    $audioSrc = json_decode($slideJSON);
    $objectToArray = (array)$audioSrc;
    $resId = "";
    if(array_key_exists("audio", $objectToArray)) {
      $audiofilename = basename($objectToArray['audio'], ".mp3");
      $audiofileid = explode("_", $audiofilename);
      $resId = $audiofileid[1];
    }

    $response = array("slideTitle"=>$slide_title, "slideJSON"=>$slideJSON, "slideLayoutHTML"=>$slideLayoutHTML, "generated_slide"=>$generated_slide, "slideLayoutPHP"=>$slideLayoutPHP, "slideid"=>$slideid, "resId"=>$resId);
    echo json_encode($response);
  }	catch(Exception $exp) {
  	echo "<pre/>";
  	print_r($exp);
  }

?>