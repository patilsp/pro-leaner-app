<?php
  session_start();
  include_once $_SESSION['dir_root']."app/session_token/checksession.php";
  include $_SESSION['dir_root']."app/configration/config.php";
  include "../functions/common_function.php";
  include $_SESSION['dir_root']."app/functions/db_functions.php";

  try {
  	$logged_user_id=$_SESSION['cms_userid'];
    $slideid = intval($_POST['slideid']);
    $layoutid = intval($_POST['layoutid']);
    
    $getSlideJson = GetRecord("skillpre_schools.quizzone_questions", array("id"=>$slideid));
    $slideJSON = $getSlideJson['slide_json'];
    $slide_title = $getSlideJson['slide_title'];
    $getSlideLayoutHTML = GetRecord("resources", array("id"=>$layoutid));
    $slideLayoutHTML = $web_root.$getSlideLayoutHTML['layoutfilepath_html'].'?api_end_point=app/transactions/quizzone/getactivitydata.php&qust_id='.$slideid;
    $slideLayoutPHP = $web_root.$getSlideLayoutHTML['layoutfilepath_html'];
    $slideLayoutPHP = str_replace("html", "php", $slideLayoutPHP);
    if($layoutid == 0){
      $slideLayoutHTML = $getSlideJson['slide_file_path'];
    }

    $response = array("slideTitle"=>$slide_title, "slideJSON"=>$slideJSON, "slideLayoutHTML"=>$slideLayoutHTML, "slideLayoutPHP"=>$slideLayoutPHP, "slideid"=>$slideid);
    echo json_encode($response);
  }	catch(Exception $exp) {
  	echo "<pre/>";
  	print_r($exp);
  }

?>