<?php
  include_once "../../session_token/checksession.php";
  require_once "../../configration/config.php";
  require_once "../../functions/db_functions.php";
try{
  $class_id = getSanitizedData($_POST['classes']);
  $topic_id = getSanitizedData($_POST['topic_id']);
  $slide_id = getSanitizedData($_POST['slide_id']);
  $logged_user_id=$_SESSION['cms_userid'];
  if(count($_POST['word'])) {
  	//Delete the words
	$query = "UPDATE popup_words SET deleted_by = ?, deleted_on = NOW() WHERE topic_id = ? AND slide_id = ? AND deleted_on IS NULL";
	$stmt = $db->prepare($query);
	$stmt->execute(array($logged_user_id, $topic_id, $slide_id));

	$query = "INSERT INTO popup_words (class, topic_id, slide_id, word, meaning, updated_by, updated_on) VALUES (?, ?, ?, ?, ?, ?, NOW())";
	$stmt = $db->prepare($query);
  	foreach ($_POST['word'] as $key => $value) {
  		$word = getSanitizedData($value);
  		$meaning = $_POST['meaning'][$key];

  		$stmt->execute(array($class_id, $topic_id, $slide_id, $word, $meaning, $logged_user_id));  		
  	}
  }
  echo json_encode(array("status"=>true, "Message"=>"POP-UP Words created Successfully"));
 } catch(Exception $exp) {
 	print_r($exp);
 }
?>