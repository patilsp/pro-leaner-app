<?php
  session_start();
  include_once $_SESSION['dir_root']."app/session_token/checksession.php";
  include $_SESSION['dir_root']."app/configration/config.php";

  try {
  	$logged_user_id=$_SESSION['cms_userid'];
    $slideid = intval($_POST['current_container_slideid']);
    $query = "UPDATE popup_words SET synced = 0, updated_by = ?, updated_on = NOW() WHERE slide_id = ? AND deleted_by IS NULL AND synced = 1";
    $stmt = $db->prepare($query);
    $stmt->execute(array($logged_user_id, $slideid));
  } catch(Exception $exp) {
    echo "<pre/>";
    print_r($exp);
  }

?>