<?php
session_start();
include_once $_SESSION['dir_root']."app/session_token/checksession.php";
include $_SESSION['dir_root']."app/configration/config.php";
include $_SESSION['dir_root']."app/functions/db_functions.php";

try{
	$logged_user_id=$_SESSION['cms_userid'];
	$class = getSanitizedData($_POST['classid']);
	$topicid = getSanitizedData($_POST['topicid']);
	$selected_device = getSanitizedData($_POST['selected_device']);

	if(isset($_POST['slideid'])){
		if(count($_POST['slideid']) > 0) {
			$autoid_status = InsertRecord("topic_responsive_status", array("device_size" => $selected_device,
			"classid" => $class,
			"topicid" => $topicid,
			"status" => "Yes",
			"updated_by" => $logged_user_id
			));


			foreach ($_POST['slideid'] as $value) {
				$slideid = getSanitizedData($value);
				$slide_comment = $_POST['slide_feedback'][$value];
				$query = "SELECT * FROM slide_responsive_status WHERE classid = ? AND topicid=? AND slideid=? AND status=0 AND device_size=?";
		  		$stmt = $db->prepare($query);
		  		$stmt->execute(array($class,$topicid,$slideid,$selected_device));
		  		if(!$stmt->rowCount()){
					$autoid_status = InsertRecord("slide_responsive_status", array("device_size" => $selected_device,
					"classid" => $class,
					"topicid" => $topicid,
					"slideid" => $slideid,
					"slide_comment" => $slide_comment,
					"updated_by" => $logged_user_id
					));
				}
			}
		}
	}else {
		$autoid_status = InsertRecord("topic_responsive_status", array("device_size" => $selected_device,
		"classid" => $class,
		"topicid" => $topicid,
		"status" => "No",
		"updated_by" => $logged_user_id
		));
	}

	//get device name
	$device_name = GetRecord("device", array("width"=>$selected_device));
	
	$status =true;
	$message = "Successfully Updated - ".$device_name['device_name'];
	$response = array("status"=>$status, "message"=>$message);
	echo json_encode($response);
}catch(Exception $exp){
	echo "<pre/>";
	print_r($exp);
}
?>