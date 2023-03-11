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
				$file_arr[$file['assignment_id']][$file['upload_filename']] = $file['upload_path'];
				$fileupload_arr[$file['assignment_id']][] = $file['upload_path'];
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
				$uploadpath = implode(",", $fileupload_arr[$id]);
				$filename = implode(",", $file_arr[$id]);
				$publishdatetime = $data['publish_date_time'];
				
				$list[] = array("title"=>$title, "duedate"=>$duedate, "link"=>$link, "intro"=>$intro, "files_text"=>$file_arr[$id], "subjectID"=>$subjectID, "id"=>$id,"uploadpath" => $fileupload_arr[$id],"publish_date_time" => $publishdatetime);

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
				$publishdate = $data['publish_date'];
				$publishtime = $data['publish_time'];
				$grade = $data['grade'];
				$class = $data['class'];
				$subjects = getSubject($class);
				$output['subject'] = $subjects;
				$subject = $data['subject'];
				$subject_id = intval($subject);
			    $options = "";
			    $records = GetRecords("cpmodules", array("parentId"=>$subject_id, "level"=>3, "type"=>'chapter'), array("module"));
			    if(count($records) == 0) {
			      $options .= '<option value="">No Chapters added</option>';
			    } else if(count($records) == 1) {
			    $options .= '<option value="">-Select Chapter-</option>';

			      $options .= '<option value="'.$records[0]['id'].'">'.$records[0]['module'].'</option>';
			    } else if(count($records) > 1) {
			      $options .= '<option value="">-Select Chapter-</option>';
			      foreach($records as $record) {
			        // if($record['fullname'] == "Assessments" || $record['fullname'] == "Assignments") {
			        //   continue;
			        // }
			        $options .= '<option value="'.$record['id'].'">'.$record['module'].'</option>';
			      }
			    }
			    $output['course'] = $options;
				$course = $data['course'];
				$topic_id = $course;
			    $options = "";
			    $records = GetRecords("cpmodules", array("parentId"=>$topic_id, "level"=>4, "type"=>'topic'), array("module"));
			    if(count($records) == 0) {
			      $options .= '<option value="">No topics added</option>';
			    } else if(count($records) == 1) {
				  
				  $options .= '<option value="">-Select Chapter-</option>';
			      $options .= '<option value="'.$records[0]['id'].'">'.$records[0]['module'].'</option>';
			    } else if(count($records) > 1) {
			      $options .= '<option value="">-Select Topic-</option>';
			      foreach($records as $record) {
			        // if($record['fullname'] == "Assessments" || $record['fullname'] == "Assignments") {
			        //   continue;
			        // }
			        $options .= '<option value="'.$record['id'].'">'.$record['module'].'</option>';
			      }
			    }
			    $output['topic'] = $options;
				$topic = $data['topic'];
				$subtopic_id = $topic;
			    $options = "";
			    $records = GetRecords("cpmodules", array("parentId"=>$subtopic_id, "level"=>5, "type"=>'subTopic'), array("module"));
			    if(count($records) == 0) {
			      $options .= '<option value="">No Sub Topics added</option>';
			    } else if(count($records) == 1) {
				  $options .= '<option value="">-Select Chapter-</option>';
			      $options .= '<option value="'.$records[0]['id'].'">'.$records[0]['module'].'</option>';
			    } else if(count($records) > 1) {
			      $options .= '<option value="">-Select Sub Topic-</option>';
			      foreach($records as $record) {
			        // if($record['fullname'] == "Assessments" || $record['fullname'] == "Assignments") {
			        //   continue;
			        // }
			        $options .= '<option value="'.$record['id'].'">'.$record['module'].'</option>';
			      }
			    }
			    $output['subtopic'] = $options;
				$subtopic = $data['subtopic'];
				$list[] = array("title"=>$title, "duedate"=>$duedate, "link"=>$link, "date"=>$date, "time"=>$time, "intro"=>$intro, "files"=>$file_arr[$data['id']], "subjectID"=>$subjectID, "id"=>$id,"publish_date" => $publishdate,"publish_time" => $publishtime,"grade" => $grade,"classId" => $class,"subject" => $subject,"course" => $course,"topic" => $topic,"subtopic" => $subtopic,"output" => $output);

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