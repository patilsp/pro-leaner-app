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

function upload_multiple_images($source_ref, $dest_path, $resId="")
{
	$uploaded_files = array();
	/*echo "upload 2";
	print_r($_FILES[$source_ref]['name']);*/
	foreach ($_FILES[$source_ref]['name'] as $key1 => $value1) {
		if($_FILES[$source_ref]['error'][$key1] == 0)
		{
			$extension = explode('.', $_FILES[$source_ref]['name'][$key1]);
			$new_name = rand() . $resId . '.' . end($extension);
			$destination = $dest_path . $new_name;
			$original_name = $_FILES[$source_ref]['name'];
			move_uploaded_file($_FILES[$source_ref]['tmp_name'][$key1], $destination);
			array_push($uploaded_files, $destination, $original_name);
		}
	}
	return $uploaded_files;
}

function upload_multiple_images_concept($source_ref, $dest_path, $resId="")
{
	$uploaded_files = array();
	/*echo "upload 2";
	print_r($_FILES[$source_ref]['name']);*/
	foreach ($_FILES[$source_ref]['name'] as $key1 => $value1) {
		if($_FILES[$source_ref]['error'][$key1] == 0)
		{
			$extension = explode('.', $_FILES[$source_ref]['name'][$key1]);
			$new_name = rand() . $resId . '.' . end($extension);
			$destination = $dest_path . $new_name;
			$original_name = $_FILES[$source_ref]['name'];
			move_uploaded_file($_FILES[$source_ref]['tmp_name'][$key1], $destination);
			array_push($uploaded_files, $destination, $new_name);
		}
	}
	return $uploaded_files;
}

function upload_resource_multiple_images($source_ref, $dest_path)
{
	$uploaded_files = array();
	$failure_files = array();
	/*echo "upload 3";
	print_r($_FILES[$source_ref]['name']);*/
	foreach ($_FILES[$source_ref]['name'] as $key1 => $value1) {
		if($_FILES[$source_ref]['error'][$key1] == 0)
		{
			$extension = explode('.', $_FILES[$source_ref]['name'][$key1]);
			$new_name = $_FILES[$source_ref]['name'][$key1];
			$destination = $dest_path . $new_name;
			if(!file_exists($destination)){
				move_uploaded_file($_FILES[$source_ref]['tmp_name'][$key1], $destination);
				array_push($uploaded_files, $destination);
			} else{
				array_push($failure_files, $new_name);
			}
		}
	}
	return [$uploaded_files, $failure_files];
}

function getClasses()
{
	global $db;

	try{
		$all_classess = array();
		for($class = 1; $class <= 12; $class++) {
 			$all_classess[$class] = $class;
		}
		return $all_classess;
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
		$query = "SELECT * FROM status WHERE deleted=0 AND role_id !=6";
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

function getTopicsRMVisible($class_auto_id)
{
	global $db;
	global $master_db;
	try{
		$topics = array();
		if($class_auto_id != "") {
		 	/*AND visible=1*/
			$classsearch = "CLASS ".$class_auto_id;
		  	$query = "SELECT id FROM $master_db.mdl_course_categories WHERE name = ? AND depth = 1";
	  		$stmt = $db->prepare($query);
	  		$stmt->execute(array($classsearch));
	  		$rowcount = $stmt->rowCount();
	  		if($rowcount > 0){
	  			while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
	  				/*AND visible=1*/
	  				$query1 = "SELECT id,name FROM $master_db.mdl_course_categories WHERE parent = ? AND depth = 2 ORDER BY sortorder";
			  		$stmt1 = $db->prepare($query1);
			  		$stmt1->execute(array($fetch['id']));
			  		$rowcount1 = $stmt1->rowCount();
			  		if($rowcount1 > 0){
			  			while($fetch1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
		  				 	/*AND visible=1*/
			  				$query2 = "SELECT id,name FROM $master_db.mdl_course_categories WHERE parent = ? AND depth = 3 ORDER BY sortorder";
					  		$stmt2 = $db->prepare($query2);
					  		$stmt2->execute(array($fetch1['id']));
					  		$rowcount2 = $stmt2->rowCount();
					  		if($rowcount2 > 0){
					  			/*AND visible=1*/
					  			while($fetch2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
					  				$query3 = "SELECT id, fullname FROM $master_db.mdl_course WHERE category = ? ORDER BY sortorder";
							  		$stmt3 = $db->prepare($query3);
							  		$stmt3->execute(array($fetch2['id']));
							  		$rowcount3 = $stmt3->rowCount();
							  		if($rowcount3 > 0){
							  			while($fetch3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
							  				$topic_id_arr = array();
						  					$topic_id_arr['id'] = $fetch3['id'];
						  					$topic_id_arr['description'] = $fetch3['fullname'];
						  					array_push($topics, $topic_id_arr);
							  			}
						  			}
					  			}
				  			}
			  			}
		  			}
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

function getTopics($class_auto_id)
{
	global $db;
	global $master_db;
	try{
		$topics = array();
		if($class_auto_id != "") {
			$classsearch = "CLASS ".$class_auto_id;
		  	$query = "SELECT id FROM $master_db.mdl_course_categories WHERE name = ? AND depth = 1 AND visible = 1";
	  		$stmt = $db->prepare($query);
	  		$stmt->execute(array($classsearch));
	  		$rowcount = $stmt->rowCount();
	  		if($rowcount > 0){
	  			while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
	  				$query1 = "SELECT id,name FROM $master_db.mdl_course_categories WHERE parent = ? AND depth = 2 AND visible = 1 ORDER BY sortorder";
			  		$stmt1 = $db->prepare($query1);
			  		$stmt1->execute(array($fetch['id']));
			  		$rowcount1 = $stmt1->rowCount();
			  		if($rowcount1 > 0){
			  			while($fetch1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
			  				$query2 = "SELECT id,name FROM $master_db.mdl_course_categories WHERE parent = ? AND depth = 3 AND visible = 1 ORDER BY sortorder";
					  		$stmt2 = $db->prepare($query2);
					  		$stmt2->execute(array($fetch1['id']));
					  		$rowcount2 = $stmt2->rowCount();
					  		if($rowcount2 > 0){
					  			while($fetch2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
					  				$query3 = "SELECT id, fullname FROM $master_db.mdl_course WHERE category = ? AND visible = 1 ORDER BY sortorder";
							  		$stmt3 = $db->prepare($query3);
							  		$stmt3->execute(array($fetch2['id']));
							  		$rowcount3 = $stmt3->rowCount();
							  		if($rowcount3 > 0){
							  			while($fetch3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
							  				$topic_id_arr = array();
						  					$topic_id_arr['id'] = $fetch3['id'];
						  					$topic_id_arr['description'] = $fetch3['fullname'];
						  					array_push($topics, $topic_id_arr);
							  			}
						  			}
					  			}
				  			}
			  			}
		  			}
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

//get hidden topics allso for add new slide
function getHiddenTopicsTopicsAllSo($class_auto_id)
{
	global $db;
	global $master_db;
	try{
		$topics = array();
		if($class_auto_id != "") {
			$classsearch = "CLASS ".$class_auto_id;
		  	$query = "SELECT id FROM $master_db.mdl_course_categories WHERE name = ? AND depth = 1";
	  		$stmt = $db->prepare($query);
	  		$stmt->execute(array($classsearch));
	  		$rowcount = $stmt->rowCount();
	  		if($rowcount > 0){
	  			while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
	  				$query1 = "SELECT id,name FROM $master_db.mdl_course_categories WHERE parent = ? AND depth = 2 ORDER BY sortorder";
			  		$stmt1 = $db->prepare($query1);
			  		$stmt1->execute(array($fetch['id']));
			  		$rowcount1 = $stmt1->rowCount();
			  		if($rowcount1 > 0){
			  			while($fetch1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
			  				$query2 = "SELECT id,name FROM $master_db.mdl_course_categories WHERE parent = ? AND depth = 3 ORDER BY sortorder";
					  		$stmt2 = $db->prepare($query2);
					  		$stmt2->execute(array($fetch1['id']));
					  		$rowcount2 = $stmt2->rowCount();
					  		if($rowcount2 > 0){
					  			while($fetch2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
					  				$query3 = "SELECT id, fullname FROM $master_db.mdl_course WHERE category = ? ORDER BY sortorder";
							  		$stmt3 = $db->prepare($query3);
							  		$stmt3->execute(array($fetch2['id']));
							  		$rowcount3 = $stmt3->rowCount();
							  		if($rowcount3 > 0){
							  			while($fetch3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
							  				$topic_id_arr = array();
						  					$topic_id_arr['id'] = $fetch3['id'];
						  					//output showing little black diamonds with a question mark. for the topic like - Water… Water… Water… Always('Water� Water� Water� Always'). so using preg_replace method removed those charcters.
						  					$topic_id_arr['description'] = preg_replace('/[^A-Za-z0-9ÄäÜüÖöß]/', ' ', $fetch3['fullname']);
						  					array_push($topics, $topic_id_arr);
							  			}
						  			}
					  			}
				  			}
			  			}
		  			}
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
		elseif ($role == "PM")
			$dept = 7;
		else
			$dept = "";
		
		$users = array();
		if($dept != "") {
			$query = "SELECT id, first_name, last_name, roles_id FROM users WHERE roles_id=? AND id != ?";
	  		$stmt = $db->prepare($query);
	  		$stmt->execute(array($dept, $logged_user_id));
  		} else {
  			$query = "SELECT id, first_name, last_name, roles_id FROM users WHERE id != ?";
	  		$stmt = $db->prepare($query);
	  		$stmt->execute(array($logged_user_id));	
  		}
  		$rowcount = $stmt->rowCount();
  		if($rowcount > 0){
  			while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
			    array_push($users, array("id"=>$fetch['id'], "username"=>$fetch['first_name']." ".$fetch['last_name'], "role_id"=>$fetch['roles_id']));
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
	global $db, $master_db;
	try{	
		//get master_topics names and id
		$topic_name = array();
		//$lessons_name = GetRecords("$master_db.mdl_course");
		$lessons_name = GetRecords("$master_db.mdl_course", array("visible"=>1));
		foreach ($lessons_name as $lesson) {
			$topic_name[$lesson['id']] = $lesson['fullname'];
		}



		$tasks = array();
		if($role_id == 1) {
			$query = "select t.id as task_id,t.slide_id,t.task_name,t.template_id,t.layout_id,t.class_id,t.topics_id,s.name,ta.id as task_ass_id,ta.user_id as tassign_user_id, r.name as dept,ta.updated_date, u.first_name, u.last_name from tasks t, status s, task_assign ta, users u, roles r where ta.status = s.id and (t.work_type!=5 OR t.work_type IS NULL) and t.id=ta.tasks_id and ta.user_id=u.id and u.roles_id= r.id AND u.roles_id != 1 ORDER BY ta.id desc";
	  		$stmt = $db->query($query);
	  	} else if($role_id == 5) {
	  		$query = "select t.id as task_id,t.slide_id,t.task_name,t.template_id,t.layout_id,t.class_id,t.topics_id,s.name,ta.id as task_ass_id,ta.user_id as tassign_user_id, r.name as dept,ta.updated_date, u.first_name, u.last_name, t.work_type, t.slide_id from tasks t, status s, task_assign ta, users u, roles r where ta.status = s.id and t.id=ta.tasks_id and ta.user_id=u.id and u.roles_id= r.id AND u.roles_id != 1 ORDER BY ta.id desc";
	  		$stmt = $db->query($query);
	  	} else {
  			$query = "select t.id as task_id,t.slide_id,t.task_name,t.template_id,t.layout_id,t.class_id,t.topics_id,s.name,ta.id as task_ass_id,ta.user_id as tassign_user_id, r.name as dept, ta.updated_date,u.first_name, u.last_name from tasks t, status s, task_assign ta, users u, roles r where ta.status = s.id and (t.work_type!=5 OR t.work_type IS NULL) and t.id=ta.tasks_id and ta.user_id=u.id and u.roles_id= r.id AND ta.user_id='".$logged_user_id."' ORDER BY ta.id desc";
	  		$stmt = $db->query($query);	
  		}
  		$rowcount = $stmt->rowCount();
  		while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
		    array_push($tasks, array("title"=>$fetch['task_name'], "dept"=>$fetch['dept'], "class"=>$fetch['class_id'], "topic"=>$topic_name[$fetch['topics_id']], "class_id"=>$fetch['class_id'], "topic_id"=>$fetch['topics_id'], "status"=>$fetch['name'], "task_ass_id"=>$fetch['task_ass_id'], "task_id"=>$fetch['task_id'], "slide_id"=>$fetch['slide_id'],"task_userid"=>$fetch['tassign_user_id'],"template_id"=>$fetch['template_id'],"layout_id"=>$fetch['layout_id'],"username"=>$fetch['first_name']." ".$fetch['last_name'],"updated_date"=>$fetch['updated_date'], "work_type"=>$fetch['work_type'], "slide_id"=>$fetch['slide_id']));
	  	}
	  	return $tasks;
  	}catch(Exception $exp){
  		print_r($exp);
		return "false";
	}
}

//get list of task for PM and ID
function getTaskListPMID($role_id, $logged_user_id)
{
	global $db;
	try{
		$tasks = array();
		$query = "select t.id as task_id,t.slide_id,t.task_name,c.class_name,c.id as cid,tp.topic_name,tp.id as tpid,s.name,ta.id as task_ass_id,ta.user_id as tassign_user_id, r.name as dept from tasks t,class c,topics tp, status s, task_assign ta, users u, roles r where t.class_id = c.id and t.topics_id=tp.id and ta.status = s.id and t.id=ta.tasks_id and ta.user_id=u.id and u.roles_id= r.id AND u.roles_id = 1 ORDER BY ta.id desc";
  		$stmt = $db->query($query);
  		$rowcount = $stmt->rowCount();
  		while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
		    array_push($tasks, array("title"=>$fetch['task_name'], "dept"=>$fetch['dept'], "class"=>$fetch['class_name'], "topic"=>$fetch['topic_name'], "class_id"=>$fetch['cid'], "topic_id"=>$fetch['tpid'], "status"=>$fetch['name'], "task_ass_id"=>$fetch['task_ass_id'], "task_id"=>$fetch['task_id'], "slide_id"=>$fetch['slide_id'],"task_userid"=>$fetch['tassign_user_id']));
	  	}
	  	return $tasks;
  	}catch(Exception $exp){

		print_r($exp);
		return "false";
	}
}
function getTaskStatus($task_id,$task_assign_id) {
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
  		$response['topics_id']=$fetch['topics_id'];
		}
		$get_topic_name = getTopics($fetch['class_id']);
		foreach ($get_topic_name as $key => $value) {
			if($value['id'] == $response['topics_id']) {
				$top_name = $value['description'];
				break;
			}
		}
	}

	$all_depts_data = array();
	//Assigned Departments Loop
	$query = "SELECT * FROM task_details WHERE task_assign_id=? ORDER BY id";
	$stmt = $db->prepare($query);
	$stmt->execute(array($task_assign_id));
	$rowcount = $stmt->rowCount();
	if($rowcount > 0){
		while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
  		$this_data['user_id'] = $fetch['user_id'];
  		$this_data['instructions'] = $fetch['instructions'];
  		$this_data['attachments'] = $fetch['attachments'];
  		$this_data['status'] = $fetch['status'];

  		$query1 = "SELECT * FROM status WHERE id='".$fetch['status']."' ORDER BY id";
		$stmt1 = $db->query($query1);
		$fetch1 = $stmt1->fetch(PDO::FETCH_ASSOC);
		$this_data['status_name'] = $fetch1['name'];

  		array_push($all_depts_data, $this_data);
		}


		$response['AssignedDepartments'] = $all_depts_data;
	}
	//print_r($all_depts_data);
	$data = "";
	foreach ($all_depts_data as $key => $value) {
		if($value['user_id'] == 11) {

	 	$data .= '
	 	<div class="col-md-12">
		  <div class="card">
		    <div class="card-header tx-medium">
		      Project Manager Input - Status(<span id="pm_ip_status">'.$value['status_name'].'</span>)
		    </div><!-- card-header -->
		    <div class="card-body">
		      <div class="row">
		      	<div class="col-md-6">
                  <div class="form-group">
                    <label for="user_cw">Class:</label>
                    <input type="text" readonly value="'.$response['class_id'].'" class="form-control" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="user_cw">Topics:</label>
                    <input type="text" readonly value="'.$top_name.'" class="form-control" />
                  </div>
                </div>
		        <div class="col-md-12">
                  <div class="form-group">
                    <label for="inst_cw">Instructions:</label>
                    <textarea class="form-control" readonly rows="2" name="inst" id="inst">'.$value['instructions'].'</textarea>
                  </div>
                </div>
                <div class="col-md-12">
                ';
                $attachments = json_decode($value['attachments']);
                if(is_array($attachments))
            		foreach ($attachments as $attachment) {
	                  $file_type = explode(".", $attachment);
	                  $file_type = $file_type[1];
              	$data .='
                  <div class="col-md-3">
              		<img src="transactions/pm/'.$attachment.'" class="img-responsive" width="100%"/>
                  </div>';
              	}
                $data .= '</div>
		      </div>
		      <div class="row">
		        
		      </div>
		    </div><!-- card-body -->
		  </div>
		</div>';
		}
		if($value['user_id'] == 5) {
		$data .= '
		<div class="col-md-12">
		  <div class="card">
		    <div class="card-header tx-medium">
		      ID Reply - Status(<span id="id_ip_status">'.$value['status_name'].'</span>)
		    </div><!-- card-header -->
		    <div class="card-body">
      			<div class="col-md-12">
                  <div class="form-group">
                    <label for="inst_cw">Remarks:</label>
                    <textarea class="form-control" readonly rows="2" name="inst" id="inst">'.$value['instructions'].'</textarea>
                  </div>
                </div>
		    </div><!-- card-body -->
		  </div>
		</div>
		';
		}
 	}
 	return $data;
}

//get list of task for CR and ID
function getTaskListCR($role_id)
{
	global $db;
	try{
		$tasksCR = array();
		if($role_id == 6) {
			$query = "SELECT * FROM masters_class_topics_mapping";
	  		$stmt = $db->query($query);
	  	} else {
  				
  		}
  		$rowcount = $stmt->rowCount();
  		while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
  			$class = $fetch['class_id'];
  			$topic_id = $fetch['topic_id'];
  			$review_status = $fetch['review_status'];
  			$review_date = $fetch['review_date'];
  			if($review_date == "0000-00-00 00:00:00")
  				$review_date = "";
  			$review_notes = $fetch['review_notes'];

  			
  			$query1 = "SELECT * FROM topics WHERE id = ?";
	  		$stmt1 = $db->prepare($query1);
	  		$stmt1->execute(array($topic_id));
	  		while($fetch1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
  				$topic_name = $fetch1['topic_name'];
  			}

  			//get Status description
  			$status_cat = 6;
  			$query2 = "SELECT * FROM status WHERE id = ?";
	  		$stmt2 = $db->prepare($query2);
	  		$stmt2->execute(array($status_cat));
	  		while($fetch2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
  				$status_name = $fetch2['name'];
  			}


		    array_push($tasksCR, array("class"=>$class, "topic_id"=>$topic_id, "topic_name"=>$topic_name, "status_name"=>$status_name, "review_date"=>$review_date, "review_notes"=>$review_notes));
	  	}
	  	return $tasksCR;
  	}catch(Exception $exp){

		print_r($exp);
		return "false";
	}
}
function getStatusCR()
{
	global $db;

	try{
		$all_status = array();
		$query = "SELECT * FROM status WHERE deleted=0 AND id >7";
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

//get ReviewSlides for ID
function getReviewSlides($web_root, $class_id, $topic_id){
	global $db, $master_db;
	try{
		//get topic name
		$lessons_name = GetRecords("$master_db.mdl_course", array("id"=>$topic_id));
		foreach ($lessons_name as $lesson) {
			$topic_name = $lesson['fullname'];

  			$words = explode(" ", $topic_name);
			$topic_code = "";

			foreach ($words as $w) {
			  $topic_code .= $w[0];
			}
		}
  		
		$si = 0;
		$slides_arr = array();
		$lessons = GetRecords("$master_db.mdl_lesson", array("course"=>$topic_id));
	 	foreach($lessons as $lesson)
	 	{
			$lessonid = $lesson['id'];
		 	$slide_sequences = array();
			$contents = array();
			$slideIDs = array();
			$nedpgids = array();
			$pvedpgids = array();
			$status = array();
			$page = GetRecord("$master_db.mdl_lesson_pages", array("lessonid"=>$lessonid, "prevpageid"=>0));
			$nextpageid = $page['nextpageid'];
			array_push($contents, DecryptContent($page['contents']));
			array_push($slideIDs, $page['id']);
			array_push($nedpgids, $page['nextpageid']);
			array_push($pvedpgids, $page['prevpageid']);
			array_push($status, $page['status']);

			while($nextpageid != 0)
			{
				//echo "<br />$lessonid--$nextpageid--CAME";
				$page = GetRecord("$master_db.mdl_lesson_pages", array("lessonid"=>$lessonid, "id"=>$nextpageid));				
				array_push($slide_sequences, $page['id']);
				$nextpageid = $page['nextpageid'];
				array_push($contents, DecryptContent($page['contents']));
				array_push($slideIDs, $page['id']);
				array_push($nedpgids, $page['nextpageid']);
				array_push($pvedpgids, $page['prevpageid']);
				array_push($status, $page['status']);
			}
			
			foreach($contents as $key=>$content)
			{
				$icon = "";
	  			if($status[$key] == 10)
	  				$icon = '<i class="icon ion-checkmark-circled" style="font-size:16px; color: #17a2b8;"></i>';
	  			if($status[$key] == 11)
	  				$icon = '<i class="icon ion-backspace" style="font-size:16px; color: #17a2b8;"></i>';
	  			$si++;
				$slide_name = "G".$class_id."_".$topic_code."-".$slideIDs[$key]."_S".$si;
				$slides_arr[] = '<div class="col-md-12 mg-t-20 mg-md-t-0 templates_div">
		        <div class="card bd-0">
			          <object width="100%" height="100%" data="'.$web_root."app/".$content.'"></object>
			          <div class="card-body rounded-bottom">
			            <button class="btn btn-outline-warning btn-block mg-b-10 review_slide_btn" id="slide'.$si.'" data-id="'.$web_root."app/".$content.'" data-val="'.$slideIDs[$key].'" data-val1="'.$class_id.'" data-val2="'.$topic_id.'">'.$slide_name.' <span class="slideicon step size-96">'.$icon.'</span></button>
			          </div>
			        </div>
			    </div>';
			}
		}
		return $slides_arr;
	} catch(Exception $exp) {
		echo "<pre/>";
		print_r($exp);
	}
}

//get getMHLeftSlides for ID
function getMHLeftSlides($web_root, $class_id, $topic_id){
	global $db;
	global $master_db;
	try{
		//get topic name
		$lessons_name = GetRecords("$master_db.mdl_course", array("id"=>$topic_id));
		foreach ($lessons_name as $lesson) {
			$topic_name = $lesson['fullname'];

  			$words = explode(" ", $topic_name);
			$topic_code = "";

			foreach ($words as $w) {
			  $topic_code .= $w[0];
			}
		}
  		
		$si = 1;
		$slides_arr = array();
		$lessons = GetRecords("$master_db.mdl_lesson", array("course"=>$topic_id));
	 	foreach($lessons as $lesson)
	 	{
			$lessonid = $lesson['id'];
		 	$slide_sequences = array();
			$contents = array();
			$slideIDs = array();
			$nedpgids = array();
			$pvedpgids = array();
			$slide_status = array();
			$page = GetRecord("$master_db.mdl_lesson_pages", array("lessonid"=>$lessonid, "prevpageid"=>0));
			if(!isset($page['id'])) {
				continue;
			}
			$nextpageid = $page['nextpageid'];
			array_push($contents, DecryptContent($page['contents']));
			array_push($slideIDs, $page['id']);
			array_push($nedpgids, $page['nextpageid']);
			array_push($pvedpgids, $page['prevpageid']);
			array_push($slide_status, $page['status']);

			while($nextpageid != 0)
			{
				//echo "<br />$lessonid--$nextpageid--CAME";
				$page = GetRecord("$master_db.mdl_lesson_pages", array("lessonid"=>$lessonid, "id"=>$nextpageid));				
				array_push($slide_sequences, $page['id']);
				$nextpageid = $page['nextpageid'];
				array_push($contents, DecryptContent($page['contents']));
				array_push($slideIDs, $page['id']);
				array_push($nedpgids, $page['nextpageid']);
				array_push($pvedpgids, $page['prevpageid']);
				array_push($slide_status, $page['status']);
			}
			foreach($contents as $key=>$content)
			{
				$slide_name = "G".$class_id."_".$topic_code."-".$slideIDs[$key]."_S".$si++;
				$action_type="";
				if($slide_status[$key] != 11) {
					$action_type .= '
						<label class="checked_btn btn btn-danger d-block mx-auto">
			              <input type="radio" class="slidepath" name="slidepath" value="'.$slideIDs[$key].'" data-val="'.$web_root."app/".$content.'" data-val1="'.$class_id.'" data-val2="'.$topic_id.'" autocomplete="off"> Choose to Move('.$slide_name.')
			            </label>
					';
				} else {
					$action_type .= '
						<label class="checked_btn btn btn-danger d-block mx-auto">
			              <input type="radio" disabled class="slidepath" name="slidepath" value="'.$slideIDs[$key].'" data-val="'.$web_root."app/".$content.'" data-val1="'.$class_id.'" data-val2="'.$topic_id.'" autocomplete="off"> cannot move task assigned for this slide('.$slide_name.')
			            </label>
					';
				}

				$slides_arr[] = '<div class="col-md-12 mg-t-20 mg-md-t-0 templates_div">
		        <div class="card bd-0">
			          <object width="100%" height="100%" data="'.$web_root."app/".$content.'"></object>
			          <div class="card-body rounded-bottom">'
			            .$action_type.
			          '</div>
			        </div>
			    </div>';
			}
		}
		return $slides_arr;
	} catch(Exception $exp) {
		echo "<pre/>";
		print_r($exp);
	}
}
//get getMHLeftSlides for ID
function getMHLeftSlidesTest($web_root, $class_id, $topic_id, $showcheckbox=false){
	global $db;
	global $master_db;
	try{
		//get topic name
		$lessons_name = GetRecords("$master_db.mdl_course", array("id"=>$topic_id));
		foreach ($lessons_name as $lesson) {
			$topic_name = $lesson['fullname'];

  			$words = explode(" ", $topic_name);
			$topic_code = "";

			foreach ($words as $w) {
			  $topic_code .= $w[0];
			}
		}
  		
		$si = 1;
		$slides_arr = array();
		$lessons = GetRecords("$master_db.mdl_lesson", array("course"=>$topic_id));
	 	foreach($lessons as $lesson)
	 	{
			$lessonid = $lesson['id'];
		 	$slide_sequences = array();
			$contents = array();
			$slideIDs = array();
			$nedpgids = array();
			$pvedpgids = array();
			$slide_status = array();
			$page = GetRecord("$master_db.mdl_lesson_pages", array("lessonid"=>$lessonid, "prevpageid"=>0));
			$nextpageid = $page['nextpageid'];
			array_push($contents, DecryptContent($page['contents']));
			array_push($slideIDs, $page['id']);
			array_push($nedpgids, $page['nextpageid']);
			array_push($pvedpgids, $page['prevpageid']);
			array_push($slide_status, $page['status']);

			while($nextpageid != 0)
			{
				//echo "<br />$lessonid--$nextpageid--CAME";
				$page = GetRecord("$master_db.mdl_lesson_pages", array("lessonid"=>$lessonid, "id"=>$nextpageid));				
				array_push($slide_sequences, $page['id']);
				$nextpageid = $page['nextpageid'];
				array_push($contents, DecryptContent($page['contents']));
				array_push($slideIDs, $page['id']);
				array_push($nedpgids, $page['nextpageid']);
				array_push($pvedpgids, $page['prevpageid']);
				array_push($slide_status, $page['status']);
			}
			foreach($contents as $key=>$content)
			{
				/*echo "<pre/>";
				print_r($content);*/
				$filepath_ext = explode(".", $content);
				$ext = end($filepath_ext);

				$slide_name = "G".$class_id."_".$topic_code."-".$slideIDs[$key]."_S".$si++;
				$action_type="";
				if($slide_status[$key] != 11) {
					if(!$showcheckbox){
						$action_type .= '
							<label class="checked_btn btn btn-danger d-block mx-auto">
				              <button class="btn btn-danger text-center">SLIDE ID - '.$slideIDs[$key].'</button>
				            </label>
						';
					} else {
						$action_type .= '
							<label class="checked_btn btn btn-danger d-block mx-auto" style="margin: 0px;font-size: 16px;">
							  <input type="checkbox" disabled class="slideid" name="slideid[]" value="'.$slideIDs[$key].'" style="width:26px;height:23px;vertical-align: middle;">SLIDE ID - '.$slideIDs[$key].'
							</label>
							<label class="checked_btn btn btn-danger d-block mx-auto">
							  <textarea placeholder="Any Comment..." class="form-control" name="slide_feedback['.$slideIDs[$key].']"></textarea>
							</label>
						';
					}
				} else {
					if(!$showcheckbox){
						$action_type .= '
							<label class="checked_btn btn btn-danger d-block mx-auto">
				              <button class="btn btn-danger text-center">SLIDE ID - '.$slideIDs[$key].'</button>
				            </label>
						';
					} else {
						$action_type .= '
							<label class="checked_btn btn btn-danger d-block mx-auto" style="margin: 0px;font-size: 16px;">
							  <input type="checkbox" disabled class="slideid" name="slideid[]" value="'.$slideIDs[$key].'" style="width:26px;height:23px;vertical-align: middle;">SLIDE ID - '.$slideIDs[$key].'
							</label>
							<label class="checked_btn btn btn-danger d-block mx-auto">
							  <textarea placeholder="Any Comment..." class="form-control" name="slide_feedback['.$slideIDs[$key].']"></textarea>
							</label>
						';
					}
				}

				if($ext == "html") {
					$final_filepath = '<object width="100%" height="670px" data="'.$web_root."app/".$content.'?v='.time().'"></object>';
				} else if($ext == "php"){
					$final_filepath = '<p style="font-size: 24px;text-align: center;color: #020202;padding-top: 20px">Content cannot be displayed, because of PHP slide.</p>';
				}

				$slides_arr[] = '<div class="col-md-12 mg-t-20 mg-md-t-0 templates_div">
		        <div class="card bd-0">'
			          .$final_filepath.
			          '<div class="card-body rounded-bottom" style="padding: 0px;">'
			            .$action_type.
			          '</div>
			        </div>
			    </div>';
			}
		}
		return $slides_arr;
	} catch(Exception $exp) {
		echo "<pre/>";
		print_r($exp);
	}
}
function DecryptContent($contents)
{
	global $db, $master_db;
	$desc = $contents;
	$filepath = "";
	if(($objstart = strpos($desc, "<object "))){
		$objend = strpos($desc, "</object>", $objstart);
		$datastart = strpos($desc, "data=", $objstart) ;
		$dataend = strpos($desc, "\"", $datastart + strlen("data=")+2) ;
		$pathstart = strpos($desc, '"', $datastart) + 1;
		$pathend = strpos($desc, '"', $pathstart) - 1;
		$filepath = substr($desc, $pathstart, $pathend - $pathstart + 1 );
		$filepath = str_replace("../../","",$filepath);
	}
	return $filepath;
}

//get getRespectiveClassOfTopicMH for ID
function getTopicsClassMH($class_id, $topic_id){
	global $db;
	global $master_db;
	try{
		$classes = array();
	  	$query = "SELECT * FROM $master_db.mdl_course WHERE id = ?";
  		$stmt = $db->prepare($query);
  		$stmt->execute(array($topic_id));
  		while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
			$course_name = $fetch['fullname'];
			$query1 = "SELECT * FROM $master_db.mdl_course WHERE fullname = '$course_name'";
  			$stmt1 = $db->query($query1);
  			while ($fetch1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
  				$category = $fetch1['category'];

				$query2 = "SELECT * FROM $master_db.mdl_course_categories WHERE id = ?";
		  		$stmt2 = $db->prepare($query2);
		  		$stmt2->execute(array($category));
		  		while($fetch2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
		  			$path = $fetch2['path'];
		  			$path = explode("/", $path);
		  			$query3 = "SELECT * FROM $master_db.mdl_course_categories WHERE id = ?";
			  		$stmt3 = $db->prepare($query3);
			  		$stmt3->execute(array($path[1]));
			  		while($fetch3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
		  				$name = $fetch3['name'];
		  				$name = str_replace("Class ", "", $name);
		  				array_push($classes, array("id"=>$name));
	  				}
		  		}
  			}
		}
		return $classes;
	}catch(Exception $exp){

		print_r($exp);
		return "false";
	}
}

//get getMHCS for ID
function getMHCS($master_db, $web_root, $class_id, $topic_id, $selected_slide_id, $selected_topic_name){
	global $db;
	global $master_db;
	try{
		if($class_id != "") {
			$classsearch = "CLASS ".$class_id;
		  	$query = "SELECT id FROM $master_db.mdl_course_categories WHERE name = ? AND depth = 1 AND visible = 1";
	  		$stmt = $db->prepare($query);
	  		$stmt->execute(array($classsearch));
	  		$rowcount = $stmt->rowCount();
	  		if($rowcount > 0){
	  			while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
	  				$query1 = "SELECT id,name FROM $master_db.mdl_course_categories WHERE parent = ? AND depth = 2 AND visible = 1 ORDER BY sortorder";
			  		$stmt1 = $db->prepare($query1);
			  		$stmt1->execute(array($fetch['id']));
			  		$rowcount1 = $stmt1->rowCount();
			  		if($rowcount1 > 0){
			  			while($fetch1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
			  				$query2 = "SELECT id,name FROM $master_db.mdl_course_categories WHERE parent = ? AND depth = 3 AND visible = 1 ORDER BY sortorder";
					  		$stmt2 = $db->prepare($query2);
					  		$stmt2->execute(array($fetch1['id']));
					  		$rowcount2 = $stmt2->rowCount();
					  		if($rowcount2 > 0){
					  			while($fetch2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
					  				$query3 = "SELECT id, fullname FROM $master_db.mdl_course WHERE category = ? AND fullname=? AND visible = 1 ORDER BY sortorder";
							  		$stmt3 = $db->prepare($query3);
							  		$stmt3->execute(array($fetch2['id'], $selected_topic_name));
							  		$rowcount3 = $stmt3->rowCount();
							  		if($rowcount3 > 0){
							  			while($fetch3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
							  				$topic_id = $fetch3['id'];
							  				break;
						  				}
						  			}
					  			}
				  			}
			  			}
		  			}
	  			}
	  		}
		}


		$slides_arr = "";
		$query1 = "SELECT * FROM $master_db.mdl_lesson WHERE course = ?";
  		$stmt1 = $db->prepare($query1);
  		$stmt1->execute(array($topic_id));
  		$i=1;
  		while($fetch1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
  			$chap_name = $fetch1['name'];

  			$slides_arr.= '
			<div class="col-md-12 mg-t-20 mg-md-t-0">
				<div class="accordion" id="accordion">
				  <div class="card">
				    <div class="card-header" id="h'.$fetch1['id'].'">
				      <h5 class="mb-0">
				      	<a data-toggle="collapse" data-parent="#accordion" href="#c'.$fetch1['id'].'" aria-expanded="false" aria-controls="c'.$fetch1['id'].'" class="tx-gray-800 transition">
		        			'.$chap_name.'
				        </a>
				      </h5>
				    </div>

				    <div id="c'.$fetch1['id'].'" class="collapse" aria-labelledby="h'.$fetch1['id'].'" data-parent="#accordion">
				      <div class="card-body">';
			$slide_sequences = array();
			$paths = array();
			$slide_ids = array();
			$nedpgids = array();
			$pvedpgids = array();
			$page = GetRecord("$master_db.mdl_lesson_pages", array("lessonid"=>$fetch1['id'], "prevpageid"=>0));
			$nextpageid = $page['nextpageid'];
			array_push($paths, DecryptContent($page['contents']));
			array_push($slide_ids, $page['id']);
			array_push($nedpgids, $page['nextpageid']);
			array_push($pvedpgids, $page['prevpageid']);

			while($nextpageid != 0)
			{
				//echo "<br />$lessonid--$nextpageid--CAME";
				$page = GetRecord("$master_db.mdl_lesson_pages", array("lessonid"=>$fetch1['id'], "id"=>$nextpageid));				
				array_push($slide_sequences, $page['id']);
				$nextpageid = $page['nextpageid'];
				array_push($paths, DecryptContent($page['contents']));
				array_push($slide_ids, $page['id']);
				array_push($nedpgids, $page['nextpageid']);
				array_push($pvedpgids, $page['prevpageid']);
			}
	  		$next_slide = 0;
	  		foreach($slide_ids as $key=>$slide_id)
	  		{
	  			$slides_arr.= '
  					<div class="card">';
  				if(!($selected_slide_id == $slide_id || (isset($slide_ids[$key-1]) && $selected_slide_id == $slide_ids[$key-1])))
  				$slides_arr.='
					  <div class="card-header d-flex align-items-center justify-content-between pd-y-5">
					    <div class="alert alert-danger text-center" role="alert" style="width:100%;font-size: 26px;">
					      <a href="#." data-id="'.$next_slide.'" data-DestlessonID='.$fetch1['id'].' data-DestcourseID='.$topic_id.' data-DestprevID='.$next_slide.' class="alert-link move_here">Move Here..</a>
					    </div>
					  </div><!-- card-header -->';
				$next_slide = $slide_id;
				$slides_arr .= '
					  <div class="card-body">
					    <object width="100%" height="670px" data="'.$web_root."app/".$paths[$key].'"></object>
					  </div><!-- card-body -->
					</div>
	  			';
			}
			if($selected_slide_id != end($slide_ids))
			$slides_arr .='
								<div class="card">
								  <div class="card-header d-flex align-items-center justify-content-between pd-y-5">
								    <div class="alert alert-danger text-center" role="alert" style="width:100%;font-size: 26px;">
								      <a href="#." data-id="'.$next_slide.'" data-DestlessonID='.$fetch1['id'].' data-DestcourseID='.$topic_id.' data-DestprevID='.$next_slide.' class="alert-link move_here">Move Here..</a>
								    </div>
								  </div><!-- card-header -->';
			$slides_arr .='								  
							  	</div>
							</div>
			    		</div>
			  		</div>
				</div>
			</div>
			';
		}
		return $slides_arr;
	} catch(Exception $exp) {
		echo "<pre/>";
		print_r($exp);
	}
}

//move Slide from one class to another class in same topic for ID
function moveSlide($master_db, $page_id,$desti_course_id, $desti_lesson_id, $desti_destprevid) {
	global $db;
	global $master_db;

	try{
		$querySch = "SELECT mysql_database FROM skillpre_schools.masters_school WHERE mysql_database = ? OR master_school_dbname = ?";
		$stmtSch = $db->prepare($querySch);
		$stmtSch->execute(array($master_db, $master_db));
		while($rowsSch = $stmtSch->fetch(PDO::FETCH_ASSOC))
		{
			$thisdb = $rowsSch['mysql_database'];
			$lesson = GetRecord("$thisdb.mdl_lesson_pages", array("id"=>$page_id));
			$prevpageid = $lesson['prevpageid'];
			$nextpageid = $lesson['nextpageid'];
			$contents = $lesson['contents'];
			$title = $lesson['title'];
			if($previous_lessonid == $desti_lesson_id) {
				$insert_pageid = $page_id;
			} else {
				$insert_pageid = NULL;
			}
			
			//Delete mdl_lesson_pages
			$query_mlp = "DELETE FROM $thisdb.mdl_lesson_pages WHERE id = ?";
			$stmt_mlp = $db->prepare($query_mlp);
			$stmt_mlp->execute(array($page_id));
			
			//Delete mdl_lesson_answers
			$query = "DELETE FROM $thisdb.mdl_lesson_answers WHERE pageid = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($page_id));
			
			if($prevpageid == 0) {
				$query1 = "UPDATE $thisdb.mdl_lesson_pages SET prevpageid=0 WHERE id=?";
				$stmt1 = $db->prepare($query1);
				$stmt1->execute(array($nextpageid));
				$rowcount1 = $stmt1->rowCount();

				//Delete the Previous Button
				$query_mlp1 = "DELETE FROM $thisdb.mdl_lesson_answers WHERE pageid = ? AND answer = 'Previous'";
				$stmt_mlp1 = $db->prepare($query_mlp1);
				$stmt_mlp1->execute(array($nextpageid));
			} elseif ($nextpageid == 0) {
				$query1 = "UPDATE $thisdb.mdl_lesson_pages SET nextpageid=0 WHERE id=?";
				$stmt1 = $db->prepare($query1);
				$stmt1->execute(array($prevpageid));
				$rowcount1 = $stmt1->rowCount();
			} else {
				$query1 = "UPDATE $thisdb.mdl_lesson_pages SET prevpageid=? WHERE id=?";
				$stmt1 = $db->prepare($query1);
				$stmt1->execute(array($prevpageid, $nextpageid));
				$rowcount1 = $stmt1->rowCount();
	
				$query1 = "UPDATE $thisdb.mdl_lesson_pages SET nextpageid=? WHERE id=?";
				$stmt1 = $db->prepare($query1);
				$stmt1->execute(array($nextpageid, $prevpageid));
				$rowcount2 = $stmt1->rowCount();
			}
	
			//Slide inserting in respective selected location
			if($desti_destprevid == 0) {
				$get_lessons = GetRecords("$thisdb.mdl_lesson_pages", array("lessonid"=>$desti_lesson_id, "prevpageid"=>0));
				foreach ($get_lessons as $get_lesson) {
					$first_slide_id = $get_lesson['id'];
				}
	
				//insert into the mdl_lesson_pages table
				$autoid_less_pages = InsertRecord("$thisdb.mdl_lesson_pages", array("id"=>$insert_pageid, "lessonid" => $desti_lesson_id,
				"prevpageid" => 0,
				"nextpageid" => $first_slide_id,
				"qtype" => '20',
				"qoption" => 0,
				"layout" => 1,
				"display" => 1,
				"timecreated" => time(),
				"timemodified" => 0,
				"title" => $title,
				"contents" => $contents,
				"contentsformat" => 1,
				"status" => 0
				));
	
				if($autoid_less_pages > 0) {
					$autoid = InsertRecord("$thisdb.mdl_lesson_answers", array("lessonid" => $desti_lesson_id,
					"pageid" => $autoid_less_pages,
					"jumpto" => '-1',
					"grade" => 0,
					"score" => 0,
					"flags" => 0,
					"timecreated" => time(),
					"timemodified" => 0,
					"answer" => 'Next',
					"answerformat" => 0,
					"response" => null,
					"responseformat" => 0
					));

					$autoid = InsertRecord("$thisdb.mdl_lesson_answers", array("lessonid" => $desti_lesson_id,
					"pageid" => $first_slide_id,
					"jumpto" => '-40',
					"grade" => 0,
					"score" => 0,
					"flags" => 0,
					"timecreated" => time(),
					"timemodified" => 0,
					"answer" => 'Previous',
					"answerformat" => 0,
					"response" => null,
					"responseformat" => 0
					));
				}
	
				$query_up = "UPDATE $thisdb.mdl_lesson_pages SET prevpageid=? WHERE id=?";
				$stmt_up = $db->prepare($query_up);
				$stmt_up->execute(array($autoid_less_pages, $first_slide_id));
			} else {
				$get_lessons = GetRecords("$thisdb.mdl_lesson_pages", array("id"=>$desti_destprevid));
				foreach ($get_lessons as $get_lesson) {
					$nextPageID = $get_lesson['nextpageid'];
				}
	
				//insert into the mdl_lesson_pages table
				$autoid_mlp = InsertRecord("$thisdb.mdl_lesson_pages", array("lessonid" => $desti_lesson_id,
				"prevpageid" => $desti_destprevid,
				"nextpageid" => $nextPageID,
				"qtype" => '20',
				"qoption" => 0,
				"layout" => 1,
				"display" => 1,
				"timecreated" => time(),
				"timemodified" => 0,
				"title" => $title,
				"contents" => $contents,
				"contentsformat" => 1,
				"status" => 0
				));
	
				$query1 = "UPDATE $thisdb.mdl_lesson_pages SET nextpageid=? WHERE id=?";
				$stmt1 = $db->prepare($query1);
				$stmt1->execute(array($autoid_mlp, $desti_destprevid));
				$rowcount1 = $stmt1->rowCount();
	
				if($nextPageID != 0) {
					$query1 = "UPDATE $thisdb.mdl_lesson_pages SET prevpageid=? WHERE id=?";
					$stmt1 = $db->prepare($query1);
					$stmt1->execute(array($autoid_mlp, $nextPageID));
					$rowcount1 = $stmt1->rowCount();
				}
	
				//insert into the mdl_lesson_answers table
				$autoid = InsertRecord("$thisdb.mdl_lesson_answers", array("lessonid" => $desti_lesson_id,
				"pageid" => $autoid_mlp,
				"jumpto" => "-40",
				"grade" => 0,
				"score" => 0,
				"flags" => 0,
				"timecreated" => time(),
				"timemodified" => 0,
				"answer" => 'Previous',
				"answerformat" => 0,
				"response" => "",
				"responseformat" => 0
				));
	
				$autoid = InsertRecord("$thisdb.mdl_lesson_answers", array("lessonid" => $desti_lesson_id,
				"pageid" => $autoid_mlp,
				"jumpto" => -1,
				"grade" => 0,
				"score" => 0,
				"flags" => 0,
				"timecreated" => time(),
				"timemodified" => 0,
				"answer" => 'Next',
				"answerformat" => 0,
				"response" => "",
				"responseformat" => 0
				));
			}
		}
		$status =true;
		$message ="Slide Status Updated Successfully";
		$response = array("status"=>$status, "message"=>$message);
		return $response;
	} catch(Exception $exp) {
		echo "<pre/>";
		print_r($exp);
	}
}

function cpy($source, $dest){
	if(!is_dir($dest)){
        mkdir($dest, 0777, true);
    }
    if(is_dir($source)) {
        $dir_handle=opendir($source);
        while($file=readdir($dir_handle)){
            if($file!="." && $file!=".."){
                if(is_dir($source."/".$file)){
                    if(!is_dir($dest."/".$file)){
                        mkdir($dest."/".$file, 0777, true);
                    }
                    cpy($source."/".$file, $dest."/".$file);
                } else {
                    copy($source."/".$file, $dest."/".$file);
                }
            }
        }
        closedir($dir_handle);
    } else {
        //copy($source, $dest);
    }
}

//get list of task
function getTaskListAdd($role_id, $logged_user_id)
{
	global $db, $master_db;
	try{	
		//get master_topics names and id
		$topic_name = array();
		//$lessons_name = GetRecords("$master_db.mdl_course");
		$lessons_name = GetRecords("$master_db.mdl_course", array());
		foreach ($lessons_name as $lesson) {
			$topic_name[$lesson['id']] = $lesson['fullname'];
		}
		//Userid - Employee
		$employees = array();
		$users = GetRecords("users", array());
		foreach($users as $user) {
			$employees[$user['id']] = $user['first_name']." ".$user['last_name'];
		}

		$tasks = array();
		if($role_id == 1) {
			$query = "select t.id as task_id,t.slide_id,t.task_name,t.template_id,t.layout_id,t.class_id,t.topics_id,s.name,ta.id as task_ass_id,ta.user_id as tassign_user_id, r.name as dept from tasks t, status s, task_assign ta, users u, roles r where ta.status = s.id and t.work_type=5 and t.id=ta.tasks_id and ta.user_id=u.id and u.roles_id= r.id AND u.roles_id != 1 ORDER BY ta.id desc";
	  		$stmt = $db->query($query);
	  	} else {
  			$query = "select t.id as task_id,t.slide_id,t.task_name,t.template_id,t.layout_id,t.class_id,t.topics_id,s.name,ta.id as task_ass_id,ta.user_id as tassign_user_id, r.name as dept from tasks t, status s, task_assign ta, users u, roles r where ta.status = s.id and t.work_type=5 and t.id=ta.tasks_id and ta.user_id=u.id and u.roles_id= r.id AND ta.user_id='".$logged_user_id."' ORDER BY ta.id desc";
	  		$stmt = $db->query($query);	
  		}
  		$rowcount = $stmt->rowCount();
  		while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
  			$slide_ids = json_decode($fetch['slide_id']);
  			if(is_array($slide_ids)){
  				$slide_ids = "Add slides for Existing Topic";
  			}

  			//checking only layout 6 layout slides
  			$query_addSlide = "SELECT task_assign_id, layout_id FROM add_slide_list WHERE layout_id IN (10, 23, 24, 25, 26) AND task_assign_id = '".$fetch['task_ass_id']."'";
		  	$stmt_addSlide = $db->query($query_addSlide);
		  	$rowcount_addSlide = $stmt_addSlide->rowCount();

		  	$add_slide_list_tb = GetRecords("add_slide_list", array("task_assign_id"=>$fetch['task_ass_id']), array("sequence"));
		  	$slideContentContains = "";
			if(count($add_slide_list_tb) > 0) {
				//echo "<pre/>";
				//print_r($add_slide_list_tb);
				foreach($add_slide_list_tb as $slide)
				{
				  	//checking any slides contains empty json data except DictionaryWords layout and slide_json column contains null values
					$ignoreLayouts_ids = array(0, 5263);
					$slideJSON = json_decode($slide['slide_json']);
					$objectToArray = (array)$slideJSON;
					$layout_id = $slide['layout_id'];
					// echo "<pre/>";
					// print_r($objectToArray);
					if(!in_array($layout_id, $ignoreLayouts_ids)) {
					      foreach ($objectToArray as $key => $value)
						  {
						  	//echo 'key---'.$objectToArray[$key];
						  	if(isset($objectToArray[$key]) && !is_array($objectToArray[$key])){
							    //this means key exists and the value is not a array
							    if(trim($objectToArray[$key]) != '') {
							    	//value is null or empty string or whitespace only
								    $slideContentContains = "";
							    	break;
						    	} else {
									//echo "else 111";echo '<br/>';
									$slideContentContains = 'slide Empty - ';
								}
							} elseif (is_array($objectToArray[$key])) {
								foreach ($value as $key1 => $value1)
					  			{
					  				//echo "value 1---".$value1;echo "<br/>";
					  				if(trim($value[$key1]) != '') {
					  					//value is null or empty string or whitespace only
						  				//echo "value if 1---".$value1;echo "<br/>";
					  					$slideContentContains = "";
							    		break;
						    		} else {
						    			$slideContentContains = 'slide Empty - ';
						    		}
				  				}
							} else {
								//echo "else end";echo '<br/>';
								$slideContentContains = 'slide Empty - ';
							}
						  }
					}

					if($slideContentContains != "")
						break;
				}
			}

			// echo "slideContentContains---".$slideContentContains;echo "<br/>";
  			
		    array_push($tasks, array("title"=>$fetch['task_name'], "dept"=>$fetch['dept'], "class"=>$fetch['class_id'], "topic"=>$topic_name[$fetch['topics_id']], "class_id"=>$fetch['class_id'], "topic_id"=>$fetch['topics_id'], "status"=>$fetch['name'], "task_ass_id"=>$fetch['task_ass_id'], "task_id"=>$fetch['task_id'], "layout6"=>$rowcount_addSlide, "slide_id"=>$slide_ids,"task_userid"=>$fetch['tassign_user_id'],"template_id"=>$fetch['template_id'],"layout_id"=>$fetch['layout_id'], "AssignedTo"=>$employees[$fetch['tassign_user_id']], "slideContentEmptyContains"=>$slideContentContains));
	  	}
	  	return $tasks;
  	}catch(Exception $exp){

		print_r($exp);
		return "false";
	}
}

//get list of task
function getTaskListAddEdit($role_id, $logged_user_id)
{
	global $db, $master_db;
	try{	
		//get master_topics names and id
		$topic_name = array();
		//$lessons_name = GetRecords("$master_db.mdl_course");
		$lessons_name = GetRecords("$master_db.mdl_course", array());
		foreach ($lessons_name as $lesson) {
			$topic_name[$lesson['id']] = $lesson['fullname'];
		}

		$tasks = array();
		if($role_id == 1 || $role_id == 5) {
			$query = "select t.id as task_id,t.slide_id,t.task_name,t.work_type,t.template_id,t.layout_id,t.class_id,t.topics_id,s.name,ta.id as task_ass_id,ta.user_id as tassign_user_id,ta.updated_date, r.name as dept from tasks t, status s, task_assign ta, users u, roles r where ta.status = s.id and t.id=ta.tasks_id and ta.user_id=u.id and u.roles_id= r.id AND u.roles_id != 1 ORDER BY ta.id desc";
	  		$stmt = $db->query($query);
	  	} else if($role_id == 3) {
			$query = "SELECT distinct(td.task_assign_id), t.id as task_id,t.slide_id,t.task_name,t.work_type,t.template_id,t.layout_id,t.class_id,t.topics_id,s.name,ta.id as task_ass_id,td.user_id as tassign_user_id, r.name as dept FROM task_details td, task_assign ta, tasks t, status s, users u, roles r WHERE td.task_assign_id = ta.id AND ta.status = s.id AND t.id=ta.tasks_id AND td.user_id=u.id AND u.roles_id= r.id AND td.user_id='".$logged_user_id."'ORDER BY td.id desc";
			//$query = "SELECT td.task_assign_id, t.id as task_id,t.slide_id,t.task_name,t.work_type,t.template_id,t.layout_id,t.class_id,t.topics_id,s.name AS userStatus,ta.id AS  task_ass_id, ta.status AS name, td.user_id as tassign_user_id, r.name as dept FROM task_details td, task_assign ta, tasks t, status s, users u, roles r, (SELECT MAX(id) AS maxid FROM `task_details` GROUP BY task_assign_id, user_id) AS tai WHERE td.task_assign_id = ta.id AND td.status = s.id AND t.id=ta.tasks_id AND td.user_id=u.id AND u.roles_id= r.id AND td.user_id='".$logged_user_id."' AND tai.maxid = td.id ORDER BY td.id desc";
	  		$stmt = $db->query($query);
	  	} else {
  			$query = "select t.id as task_id,t.slide_id,t.task_name,t.work_type,t.template_id,t.layout_id,t.class_id,t.topics_id,s.name,ta.id as task_ass_id,ta.user_id as tassign_user_id,ta.updated_date, r.name as dept from tasks t, status s, task_assign ta, users u, roles r where ta.status = s.id and t.id=ta.tasks_id and ta.user_id=u.id and u.roles_id= r.id AND ta.user_id='".$logged_user_id."' ORDER BY ta.id desc";
	  		$stmt = $db->query($query);	
  		}
  		$rowcount = $stmt->rowCount();
  		while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
  			$slide_ids = json_decode($fetch['slide_id']);
  			if(is_array($slide_ids)){
  				$slide_ids = "Add slides for Existing Topic";
  			}

  			/*if(is_numeric($fetch['name'])) {
  				//$fetch['name'] = $fetch['userStatus'];
  				$status_info = GetRecord("status", array("id"=>$fetch['name']));
  				$fetch[]
  			}*/

		    array_push($tasks, array("title"=>$fetch['task_name'], "dept"=>$fetch['dept'], "class"=>$fetch['class_id'], "topic"=>$topic_name[$fetch['topics_id']], "class_id"=>$fetch['class_id'], "topic_id"=>$fetch['topics_id'], "status"=>$fetch['name'], "task_ass_id"=>$fetch['task_ass_id'], "task_id"=>$fetch['task_id'], "slide_id"=>$slide_ids,"task_userid"=>$fetch['tassign_user_id'],"template_id"=>$fetch['template_id'],"layout_id"=>$fetch['layout_id'],"work_type"=>$fetch['work_type'],"updated_date"=>$fetch['updated_date']));

		    //array_push($tasks, array("title"=>$fetch['task_name'], "dept"=>$fetch['dept'], "class"=>$fetch['class_id'], "topic"=>$topic_name[$fetch['topics_id']], "class_id"=>$fetch['class_id'], "topic_id"=>$fetch['topics_id'], "status"=>$fetch['name'], "task_ass_id"=>$fetch['task_ass_id'], "task_id"=>$fetch['task_id'], "slide_id"=>$slide_ids,"task_userid"=>$fetch['tassign_user_id'],"template_id"=>$fetch['template_id'],"layout_id"=>$fetch['layout_id'],"work_type"=>$fetch['work_type'],"updated_date"=>$fetch['updated_date'], "userStatus"=>$fetch['userStatus']));
	  	}
	  	return $tasks;
  	}catch(Exception $exp){

		print_r($exp);
		return "false";
	}
}

function getTemplates($class_id, $topic_id) {
	global $db, $web_root;

	$templates = GetRecords("resources", array("class_id"=>$class_id, "topics_id"=>$topic_id));
	$temp_blk = "";
	if(count($templates) > 0) {
		foreach ($templates as $template) {
			$temp_blk .='
				<div class="col-md mg-t-20 mg-md-t-0">
					<div class="card bd-0">
					    <div class="card-body rounded-top bd-0 bg-default tx-white">
					      	<label class="checked_btn btn btn-info d-block mx-auto">
					          	<input type="radio" class="template_id" name="template_id" value="'.$template['id'].'" autocomplete="off"> Choose Template 1
					        </label>
					    </div><!-- card-body -->
					    <img class="card-img-bottom img-fluid" src="'.$web_root.$template['filepath'].'" alt="Image">
					</div>
				</div>
			';
		}
	} else{
		$temp_blk .='
			<div class="col-md mg-t-20 mg-md-t-0">
				<div class="card bd-0">
				    <div class="card-body rounded-top bd-0 bg-warning tx-white">
				      <h6 class="mg-b-3"><a href="#" class="tx-white hover-white-8">No Templates Availlable</a></h6>
				    </div><!-- card-body -->
				    <img class="card-img-bottom img-fluid" src="'.$web_root.'img/noTemplates.png'.'" alt="Image">
				</div>
			</div>
		';
	}
	return $temp_blk;
}

function getLayouts($temp_id) {
	global $db, $web_root;

	$layouts = GetRecords("resources", array("template_id"=>$temp_id));
	$lay_blk = "";
	if(count($layouts) > 0) {
		$i=1;
		foreach ($layouts as $layout) {
			$lay_blk .='
				<div class="col-md mg-t-20 mg-md-t-0">
					<div class="card bd-0">
					    <div class="card-body rounded-top bd-0 bg-default tx-white">
					      	<label class="checked_btn btn btn-info d-block mx-auto">
					          	<input type="radio" class="layout_id" name="layout_id" value="'.$layout['id'].'" autocomplete="off"> Choose Layout '.$i++.'
					        </label>
					    </div><!-- card-body -->
					    <img class="card-img-bottom img-fluid" src="'.$web_root.$layout['filepath'].'" alt="Image">
					</div>
				</div>
			';
		}
	} else{
		$lay_blk .='
			<div class="col-md mg-t-20 mg-md-t-0">
				<div class="card bd-0">
				    <div class="card-body rounded-top bd-0 bg-warning tx-white">
				      <h6 class="mg-b-3"><a href="#" class="tx-white hover-white-8">No Layouts Availlable</a></h6>
				    </div><!-- card-body -->
				    <img class="card-img-bottom img-fluid" src="'.$web_root.'img/noTemplates.png'.'" alt="Image">
				</div>
			</div>
		';
	}
	return $lay_blk;
}

//get ReviewSlides for ID
function getAWNS($web_root, $class_id, $topic_id){
	global $db;
	global $master_db;
	try{
		$selected_slide_id = 0;
		$slides_arr = "";
		$query1 = "SELECT * FROM $master_db.mdl_lesson WHERE course = ?";
  		$stmt1 = $db->prepare($query1);
  		$stmt1->execute(array($topic_id));
  		$i=1;
  		while($fetch1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
  			$chap_name = $fetch1['name'];

  			$slides_arr.= '
			<div class="col-md-12 mg-t-20 mg-md-t-0">
				<div class="accordion" id="accordion">
				  <div class="card">
				    <div class="card-header" id="h'.$fetch1['id'].'">
				      <h5 class="mb-0">
				      	<a data-toggle="collapse" data-parent="#accordion" href="#c'.$fetch1['id'].'" aria-expanded="false" aria-controls="c'.$fetch1['id'].'" class="tx-gray-800 transition">
		        			'.$chap_name.'
				        </a>
				      </h5>
				    </div>

				    <div id="c'.$fetch1['id'].'" class="collapse" aria-labelledby="h'.$fetch1['id'].'" data-parent="#accordion">
				      <div class="card-body">';
			$slide_sequences = array();
			$paths = array();
			$slide_ids = array();
			$nedpgids = array();
			$pvedpgids = array();
			$page = GetRecord("$master_db.mdl_lesson_pages", array("lessonid"=>$fetch1['id'], "prevpageid"=>0));
			$nextpageid = $page['nextpageid'];
			array_push($paths, DecryptContent($page['contents']));
			array_push($slide_ids, $page['id']);
			array_push($nedpgids, $page['nextpageid']);
			array_push($pvedpgids, $page['prevpageid']);

			while($nextpageid != 0)
			{
				//echo "<br />$lessonid--$nextpageid--CAME";
				$page = GetRecord("$master_db.mdl_lesson_pages", array("lessonid"=>$fetch1['id'], "id"=>$nextpageid));				
				array_push($slide_sequences, $page['id']);
				$nextpageid = $page['nextpageid'];
				array_push($paths, DecryptContent($page['contents']));
				array_push($slide_ids, $page['id']);
				array_push($nedpgids, $page['nextpageid']);
				array_push($pvedpgids, $page['prevpageid']);
			}
	  		$next_slide = 0;
	  		foreach($slide_ids as $key=>$slide_id)
	  		{
	  			$slides_arr.= '
  					<div class="card">';
  				if(!($selected_slide_id == $slide_id || (isset($slide_ids[$key-1]) && $selected_slide_id == $slide_ids[$key-1])))
  				$slides_arr.='
					  <div class="card-header d-flex align-items-center justify-content-between pd-y-5">
					    <div class="alert alert-danger text-center" role="alert" style="width:100%;font-size: 26px;">
					      <a href="#." data-id="'.$next_slide.'" data-DestlessonID='.$fetch1['id'].' data-DestcourseID='.$topic_id.' data-DestprevID='.$next_slide.' class="alert-link add_here" data-toggle="modal" data-target="#modaldemo3" id="inst_btn">Add New Slide</a>
					    </div>
					  </div><!-- card-header -->';
				$next_slide = $slide_id;
				$slides_arr .= '
					  <div class="card-body">
					    <object width="100%" height="670px" data="'.$web_root."app/".$paths[$key].'"></object>
					  </div><!-- card-body -->
					</div>
	  			';
			}
			if($selected_slide_id != end($slide_ids))
			$slides_arr .='
								<div class="card">
								  <div class="card-header d-flex align-items-center justify-content-between pd-y-5">
								    <div class="alert alert-danger text-center" role="alert" style="width:100%;font-size: 26px;">
								      <a href="#." data-id="'.$next_slide.'" data-DestlessonID='.$fetch1['id'].' data-DestcourseID='.$topic_id.' data-DestprevID='.$next_slide.' class="alert-link add_here" data-toggle="modal" data-target="#modaldemo3" id="inst_btn">Add New Slide</a>
								    </div>
								  </div><!-- card-header -->';
			$slides_arr .='								  
							  	</div>
							</div>
			    		</div>
			  		</div>
				</div>
			</div>
			';
		}
		return $slides_arr;
	} catch(Exception $exp) {
		echo "<pre/>";
		print_r($exp);
	}
}

//get Task Type for Add new slide
function getTaskType(){
	global $db;
	$taskTypes = array();
	$gettaskTypes = GetRecords("task_type", array("deleted"=>0));
	foreach ($gettaskTypes as $gettaskType) {
		$taskTypes[$gettaskType['role']][$gettaskType['id']] = $gettaskType['work_type'];
	}
	return $taskTypes;
}

//copy add slide of external files while choose on publish
function cpyExternalFiles($source){
	global $web_root, $dir_root, $dir_root_production;
	$source_path = str_replace($web_root, $dir_root, $source);
	$source_pathinfo = pathinfo($source);
	$source = $source_pathinfo['dirname'];
	$source_basename = $source_pathinfo['basename'];
	$dest = str_replace($web_root."app/", $dir_root_production, $source);
	if(!is_dir($dest)){
        mkdir($dest, 0777, true);
    }

    copy($source_path, $dest."/".$source_basename);
}

//Add POP Up to a file

function AddPopUp($slideRecord) {
	global $db, $web_root, $dir_root;
	try {
		$query = "SELECT id, slide_id, word, meaning FROM popup_words WHERE slide_id = ? AND deleted_by IS NULL AND synced = 0 ORDER BY id";
		$stmt = $db->prepare($query);
		$stmt->execute(array($slideRecord['id']));
		while($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$id = $rows['id'];
			$word = $rows['word'];
			$meaning = $rows['meaning'];
			$file_path = $slideRecord['slide_file_path'];
			$cms_path = str_replace($web_root, $dir_root, $file_path);
			$inputfile = fopen($cms_path, "rb");			
			$contents = fread($inputfile, filesize($cms_path));			
			fclose($inputfile);
			$pos = strpos($contents, $word);
			if ($pos !== false) {
				unlink($cms_path);
				$replace = '<u style="cursor:pointer;color:red;" data-toggle="tooltip" data-placement="top" data-html="true" aria-describedby="passHelp" title="<p>'.$meaning.'</p>">'.$word.'</u>';
			    $contents = substr_replace($contents, $replace, $pos, strlen($word));
			    
			    $find2 = '<script src="../../../bootstrap_4.1.3/js/bootstrap.min.js"></script>';
			     $pos2 = strpos($contents, $find2);
$replace2 = <<<EOD
		<script src="../../../bootstrap_4.1.3/js/popper.min.js"></script>
		<script src="../../../bootstrap_4.1.3/js/bootstrap.min.js"></script>
  		<script src="../../../js/lessons/pms/2019/tooltip.js"></script>
EOD;
				if ($pos2 !== false) {
					$contents = substr_replace($contents, $replace2, $pos2, strlen($find2));
				}
				$outputfile = fopen($cms_path, "wb") or die("Unable to open file output!".$cms_path);
				fwrite($outputfile, $contents) or die("Could not write to file.");
				fclose($outputfile);
				
				$query1 = "UPDATE popup_words SET synced = 1 WHERE id = ".$rows['id'];
				$stmt1 = $db->query($query1);
			}
		}
	} catch(Exception $exp) {
		echo "<pre/>";
		print_r($exp);
		die;
	}
}

//Insert a New Slide
function insertUpdateSlide($desti_lesson_id, $desti_destprevid, $file_path, $title="Content Slide", $audioPath = "", $courseid = 0) {
	global $db;
	global $master_db;
	

	try{
		$inserted_pageid = 0;
		//$master_db = "sp_2021_master";
		$time = time();
		$contents = '<div style="text-align: center;"><object class="mp4downloader_tagChecked" data="../..'.$file_path.'?ver='.$time.'" width="100%" height="700"> </object></div>';
		$querySch = "SELECT id, mysql_host, mysql_database, school_code FROM skillpre_schools.masters_school WHERE (mysql_database = ? ) AND replicate = 1";
		$stmtSch = $db->prepare($querySch);
		$stmtSch->execute(array($master_db));

		$querySch = "SELECT mysql_database FROM skillpre_schools.masters_school WHERE (mysql_database = ? OR master_school_dbname = ?) AND replicate = 1";
		$stmtSch = $db->prepare($querySch);
		$stmtSch->execute(array($master_db, $master_db));
		
		while($rowsSch = $stmtSch->fetch(PDO::FETCH_ASSOC))
		{ 
			$thisdb = $rowsSch['mysql_database'];
			//Slide inserting in respective selected location
			if($desti_destprevid == 0) {
				$first_slide_id = 0;
				$get_lessons = GetRecords("$thisdb.mdl_lesson_pages", array("lessonid"=>$desti_lesson_id, "prevpageid"=>0));
				foreach ($get_lessons as $get_lesson) {
					$first_slide_id = $get_lesson['id'];
				}

				//insert into the mdl_lesson_pages table
				$pageid = $autoid_less_pages = InsertRecord("$thisdb.mdl_lesson_pages", array("lessonid" => $desti_lesson_id,
				"prevpageid" => 0,
				"nextpageid" => $first_slide_id,
				"qtype" => '20',
				"qoption" => 0,
				"layout" => 1,
				"display" => 1,
				"timecreated" => time(),
				"timemodified" => 0,
				"title" => $title,
				"contents" => $contents,
				"contentsformat" => 1,
				"status" => 0
				));
				if($thisdb == $master_db)
					$inserted_pageid = $autoid_less_pages;

				if($autoid_less_pages > 0) {
					$autoid = InsertRecord("$thisdb.mdl_lesson_answers", array("lessonid" => $desti_lesson_id,
					"pageid" => $autoid_less_pages,
					"jumpto" => '-1',
					"grade" => 0,
					"score" => 0,
					"flags" => 0,
					"timecreated" => time(),
					"timemodified" => 0,
					"answer" => 'Next',
					"answerformat" => 0,
					"response" => null,
					"responseformat" => 0
					));
				}

				$query_up = "UPDATE $thisdb.mdl_lesson_pages SET prevpageid=? WHERE id=?";
	  		$stmt_up = $db->prepare($query_up);
	  		$stmt_up->execute(array($autoid_less_pages, $first_slide_id));

	  		//As this is first slide, you should add Previous Button to 2nd slide (if exists)
	  		if($first_slide_id > 0) {
	  			$id = InsertRecord("$thisdb.mdl_lesson_answers", array("lessonid" => $desti_lesson_id,
					"pageid" => $first_slide_id,
					"jumpto" => "-40",
					"grade" => 0,
					"score" => 0,
					"flags" => 0,
					"timecreated" => time(),
					"timemodified" => 0,
					"answer" => 'Previous',
					"answerformat" => 0,
					"response" => "",
					"responseformat" => 0
					));
	  		}
		  } else {
				$get_lessons = GetRecords("$thisdb.mdl_lesson_pages", array("id"=>$desti_destprevid));
				foreach ($get_lessons as $get_lesson) {
					$nextPageID = $get_lesson['nextpageid'];
				}

				//insert into the mdl_lesson_pages table
				$pageid = $autoid_mlp = InsertRecord("$thisdb.mdl_lesson_pages", array("lessonid" => $desti_lesson_id,
				"prevpageid" => $desti_destprevid,
				"nextpageid" => $nextPageID,
				"qtype" => '20',
				"qoption" => 0,
				"layout" => 1,
				"display" => 1,
				"timecreated" => time(),
				"timemodified" => 0,
				"title" => $title,
				"contents" => $contents,
				"contentsformat" => 1,
				"status" => 13
				));
				if($thisdb == $master_db)
					$inserted_pageid = $autoid_mlp;

				$query1 = "UPDATE $thisdb.mdl_lesson_pages SET nextpageid=? WHERE id=?";
		  		$stmt1 = $db->prepare($query1);
		  		$stmt1->execute(array($autoid_mlp, $desti_destprevid));
		  		$rowcount1 = $stmt1->rowCount();

		  		if($nextPageID != 0) {
					$query1 = "UPDATE $thisdb.mdl_lesson_pages SET prevpageid=? WHERE id=?";
			  		$stmt1 = $db->prepare($query1);
			  		$stmt1->execute(array($autoid_mlp, $nextPageID));
			  		$rowcount1 = $stmt1->rowCount();
		  		}

		  		//insert into the mdl_lesson_answers table
				$autoid = InsertRecord("$thisdb.mdl_lesson_answers", array("lessonid" => $desti_lesson_id,
				"pageid" => $autoid_mlp,
				"jumpto" => "-40",
				"grade" => 0,
				"score" => 0,
				"flags" => 0,
				"timecreated" => time(),
				"timemodified" => 0,
				"answer" => 'Previous',
				"answerformat" => 0,
				"response" => "",
				"responseformat" => 0
				));

				$autoid = InsertRecord("$thisdb.mdl_lesson_answers", array("lessonid" => $desti_lesson_id,
				"pageid" => $autoid_mlp,
				"jumpto" => -1,
				"grade" => 0,
				"score" => 0,
				"flags" => 0,
				"timecreated" => time(),
				"timemodified" => 0,
				"answer" => 'Next',
				"answerformat" => 0,
				"response" => "",
				"responseformat" => 0
				));
			}
			//Insert into audio table
			if($audioPath != "" && $courseid > 0) {
				InsertRecord("$thisdb.lesson_pages_audio", array("course_id"=>$courseid, "page_id"=>$pageid, "audio_path"=>$audioPath));
			}
		}
		return $inserted_pageid;
	} catch(Exception $exp) {
		echo "<pre/>";
		print_r($exp);
	}
}

//get ReviewSlides for ID
/*function getSlideCardsAWNS($logged_user_id, $no_slides){
	global $db, $master_db;
	try{
		$cw_user_opt = "";
		$query = "SELECT id, first_name, last_name, roles_id FROM users WHERE roles_id=2 AND id != ?";
	  	$stmt = $db->prepare($query);
	  	$stmt->execute(array($logged_user_id));
	  	$rowcount = $stmt->rowCount();
	  	if($rowcount > 0){
		    while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
		      $username = $fetch['first_name']." ".$fetch['last_name'];
		      $user_id = $fetch['id'];
		      //$role_id = $fetch['role_id'];
		      $cw_user_opt .= "<option value=\"$user_id\">$username</option>";
		    }
	 	}

	 	$tt_user_opt = "";
	 	$query = "SELECT id, first_name, last_name, roles_id FROM users WHERE roles_id=5 AND id != ?";
	  	$stmt = $db->prepare($query);
	  	$stmt->execute(array($logged_user_id));
	  	$rowcount = $stmt->rowCount();
	  	if($rowcount > 0){
		    while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
		      $username = $fetch['first_name']." ".$fetch['last_name'];
		      $user_id = $fetch['id'];
		      //$role_id = $fetch['role_id'];
		      $tt_user_opt .= "<option value=\"$user_id\">$username</option>";
		    }
	 	}


		$slides_arr = "";
		for ($i=1; $i <= $no_slides; $i++) { 
			$slides_arr .= '
				<div class="card">
				  <div class="card-header tx-medium bd-0 tx-white bg-mantle">
				    Slide '.$i.'
				  </div><!-- card-header -->
				  <div class="card-body">
				    <div class="row">
				      <div class="col-md-12">
				        <div class="form-group">
				          <label for="user_vd">Slide Type:</label>
				          <select class="form-control slide_type" name="slide_type" id="slide_type">
				            <option value="">- Select Type of Slide -</option>
				            <option value="ls">Lesson Slide</option>
				            <option value="as">Activity/Scenario Slide</option>
				          </select>
				        </div>
				      </div>
				    </div>
				    <div class="card cw_block">
				      <div class="card-header tx-medium bd-0 tx-white bg-info">
				        Content Writer
				      </div><!-- card-header -->
				      <div class="card-body">
				        <div class="row">
				          <div class="col-md-4">
				            <div class="form-group">
				              <label for="user_vd">Assign To:</label>
				              <select class="form-control" name="user_vd" id="user_vd">
				                <option value="">- Select User -</option>
				                '.$cw_user_opt.'
				              </select>
				            </div>
				          </div>
				          <div class="col-md-8">
				            <div class="form-group">
				              <label for="inst_vd">Instructions:</label>
				              <textarea class="form-control" rows="5" name="inst_vd" id="inst_vd"></textarea>
				            </div>
				          </div>
				          <div class="col-md-12">
				            <div class="form-group">
				              <label for="file_vd">Reference Files:</label>
				              <div class="file-loading">
				                <input id="file_vd" type="file" name="vd_files[]" multiple class="file" data-overwrite-initial="false">
				              </div>
				            </div>
				          </div>
				        </div>
				      </div><!-- card-body -->
				    </div>
				    <div class="card tt_block">
				      <div class="card-header tx-medium bd-0 tx-white bg-info">
				        Tech Team
				      </div><!-- card-header -->
				      <div class="card-body">
				        <div class="row">
				          <div class="col-md-4">
				            <div class="form-group">
				              <label for="user_vd">Assign To:</label>
				              <select class="form-control" name="user_vd" id="user_vd">
				                <option value="">- Select User -</option>
				                '.$tt_user_opt.'
				              </select>
				            </div>
				          </div>
				          <div class="col-md-8">
				            <div class="form-group">
				              <label for="inst_vd">Instructions:</label>
				              <textarea class="form-control" rows="5" name="inst_vd" id="inst_vd"></textarea>
				            </div>
				          </div>
				          <div class="col-md-12">
				            <div class="form-group">
				              <label for="file_vd">Reference Files:</label>
				              <div class="file-loading">
				                <input id="file_vd" type="file" name="vd_files[]" multiple class="file" data-overwrite-initial="false">
				              </div>
				            </div>
				          </div>
				        </div>
				      </div><!-- card-body -->
				    </div>
				  </div><!-- card-body -->
				</div>
			';
		}
		return $slides_arr;
	} catch(Exception $exp) {
		echo "<pre/>";
		print_r($exp);
	}
}*/

//get list of task
function getSlideFeedbackList($role_id, $logged_user_id)
{
	global $db, $master_db;
	try{	
		//get master_topics names and id
		$topic_name = array();
		$lessons_name = GetRecords("$master_db.mdl_course", array("visible"=>1));
		foreach ($lessons_name as $lesson) {
			$topic_name[$lesson['id']] = $lesson['fullname'];
		}

		$slideFeedbackArray = array();
		if($role_id == 1) {
			$query = "SELECT * FROM slidefeedback WHERE role NOT IN ('CR') OR role IS NULL ORDER BY id DESC";
	  		$stmt = $db->query($query);
	  	} else {
  			$query = "SELECT * FROM slidefeedback WHERE updatedBy='".$logged_user_id."' AND role NOT IN ('CR') OR role IS NULL ORDER BY id DESC";
	  		$stmt = $db->query($query);	
  		}
  		$rowcount = $stmt->rowCount();
  		while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
  			$query1 = "SELECT * FROM users WHERE id='".$fetch['updatedBy']."'";
	  		$stmt1 = $db->query($query1);
	  		while($fetch1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
	  			$username = $fetch1['first_name']." ".$fetch1['last_name'];
  			}
		    array_push($slideFeedbackArray, array("classId"=>$fetch['classId'], "slideId"=>$fetch['slideId'], "feedbackType"=>$fetch['feedbackType'], "topic"=>$topic_name[$fetch['topicId']], "feedback"=>$fetch['feedback'], "updatedBy"=>$username, "status"=>$fetch['updatedOn']));
	  	}
	  	return $slideFeedbackArray;
  	}catch(Exception $exp){

		print_r($exp);
		return "false";
	}
}
function getSlideFeedbackListCR($role_id, $logged_user_id)
{
	global $db, $master_db;
	try{	
		//get master_topics names and id
		$topic_name = array();
		$lessons_name = GetRecords("$master_db.mdl_course");
		foreach ($lessons_name as $lesson) {
			$topic_name[$lesson['id']] = $lesson['fullname'];
		}

		$slideFeedbackArray = array();
		if($role_id != 6) {
			$query = "SELECT * FROM slidefeedback WHERE role='CR'";
	  		$stmt = $db->query($query);
	  	} else {
  			$query = "SELECT * FROM slidefeedback WHERE role='CR' AND updatedBy='".$logged_user_id."'";
	  		$stmt = $db->query($query);	
  		}
  		$rowcount = $stmt->rowCount();
  		while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
  			$username = "";
			$query1 = "SELECT * FROM users WHERE id='".$fetch['updatedBy']."'";
	  		$stmt1 = $db->query($query1);
	  		while($fetch1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
	  			$username = $fetch1['first_name']." ".$fetch1['last_name'];
  			}

		    array_push($slideFeedbackArray, array("cr_issue_id"=>$fetch['id'], "classId"=>$fetch['classId'], "slideId"=>$fetch['slideId'], "feedbackType"=>$fetch['feedbackType'], "topic"=>$topic_name[$fetch['topicId']], "feedback"=>$fetch['feedback'], "updatedBy"=>$username, "updatedOn"=>$fetch['updatedOn'], "issue_type"=>$fetch['issue_type'], "issue_type_status"=>$fetch['issue_status']));
	  	}
	  	return $slideFeedbackArray;
  	}catch(Exception $exp){

		print_r($exp);
		return "false";
	}
}

//get type of issues
function type_of_issue()
{
	global $db;
	try{
		$type_of_issue = array();
		$query = "SELECT * FROM issue_type WHERE deleted=0";
  		$stmt = $db->query($query);
  		$rowcount = $stmt->rowCount();
  		while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
  			array_push($type_of_issue, array("issue"=>$fetch['issue'], "id"=>$fetch['id']));
	  	}
	  	return $type_of_issue;
  	}catch(Exception $exp){

		print_r($exp);
		return "false";
	}
}

//get type of issues status
function type_of_issue_status()
{
	global $db;
	try{
		$type_of_issue_status = array();
		$query = "SELECT * FROM issue_status WHERE deleted=0";
  		$stmt = $db->query($query);
  		$rowcount = $stmt->rowCount();
  		while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
  			array_push($type_of_issue_status, array("status"=>$fetch['status'], "id"=>$fetch['id']));
	  	}
	  	return $type_of_issue_status;
  	}catch(Exception $exp){

		print_r($exp);
		return "false";
	}
}

//Added slides publish to skills4life database and skills4lifeadmin content folder
function insertSlide($desti_lesson_id, $desti_destprevid, $file_path) {
	global $db;
	global $master_db;

	try{
		$title = "lesson";
		$contents = '<div style="text-align: center;"><object class="mp4downloader_tagChecked" data="../../'.$file_path.'" width="100%" height="700"> </object></div>';
		//Slide inserting in respective selected location
		if($desti_destprevid == 0) {
			$first_slide_id = 0;
			$get_lessons = GetRecords("$master_db.mdl_lesson_pages", array("lessonid"=>$desti_lesson_id, "prevpageid"=>0));
			foreach ($get_lessons as $get_lesson) {
				$first_slide_id = $get_lesson['id'];
			}

			//insert into the mdl_lesson_pages table
			$autoid_less_pages = InsertRecord("$master_db.mdl_lesson_pages", array("lessonid" => $desti_lesson_id,
			"prevpageid" => 0,
			"nextpageid" => $first_slide_id,
			"qtype" => '20',
			"qoption" => 0,
			"layout" => 1,
			"display" => 1,
			"timecreated" => time(),
			"timemodified" => 0,
			"title" => $title,
			"contents" => $contents,
			"contentsformat" => 1,
			"status" => 0
			));

			if($autoid_less_pages > 0) {
				$autoid = InsertRecord("$master_db.mdl_lesson_answers", array("lessonid" => $desti_lesson_id,
				"pageid" => $autoid_less_pages,
				"jumpto" => '-1',
				"grade" => 0,
				"score" => 0,
				"flags" => 0,
				"timecreated" => time(),
				"timemodified" => 0,
				"answer" => 'Next',
				"answerformat" => 0,
				"response" => null,
				"responseformat" => 0
				));
			}

			$query_up = "UPDATE $master_db.mdl_lesson_pages SET prevpageid=? WHERE id=?";
	  		$stmt_up = $db->prepare($query_up);
	  		$stmt_up->execute(array($autoid_less_pages, $first_slide_id));
	  	} else {
			$get_lessons = GetRecords("$master_db.mdl_lesson_pages", array("id"=>$desti_destprevid));
			foreach ($get_lessons as $get_lesson) {
				$nextPageID = $get_lesson['nextpageid'];
			}

			//insert into the mdl_lesson_pages table
			$autoid_mlp = InsertRecord("$master_db.mdl_lesson_pages", array("lessonid" => $desti_lesson_id,
			"prevpageid" => $desti_destprevid,
			"nextpageid" => $nextPageID,
			"qtype" => '20',
			"qoption" => 0,
			"layout" => 1,
			"display" => 1,
			"timecreated" => time(),
			"timemodified" => 0,
			"title" => $title,
			"contents" => $contents,
			"contentsformat" => 1,
			"status" => 13
			));

			$query1 = "UPDATE $master_db.mdl_lesson_pages SET nextpageid=? WHERE id=?";
	  		$stmt1 = $db->prepare($query1);
	  		$stmt1->execute(array($autoid_mlp, $desti_destprevid));
	  		$rowcount1 = $stmt1->rowCount();

	  		if($nextPageID != 0) {
				$query1 = "UPDATE $master_db.mdl_lesson_pages SET prevpageid=? WHERE id=?";
		  		$stmt1 = $db->prepare($query1);
		  		$stmt1->execute(array($autoid_mlp, $nextPageID));
		  		$rowcount1 = $stmt1->rowCount();
	  		}

	  		//insert into the mdl_lesson_answers table
			$autoid = InsertRecord("$master_db.mdl_lesson_answers", array("lessonid" => $desti_lesson_id,
			"pageid" => $autoid_mlp,
			"jumpto" => "-40",
			"grade" => 0,
			"score" => 0,
			"flags" => 0,
			"timecreated" => time(),
			"timemodified" => 0,
			"answer" => 'Previous',
			"answerformat" => 0,
			"response" => "",
			"responseformat" => 0
			));

			$autoid = InsertRecord("$master_db.mdl_lesson_answers", array("lessonid" => $desti_lesson_id,
			"pageid" => $autoid_mlp,
			"jumpto" => 1,
			"grade" => 0,
			"score" => 0,
			"flags" => 0,
			"timecreated" => time(),
			"timemodified" => 0,
			"answer" => 'Next',
			"answerformat" => 0,
			"response" => "",
			"responseformat" => 0
			));
		}

		return "success";
	} catch(Exception $exp) {
		echo "<pre/>";
		print_r($exp);
	}
}

function getSlideTypes() {
	global $db;
	$return_slide_type_array = array();
	try{
		$i = 0;
		$slide_types = GetRecords("slide_types", array("deleted"=>0));
		foreach ($slide_types as $slide_type) {
			$slide_type_id = $slide_type['id'];
			$slide_type_path = GetRecords("slide_types_html_path", array("deleted"=>0, "type"=>$slide_type_id));
			foreach ($slide_type_path as $slide_type_html_path) {
				$return_slide_type_array[$i]['id'] = $slide_type_html_path['id'];
				$return_slide_type_array[$i]['path'] = $slide_type_html_path['path'];
				$return_slide_type_array[$i]['name'] = $slide_type_html_path['name'];
				$i++;
			}
		}

		return $return_slide_type_array;
	} catch(Exception $exp) {
		echo "<pre/>";
		print_r($exp);
	}
}


function CopyContentToSkills4life($sourcePath)
{
	try {
		global $db;
		global $web_root;
		global $dir_root;

		$cms_path = str_replace($web_root, $dir_root, $sourcePath);
		$s4l_path = str_replace("cms/app", "skills4lifeadmin", $cms_path);
		$temp1 = $temp = explode("/", $s4l_path);
		unset($temp1[count($temp1) - 1]);
		$temp2 = implode("/", $temp1);
		if(! file_exists($temp2)) {
			mkdir($temp2, 0777, true);
		}
		copy($cms_path, $s4l_path);

	} catch(Exception $exp) {
		echo "<pre/>";
		print_r($exp);
	}
}

function CopyCSSToSkills4life($htmlPath, $topicName)
{
	try {
		global $db;
		global $web_root;
		global $dir_root;

		$cms_path = str_replace($web_root, $dir_root, $htmlPath);
		$s4l_path = str_replace("cms/app", "skills4lifeadmin", $cms_path);
		$temp1 = $temp = explode("/", $s4l_path);
		unset($temp1[count($temp1) - 1]);
		$s4l_path = implode("/", $temp1)."/css";

		$temp1 = $temp = explode("/", $cms_path);
		unset($temp1[count($temp1) - 1]);
		$cms_path = implode("/", $temp1)."/css";

		if(! file_exists($s4l_path)) {
			mkdir($s4l_path, 0777, true);
		}
		cpy($cms_path, $s4l_path);

		$cms_path = $dir_root."app/contents/css/".$topicName;
		$s4l_path = str_replace("cms/app", "skills4lifeadmin", $cms_path);
		if(! file_exists($s4l_path)) {
			mkdir($s4l_path, 0777, true);
		}
		cpy($cms_path, $s4l_path);

	} catch(Exception $exp) {
		echo "<pre/>";
		print_r($exp);
	}
}

function CopyJSToSkills4life($htmlPath, $topicName)
{
	try {
		global $db;
		global $web_root;
		global $dir_root;

		$cms_path = str_replace($web_root, $dir_root, $htmlPath);
		$s4l_path = str_replace("cms/app", "skills4lifeadmin", $cms_path);
		$temp1 = $temp = explode("/", $s4l_path);
		unset($temp1[count($temp1) - 1]);
		$s4l_path = implode("/", $temp1)."/js";

		$temp1 = $temp = explode("/", $cms_path);
		unset($temp1[count($temp1) - 1]);
		$cms_path = implode("/", $temp1)."/js";

		if(! file_exists($s4l_path)) {
			mkdir($s4l_path, 0777, true);
		}
		cpy($cms_path, $s4l_path);

		$cms_path = $dir_root."app/contents/js/".$topicName;
		$s4l_path = str_replace("cms/app", "skills4lifeadmin", $cms_path);
		if(! file_exists($s4l_path)) {
			mkdir($s4l_path, 0777, true);
		}
		cpy($cms_path, $s4l_path);

	} catch(Exception $exp) {
		echo "<pre/>";
		print_r($exp);
	}
}

function CopyImagesToSkills4life($htmlPath, $topicName)
{
	try {
		global $db;
		global $web_root;
		global $dir_root;

		$cms_path = str_replace($web_root, $dir_root, $htmlPath);
		$s4l_path = str_replace("cms/app", "skills4lifeadmin", $cms_path);
		$temp1 = $temp = explode("/", $s4l_path);
		unset($temp1[count($temp1) - 1]);
		$s4l_path = implode("/", $temp1)."/images";

		$temp1 = $temp = explode("/", $cms_path);
		unset($temp1[count($temp1) - 1]);
		$cms_path = implode("/", $temp1)."/images";

		if(! file_exists($s4l_path)) {
			mkdir($s4l_path, 0777, true);
		}
		cpy($cms_path, $s4l_path);

		$cms_path = $dir_root."app/contents/images/graphics/".$topicName;
		$s4l_path = str_replace("cms/app", "skills4lifeadmin", $cms_path);
		if(! file_exists($s4l_path)) {
			mkdir($s4l_path, 0777, true);
		}
		cpy($cms_path, $s4l_path);

		$cms_path = $dir_root."app/contents/images/templates/".$topicName;
		$s4l_path = str_replace("cms/app", "skills4lifeadmin", $cms_path);
		if(! file_exists($s4l_path)) {
			mkdir($s4l_path, 0777, true);
		}
		cpy($cms_path, $s4l_path);

	} catch(Exception $exp) {
		echo "<pre/>";
		print_r($exp);
	}
}

function CopyAudiosToSkills4life($htmlPath, $topicName, $class_id)
{
	try {
		global $db;
		global $web_root;
		global $dir_root;

		$cms_path = str_replace($web_root, $dir_root, $htmlPath);
		$s4l_path = str_replace("cms/app", "skills4lifeadmin", $cms_path);
		$temp1 = $temp = explode("/", $s4l_path);
		unset($temp1[count($temp1) - 1]);
		$s4l_path = implode("/", $temp1)."/audio";

		$temp1 = $temp = explode("/", $cms_path);
		unset($temp1[count($temp1) - 1]);
		$cms_path = implode("/", $temp1)."/audio";

		if(! file_exists($s4l_path)) {
			mkdir($s4l_path, 0777, true);
		}
		cpy($cms_path, $s4l_path);

		$cms_path = $dir_root."app/contents/audio/c".$class_id.$topicName;
		$s4l_path = str_replace("cms/app", "skills4lifeadmin", $cms_path);
		if(! file_exists($s4l_path)) {
			mkdir($s4l_path, 0777, true);
		}
		cpy($cms_path, $s4l_path);

	} catch(Exception $exp) {
		echo "<pre/>";
		print_r($exp);
	}
}

//get resources images using class and topic id
function getImageResources($class_id, $topic_id, $module){
	global $db, $master_db, $dir_root, $web_root;

	$lessons_name = GetRecord("$master_db.mdl_course", array("id"=>$topic_id));
	$topic_name = $lessons_name['fullname'];
	if($module == "")
		$images = GetRecords("resources", array("class_id"=>$class_id, "topics_id"=>$topic_id, "resource_type_id"=>"1"), array("id DESC"));
	else
		$images = GetRecords("resources", array("class_id"=>$class_id, "topics_id"=>$topic_id, "resource_type_id"=>"4", "module"=>$module), array("id DESC"));

	$image_data = "";
	if(count($images) > 0) {
		foreach ($images as $image) {
			foreach (json_decode($image['filepath']) as $image_filepath) {
				$image_filepath = $image_filepath;
				$get_filename = pathinfo($image_filepath);
				//echo $get_filename['extension'];
				$ms_file_formates = array("doc", "docx", "ppt", "pptx", "xls", "xlsx", "pdf");
				if(in_array($get_filename['extension'], $ms_file_formates)){
					if($get_filename['extension'] == "doc" || $get_filename['extension'] == "docx")
						$widget_img = '<img class="card-img-top" src="images/word.jpg" alt="res_images" style="height: 180px; width: 100%; display: block;">';
					else if($get_filename['extension'] == "ppt" || $get_filename['extension'] == "pptx")
						$widget_img = '<img class="card-img-top" src="images/ppt.png" alt="res_images" style="height: 180px; width: 100%; display: block;">';
					else if($get_filename['extension'] == "xls" || $get_filename['extension'] == "xls")
						$widget_img = '<img class="card-img-top" src="images/excel.jpg" alt="res_images" style="height: 180px; width: 100%; display: block;">';
					else if($get_filename['extension'] == "pdf")
						$widget_img = '<img class="card-img-top" src="images/pdf.jpg" alt="res_images" style="height: 180px; width: 100%; display: block;">';
				} else {
					$widget_img = '<img class="card-img-top" src="'.str_replace($dir_root, $web_root, $image_filepath).'" alt="res_images" style="height: 180px; width: 100%; display: block;">';
				}
				$image_data .='
					<div class="col-md-3">
		                <div class="card">
	                	  '.$widget_img.'
		                  <ul class="list-group list-group-flush">
		                    <li class="list-group-item text-center">Class '.$class_id.' - '.$topic_name.' - ../../..'.str_replace('vol/skillprep/cms/app/contents/', '', $image_filepath).'</li>
		                  </ul>
		                  <div class="card-body">
		                    <a href="'.str_replace($dir_root, $web_root, $image_filepath).'" class="card-link float-left">Download</a>
		                    <a href="deleteResourceImg.php?resource_id='.$image['id'].'" class="card-link float-right">Delete</a>
		                  </div>
		                </div>      
	              	</div>
				';
			}
		}
	} else{
		$image_data .='
			<div class="col-md mg-t-20 mg-md-t-0">
				<div class="card bd-0">
				    <div class="card-body rounded-top bd-0 bg-warning tx-white">
				      <h6 class="mg-b-3"><a href="#" class="tx-white hover-white-8">No Layouts Availlable</a></h6>
				    </div><!-- card-body -->
				    <img class="card-img-bottom img-fluid" src="'.$web_root.'img/noTemplates.png'.'" alt="Image">
				</div>
			</div>
		';
	}
	return $image_data;
}

//get task assign gd user id
function get_task_assgin_gd($task_ass_id){
	global $db;
	try{
		$task_ass_id = $task_ass_id;

		$gd_user_ids = array();
		$query = "SELECT id, roles_id FROM users WHERE roles_id=3";
	    $stmt = $db->query($query);
	    while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
	    	$gd_user_ids[] = $fetch['id'];
		}
		$implode_gd_user_ids = implode(',', $gd_user_ids);

		//echo $implode_gd_user_ids;

		$query1 = "SELECT * FROM task_details WHERE task_assign_id = ? AND user_id IN ($implode_gd_user_ids)";
		$stmt1 = $db->prepare($query1);
		$stmt1->execute(array($task_ass_id));
		$rowcount1 = $stmt1->rowCount();
		if($rowcount1){
			while($fetch1 = $stmt1->fetch(PDO::FETCH_ASSOC))
				$user_id = $fetch1['user_id'];
			return $user_id;
		} else {
			return 0;
		}
	} catch(Exception $exp){
		echo "<pre/>";
		print_r($exp);
	}
}

function getLessons($class, $topic_id)
{
	global $db;
	global $master_db;
	try{
		$class_id = $class;
		$topic_id = $topic_id;
		//this module will get from mdl_modules table
		$module = "13";
		$data = "";
		//get chapters and category
		$getChapters = GetRecords("$master_db.mdl_course_modules", array("course"=>$topic_id, "module"=>$module, "visible"=>1));
		if(count($getChapters) > 0) {
		  $instance = array();
		  foreach ($getChapters as $getChapter) {
		    $instance[] = $getChapter['instance'];
		  }
		  $instanceImplode = implode(",", $instance);

		$sequences = array();
		$query0 = "SELECT sequence FROM $master_db.mdl_course_sections WHERE course = ? AND sequence != '' ORDER BY section";
		$stmt0 = $db->prepare($query0);
  		$stmt0->execute(array($topic_id));
  		while($fetch0 = $stmt0->fetch(PDO::FETCH_ASSOC))
  			$sequences[] = $fetch0['sequence'];
  		/*echo "<pre/>";
  		print_r($sequences);die;*/
  		if(count($sequences) > 0) {
  			$sequence = implode(",", $sequences);
  		} else {
  			$sequence = 0;
  		}
  		$sequence_ids = array();
  		$query0 = "SELECT instance FROM $master_db.mdl_course_modules WHERE course = ? ORDER BY FIELD (id, $sequence)";
  		$stmt0 = $db->prepare($query0);
  		$stmt0->execute(array($topic_id));
  		while($fetch0 = $stmt0->fetch(PDO::FETCH_ASSOC)) {
  			$sequence_ids[] = $fetch0['instance'];
  		}
  		if(count($sequence_ids) > 0) {
  			$sequence_ids_string = implode(",", $sequence_ids);
  		} else {
  			$sequence_ids_string = "0";
  		}

		  $query = "SELECT * FROM $master_db.mdl_lesson WHERE id IN ($instanceImplode)  ORDER BY FIELD (id, $sequence_ids_string)";
		  $stmt = $db->query($query);
		  $rowcount = $stmt->rowCount();
		  //if($_SESSION['cms_usertype'] != "Instructional Designer") {
			  if($rowcount > 0){
			  	$data .= '<select class="form-control" name="lesson_id" id="exampleFormControlSelect1" required="required">';
			  	$data .= '<option value="">-Select Lesson-</option>';
			    while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
			      $name = $fetch['name'];
			      $lesson_id = $fetch['id'];
			      $data .= '<option value="'.$lesson_id.'">'.$name.'</option>';
			      
		        }// end of mdl_lesson while loop
		        $data .= '</select>';
		      }
		}// end of if loop of getChapters

	return $data;
	} catch(Exception $exp) {
		echo "<pre/>";
		print_r($exp);
	}
}

/** 
 Created By: Dinesh V
 Created On: 01/11/2021
 ********************Start here from Concept Prep Functions *************
*/
//get yet to assign task list
function getCPYetToAssignTaskList($role_id, $logged_user_id)
{
	global $db, $master_db;
	try{	
		//Get Class and Subjects
		$query = "SELECT c.id as classAutoId, c.module as className, s.id as subjectAutoId, s.module as subjectName FROM cpmodules as c, cpmodules as s WHERE c.type='class' AND c.id=s.parentId";
	  	$stmt = $db->query($query);

		$tasks = array();
		$rowcount = $stmt->rowCount();
  		while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){

  			$query1 = "SELECT * FROM cptasks WHERE class_id='".$fetch['classAutoId']."' AND subject_id='".$fetch['subjectAutoId']."'";
		  	$stmt1 = $db->query($query1);
		  	$rowcount1 = $stmt1->rowCount();
	  		
		  	if ($rowcount1 == 0) {
		  		array_push($tasks, array("classId"=>$fetch['classAutoId'], "subId"=>$fetch['subjectAutoId'], "className"=>$fetch['className'], "subName"=>$fetch['subjectName']));
		  	}
	    }
	  	return $tasks;
  	}catch(Exception $exp){

		print_r($exp);
		return "false";
	}
}

//get list of task
function getCPTaskListAdd($role_id, $logged_user_id) {
	global $db, $master_db;
	try{	
		//get master_topics names and id
		$class_name = array();
		$subject_name = array();
		$chapter_name = array();
		$topic_name = array();
		$sub_topic_name = array();
		//$lessons_name = GetRecords("$master_db.mdl_course");
		$ActiveSubjects = GetRecords("cpmodules", array("deleted"=>0));
		foreach ($ActiveSubjects as $activeSubject) {
			if($activeSubject['type'] == 'class')
				$class_name[$activeSubject['id']] = $activeSubject['module'];
			if($activeSubject['type'] == 'subject')
				$subject_name[$activeSubject['id']] = $activeSubject['module'];
			if($activeSubject['type'] == 'chapter')
				$chapter_name[$activeSubject['id']] = $activeSubject['module'];
			if($activeSubject['type'] == 'topic')
				$topic_name[$activeSubject['id']] = $activeSubject['module'];
			if($activeSubject['type'] == 'subTopic')
				$sub_topic_name[$activeSubject['id']] = $activeSubject['module'];
		}
		//Userid - Employee
		$employees = array();
		$users = GetRecords("users", array());
		foreach($users as $user) {
			$employees[$user['id']] = $user['first_name']." ".$user['last_name'];
		}

		$tasks = array();
		if($role_id == 1 || $role_id == 8) {
		 $query = "select t.id as task_id,t.task_name,t.class_id,t.subject_id,s.name,ta.id as task_ass_id,ta.user_id as tassign_user_id, r.name as dept from cptasks t, status s, cptask_assign ta, users u, roles r where ta.status = s.id and t.id=ta.tasks_id and ta.user_id=u.id and u.roles_id= r.id AND u.roles_id != 1 AND s.name != 'Publish' AND s.name != 'Review' ORDER BY ta.id desc";
	  		
		$stmt = $db->query($query);
	  	} else {
  			$query = "select t.id as task_id,t.task_name,t.class_id,t.subject_id,s.name,ta.id as task_ass_id,ta.user_id as tassign_user_id, r.name as dept from cptasks t, status s, cptask_assign ta, users u, roles r where ta.status = s.id and t.id=ta.tasks_id and ta.user_id=u.id and u.roles_id= r.id AND ta.user_id='".$logged_user_id."' AND s.name != 'Publish' ORDER BY ta.id desc";
	  		$stmt = $db->query($query);	
  		}
  		$rowcount = $stmt->rowCount();
  		while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
  			$slide_ids = '';
  			if(is_array($slide_ids)){
  				$slide_ids = "Add slides for Existing Topic";
  			}

  			//checking only layout 6 layout slides
  			$query_addSlide = "SELECT task_assign_id, layout_id FROM cpadd_slide_list WHERE layout_id IN (10, 23, 24, 25, 26) AND task_assign_id = '".$fetch['task_ass_id']."'";
		  	$stmt_addSlide = $db->query($query_addSlide);
		  	$rowcount_addSlide = $stmt_addSlide->rowCount();

		  	$add_slide_list_tb = GetRecords("cpadd_slide_list", array("task_assign_id"=>$fetch['task_ass_id']), array("sequence"));
		  	$slideContentContains = "";
			if(count($add_slide_list_tb) > 0) {
				//echo "<pre/>";
				//print_r($add_slide_list_tb);
				foreach($add_slide_list_tb as $slide)
				{
				  	//checking any slides contains empty json data except DictionaryWords layout and slide_json column contains null values
					$ignoreLayouts_ids = array(0, 5263);
					$slideJSON = json_decode($slide['slide_json']);
					$objectToArray = (array)$slideJSON;
					$layout_id = $slide['layout_id'];
					// echo "<pre/>";
					// print_r($objectToArray);
					if(!in_array($layout_id, $ignoreLayouts_ids)) {
					      foreach ($objectToArray as $key => $value)
						  {
						  	//echo 'key---'.$objectToArray[$key];
						  	if(isset($objectToArray[$key]) && !is_array($objectToArray[$key])){
							    //this means key exists and the value is not a array
							    if(trim($objectToArray[$key]) != '') {
							    	//value is null or empty string or whitespace only
								    $slideContentContains = "";
							    	break;
						    	} else {
									//echo "else 111";echo '<br/>';
									$slideContentContains = 'slide Empty - ';
								}
							} elseif (is_array($objectToArray[$key])) {
								foreach ($value as $key1 => $value1)
					  			{
					  				//echo "value 1---".$value1;echo "<br/>";
					  				if(trim($value[$key1]) != '') {
					  					//value is null or empty string or whitespace only
						  				//echo "value if 1---".$value1;echo "<br/>";
					  					$slideContentContains = "";
							    		break;
						    		} else {
						    			$slideContentContains = 'slide Empty - ';
						    		}
				  				}
							} else {
								//echo "else end";echo '<br/>';
								$slideContentContains = 'slide Empty - ';
							}
						  }
					}

					if($slideContentContains != "")
						break;
				}
			}

			// echo "slideContentContains---".$slideContentContains;echo "<br/>";
  			
		    // array_push($tasks, array("title"=>$fetch['task_name'], "dept"=>$fetch['dept'], "class"=>$fetch['class_id'], "subjectName"=>$subject_name[$fetch['subject_id']], "chapterName"=>$chapter_name[$fetch['chapter_id']], "topicName"=>$topic_name[$fetch['topic_name']], "subTopicName"=>$sub_topic_name[$fetch['sub_topic_id']], "class_id"=>$fetch['class_id'], "subject_id"=>$fetch['subject_id'], "status"=>$fetch['name'], "task_ass_id"=>$fetch['task_ass_id'], "task_id"=>$fetch['task_id'], "layout6"=>$rowcount_addSlide, "slide_id"=>$slide_ids,"task_userid"=>$fetch['tassign_user_id'],"template_id"=>$fetch['template_id'],"layout_id"=>$fetch['layout_id'], "AssignedTo"=>$employees[$fetch['tassign_user_id']], "slideContentEmptyContains"=>$slideContentContains));

		    array_push($tasks, array("title"=>$fetch['task_name'], "dept"=>$fetch['dept'], "className"=>$class_name[$fetch['class_id']], "subjectName"=>$subject_name[$fetch['subject_id']], "class_id"=>$fetch['class_id'], "subject_id"=>$fetch['subject_id'], "status"=>$fetch['name'], "task_ass_id"=>$fetch['task_ass_id'], "task_id"=>$fetch['task_id'], "layout6"=>$rowcount_addSlide, "slide_id"=>$slide_ids,"task_userid"=>$fetch['tassign_user_id'],"AssignedTo"=>$employees[$fetch['tassign_user_id']], "slideContentEmptyContains"=>$slideContentContains));
	  	}
	  	return $tasks;
  	}catch(Exception $exp){

		print_r($exp);
		return "false";
	}

	function getHierarchy($courseid) {
		global $db;
		$categoryInfo = GetRecord('mdl_course', array('id'=> $courseid));
		$category = $categoryInfo['category'];
		$pathInfo = GetRecord('mdl_course_categories', array('id' => $category));
		$path = $pathInfo['path'];
		$path = explode("/",$path);
		$all_ids = $path = array_values(array_filter($path));
		$classInfo = GetRecord('master_class', array('categoryid' => $path[0]));
		$path_names = array();
		foreach($all_ids as $id) {
			$info = GetRecord("mdl_course_categories", array("id"=>$id));
			$path_names[] = $info['name'];
		}
		$path_names = array_unique($path_names);
		return array("L0ID"=>$path[0], "class"=>$classInfo['code'], "courseCategory"=>$category, "pathNames"=>$path_names);
	}

	
}
function getCPTaskListReview($role_id, $logged_user_id) {
	global $db, $master_db;
	try{	
		//get master_topics names and id
		$class_name = array();
		$subject_name = array();
		$chapter_name = array();
		$topic_name = array();
		$sub_topic_name = array();
		//$lessons_name = GetRecords("$master_db.mdl_course");
		$ActiveSubjects = GetRecords("cpmodules", array("deleted"=>0));
		foreach ($ActiveSubjects as $activeSubject) {
			if($activeSubject['type'] == 'class')
				$class_name[$activeSubject['id']] = $activeSubject['module'];
			if($activeSubject['type'] == 'subject')
				$subject_name[$activeSubject['id']] = $activeSubject['module'];
			if($activeSubject['type'] == 'chapter')
				$chapter_name[$activeSubject['id']] = $activeSubject['module'];
			if($activeSubject['type'] == 'topic')
				$topic_name[$activeSubject['id']] = $activeSubject['module'];
			if($activeSubject['type'] == 'subTopic')
				$sub_topic_name[$activeSubject['id']] = $activeSubject['module'];
		}
		//Userid - Employee
		$employees = array();
		$users = GetRecords("users", array());
		foreach($users as $user) {
			$employees[$user['id']] = $user['first_name']." ".$user['last_name'];
		}
		
 
		$tasks = array();
		if($role_id == 1 || $role_id == 8 || $role_id == 6) {
		  	$query = "select t.id as task_id,t.task_name,t.class_id,t.subject_id,s.name,ta.id as task_ass_id,ta.user_id as tassign_user_id, r.name as dept from cptasks t, status s, cptask_assign ta, users u, roles r where ta.status = s.id and t.id=ta.tasks_id and ta.user_id=u.id and u.roles_id= r.id AND u.roles_id != 1 AND (s.name = 'Publish' or s.name = 'Review') ORDER BY ta.id desc";
	  	 	
		$stmt = $db->query($query);
	  	} else {
  			$query = "select t.id as task_id,t.task_name,t.class_id,t.subject_id,s.name,ta.id as task_ass_id,ta.user_id as tassign_user_id, r.name as dept from cptasks t, status s, cptask_assign ta, users u, roles r where ta.status = s.id and t.id=ta.tasks_id and ta.user_id=u.id and u.roles_id= r.id AND s.name = 'Publish' ORDER BY ta.id desc";
	  		$stmt = $db->query($query);	
  		}
  		$rowcount = $stmt->rowCount();
  		while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
  			$slide_ids = '';
  			if(is_array($slide_ids)){
  				$slide_ids = "Add slides for Existing Topic";
  			}

  			//checking only layout 6 layout slides
  			$query_addSlide = "SELECT task_assign_id, layout_id FROM cpadd_slide_list WHERE layout_id IN (10, 23, 24, 25, 26) AND task_assign_id = '".$fetch['task_ass_id']."'";
		  	$stmt_addSlide = $db->query($query_addSlide);
		  	$rowcount_addSlide = $stmt_addSlide->rowCount();

		  	$add_slide_list_tb = GetRecords("cpadd_slide_list", array("task_assign_id"=>$fetch['task_ass_id']), array("sequence"));
		  	$slideContentContains = "";
			if(count($add_slide_list_tb) > 0) {
				//echo "<pre/>";
				//print_r($add_slide_list_tb);
				foreach($add_slide_list_tb as $slide)
				{
				  	//checking any slides contains empty json data except DictionaryWords layout and slide_json column contains null values
					$ignoreLayouts_ids = array(0, 5263);
					$slideJSON = json_decode($slide['slide_json']);
					$objectToArray = (array)$slideJSON;
					$layout_id = $slide['layout_id'];
					// echo "<pre/>";
					// print_r($objectToArray);
					if(!in_array($layout_id, $ignoreLayouts_ids)) {
					      foreach ($objectToArray as $key => $value)
						  {
						  	//echo 'key---'.$objectToArray[$key];
						  	if(isset($objectToArray[$key]) && !is_array($objectToArray[$key])){
							    //this means key exists and the value is not a array
							    if(trim($objectToArray[$key]) != '') {
							    	//value is null or empty string or whitespace only
								    $slideContentContains = "";
							    	break;
						    	} else {
									//echo "else 111";echo '<br/>';
									$slideContentContains = 'slide Empty - ';
								}
							} elseif (is_array($objectToArray[$key])) {
								foreach ($value as $key1 => $value1)
					  			{
					  				//echo "value 1---".$value1;echo "<br/>";
					  				if(trim($value[$key1]) != '') {
					  					//value is null or empty string or whitespace only
						  				//echo "value if 1---".$value1;echo "<br/>";
					  					$slideContentContains = "";
							    		break;
						    		} else {
						    			$slideContentContains = 'slide Empty - ';
						    		}
				  				}
							} else {
								//echo "else end";echo '<br/>';
								$slideContentContains = 'slide Empty - ';
							}
						  }
					}

					if($slideContentContains != "")
						break;
				}
			}

			// echo "slideContentContains---".$slideContentContains;echo "<br/>";
  			
		    // array_push($tasks, array("title"=>$fetch['task_name'], "dept"=>$fetch['dept'], "class"=>$fetch['class_id'], "subjectName"=>$subject_name[$fetch['subject_id']], "chapterName"=>$chapter_name[$fetch['chapter_id']], "topicName"=>$topic_name[$fetch['topic_name']], "subTopicName"=>$sub_topic_name[$fetch['sub_topic_id']], "class_id"=>$fetch['class_id'], "subject_id"=>$fetch['subject_id'], "status"=>$fetch['name'], "task_ass_id"=>$fetch['task_ass_id'], "task_id"=>$fetch['task_id'], "layout6"=>$rowcount_addSlide, "slide_id"=>$slide_ids,"task_userid"=>$fetch['tassign_user_id'],"template_id"=>$fetch['template_id'],"layout_id"=>$fetch['layout_id'], "AssignedTo"=>$employees[$fetch['tassign_user_id']], "slideContentEmptyContains"=>$slideContentContains));

		    array_push($tasks, array("title"=>$fetch['task_name'], "dept"=>$fetch['dept'], "className"=>$class_name[$fetch['class_id']], "subjectName"=>$subject_name[$fetch['subject_id']], "class_id"=>$fetch['class_id'], "subject_id"=>$fetch['subject_id'], "status"=>$fetch['name'], "task_ass_id"=>$fetch['task_ass_id'], "task_id"=>$fetch['task_id'], "layout6"=>$rowcount_addSlide, "slide_id"=>$slide_ids,"task_userid"=>$fetch['tassign_user_id'],"AssignedTo"=>$employees[$fetch['tassign_user_id']], "slideContentEmptyContains"=>$slideContentContains));
	  	}
	  	return $tasks;
  	}catch(Exception $exp){

		print_r($exp);
		return "false";
	}
}


?>