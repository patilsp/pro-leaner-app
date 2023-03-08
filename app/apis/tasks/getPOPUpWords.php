<?php
  include_once "../../session_token/checksession.php";
  require_once "../../configration/config.php";
  require_once "../../functions/db_functions.php";
try{
  $class_id = getSanitizedData($_POST['classes']);
  $topic_id = getSanitizedData($_POST['topic_id']);
  $slide_id = getSanitizedData($_POST['slide_id']);
  $logged_user_id=$_SESSION['cms_userid'];

  $query = "SELECT * FROM popup_words WHERE topic_id = ? AND slide_id = ? AND deleted_on IS NULL";
  $stmt = $db->prepare($query);
  $stmt->execute(array($topic_id, $slide_id));
  $words = array();
  while($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $words[] = array("word"=>$rows['word'], "meaning"=>$rows['meaning']);
  }

  echo json_encode(array("status"=>true, "result"=>$words));
 } catch(Exception $exp) {
 	print_r($exp);
 }
?>