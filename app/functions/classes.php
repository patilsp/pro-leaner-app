<?php

function getClassesCount() {
	try {
		$records = GetRecords("master_class", array("visibility"=>1));
		return count($records);
	} catch(Exception $exp) {
		print_r($exp);
	}
}
function getClasses() {
	try {
		$records = GetRecords("master_class", array("visibility"=>1));
		return $records;
	} catch(Exception $exp) {
		print_r($exp);
	}
}
function getSubjects() {
	try {
		$records = GetRecords("masters_subjects", array("parent" => 0));
		return $records;
	} catch(Exception $exp) {
		print_r($exp);
	}
}
function getDesignation() {
	try {
		$records = GetRecords("designation", array());
		return $records;
	} catch(Exception $exp) {
		print_r($exp);
	}
}

function getDepartments() {
	try {
		$records = GetRecords("department", array());
		return $records;
	} catch(Exception $exp) {
		print_r($exp);
	}
}



function getCourseName($course_id) {
	
	try {
		$records = GetRecords("mdl_course_categories", array("id"=>$course_id));
		return $records[0]['name'];
	} catch(Exception $exp) {
		print_r($exp);
	}
}

function getClassNames($visible) {
	try {
		$classes = array();
		$query = "SELECT mcc.id, mcc.name, mc.visibility, mc.code FROM master_class mc INNER JOIN mdl_course_categories mcc ON mc.categoryid  = mcc.id";
		if($visible != "All") {
			$query .= " WHERE visibility = $visible";
		}
		$query .= "  ORDER BY mc.sequence";
		$records = GetQueryRecords($query);
		return $records;
	} catch(Exception $exp) {
		print_r($exp);
	}
}

function getSections($class) {	
	global $db;
	$classList = array();
	if($class == "All")  {
		$classList  = getClassNames(1);
	} else {
		$classList[] = array("code"=>$class);
	}
	$response = array();
	foreach($classList as $rows) {
		$sections = array();
		$query1 = "SELECT id, section FROM masters_sections WHERE class = '".$rows['code']."' ORDER BY sequence";
		$stmt1 = $db->query($query1);
		$rowcount1 = $stmt1->rowCount();
		while($rows1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
			//Check Student Exists or not
			$records = GetRecords("mdl_user", array("class"=>$rows['code'], "Section"=>$rows1['section'], "deleted"=>0));
			if(count($records) == 0)
				$locked = false;
			else
				$locked = true;
			array_push($sections, array("Section"=>$rows1['section'], "Locked"=>$locked, "id"=>$rows1['id']));
		}
		$response[$rows['code']] = $sections;
	}
	return $response;
}

function getClassesAssigned($teacher_id) {
	$records = GetRecords("teacher_subject_mapping", array("user_id"=>$teacher_id));
	//print_r($records);
	$division = '';
	foreach($records as $keyid=>$classid){
		$division .='<div class="d-flex align-items-center position-relative  cmt mb-3">';
					$division.='<div class="col-4">
						<div class="form-group">';
						$records_class = GetRecords("master_class", array("visibility"=>1));
						$division.='<select class="form-control class select" id="selectclass" name="class" >
						<option value="">-Choose Class-</option>';
							foreach($records_class as $keyclass=>$valueclass){
								$selected ="";
								if($classid['class'] == $valueclass['id']){
									$selected = ' selected="selected"';
									
								}else{
									$selected = "";
								}
							$division.="<option value=".$valueclass['id'].'-'.$valueclass['categoryid']."". $selected.">".$valueclass['code']."</option>";
							
						}
			$division .='</select></div></div>';
			$division.='<div class="col-4">
						<div class="form-group">';
						$getSection = GetRecords("masters_sections", array("class"=>$classid['class']));
						$division.='<select class="form-control section" id="sectionOptionSection" name="section" value="">
						<option value="">-Choose Section-</option>';
							foreach($getSection as $keysection=>$valuesection){
								$selected ="";
								if($classid['section'] == $valuesection['section']){
									$selected = ' selected="selected"';
									
								}else{
									$selected = "";
								}	
							$division.="<option value=".$valuesection['section']."". $selected.">".$valuesection['section']."</option>";
							
						}
			$division .='</select></div></div>';
			$division.='<div class="col-4">
						<div class="form-group">';
						$records_class = GetRecords("master_class", array("id"=>$classid['class']));
						$division.='<select class="form-control subject select_remove_space" id="sectionOptionSubject" name="subject">
						<option value="">-Choose Subject-</option>';
						//print_r($records_class);
						$getSubjects = GetRecords("mdl_course_categories", array("parent"=>$records_class[0]['categoryid'], "visible"=>1));
						//$division = '<option value="">-Choose Subject-</option>';
						foreach($getSubjects as $key=>$value){
							$selected ="";
								if($classid['courseid'] == $value['id']){
									$selected = ' selected="selected"';
									
								}else{
									$selected = "";
								}	
							
							$division.="<option class=\"font-weight-bold\" value=".$value['id']."". $selected.">".$value['name']."</option>";
							$records1 = GetRecords("mdl_course_categories", array("parent"=>$value['id'], "visible"=>1));
							$records[$key]['child'] = $records1;
							foreach($records[$key]['child'] as $key1=>$value1){
								if($classid['courseid'] == $value1['id']){
									$selected = ' selected="selected"';
									
								}else{
									$selected = "";
								}	
								
								$records2 = GetRecords("mdl_course_categories", array("parent"=>$value1['id'], "visible"=>1));
								$records[$key]['child'][$key1]['sub_child'] = $records2;

								if(count($records2) > 0) {
									$class_html = "class=\"font-weight-bold\"";
								} else {
									$class_html = "";
								}
								$division.="<option $class_html value=".$value1['id']."". $selected.">&nbsp;&nbsp;".$value1['name']."</option>";

								foreach($records[$key]['child'][$key1]['sub_child'] as $key2=>$value2){
									if($classid['courseid'] == $value2['id']){
										$selected = ' selected="selected"';
										
									}else{
										$selected = "";
									}	
									$division.="<option value=".$value2['id']."". $selected.">&nbsp;&nbsp;&nbsp;&nbsp;".$value2['name']."</option>";

								}
							}
						}
						
			$division .='</select></div></div>';
			if($keyid != 0){
				$division .='<button type="button" class="remove d-none " style="display:block !important" ><i class="fa fa-times"></i></button>';
			}else{
				$division .='<button type="button" class="remove d-none " ><i class="fa fa-times"></i></button>';
			}
			
		$division .='</div>';
	}
	return $division;
}

function getCWClasses($userid) {
	try {
		$records = GetQueryRecords("SELECT * FROM master_class WHERE visibility = 1 AND id IN (SELECT DISTINCT(class) FROM tasks WHERE assigned_to = ?)", array($userid));
		return $records;
	} catch(Exception $exp) {
		print_r($exp);
	}	
}

function getRCClasses($userid) {
	try {
		$records = GetQueryRecords("SELECT * FROM master_class WHERE visibility = 1 AND id IN (SELECT DISTINCT(class) FROM tasks WHERE id IN (SELECT DISTINCT(task_id) FROM tasks_details WHERE status_id = 19))");
		return $records;
	} catch(Exception $exp) {
		print_r($exp);
	}	
}