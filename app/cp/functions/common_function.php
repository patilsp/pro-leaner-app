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
?>