<?php
function GetAssignmentsList() {
	try {
		
		$files = GetRecords("pms_assignment_files", array());
			
		// print_r($files);
		// exit;
		if(count($files) == 0) {
			$files_text = "N/A";
		}

		if(!empty($files)){
			foreach($files as $file){
				$file_arr[$file['assignment_id']] = $file['upload_filename'];
				// [
					// // 'name' => $file['upload_filename'],
					// 'upload_path' => $file['upload_path']
				// ];
			}
			// $files_text = implode(', ', array_column($files, 'upload_filename'));


		}
		// else if(count($files) == 1) {
		// 	$files_text = $files[0]['upload_filename'];
		// }

		// if(count($files) > 1) {
		// 	$files_text = $files[0]['upload_filename'] . " +" .(count($files)-1);
		// }

				$info = GetRecords("assignment_assign", array());
				// print_r($info);exit;
				$output = [];
				foreach($info as $data){
				
				$title = $data['name'];
				$duedate = $data['duedate'];
				$intro = $data['intro'];
				$link = $data['url_link'];
				$subjectID = $data['subject'];
				$id = $data['id'];
				$list[] = array("title"=>$title, "duedate"=>$duedate, "link"=>$link, "intro"=>$intro, "files_text"=>$file_arr[$data['id']], "subjectID"=>$subjectID, "id"=>$id);

				}
	
				
		// print_r($list);
		// exit;
		return $list;
	} catch(Exception $exp) {
		echo "<pre />";
		print_r($exp);
	}
}

function GetAssignmentsListEdit($id){
	try {
		
		$files = GetRecords("pms_assignment_files", array("assignment_id"=>$id));
			
	
		if(count($files) == 0) {
			$files_text = "N/A";
		}

		if(!empty($files)){
			foreach($files as $file){
				$file_arr[$file['assignment_id']] = [
					'name' => $file['upload_filename'],
					'upload_path' => $file['upload_path']
					];
				}
			}

				$info = GetRecords("assignment_assign", array("id"=>$id));
				// print_r($info);exit;
				$output = [];
				foreach($info as $data){
				
				$title = $data['name'];
				$duedate = $data['duedate'];
				$link = $data['url_link'];
				$intro = $data['intro'];

				$subjectID = $data['subject'];
				$id = $data['id'];
				$date = $data['date'];
				$time = $data['time'];
				$list[] = array("title"=>$title, "duedate"=>$duedate, "link"=>$link, "date"=>$date, "time"=>$time, "intro"=>$intro, "files"=>$file_arr[$data['id']], "subjectID"=>$subjectID, "id"=>$id);

				}
	
				
		// print_r($list);
		// exit;
		return $list;
	} catch(Exception $exp) {
		echo "<pre />";
		print_r($exp);
	}
}
?>