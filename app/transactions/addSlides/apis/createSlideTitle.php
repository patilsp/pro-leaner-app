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
    $task_assign_id = getSanitizedData($_POST['task_assign_id']);
    $class = getSanitizedData($_POST['class']);
    $topic_id = getSanitizedData($_POST['topic_id']);
    $lesson_id = getSanitizedData($_POST['lesson_id']);
    $layout_id = getSanitizedData($_POST['layout_id']);
    $slide_title = getSanitizedData($_POST['slide_title']);
    if(isset($_POST['prev_slide_id'])) {
      $prev_slide_id = getSanitizedData($_POST['prev_slide_id']);
      if($prev_slide_id != ""){
        $prev_slide_id = getSanitizedData($_POST['prev_slide_id']);
      }else{
        $prev_slide_id = NULL;
      }
    } else{
      $prev_slide_id = NULL;
    }

    //get last seruence slide id for the respective class and topic
    $query = "SELECT * FROM add_slide_list WHERE class=? AND topic_id=? AND lesson_id=? ORDER BY id DESC LIMIT 1";
    $stmt = $db->prepare($query);
    $stmt->execute(array($class, $topic_id, $lesson_id));
    $fetch = $stmt->fetch(PDO::FETCH_ASSOC);

    $LastSequenceId = $fetch['sequence'];
    if($LastSequenceId > 0)
      $sequence = $LastSequenceId + 1;
    else
      $sequence = 1;

    $autoid_status = InsertRecord("add_slide_list", array("task_assign_id" => $task_assign_id,
    "class" => $class,
    "topic_id" => $topic_id,
    "lesson_id" => $lesson_id,
    "prev_slide_id" => $prev_slide_id,
    "layout_id" => $layout_id,
    "slide_title" => $slide_title,
    "sequence" => $sequence,
    "updated_by" => $logged_user_id
    ));
    if($autoid_status) {
      //get slides of this topic
      if($prev_slide_id == NULL) {
        $getSlides = getSlides($class, $topic_id);
      }
      else {
        $getAddSlideExistingTopic = getRecord("tasks", array("id"=>$task_assign_id));
        $json_prev_lessonid_slideid = $getAddSlideExistingTopic['slide_id'];
        $getSlides = getSlidesExistingTopic($web_root, $class, $topic_id, $json_prev_lessonid_slideid, $task_assign_id);
      }
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