<?php
// required headers


require_once "../headersValidation.php";

// header("Access-Control-Allow-Origin: http://localhost/");
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Methods: POST");
// header("Access-Control-Max-Age: 3600");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// files needed to connect to database
// include_once 'config/database.php';
require('../../configration/config.php');
include_once 'objects/user.php';
// include_once 'validate_token.php';
 
// get database connection
// $database = new Database();
// $db = $database->getConnection();
 
// instantiate user object
$user = new User($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set product property values
$user->email = $data->username;
$email_exists = $user->emailExists();
$userDetails = $user->getUserDetails();
$class = '';
if (!empty($userDetails)) {
  $class = $userDetails["Class"];
}

// generate json web token
include_once 'config/core.php';
include_once 'libs/php-jwt-master/src/BeforeValidException.php';
include_once 'libs/php-jwt-master/src/ExpiredException.php';
include_once 'libs/php-jwt-master/src/SignatureInvalidException.php';
include_once 'libs/php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;
 
// check if email exists and if password is correct
if($email_exists  ){
 
    $token = array(
       "iss" => $iss,
       "aud" => $aud,
       "iat" => $iat,
       "nbf" => $nbf,
       "data" => array(
           "id" => $user->id,
           "firstname" => $user->firstname,
           "lastname" => $user->lastname,
           "email" => $user->email,
           "class" => $class
       )
    );
 
    // set response code
    http_response_code(200);
    
    $arr = [];
    // generate jwt
    $jwt = JWT::encode($token, $key);
    if (!empty($userDetails)) {
      $arr['id'] = $userDetails["id"];
      $arr['username'] = $userDetails["username"];
      $arr['firstname'] = $userDetails["firstname"];
      $arr['Class'] = $userDetails["Class"];
      $arr['displayClassName'] = $userDetails["displayClassName"];
      $arr['classCategoryID'] = '';
      $arr['userPlan'] = '';
      $arr['profile_pic'] = '';
      $arr['tandc'] = '';
      $arr['tour_status'] = '';
      $arr['course_prologue'] = '';
      $arr['unread_notifications'] = true;
      $arr['lastaccess'] = '';
      $arr['showCoursePrologue'] = '';
      $arr['fullFreetopics'] = '';
    }
    echo json_encode(
            array(
                "status" => "true",
                "User" => $arr,
                "Message" => "Login Successfull",
                "jwt" => $jwt
            )
        );
 
}
 
// login failed
else{
 
    // set response code
    http_response_code(401);
 
    // tell the user login failed
    echo json_encode(array("message" => "Login failed."));
}
?>