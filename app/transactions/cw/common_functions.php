<?php

function upload_image()
{
	//print_r($_FILES["school_logo"]);
	if(isset($_FILES["school_logo"]))
	{
		$extension = explode('.', $_FILES['school_logo']['name']);
		$new_name = rand() . '.' . $extension[1];
		$destination = '../../skills4lifeadmin/logo/' . $new_name;
		move_uploaded_file($_FILES['school_logo']['tmp_name'], $destination);
		return $new_name;
	}
}

function upload_multiple_images($source_ref, $dest_path)
{
	$uploaded_files = array();
	foreach ($_FILES[$source_ref]['name'] as $key1 => $value1) {
		if($_FILES[$source_ref]['error'][$key1] == 0)
		{
			$extension = explode('.', $_FILES[$source_ref]['name'][$key1]);
			$new_name = rand() . '.' . $extension[1];
			$destination = $dest_path . $new_name;
			move_uploaded_file($_FILES[$source_ref]['tmp_name'][$key1], $destination);
			array_push($uploaded_files, $destination);
		}
	}
	return $uploaded_files;
}

function getClasses()
{
	global $db;

	try{
		$all_classess = array();
		$query = "SELECT * FROM class WHERE deleted=0";
  		$stmt = $db->query($query);
  		$rowcount = $stmt->rowCount();
  		if($rowcount > 0){
	  		while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
			    $all_classess[$fetch['id']] = $fetch['class_name'];
		  	}
		  	return $all_classess;
	  	}
  	}catch(Exception $exp){

		print_r($exp);
		return "false";
	}
}

function getDept()
{
	global $db;

	try{
		$roles = array();
		$query = "SELECT * FROM roles WHERE name NOT IN ('Instructional Designer','Content Reviewer')";
  		$stmt = $db->query($query);
  		$rowcount = $stmt->rowCount();
  		if($rowcount > 0){
	  		while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
			    $roles[$fetch['id']] = $fetch['name'];
		  	}
		  	return $roles;
	  	}
  	}catch(Exception $exp){

		print_r($exp);
		return "false";
	}
}

function getStatus()
{
	global $db;

	try{
		$all_status = array();
		$query = "SELECT * FROM status WHERE deleted=0";
  		$stmt = $db->query($query);
  		$rowcount = $stmt->rowCount();
  		if($rowcount > 0){
	  		while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
			    $all_status[$fetch['id']] = $fetch['name'];
		  	}
		  	return $all_status;
	  	}
  	}catch(Exception $exp){

		print_r($exp);
		return "false";
	}
}

function getTopics($class_auto_id)
{
	global $db;
	try{
		$topics = array();
		if($class_auto_id != "") {
			$query = "SELECT * FROM masters_class_topics_mapping WHERE class_id=?";
	  		$stmt = $db->prepare($query);
	  		$stmt->execute(array($class_auto_id));
	  		$rowcount = $stmt->rowCount();
	  		if($rowcount > 0){
	  			$topic_id_arr = array();
				while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
					$topic_id_arr[] = $fetch['topic_id'];
			    }
			  	$topic_id_arr_implode = implode(",", $topic_id_arr);
			  	$query1 = "SELECT * FROM topics WHERE id IN ($topic_id_arr_implode)";
	  			$stmt1 = $db->query($query1);
	  			while($fetch1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
				    array_push($topics, array("id"=>$fetch1['id'], "description"=>$fetch1['topic_name']));
			  	}
			  	return $topics;
		  	}
	  	} else{
			$query = "SELECT * FROM topics";
	  		$stmt = $db->query($query);
	  		$rowcount = $stmt->rowCount();
	  		if($rowcount > 0){
				while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
				    array_push($topics, array("id"=>$fetch['id'], "description"=>$fetch['topic_name']));
			  	}
			  	return $topics;
		  	}
  		}
  		$rowcount = $stmt->rowCount();
  		
  	}catch(Exception $exp){

		print_r($exp);
		return "false";
	}
}

function getUsers($dept, $logged_user_id)
{
	global $db;
	try{
		$role = $dept;
		if($role == "CW")
			$dept = 2;
		elseif ($role == "GD")
			$dept = 3;
		elseif ($role == "VD")
			$dept = 4;
		elseif ($role == "TT")
			$dept = 5;
		else
			$dept = "";
		
		$users = array();
		if($dept != "") {
			$query = "SELECT id, first_name, last_name FROM users WHERE roles_id=? AND id != ?";
	  		$stmt = $db->prepare($query);
	  		$stmt->execute(array($dept, $logged_user_id));
  		} else {
  			$query = "SELECT id, first_name, last_name FROM users WHERE id != ?";
	  		$stmt = $db->prepare($query);
	  		$stmt->execute(array($logged_user_id));	
  		}
  		$rowcount = $stmt->rowCount();
  		if($rowcount > 0){
  			while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
			    array_push($users, array("id"=>$fetch['id'], "username"=>$fetch['first_name']." ".$fetch['last_name']));
		  	}
		  	return $users;
	  	}
  	}catch(Exception $exp){

		print_r($exp);
		return "false";
	}
}

//get list of task
function getTaskList($role_id, $logged_user_id)
{
	global $db;
	try{
		$tasks = array();
		if($role_id == 1) {
			$query = "select t.id as task_id,t.task_name,c.class_name,c.id as cid,tp.id as tpid,tp.topic_name,s.name,ta.id as task_ass_id, r.name as dept from tasks t,class c,topics tp, status s, task_assign ta, users u, roles r where t.class_id = c.id and t.topics_id=tp.id and ta.status = s.id and t.id=ta.tasks_id and ta.user_id=u.id and u.roles_id= r.id ORDER BY ta.id desc";
	  		$stmt = $db->query($query);
	  	} else {
  			$query = "select t.id as task_id,t.task_name,c.class_name,c.id as cid,tp.topic_name,tp.id as tpid,s.name,ta.id as task_ass_id, r.name as dept from tasks t,class c,topics tp, status s, task_assign ta, users u, roles r where t.class_id = c.id and t.topics_id=tp.id and ta.status = s.id and t.id=ta.tasks_id and ta.user_id=u.id and u.roles_id= r.id AND ta.user_id='".$logged_user_id."' ORDER BY ta.id desc";
	  		$stmt = $db->query($query);	
  		}
  		$rowcount = $stmt->rowCount();
  		while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
		    array_push($tasks, array("title"=>$fetch['task_name'], "dept"=>$fetch['dept'], "class"=>$fetch['class_name'], "topic"=>$fetch['topic_name'], "class_id"=>$fetch['cid'], "topic_id"=>$fetch['tpid'], "status"=>$fetch['name'], "task_ass_id"=>$fetch['task_ass_id'], "task_id"=>$fetch['task_id']));
	  	}
	  	return $tasks;
  	}catch(Exception $exp){

		print_r($exp);
		return "false";
	}
}
?>