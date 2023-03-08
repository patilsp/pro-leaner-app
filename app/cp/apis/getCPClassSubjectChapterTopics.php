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
      $data['sequence'] = $row['sequence'];
      $data['id'] =   $row['sequence']."-".$row['id'];
      $rowid = $row['id']; 
      $rowparentid =  $row['sequence']."-".$row['id'];
      $data['name'] = $row['module'];
      $data['parent'] = $row['parentId'];
      $data['type'] = $row['type'];
     
      array_push($modules, $data);

      $query1 = "SELECT * FROM cpmodules WHERE level = 2 AND parentId = ? AND deleted=0 ORDER BY sequence";
      $stmt1 = $db->prepare($query1);
      $stmt1->execute(array($rowid));
      $rowcount1 = $stmt1->rowcount();
 
      if($rowcount1 > 0)
      {
        while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {

          $data['sequence'] = $row1['sequence'];
          $row1id = $row1['id']; 
          $row1parentid =  $row1['sequence']."-".$row1['id'];
          $data['id'] =  $row1['sequence']."-".$row1['id'];
          $data['name'] = $row1['module'];
          $data['parent'] = $rowparentid;
          $data['type'] = $row1['type'];
          
          array_push($modules, $data);

          $query2 = "SELECT * FROM cpmodules WHERE level = 3 AND parentId = ? AND deleted=0 ORDER BY sequence";
          $stmt2 = $db->prepare($query2);
          $stmt2->execute(array($row1id));
          $rowcount2 = $stmt2->rowcount();
          
          if($rowcount2 > 0)
          {
            while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
              $data['sequence'] = $row2['sequence'];
              $data['id'] = $row2['sequence']."-".$row2['id'];
              $row2id = $row2['id'];
              $row2parentid =  $row2['sequence']."-".$row2['id'];
              $data['name'] = $row2['module'];
              $data['parent'] = $row1parentid;
              $data['type'] = $row2['type'];
             
              array_push($modules, $data);

              $query3 = "SELECT * FROM cpmodules WHERE level = 4 AND parentId = ? AND deleted=0 ORDER BY sequence";
              $stmt3 = $db->prepare($query3);
              $stmt3->execute(array($row2id));
              $rowcount3 = $stmt3->rowcount();

              if($rowcount3 > 0)
              {
                while($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
                  $data['sequence'] = $row3['sequence'];
                  $data['id'] = $row3['sequence']."-".$row3['id'];
                  $row3id = $row3['id'];
                  $row3parentid =  $row3['sequence']."-".$row3['id'];
                  $data['name'] = $row3['module'];
                  $data['parent'] = $row2parentid;
                  $data['type'] = $row3['type'];
                 
                  array_push($modules, $data);

                  $query4 = "SELECT * FROM cpmodules WHERE level = 5 AND parentId = ? AND deleted=0 ORDER BY sequence";
                  $stmt4 = $db->prepare($query4);
                  $stmt4->execute(array($row3id));
                  $rowcount4 = $stmt4->rowcount();

                  if($rowcount4 > 0)
                  {
                    while($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                      $data['sequence'] = $row4['sequence'];
                      $data['id'] = $row4['sequence']."-".$row4['id'];
                      $data['name'] = $row4['module'];
                      $data['parent'] = $row3parentid;
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