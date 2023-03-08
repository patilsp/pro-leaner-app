<?php
  session_start();
  include_once $_SESSION['dir_root']."app/session_token/checksession.php";
  include $_SESSION['dir_root']."app/configration/config.php";
  include $_SESSION['dir_root']."app/configration/config_schools.php";
  include $_SESSION['dir_root']."app/functions/db_functions.php";

  try {
  	/*echo "<pre/>";
  	print_r($_POST);die;*/
    $logged_user_id=$_SESSION['cms_userid'];
    $id = getSanitizedData($_POST['qid']);
    $subject = getSanitizedData($_POST['subject']);
    $date = getSanitizedData($_POST['date']);

    $query = "DELETE FROM skillpre_schools.quizzone_questions WHERE id = ?";
    $stmt = $dbs->prepare($query);
    $stmt->execute(array($id));
    $status = true;

    $response = array("status"=>$status);
    echo json_encode($response);
  }	catch(Exception $exp) {
  	echo "<pre/>";
  	print_r($exp);
  }

?>