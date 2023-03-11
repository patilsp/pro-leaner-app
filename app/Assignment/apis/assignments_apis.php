<?php session_start();
include "../../configration/config.php";
require_once "../../functions/db_functions.php";
// require_once "../../functions/lessons.php";
// require_once "../../functions/courses.php";
require_once "../../functions/questions.php";
require_once "../../functions/assignments.php";
require_once "../../functions/subjects.php";

$type = $_POST['type'];
$output = array();
$output['status'] = false;
$output['message'] = "";
$status = false;
$message = "";
$snackbar = false;
$login_userid = isset($_SESSION['cms_userid'])?$_SESSION['cms_userid']:NULL;
// print_r($_SESSION);
// exit;
if($type == "updatemodal") {
	$cmid = intval($_POST['cmid']);
	$mdl_crse_data = GetRecord("assignment_assign", array("id"=>$cmid));
	$id = $cmid;

	$name = getSanitizedData($_POST['name']);
	$intro = getSanitizedData($_POST['intro']);
	

	$date = date('Y-m-d', strtotime($_POST['att_date']));
	$time = $_POST['due_by'];
	$class = $_POST["selectedClass"];
	$selectedSubject = $_POST["selectedSubject"];
	$course = $_POST["course"];
	$topic = $_POST["topic"];
	$subtopic = $_POST["subtopic"];

	if($date != "" && $time != "") {
		$duedate = strtotime("$date $time");
	} else if($date != "" && $time ==  "") {
		$duedate = strtotime("$date 23:59:59");
	} else {
		$duedate = 0;
	}
	$duedate = date('Y-m-d H:i:s', strtotime("$date $time"));

	$url_link = getSanitizedData($_POST['url_link']);
	$grade = $_POST["grade"];

	$query = "UPDATE assignment_assign SET name = ?, intro = ?, duedate = ?, url_link = ?, date = ?, time = ?,grade = ?,class = ?,subject = ?,course = ?,topic = ?,subtopic = ?  WHERE id = ?";
	$stmt = $db->prepare($query);
	$stmt->execute(array($name, $intro, $duedate, $url_link, $date, $time,$grade,$class,$selectedSubject,$course,$topic,$subtopic,$cmid));

	
	
	unset($_FILES['upload_documents']);
	$_POST['del'] = explode(",",$_POST['del']);
	
	if(! empty($_POST['del'][0])){
		foreach($_FILES as $key => $val){			
			if (in_array($key, $_POST['del'])){
				unset($_FILES[$key]);
			}
		}
	}

	if(isset($_FILES)) {
		foreach($_FILES as $key => $val){
			$orginal_name = $val['name'];
			
			$data = [
				"orginal_name" => $orginal_name,
				"uploaded_by" => $login_userid,
				"uploaded_on" => date("Y-m-d H:i:s")
			];
			
			$new_file_name = $login_userid.$id;
			$ext = pathinfo($orginal_name, PATHINFO_EXTENSION);
			$new_folder = "../../../storage/assignment/$id/";
			if(! file_exists($new_folder)) {
				mkdir($new_folder, 0777, true);
			}
			$new_path = $new_folder.$new_file_name.".$ext";
			move_uploaded_file($val["tmp_name"], $new_path);
			$save_path = "storage/assignment/$id/".$new_file_name.".".$ext;	

			$fileInsertArr = [
				"assignment_id" => $id,
				"type" => "assignment",
				"student_id" => 0,
				"upload_path" => $save_path,
				"upload_filename" => $orginal_name,
				"created_by" => $login_userid,
				"created_on	" => date("Y-m-d H:i:s"),
			];

			$fileid = InsertRecord("pms_assignment_files", $fileInsertArr);
		}	
	}
	
	$status = true;
	$output['Result'] = null;
	$snackbar = true;
	$message = "Assignment updated successfully";

} else if($type == "editmodal") {
	$list = GetAssignmentsListEdit($_POST['cmid']);
	$status = true;
	$output['Result'] = $list;
} else if($type == "deletemodal") {
	$cmid = intval($_POST['id']);
	$mdl_course_data = GetRecord("mdl_course_modules", array("id"=>$cmid));
	$mdl_module_data = GetRecord("mdl_modules", array("id"=>$mdl_course_data['module']));

	$name = $mdl_module_data['name'];
	$course_id = $mdl_course_data['course'];

	if($name == "assign") {
		$mdl_data = DeleteRecord("mdl_assign", array("id"=>$_POST['id']));
		$mdl_data_link = DeleteRecord("pms_assignment_links", array("assignment_id"=>$_POST['id']));
		$mdl_data_file = DeleteRecord("pms_assignment_files", array("assignment_id"=>$_POST['id']));
	} else if($name == "quiz") {
		$mdl_data = DeleteRecord("mdl_quiz", array("id"=>$mdl_course_data['instance']));
	}

	$sectionInfo = GetRecord("mdl_course_sections", array("course"=>$course_id, "section"=>1));
	$section_id = $sectionInfo['id'];	
	$sequences = $sectionInfo['sequence'];
	$ids = explode(",", $sequences);
	$new_sequences = array_diff($ids, array($cmid));
	$string = implode(",", $new_sequences);

	$query = "UPDATE mdl_course_sections SET sequence = ? WHERE id = ?";
	$stmt = $db->prepare($query);
	$stmt->execute(array($string, $sectionInfo['id']));

	$query = "DELETE FROM mdl_course_modules WHERE id = ?";
	$stmt = $db->prepare($query);
	$stmt->execute(array($cmid));
	$status = true;
	$output['Result'] = true;
	$snackbar = true;
	$message = "Assignment deleted successfully";
}else if($type == "getCourses") {
    $subject_id = intval($_POST['subject_id']);
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
    $status = true;
    $output['Result'] = $options;
  }
  else if($type == "displayQuestions") {
   $questionsList = GetRecord("assignment_assign",array());
	echo "<pre>";
	print_r($questionsList);
	echo "</pre>";
	exit;
  	$output['Result'] = $questionsList;
    $status = true;
  }
  else if($type == "getTopic") {
    $topic_id = intval($_POST['topic_id']);
    $options = "";
    $records = GetRecords("cpmodules", array("parentId"=>$topic_id, "level"=>4, "type"=>'topic'), array("module"));
    if(count($records) == 0) {
      $options .= '<option value="">No topics added</option>';
    } else if(count($records) == 1) {
	  
	  $options .= '<option value="">-Select Topic-</option>';
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
    $status = true;
    $output['Result'] = $options;
  }else if($type == "getSubTopic") {
    $subtopic_id = intval($_POST['subtopic_id']);
    $options = "";
    $records = GetRecords("cpmodules", array("parentId"=>$subtopic_id, "level"=>5, "type"=>'subTopic'), array("module"));
    if(count($records) == 0) {
      $options .= '<option value="">No Sub Topics added</option>';
    } else if(count($records) == 1) {
	  $options .= '<option value="">-Select Sub Topic-</option>';
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
    $status = true;
    $output['Result'] = $options;
  } else if($type == "addAssignment") {
	
	$date = $_POST['att_date'];
	$time = $_POST['due_by'];

	$publish_date = date('Y-m-d', strtotime($_POST['publish_date']));;
	$publish_time = $_POST['publish_time'];

	if($date != "" && $time != "") {
		$duedate = strtotime("$date $time");
	} else if($date != "" && $time ==  "") {
		$duedate = strtotime("$date 23:59:59");
	} else {
		$duedate = 0;
	}
	if($publish_date != "" && $publish_time != "") {
		$publishdate = strtotime("$publish_date $publish_time");
	} else if($publish_date != "" && $time ==  "") {
		$publishdate = strtotime("$publish_date 23:59:59");
	} else {
		$publishdate = 0;
	}
	$class = $_POST['selectedClass'];
    $classdb = $class;
    
	$duedate = date('Y-m-d H:i:s', strtotime("$date $time"));
	$publishdate = date('Y-m-d H:i:s', strtotime("$publish_date $publish_time"));
	
	$insertArr = [
		"class" =>	 $classdb,
		"subject" => $_POST['selectedSubject'],
		"course" =>	 $_POST['course'],
		"topic" =>	 $_POST['topic'],
		"subtopic" =>$_POST['subtopic'],
        "name" => getSanitizedData($_POST['name']),
		"intro" => getSanitizedData($_POST['intro']),
        "duedate" => $duedate,
		"url_link" => getSanitizedData($_POST['url_link']),	
		"date"=> date('Y-m-d', strtotime($_POST['att_date'])),
		"time" => $_POST['due_by'],
		"publish_date" => $publish_date,
		"publish_time" => $_POST['publish_time'],
		"publish_date_time" => $publishdate,
		"grade" => $_POST["grade"],

		"timemodified" => time()
	
	];
	
	$autoid = InsertRecord("assignment_assign", $insertArr);
	// print_r($autoid);
	// exit;
	unset($_FILES['upload_documents']);
	$_POST['del'] = explode(",",$_POST['del']);
	
	if(! empty($_POST['del'][0])){
		foreach($_FILES as $key => $val){			
			if (in_array($key, $_POST['del'])){
				unset($_FILES[$key]);
			}
		}
	}
	$save_path = '';
	if(isset($_FILES)) {
		foreach($_FILES as $key => $val){
			$orginal_name = $val['name'];
			
			$new_file_name = $login_userid.$autoid.time();
			$ext = pathinfo($orginal_name, PATHINFO_EXTENSION);
			$new_folder = "../../../storage/assignment/$autoid/";
			if(! file_exists($new_folder)) {
				mkdir($new_folder, 0777, true);
			}
			$new_path = $new_folder.$new_file_name.".$ext";
			move_uploaded_file($val["tmp_name"], $new_path);
			$save_path = "storage/assignment/$autoid/".$new_file_name.".".$ext;

			$fileInsertArr = [
				
				"assignment_id" => $autoid,
				"type" => "assignment",
				"student_id" => 0,
				"upload_path" => $save_path,
				"upload_filename" => $orginal_name,
				// "created_by" => $login_userid,
				"created_on	" => date("Y-m-d H:i:s"),
			];

			$fileid = InsertRecord("pms_assignment_files", $fileInsertArr);

			
		}	
	}
	$status = true;
	$output['Result'] = $save_path;
	$message = "Assignment created successfully";
	$snackbar = true;
}
// end
$output['status'] = $status;
$output['message'] = $message;
if($snackbar && $output['status']) {
	if($status) {
		$_SESSION['sb_heading'] = "Success!";
	} else {
		$_SESSION['sb_heading'] = "Notice!";
	}
	$_SESSION['sb_message'] = $message;
	if(strlen($message) > 50) {
		$_SESSION['sb_time'] = 15000;
	} else {
		$_SESSION['sb_time'] = 10000;
	}
}
echo json_encode($output);