<?php
	include_once "../../session_token/checksession.php";
	include "../../configration/config.php";
	include "../../configration/config_schools.php";
	include "../../functions/db_functions.php";
	require_once "../../functions/common_functions.php";
	$logged_user_id=$_SESSION['cms_userid'];
	try{
		$global_notify = array();
		$global_notify_data = array();
  	$query = "SELECT * FROM $db_name.global_notifications WHERE sync_status = 0 AND master_database = '$master_db'";
  	$stmt = $db->query($query);
  	$rowcount = $stmt->rowCount();
  	if($rowcount){
      while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
      	$thisClass = $fetch['class'];
        $global_notify['global_notify_id'] = $fetch['id'];
        $global_notify['course_id'] = $fetch['course_id'];
        $global_notify['course_name'] = $fetch['course_name'];
        $global_notify['link'] = $fetch['link'];
        if(! isset($global_notify_data[$thisClass])) {
        	$global_notify_data[$thisClass] = array();
        }
        array_push($global_notify_data[$thisClass], $global_notify);
      }
  	}
		$database = $master_db;

		$query = "SELECT mysql_database FROM $db_name.masters_school WHERE master_school_dbname = ? AND Active=1";
	  	$stmt = $db->prepare($query);
	  	$stmt->execute(array($database));
	  	$rowcount = $stmt->rowCount();
	    if($rowcount){
		    while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
	     		$school_db = $fetch['mysql_database'];

				$query_mdl = "SELECT * FROM $school_db.mdl_user WHERE Class > 0 AND deleted = 0";
		      	$stmt_mdl = $db->query($query_mdl);
		      	$rowcount_mdl = $stmt_mdl->rowCount();
		      	if($rowcount_mdl) {
	    			while($fetch_mdl = $stmt_mdl->fetch(PDO::FETCH_ASSOC)) {
	    				$thisClass = $fetch_mdl['Class'];
						$user_id = $fetch_mdl['id'];
						$updated_on = date("Y-m-d H:i:s");
						if(! isset($global_notify_data[$thisClass])) {
							continue;
						}
						foreach ($global_notify_data[$thisClass] as $data) {
							$global_id = $data['global_notify_id'];
							$course_id = $data['course_id'];
							$course_name = $data['course_name'];
							$link = $data['link'];

							$autoid_status1 = InsertRecord("$school_db.notifications", array(
							"user_id" => $user_id,
							"category" =>  1,
							"notification_ref" => $global_id,
							"course_id" => $course_id,
							"course_name" =>  $course_name,
							"link" =>  $link,
							"created_on" => $updated_on
							));
						}
					}
		      	}
			}
		}

		$query = "UPDATE $db_name.global_notifications SET sync_status = 1, sync_on = NOW() WHERE sync_status = 0";
		$stmt = $db->query($query);

		$status =true;
		$message ="Updated Successfully";

		$response = array("status"=>$status, "message"=>$message);
		echo json_encode($response);
	} catch(Exception $exp){
		echo "<pre/>";
    	print_r($exp);
	}

?>