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
function getClasses() {
	try {
		$records = GetRecords("cpmodules", array("parentId"=>0,"visibility"=>1));
		return $records;
	} catch(Exception $exp) {
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

function getClassFromteacher_subject_mapping($userid){
	global $db;
	$records = GetRecords("teacher_subject_mapping", array("user_id"=>$userid));
	$classes = array();
	foreach($records as $record) {
		if(!in_array($record['class'], $classes))
			array_push($classes, $record['class']);		
	}

	return $classes;
}

?>