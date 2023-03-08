<?php
function GetAssignmentsList($subject_id, $cmid = "All") {
	try {
		$course_id = GetCreateCourseID4Assessment($subject_id, "Assignments");
		if($cmid == "All") {
			$cmids = GetRecords("mdl_course_modules", array("course"=>$course_id));
		} else {
			$cmids = GetRecords("mdl_course_modules", array("course"=>$course_id, "id"=>$cmid));
		}
		$list = array();
		$file_arr = array();
		$fileArr = array();
		$files_text = "";
		$intro = "";
		$grade = "";
		$links_text = "";
		$dueby = '';
		$duedatetime = '';
		foreach($cmids as $cmid) {
			$module_id = $cmid['module'];
			$moduleInfo = GetRecord("mdl_modules", array("id"=>$module_id));
			$mod_name = $moduleInfo['name'];
			$table_name = "mdl_".$mod_name;
			$instance_id = $cmid['instance'];
			if($table_name == "mdl_quiz") {
				$info = GetRecord($table_name, array("id"=>$instance_id));
				$title = $info['name'];
				$duedate = "";
				$file_arr = array();
				$files_text = $links_text = $duedatetime = "";
			} else if($table_name == "mdl_assign") {
				$info = GetRecord($table_name, array("id"=>$instance_id));
				$title = $info['name'];
				$intro = $info['intro'];
				$grade = $info['grade'];
				$duedatetime = date("j-M-Y H:i", $info['duedate']);
				$duedate = date("j-M-Y", $info['duedate']);
				$dueby = date("H:i", $info['duedate']);

				//Files 
				
				$files = GetRecords("pms_assignment_files", array("assignment_id"=>$instance_id));
				
				if(count($files) == 0) {
					$files_text = "N/A";
				}

				if(!empty($files)){
					foreach($files as $file){
						$file_arr[] = [
							'name' => $file['upload_filename'],
							'upload_path' => $file['upload_path']
						];
					}
					$files_text = implode(', ', array_column($files, 'upload_filename'));
				}else if(count($files) == 1) {
					$files_text = $files[0]['upload_filename'];
				}
				if(count($files) > 1) {
					$files_text = $files[0]['upload_filename'] . " +" .(count($files)-1);
				}
				//Link
				$link = GetRecord("pms_assignment_links", array("assignment_id"=>$instance_id));
				$links_display = "N/A";
				$links_text = "";
				if($link) {
					$links_display = $links_text = $link['link'];
				}
			}
			$list[] = array("cmid"=>$cmid['id'], "module"=>$module_id, "title"=>$title, "duedate"=>$duedate, "files"=>$file_arr, "files_text" => $files_text, "link"=>$links_text, "link_actual"=>$links_text, "instance_id"=>$cmid['instance'], "intro"=>$intro, "grade"=>$grade, "module_name"=>$mod_name, "dueby"=>$dueby, "duedatetime"=>$duedatetime);
		}
		return $list;
	} catch(Exception $exp) {
		echo "<pre />";
		print_r($exp);
	}
}