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
    $date = getSanitizedData(date('Y-m-d',strtotime($_POST['date'])));
    $class = getSanitizedData($_POST['class']);
    $temp = explode("-", $class);
    $from_class = $temp[0];
    $to_class = $temp[1];
    $sub_id = getSanitizedData($_POST['topic_id']);
    $layout_id = getSanitizedData($_POST['layout_id']);
    $slide_title = getSanitizedData($_POST['slide_title']);
    $qzone_slide_path = getSanitizedData($_POST['qzone_slide_path']);
    

    $autoid_status = InsertRecord("skillpre_schools.quizzone_questions", array("date" => $date,
    "class_group" => $class,
    "from_class"=>$from_class,
    "to_class"=>$to_class,
    "sub_id" => $sub_id,
    "layout_id" => $layout_id,
    "slide_title" => $slide_title,
    "slide_file_path" => $qzone_slide_path,
    "updated_by" => $logged_user_id
    ));
    if($autoid_status) {
      //get slides of this topic
      /*if($prev_slide_id == NULL) {
        $getSlides = getSlides($date, $class, $sub_id);
      }
      else {
        $getAddSlideExistingTopic = getRecord("tasks", array("id"=>$task_assign_id));
        $json_prev_lessonid_slideid = $getAddSlideExistingTopic['slide_id'];
        $getSlides = getSlidesExistingTopic($web_root, $class, $topic_id, $json_prev_lessonid_slideid, $task_assign_id);
      }*/
      $status = 1;
    } else {
      $status = 0;
    }
    $response = array("status"=>$status, "slideTitle"=>$slide_title, "slides"=>$getSlides, "slideid"=>$autoid_status);
    echo json_encode($response);
  }	catch(Exception $exp) {
  	echo "<pre/>";
  	print_r($exp);
  }

?>