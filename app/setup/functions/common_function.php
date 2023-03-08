<?php
	function getCPClasses()
	{
		global $db;
		try{
			$data = array();
			$class_arr = GetRecords("cpmodules", array("parentId"=>0,"visibility"=>1));
			$data['classes'] = $class_arr;
			return $data;
		} catch(Exception $exp) {
			echo "<pre/>";
			print_r($exp);
		}
	}
	function getClassNames($visible) {
	try {
		$classes = array();
		$query = "SELECT id, module,category_id FROM cpmodules WHERE parentId = 0";
		if($visible != "All") {
			$query .= " AND visibility = $visible";
		}
		$query .= "  ORDER BY sequence";
		$records = GetQueryRecords($query);
		return $records;
	} catch(Exception $exp) {
		print_r($exp);
	}
}
function getSectionsData() {
	global $db;
	try {
		$classList = array();
		$query = "SELECT id, module FROM cpmodules WHERE parentId = 0 AND visibility = 1 ORDER BY sequence";
		$records = GetQueryRecords($query);
		
		$response = array();
		foreach($records as $rows) {
			$sections = array();
			$query1 = "SELECT id, section FROM masters_sections WHERE class = '".$rows['id']."' ORDER BY sequence";
			$stmt1 = $db->query($query1);
			$rowcount1 = $stmt1->rowCount();
			while($rows1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
				array_push($sections, array("Section"=>$rows1['section'], "id"=>$rows1['id']));
				
			}
			$response[$rows['id']] = $sections;
			
		}
		return $response;
	} catch(Exception $exp) {
		print_r($exp);
	}
}

function getClassesAssigned($teacher_id) {
	$records = GetRecords("teacher_subject_mapping", array("user_id"=>$teacher_id));
	//print_r($records);
	$division = '';
	if (!empty($records)) {
	foreach($records as $keyid=>$classid){
		$division .='<div class="d-flex align-items-center position-relative  cmt mb-3">';
					$division.='<div class="col-4">
						<div class="form-group">';
						$records_class = GetRecords("cpmodules", array("level" => 1,"type" => "class","visibility"=>1));
						$division.='<select class="form-control class select" id="selectclass" name="class[]" >
						<option value="">-Choose Class-</option>';
							foreach($records_class as $keyclass=>$valueclass){
								$selected ="";
								if($classid['class'] == $valueclass['id']){
									$selected = ' selected="selected"';
									
								}else{
									$selected = "";
								}
							$division.="<option value=".$valueclass['id'].'-'.$valueclass['category_id']."". $selected.">".$valueclass['module']."</option>";
							
						}
			$division .='</select></div></div>';
			$division.='<div class="col-4">
						<div class="form-group">';
						$getSection = GetRecords("masters_sections", array("class"=>$classid['class']));
						$division.='<select class="form-control section" id="sectionOptionSection" name="section[]" value="">
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
						$records_class = GetRecords("cpmodules", array("id"=>$classid['class']));
						$division.='<select class="form-control subject select_remove_space" id="sectionOptionSubject" name="subject[]">
						<option value="">-Choose Subject-</option>';
						//print_r($records_class);
						$getSubjects = GetRecords("cpmodules", array("parentId"=>$records_class[0]['id'],"type" =>"subject"));
						//$division = '<option value="">-Choose Subject-</option>';
						foreach($getSubjects as $key=>$value){
							$selected ="";
								if($classid['courseid'] == $value['id']){
									$selected = ' selected="selected"';
									
								}else{
									$selected = "";
								}	
							
							$division.="<option class=\"font-weight-bold\" value=".$value['id']."". $selected.">".$value['module']."</option>";
							$records1 = GetRecords("cpmodules", array("parentId"=>$value['id'], "visibility"=>1));
							$records[$key]['child'] = $records1;
							foreach($records[$key]['child'] as $key1=>$value1){
								if($classid['courseid'] == $value1['id']){
									$selected = ' selected="selected"';
									
								}else{
									$selected = "";
								}	
								
								$records2 = GetRecords("cpmodules", array("parentId"=>$value1['id'], "visibility"=>1));
								$records[$key]['child'][$key1]['sub_child'] = $records2;

								if(count($records2) > 0) {
									$class_html = "class=\"font-weight-bold\"";
								} else {
									$class_html = "";
								}
								$division.="<option $class_html value=".$value1['id']."". $selected.">&nbsp;&nbsp;".$value1['module']."</option>";

								foreach($records[$key]['child'][$key1]['sub_child'] as $key2=>$value2){
									if($classid['courseid'] == $value2['id']){
										$selected = ' selected="selected"';
										
									}else{
										$selected = "";
									}	
									$division.="<option value=".$value2['id']."". $selected.">&nbsp;&nbsp;&nbsp;&nbsp;".$value2['module']."</option>";

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
	} else {
		$division .='<div class="d-flex align-items-center position-relative  cmt mb-3">';
					$division.='<div class="col-4">
						<div class="form-group">';
						$records_class = GetRecords("cpmodules", array("level" => 1,"type" => "class","visibility"=>1));
						$division.='<select class="form-control class select" id="selectclass1" name="class[]" >
						<option value="" selected>-Choose Class-</option>';
							foreach($records_class as $keyclass=>$valueclass){
								$selected ="";
								
							$division.="<option value=".$valueclass['id'].'-'.$valueclass['category_id']."". $selected.">".$valueclass['module']."</option>";
							
						}
			$division .='</select></div></div>';
		$division.='<div class="col-4">
						<div class="form-group">';
						$division.='<select class="form-control section" id="sectionOptionSection1" name="section[]" value="">
						<option value="">-Choose Section-</option>';
						
			$division .='</select></div></div>';
			$division.='<div class="col-4">
						<div class="form-group">';
						$division.='<select class="form-control subject select_remove_space" id="sectionOptionSubject1" name="subject[]">
						<option value="">-Choose Subject-</option>';
			$division .='</select></div></div>';
	}
	return $division;
}

function getCategoryList() {
	global $db;
	$records = GetRecords("masters_subject_category", array());
	return $records;    
}
function getSubjectListNew() {
	global $db;
	$records = GetQueryRecords("SELECT ms.id, ms.module,msc.name as category_name,ms.parentId as classid FROM cpmodules ms LEFT JOIN masters_subject_category msc ON ms.category_id = msc.id WHERE level = 2 AND type = 'subject' AND deleted = 0 ORDER BY classid, module");
	foreach($records as $key=>$value){
		$records1 = GetQueryRecords("SELECT module, id FROM `cpmodules` WHERE parentId = ? ORDER BY sequence ", array($value['id']));
		//print_r($records1);
		$records[$key]['child'] = $records1;
		foreach($records[$key]['child'] as $key1=>$value1){
			$records2 = GetQueryRecords("SELECT module, id FROM `cpmodules` WHERE parentId = ? ORDER BY sequence ", array($value1['id']));
			//print_r($records1);
			$records[$key]['child'][$key1]['sub_child'] = $records2;
			$recordsnew[$key1]['child'] = $records2;
			foreach($recordsnew[$key1]['child'] as $key2=>$value2){
				$records3 = GetQueryRecords("SELECT module, id FROM `cpmodules` WHERE parentId = ? ORDER BY sequence ", array($value2['id']));
				$records[$key]['child'][$key1]['sub_child'][$key2]['sub_child1'] = $records3;
			}
		}
		$classesarr = [];
		$classstr = '';
		$classes = explode(",", $value["classid"]);
		foreach ($classes as $k => $val) {
			$classnames = GetQueryRecords("SELECT module, id FROM `cpmodules` WHERE id = ?", array($val));
			array_push($classesarr, $classnames[0]["module"]);
		}
		$classstr = implode(",", $classesarr);
		$records[$key]["class"] = $classstr;
		$tasks = GetQueryRecords("SELECT CONCAT(users.first_name, ' ', users.last_name) as name,cptasks.id,cptask_assign.id as task_ass_id,cptask_assign.user_id as task_userid FROM cptasks JOIN cptask_assign ON cptasks.id = cptask_assign.tasks_id JOIN users ON cptask_assign.user_id = users.id WHERE class_id='".$value["classid"]."' AND subject_id = '".$value["id"]."' ORDER BY cptasks.id DESC LIMIT 1");
		if (!empty($tasks)) {
			$cptasksid = $tasks[0]["id"];
			$records[$key]["task_id"] = $cptasksid;
			$records[$key]["assignedname"] = $tasks[0]["name"];
			$records[$key]["task_userid"] = $tasks[0]["task_userid"];
			$records[$key]["task_ass_id"] = $tasks[0]["task_ass_id"];
		} else {
			$cptasksid = '';
			$records[$key]["task_id"] = '';
			$records[$key]["assignedname"] = '';
			$records[$key]["task_userid"] = '';
			$records[$key]["task_ass_id"] = '';
		}
		$taskstatus = GetQueryRecords("SELECT status.name FROM cptasks JOIN status ON cptasks.status_id = status.id WHERE cptasks.id = '".$cptasksid."'");
		if (!empty($taskstatus)) {
			$records[$key]["status"] = $taskstatus[0]["name"];
		} else {
			$records[$key]["status"] = '';
		}
		
	}
	// echo "<pre>";
	// print_r($records);
	// echo "</pre>";
	// exit;
	return($records);
}

function getSubjectList() {
	global $db;
	$records = GetQueryRecords("SELECT ms.id, ms.module,msc.name as category_name,GROUP_CONCAT(ms.parentId) as classid FROM cpmodules ms LEFT JOIN masters_subject_category msc ON ms.category_id = msc.id WHERE level = 2 AND type = 'subject' AND deleted = 0 GROUP BY ms.module,ms.category_id ORDER BY sequence");
	foreach($records as $key=>$value){
		$records1 = GetQueryRecords("SELECT module, id FROM `cpmodules` WHERE parentId = ? ORDER BY sequence ", array($value['id']));
		//print_r($records1);
		$records[$key]['child'] = $records1;
		foreach($records[$key]['child'] as $key1=>$value1){
			$records2 = GetQueryRecords("SELECT module, id FROM `cpmodules` WHERE parentId = ? ORDER BY sequence ", array($value1['id']));
			//print_r($records1);
			$records[$key]['child'][$key1]['sub_child'] = $records2;
		}
		$classesarr = [];
		$classstr = '';
		$classes = explode(",", $value["classid"]);
		foreach ($classes as $k => $val) {
			$classnames = GetQueryRecords("SELECT module, id FROM `cpmodules` WHERE id = ?", array($val));
			array_push($classesarr, $classnames[0]["module"]);
		}
		$classstr = implode(",", $classesarr);
		$records[$key]["class"] = $classstr;
	}
	return($records);
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
?>