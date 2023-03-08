<?php
  include_once $dir_root."app/session_token/checksession.php";
  include $dir_root."app/configration/config.php";
  //include $dir_root."app/functions/common_functions.php";
  include $dir_root."app/functions/db_functions.php";

function getTaskStatus1($task_id,$task_assign_id) {
  	global $db;
  	$response = array();
  	$query = "SELECT * FROM tasks WHERE id=?";
	$stmt = $db->prepare($query);
	$stmt->execute(array($task_id));
	$rowcount = $stmt->rowCount();
	if($rowcount > 0){
		while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
			$response['task_name']=$fetch['task_name'];
  		$response['inputs']=$fetch['inputs'];
  		$response['class_id']=$fetch['class_id'];
  		$response['prev_slide_id']=$fetch['slide_id'];
  		$response['lesson_id']=$fetch['lesson_id'];
		}
	}

	$all_depts_data = array();
		//Assigned Departments Loop
		$query = "SELECT * FROM task_details WHERE task_assign_id=? ORDER BY id desc LIMIT 1";
	$stmt = $db->prepare($query);
	$stmt->execute(array($task_assign_id));
	$rowcount = $stmt->rowCount();
	if($rowcount > 0){
		while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
  		$this_data['user_id'] = $fetch['user_id'];
  		$this_data['instructions'] = $fetch['instructions'];
  		$this_data['attachments'] = $fetch['attachments'];
  		$this_data['status'] = $fetch['status'];
  		$this_data['file_path'] = $fetch['added_new_html_file'];

  		$query1 = "SELECT * FROM status WHERE id='".$fetch['status']."' ORDER BY id";
		$stmt1 = $db->query($query1);
		$fetch1 = $stmt1->fetch(PDO::FETCH_ASSOC);
		$this_data['status_name'] = $fetch1['name'];

  		array_push($all_depts_data, $this_data);
		}


		$response['AssignedDepartments'] = $all_depts_data;
	}
		return $response;
}


function getTaskStatusEdit($task_id,$task_assign_id) {
  	global $db;
  	$response = array();
  	$query = "SELECT * FROM tasks WHERE id=?";
	$stmt = $db->prepare($query);
	$stmt->execute(array($task_id));
	$rowcount = $stmt->rowCount();
	if($rowcount > 0){
		while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
			$response['task_name']=$fetch['task_name'];
  		$response['inputs']=$fetch['inputs'];
  		$response['class_id']=$fetch['class_id'];
  		$response['prev_slide_id']=$fetch['slide_id'];
  		$response['lesson_id']=$fetch['lesson_id'];
		}
	}

	$all_depts_data = array();
		//Assigned Departments Loop
		$query = "SELECT * FROM task_details WHERE task_assign_id=?";
	$stmt = $db->prepare($query);
	$stmt->execute(array($task_assign_id));
	$rowcount = $stmt->rowCount();
	if($rowcount > 0){
		while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
  		$this_data['user_id'] = $fetch['user_id'];
  		$this_data['instructions'] = $fetch['instructions'];
  		$this_data['attachments'] = $fetch['attachments'];
  		$this_data['status'] = $fetch['status'];
  		$this_data['file_path'] = $fetch['added_new_html_file'];

  		$query1 = "SELECT * FROM status WHERE id='".$fetch['status']."' ORDER BY id";
		$stmt1 = $db->query($query1);
		$fetch1 = $stmt1->fetch(PDO::FETCH_ASSOC);
		$this_data['status_name'] = $fetch1['name'];

  		array_push($all_depts_data, $this_data);
		}


		$response['AssignedDepartments'] = $all_depts_data;
	}
		return $response;
}
?>