<?php 
include_once "../session_token/checksession.php";
include_once "../configration/config.php";
//include_once "session_token/checktoken.php";
require_once "../functions/db_functions.php"; 
include "functions/common_function.php";

$userid=$_GET['user_id'];
$classesAssigned = getClassesAssigned($userid);

 $sql = "SELECT * FROM users WHERE id = ?";
 $query=$db->prepare($sql);
 $query->execute(array($userid)); 
 $result = [];
 while($fetch = $query->fetch(PDO::FETCH_ASSOC))
  {

    $result["user_auto_id"] = $fetch['id'];
    $result["first_name"] = $fetch['first_name'];
    $result["last_name"] = $fetch['last_name'];
    $result["password"] = $fetch['password'];
    $result["email"] = $fetch['email'];
    $result["mobile"] = $fetch['mobile'];
    // $result["roles_id"] = $fetch['roles_id'];
    // $result["gender"] = $fetch['gender'];
    // $result["username"] = $fetch['username'];
    // $result["designation"] = $fetch['designation'];
    // $result["dept"] = $fetch['dept'];
    $result["phone"] = $fetch['phone'];

  }  
  // $data["users"] = $result;
  echo json_encode($result);
?>

