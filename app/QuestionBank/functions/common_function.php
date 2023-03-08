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
	// function getHierarchy($courseid) {
	// 	global $db;
	// 	$categoryInfo = GetRecord('cpmodules', array('id'=> $courseid));
	// 	$category = $categoryInfo['category_id'];
	// 	$pathInfo = GetRecord('cpmodules', array('id' => $category));
	// 	$path = $pathInfo['path'];
	// 	$path = explode("/",$path);
	// 	$all_ids = $path = array_values(array_filter($path));
	// 	$classInfo = GetRecord('master_class', array('categoryid' => $path[0]));
	// 	$path_names = array();
	// 	foreach($all_ids as $id) {
	// 		$info = GetRecord("mdl_course_categories", array("id"=>$id));
	// 		$path_names[] = $info['name'];
	// 	}
	// 	$path_names = array_unique($path_names);
	// 	return array("L0ID"=>$path[0], "class"=>$classInfo['code'], "courseCategory"=>$category, "pathNames"=>$path_names);
	// }
	function getHierarchy($courseid) {
		global $db;
		$categoryInfo = GetRecord('cpmodules', array('id'=> $courseid));
		$subject = $categoryInfo["parentId"];
		$classInfo = GetRecord('cpmodules', array('id'=> $subject));
		$classid = $classInfo["parentId"];
		return array("class"=>$classid, "subject"=>$subject);

	}
    ?>