<?php
  session_start();
  include_once $_SESSION['dir_root']."app/session_token/checksession.php";
  include $_SESSION['dir_root']."app/configration/config.php";
  include "../functions/common_function.php";
  include $_SESSION['dir_root']."app/functions/db_functions.php";

  try {
    /*echo "<pre/>";
    print_r($_POST);die;*/
  	$logged_user_id=$_SESSION['cms_userid'];
    $id = getSanitizedData($_POST['id']);
    $type = getSanitizedData($_POST['type']);
    if($type == 'add') {
      $query1 = "SELECT * FROM cpmodules WHERE id = ?";
      $stmt1 = $db->prepare($query1);
      $stmt1->execute(array($id));
      $rowcount1 = $stmt1->rowcount();

      if($rowcount1 > 0)
      {
        $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
        $type = $row1['type'];
        if($type == 'class') {
          $moduleType = 'subject';
          $level = 2;
        } elseif($type == 'subject'){
          $moduleType = 'chapter';
          $level = 3;
        } elseif($type == 'chapter'){
          $moduleType = 'topic';
          $level = 4;
        } elseif($type == 'topic'){
          $moduleType = 'subTopic';
          $level = 5;
        }
        $parentId = $id;
        $module = 'Enter '.$moduleType;

        //get sequence
        $query1 = "SELECT id, sequence FROM cpmodules WHERE parentId = ? order by id desc LIMIT 1";
        $stmt1 = $db->prepare($query1);
        $stmt1->execute(array($parentId));
        $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
        $sequence = $row1['sequence'] + 1;

        $query = "INSERT INTO cpmodules (module, parentId, level, sequence, type, created_by) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->execute(array($module, $parentId, $level, $sequence, $moduleType, $logged_user_id));  

        $status = true;
      } else {
        $status = false;
      }
    } else if ($type == 'delete') {
      $query1 = "SELECT * FROM cpmodules WHERE id = ?";
      $stmt1 = $db->prepare($query1);
      $stmt1->execute(array($id));
      $rowcount1 = $stmt1->rowcount();

      if($rowcount1 > 0)
      {
        $query = "UPDATE cpmodules SET deleted = 1 WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute(array($id));
        $status = true;
      } else {
        $status = false;
      }
    } else if ($type == 'update') {
      $updatedModuleName = getSanitizedData($_POST['name']);
      $query1 = "SELECT * FROM cpmodules WHERE id = ?";
      $stmt1 = $db->prepare($query1);
      $stmt1->execute(array($id));
      $rowcount1 = $stmt1->rowcount();

      if($rowcount1 > 0)
      {
        $query = "UPDATE cpmodules SET module = ? WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute(array($updatedModuleName, $id));
        $status = true;
      } else {
        $status = false;
      }
    }

    $response = array("status"=>$status);
    echo json_encode($response);
  }	catch(Exception $exp) {
  	echo "<pre/>";
  	print_r($exp);
  }

?>