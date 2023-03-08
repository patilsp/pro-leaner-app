<?php
  include_once "../../../session_token/checksession.php";
  include "../../../configration/config.php";
  include "../../../functions/common_functions.php";
  include "../../../functions/db_functions.php";

  $role_id = getSanitizedData($_POST['checkeddept']);
  $getUsers = getUsers($role_id,$_SESSION['cms_userid']);
  echo json_encode($getUsers);
?>