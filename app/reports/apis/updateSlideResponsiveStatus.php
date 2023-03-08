<?php
	include_once "../../session_token/checksession.php";
	include "../../configration/config.php";
	include "../../functions/db_functions.php";
	$logged_user_id=$_SESSION['cms_userid'];
	try{
		/*print_r($_POST);
		print_r($_FILES);die;*/
		$id = getSanitizedData($_POST['id']);
		$status = getSanitizedData($_POST['status']);
		$updated_on = date("Y-m-d H:i:s");
		
		$query = "UPDATE slide_responsive_status SET tt_status = ?, tt_updated_by=?, tt_updated_on=? WHERE id = ?";
		$stmt = $db->prepare($query);
		$stmt->execute(array($status, $logged_user_id, $updated_on, $id));
		echo "1";
	} catch(Exception $exp){
    	echo "<pre/>";
    	print_r($exp);
	}
?>