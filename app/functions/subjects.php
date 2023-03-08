<?php

function validateSubjectNameCharacters($subject_name) {
	return preg_match('/^[a-zA-Z0-9()& .-]+$/', $subject_name);
}
//get Subject
function getSubject($class_auto_id)
{
	global $db;
	try{
		// echo $class_auto_id;
		$topics = array();
		if($class_auto_id != "") {
			$subjectarray = '<option value="">-Choose Subject-</option>';
			$classsearch = "CLASS ".$class_auto_id;
		  	$query = "SELECT module,id FROM cpmodules WHERE parentId = ".$class_auto_id." AND level = 2 AND type = 'subject'";
			$stmt = $db->prepare($query);
	  		
	  		$stmt->execute();
	  		$rowcount = $stmt->rowCount();
			
			  while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
			$subjectarray .= '<option value="'.$fetch['id'].'">'.$fetch['module'].'</option>';
			  }
	  		// if($rowcount > 0){
	  		// 	while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
	  		// 		$query1 = "SELECT id,name FROM mdl_course_categories WHERE parent = ? AND depth = 2 AND visible = 1 ORDER BY sortorder";
			//   		$stmt1 = $db->prepare($query1);
			//   		$stmt1->execute(array($fetch['id']));
			//   		$rowcount1 = $stmt1->rowCount();
			//   		if($rowcount1 > 0){
			//   			while($fetch1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
			//   				$query2 = "SELECT id,name FROM mdl_course_categories WHERE parent = ? AND depth = 3 AND visible = 1 ORDER BY sortorder";
			// 		  		$stmt2 = $db->prepare($query2);
			// 		  		$stmt2->execute(array($fetch1['id']));
			// 		  		$rowcount2 = $stmt2->rowCount();
			// 		  		// if($rowcount2 > 0){
			// 		  			$subjectarray .= '<optgroup label="'.$fetch1['name'].'">';
			// 		  			while($fetch2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
			// 		  				$query3 = "SELECT id,name FROM mdl_course_categories WHERE parent = ? AND depth = 4 AND visible = 1 ORDER BY sortorder";
			// 				  		$stmt3 = $db->prepare($query3);
			// 				  		$stmt3->execute(array($fetch2['id']));
			// 				  		$rowcount3 = $stmt3->rowCount();
			// 				  		if($rowcount3 > 0){
			// 				  			$subjectarray .= '<optgroup label="&nbsp;&nbsp;&nbsp;&nbsp;'.$fetch2['name'].'">';
			// 				  			while($fetch3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
			// 				  				$subjectarray .= '<option value="'.$fetch3['id'].'">&nbsp;&nbsp;&nbsp;&nbsp;'.$fetch3['name'].'</option>';
			// 			  				}
			// 			  				$subjectarray .= '</optgroup>';
			// 		  				} else {
			// 		  					$subjectarray .= '<option value="'.$fetch2['id'].'">'.$fetch2['name'].'</option>';
			// 		  				}
			//   					}
			// 		  			$subjectarray .= '</optgroup>';
			// 	  			} else {
			// 	  				$subjectarray .= '<option value="'.$fetch1['id'].'">'.$fetch1['name'].'</option>';
			// 	  			}
			//   			}
		  	// 		} else {
		  	// 			$subjectarray .= '<option value="'.$fetch['id'].'">'.$fetch['name'].'</option>';
		  	// 		}
	  		// 	}
	  		// 	return $subjectarray;
  			// }
		}
		return $subjectarray;

  		
  	}catch(Exception $exp){

		print_r($exp);
		return "false";
	}
}

//get Subject
function getSubject_array_format($class_auto_id)
{
	global $db;
	try{
		$topics = array();
		if($class_auto_id != "") {
			$classsearch = "CLASS ".$class_auto_id;
		  	$query = "SELECT id FROM mdl_course_categories WHERE name = ? AND depth = 1 AND visible = 1";
	  		$stmt = $db->prepare($query);
	  		$stmt->execute(array($classsearch));
	  		$rowcount = $stmt->rowCount();
	  		if($rowcount > 0){
	  			while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
	  				$query1 = "SELECT id,name FROM mdl_course_categories WHERE parent = ? AND depth = 2 AND visible = 1 ORDER BY sortorder";
			  		$stmt1 = $db->prepare($query1);
			  		$stmt1->execute(array($fetch['id']));
			  		$rowcount1 = $stmt1->rowCount();
			  		$subjectarray = array();
			  		if($rowcount1 > 0){
			  			while($fetch1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
			  				$query2 = "SELECT id,name FROM mdl_course_categories WHERE parent = ? AND depth = 3 AND visible = 1 ORDER BY sortorder";
					  		$stmt2 = $db->prepare($query2);
					  		$stmt2->execute(array($fetch1['id']));
					  		$rowcount2 = $stmt2->rowCount();
					  		if($rowcount2 > 0){
					  			while($fetch2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
					  				$query3 = "SELECT id,name FROM mdl_course_categories WHERE parent = ? AND depth = 4 AND visible = 1 ORDER BY sortorder";
							  		$stmt3 = $db->prepare($query3);
							  		$stmt3->execute(array($fetch2['id']));
							  		$rowcount3 = $stmt3->rowCount();
							  		if($rowcount3 > 0){
							  			while($fetch3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
							  				$subjectarray[$fetch3['id']] = $fetch3['name'];
						  				}
						  			} else {
					  					$subjectarray[$fetch2['id']]= $fetch2['name'];
					  				}
			  					}
					  		} else {
				  				$subjectarray[$fetch1['id']]= $fetch1['name'];
				  			}
			  			}
		  			} else {
		  				$subjectarray[$fetch1['id']]= $fetch1['name'];
		  			}
	  			}
	  			return $subjectarray;
  			}
		}
  		$rowcount = $stmt->rowCount();
  		
  	}catch(Exception $exp){

		print_r($exp);
		return "false";
	}
}

//get hidden chapters allso
function getChapters($sub_id)
{
	global $db;
	try{
		$chapters = array();
		if($sub_id != "") {
			$query = "SELECT id, fullname FROM mdl_course WHERE category = ? ORDER BY sortorder";
	  		$stmt = $db->prepare($query);
	  		$stmt->execute(array($sub_id));
	  		$rowcount = $stmt->rowCount();
	  		if($rowcount > 0){
	  			$chapter_arr = array();
	  			while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
	  				$chapter_arr['id'] = $fetch['id'];
  					$chapter_arr['description'] = $fetch['fullname'];
  					
  					//geting task id with assign teacher id using - course id
  					$chapter_arr['task_id'] = "";
  					$chapter_arr['teacher_id'] = "";
  					$query1 = "SELECT id, assigned_to FROM tasks WHERE courseid = ?";
			  		$stmt1 = $db->prepare($query1);
			  		$stmt1->execute(array($fetch['id']));
			  		$rowcount1 = $stmt1->rowCount();
			  		if($rowcount1 > 0){
			  			$chapter_arr = array();
			  			while($fetch1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
			  				$chapter_arr['id'] = $fetch['id'];
  							$chapter_arr['description'] = $fetch['fullname'];
			  				$chapter_arr['task_id'] = $fetch1['id'];
  							$chapter_arr['teacher_id'] = $fetch1['assigned_to'];

  							array_push($chapters, $chapter_arr);
		  				}
	  				} else {
	  					array_push($chapters, $chapter_arr);
  					}
	  			}
  			}
		}
		return $chapters;		
  	}catch(Exception $exp){

		print_r($exp);
		return "false";
	}
}

function getAssignedSubjects($class, $userid, $module) {
	global $db;
	try {
		$courseids = array();
		$categories = array();
		$subjects = array();
		$optionsHTML = '<option value="">-Select Subject-</option>';
		if($module == "CW") {
			$records = GetRecords("tasks", array("class"=>$class, "assigned_to"=>$userid));
			foreach($records as $record) {
				array_push($courseids, $record['courseid']);
			}
		} else if($module == "RC") {
			$records = GetQueryRecords("SELECT DISTINCT(courseid) FROM tasks WHERE id IN (SELECT DISTINCT(task_id) FROM tasks_details WHERE status_id = 19)", array("class"=>$class));
			foreach($records as $record) {
				array_push($courseids, $record['courseid']);
			}
		}
		
		if(count($courseids) > 0) {
			$course_string = implode(",", $courseids);
			$records1 = GetQueryRecords("SELECT DISTINCT(category) AS category FROM mdl_course WHERE id IN ($course_string)");
			foreach($records1 as $record1) {
				array_push($categories, $record1['category']);
			}
			$categories_string = implode(",", $categories);
			$records2 = GetQueryRecords("SELECT DISTINCT(path) AS path FROM mdl_course_categories WHERE id IN ($categories_string)");
			foreach($records2 as $record2) {
				$path = $record2['path'];
				$temp = explode("/", $path);
				$temp = array_filter($temp);
				foreach($temp as $value) {
					array_push($categories, $value);
				}
			}
			//Remove Duplicates
			$categories = array_unique($categories);
			$categories_string = implode(",", $categories);
			//Get L2
			$records2 = GetQueryRecords("SELECT id, name FROM mdl_course_categories WHERE id IN ($categories_string) AND visible = 1 AND depth = 2 ORDER BY sortorder");
			foreach($records2 as $record2) {
				$thisSubject = array();
				$thisSubject['id'] = $record2['id'];
				$thisSubject['name'] = $record2['name'];
				$child = array();
				$records3 = GetQueryRecords("SELECT id, name FROM mdl_course_categories WHERE id IN ($categories_string) AND parent = ? AND visible = 1 AND depth = 3 ORDER BY sortorder", array($record2['id']));
				if(count($records3) > 0) {
					$optionsHTML .= '<optgroup label="'.$record2['name'].'">';
				} else {
					$optionsHTML .= '<option value="'.$record2['id']."\">".$record2['name'].'</option>';
				}
				foreach($records3 as $record3) {
					$thisSubject2 = array();
					$thisSubject2['id'] = $record3['id'];
					$thisSubject2['name'] = $record3['name'];
					$child2 = array();

					$records4 = GetQueryRecords("SELECT id, name FROM mdl_course_categories WHERE id IN ($categories_string) AND parent = ? AND visible = 1 AND depth = 4 ORDER BY sortorder", array($record3['id']));
					if(count($records4) > 0) {
						$optionsHTML .= '<optgroup label="'.$record3['name'].'">';
					} else {
						$optionsHTML .= '<option value="'.$record3['id']."\">".$record3['name'].'</option>';
					}
					foreach($records4 as $record4) {
						$thisSubject3 = array();
						$thisSubject3['id'] = $record4['id'];
						$thisSubject3['name'] = $record4['name'];
						array_push($child2, $thisSubject3);
						$optionsHTML .= '<option value="'.$record4['id']."\">".$record4['name'].'</option>';
					}
					if(count($child2) > 0) {
						$thisSubject2['child'] = $child2;
						$optionsHTML .= '</optgroup>';
					}
					array_push($child, $thisSubject2);
				}
				if(count($child) > 0) {
					$thisSubject['child'] = $child;
					$optionsHTML .= '</optgroup>';
				}
				array_push($subjects, $thisSubject);
			}
			return array("Array"=>$subjects, "OptionsHTML"=>$optionsHTML);
		}
	} catch(Exception $exp) {

	}
}

function getSubjectHierarchy($categoryid) {
	global $db;
	$categoryInfo = GetRecord('mdl_course_categories', array('id' => $categoryid));
	if($categoryInfo) {
		$result[] = $categoryInfo['name'];
		$path = $categoryInfo['path'];
		$temp = explode("/", $path);
		unset($temp[count($temp)-1]);
		$temp = array_filter($temp);
		$temp = array_reverse($temp);
		foreach ($temp as $key => $value) {
			$info = GetRecord('mdl_course_categories', array('id' => $value));
			$result[] = $info['name'];
		}
	}
	return array_reverse($result);
}

function getApplicableCourses($categoryid, $userid) {
	global $db;
	$records = GetQueryRecords("SELECT id, fullname FROM mdl_course WHERE category = ? AND id IN (SELECT courseid FROM tasks WHERE assigned_to = ?) ORDER BY sortorder", array($categoryid, $userid));
	foreach($records as $key=>$record) {
		$course_id = $record['id'];
		$taskInfo = GetRecord("tasks", array("courseid"=>$course_id), array("id"));
		$records[$key]['TaskAssignID'] = $taskInfo['id'];
		$records[$key]['Class'] = $taskInfo['class'];
		$records[$key]['Status'] = $taskInfo['final_status_id'];
	}
	return $records;
}

function getReviewCourses($categoryid, $statusid) {
	global $db;
	$records = GetQueryRecords("SELECT id, fullname FROM mdl_course WHERE category = ? AND id IN (SELECT courseid FROM tasks WHERE final_status_id = ?) ORDER BY sortorder", array($categoryid, $statusid));
	foreach($records as $key=>$record) {
		$course_id = $record['id'];
		$taskInfo = GetRecord("tasks", array("courseid"=>$course_id), array("id"));
		$records[$key]['TaskAssignID'] = $taskInfo['id'];
		$records[$key]['Class'] = $taskInfo['class'];
		$records[$key]['AssignedTo'] = $taskInfo['assigned_to'];
	}
	return $records;
}

function GetContentEnableSubjectsOld($class, $section, $userid, $role_id)
{
	global $db;
	try {
		$courseids = array();
		$categories = array();
		$subjects = array();
		$optionsHTML = '<option value="">-Select Subject-</option>';
		$cond = "";
		if($role_id == "9") {
			//Get respective categories
			$records = GetRecords("teacher_subject_mapping", array("class"=>$class, "section"=>$section, "user_id"=>$userid));
			foreach($records as $record) {
				$categories[] = $record['courseid'];
			}
			$categories_string = implode(",", $categories);
			$records2 = GetQueryRecords("SELECT id, level FROM  cpmodules WHERE id IN ($categories_string)");
			foreach($records2 as $record2) {
				$path = $record2['path'];
				$temp = explode("/", $path);
				$temp = array_filter($temp);
				foreach($temp as $value) {
					array_push($categories, $value);
				}
				//Get Child Categories
				$records3 = GetRecords("mdl_course_categories", array("parent"=>$record2['id'], "depth"=>$record2['depth']+1, "visible"=>1));
				foreach($records3 as $record3) {
					array_push($categories, $record3['id']);
				}
			}
			//Remove Duplicates
			$categories = array_unique($categories);
			$categories_string = implode(",", $categories);
			if($categories_string != '') {
				$cond = "id IN ($categories_string) AND";
			} else {
				$cond = "id IN (0) AND";
			}
		}
		//Get Class Category
		$categoryInfo = GetRecord("master_class", array("code"=>$class));
		$parent_category_id = $categoryInfo['categoryid'];
		//Get L2
		$records2 = GetQueryRecords("SELECT id, name FROM mdl_course_categories WHERE $cond parent = ? AND visible = 1 AND depth = 2 ORDER BY sortorder", array($parent_category_id));
		foreach($records2 as $record2) {
			$thisSubject = array();
			$thisSubject['id'] = $record2['id'];
			$thisSubject['name'] = $record2['name'];
			$child = array();
			$records3 = GetQueryRecords("SELECT id, name FROM mdl_course_categories WHERE $cond parent = ? AND visible = 1 AND depth = 3 ORDER BY sortorder", array($record2['id']));
			if(count($records3) > 0) {
				$optionsHTML .= '<optgroup label="'.$record2['name'].'">';
			} else {
				$optionsHTML .= '<option value="'.$record2['id']."\">".$record2['name'].'</option>';
			}
			foreach($records3 as $record3) {
				$thisSubject2 = array();
				$thisSubject2['id'] = $record3['id'];
				$thisSubject2['name'] = $record3['name'];
				$child2 = array();

				$records4 = GetQueryRecords("SELECT id, name FROM mdl_course_categories WHERE $cond parent = ? AND visible = 1 AND depth = 4 ORDER BY sortorder", array($record3['id']));
				if(count($records4) > 0) {
					$optionsHTML .= '<optgroup label="'.$record3['name'].'">';
				} else {
					$optionsHTML .= '<option value="'.$record3['id']."\">".$record3['name'].'</option>';
				}
				foreach($records4 as $record4) {
					$thisSubject3 = array();
					$thisSubject3['id'] = $record4['id'];
					$thisSubject3['name'] = $record4['name'];
					array_push($child2, $thisSubject3);
					$optionsHTML .= '<option value="'.$record4['id']."\">".$record4['name'].'</option>';
				}
				if(count($child2) > 0) {
					$thisSubject2['child'] = $child2;
					$optionsHTML .= '</optgroup>';
				}
				array_push($child, $thisSubject2);
			}
			if(count($child) > 0) {
				$thisSubject['child'] = $child;
				$optionsHTML .= '</optgroup>';
			}
			array_push($subjects, $thisSubject);
		}
		return array("Array"=>$subjects, "OptionsHTML"=>$optionsHTML);

	} catch(Exception $exp) {
		print_r($exp);
	}
}

function GetContentEnableSubjects($class, $section, $userid, $role_id)
{
	global $db;
	try {
		$courseids = array();
		$categories = array();
		$subjects = array();
		$optionsHTML = '<option value="">-Select Subject-</option>';
		$cond = "";
		if($role_id == "9") {
			//Get respective categories
			$records = GetRecords("teacher_subject_mapping", array("class"=>$class, "section"=>$section, "user_id"=>$userid));
			foreach($records as $record) {
				$categories[] = $record['courseid'];
			}
			$categories_string = implode(",", $categories);
			// $records2 = GetQueryRecords("SELECT id, level FROM  cpmodules WHERE id IN ($categories_string)");
			// foreach($records2 as $record2) {
			// 	$path = $record2['path'];
			// 	$temp = explode("/", $path);
			// 	$temp = array_filter($temp);
			// 	foreach($temp as $value) {
			// 		array_push($categories, $value);
			// 	}
			// 	//Get Child Categories
			// 	$records3 = GetRecords("mdl_course_categories", array("parent"=>$record2['id'], "depth"=>$record2['depth']+1, "visible"=>1));
			// 	foreach($records3 as $record3) {
			// 		array_push($categories, $record3['id']);
			// 	}
			// }
			//Remove Duplicates
			$categories = array_unique($categories);
			$categories_string = implode(",", $categories);
			if($categories_string != '') {
				$cond = "id IN ($categories_string) AND";
			} else {
				$cond = "id IN (0) AND";
			}
		}
		//Get Class Category
		$categoryInfo = GetRecord("cpmodules", array("id"=>$class));
		// $parent_category_id = $categoryInfo['category_id'];
		$parent_category_id = $categoryInfo['category_id'];
		//Get L2
		$records2 = GetQueryRecords("SELECT id, module FROM cpmodules WHERE parentId = ? AND level = 2 AND type = 'subject' ORDER BY id", array($class));
		$optionsHTML = '<option value="">-Select Subject-</option>';
		foreach($records2 as $record2) {
			$thisSubject = array();
			$thisSubject['id'] = $record2['id'];
			$thisSubject['name'] = $record2['module'];
			$child = array();
			// $optionsHTML .= '<optgroup label="'.$record2['module'].'">';
			$optionsHTML .= '<option value="'.$record2['id']."\">".$record2['module'].'</option>';
			// $optionsHTML .= '</optgroup>';

			
		}
		return array("OptionsHTML"=>$optionsHTML);

	} catch(Exception $exp) {
		print_r($exp);
	}
}