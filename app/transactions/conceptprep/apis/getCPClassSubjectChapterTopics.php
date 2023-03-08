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
    
    $response = array();
    $modules = array();
    $data = array();
    $query = "SELECT * FROM cpmodules WHERE id=? AND deleted=0 AND level = 1 ORDER BY sequence";
    $stmt = $db->prepare($query);
    $stmt->execute(array($id));
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $data['id'] = $row['id'];
      $data['name'] = $row['module'];
      $data['parent'] = $row['parentId'];
      $data['type'] = $row['type'];
      array_push($modules, $data);

      $query1 = "SELECT * FROM cpmodules WHERE level = 2 AND parentId = ? AND deleted=0 ORDER BY sequence";
      $stmt1 = $db->prepare($query1);
      $stmt1->execute(array($row['id']));
      $rowcount1 = $stmt1->rowcount();

      if($rowcount1 > 0)
      {
        while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
          $data['id'] = $row1['id'];
          $data['name'] = $row1['module'];
          $data['parent'] = $row1['parentId'];
          $data['type'] = $row1['type'];
          array_push($modules, $data);

          $query2 = "SELECT * FROM cpmodules WHERE level = 3 AND parentId = ? AND deleted=0 ORDER BY sequence";
          $stmt2 = $db->prepare($query2);
          $stmt2->execute(array($row1['id']));
          $rowcount2 = $stmt2->rowcount();

          if($rowcount2 > 0)
          {
            while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
              $data['id'] = $row2['id'];
              $data['name'] = $row2['module'];
              $data['parent'] = $row2['parentId'];
              $data['type'] = $row2['type'];
              array_push($modules, $data);

              $query3 = "SELECT * FROM cpmodules WHERE level = 4 AND parentId = ? AND deleted=0 ORDER BY sequence";
              $stmt3 = $db->prepare($query3);
              $stmt3->execute(array($row2['id']));
              $rowcount3 = $stmt3->rowcount();

              if($rowcount3 > 0)
              {
                while($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
                  $data['id'] = $row3['id'];
                  $data['name'] = $row3['module'];
                  $data['parent'] = $row3['parentId'];
                  $data['type'] = $row3['type'];
                  array_push($modules, $data);

                  $query4 = "SELECT * FROM cpmodules WHERE level = 5 AND parentId = ? AND deleted=0 ORDER BY sequence";
                  $stmt4 = $db->prepare($query4);
                  $stmt4->execute(array($row3['id']));
                  $rowcount4 = $stmt4->rowcount();

                  if($rowcount4 > 0)
                  {
                    while($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                      $data['id'] = $row4['id'];
                      $data['name'] = $row4['module'];
                      $data['parent'] = $row4['parentId'];
                      $data['type'] = $row4['type'];
                      array_push($modules, $data);
                    }
                  }
                }
              }
            }
          }
        }
      }
    }

    /*echo "<pre/>";
    print_r($response);die;*/

    $response = array("status"=>true, "result"=>$modules);
    echo json_encode($response);
  }	catch(Exception $exp) {
  	echo "<pre/>";
  	print_r($exp);
  }

?>