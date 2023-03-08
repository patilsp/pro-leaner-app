<?php 
include_once "../session_token/checksession.php";
include_once "../configration/config.php";
//include_once "session_token/checktoken.php";
require_once "../functions/db_functions.php"; 

$userid=$_GET['user_id'];

 $sql = "SELECT * FROM users WHERE id = ?";
 $query=$db->prepare($sql);
 $query->execute(array($userid)); 
 $result = [];
 while($fetch = $query->fetch(PDO::FETCH_ASSOC))
  {

    $result["user_auto_id"] = $fetch['id'];
    $result["first_name"] = $fetch['first_name'];
    $result["last_name"] = $fetch['last_name'];
    
    // $result["email"] = $fetch['email'];
    // $result["mobile"] = $fetch['mobile'];
    // $result["roles_id"] = $fetch['roles_id'];
    $result["gender"] = $fetch['gender'];
    $result["admission"] = $fetch['admission'];
    $result["section"] = $fetch['section'];
    $result["class"] = $fetch['class'];
    $result["phone"] = $fetch['phone'];

  } 
  $sql = "SELECT * FROM masters_sections WHERE class = ?";
  $query=$db->prepare($sql);
  $query->execute(array($result["class"])); 
  while($fetch = $query->fetch(PDO::FETCH_ASSOC))
  {
    $sections[$fetch["id"]] = $fetch["section"]; 
  }
  $result["sectionlist"] = $sections;
  // $data["users"] = $result;
  echo json_encode($result);
?>

