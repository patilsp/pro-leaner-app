<?php session_start();
// include "../../configration/config.php";
// require_once "../../functions/db_functions.php";
// require_once "../../functions/lessons.php";
// require_once "../../functions/courses.php";
// require_once "../../functions/questions.php";
// require_once "../../functions/assignments.php";

include_once "../configration/config.php";
include "../functions/db_functions.php";

$type = $_POST['type'];
$output = array();
$output['status'] = false;
$output['message'] = "";
$status = false;
$message = "";
$snackbar = false;
$login_userid = $_SESSION['ilp_loginid'];

if($type == "updatemodal") {
	$cmid = intval($_POST['cmid']);
	$mdl_crse_data = GetRecord("mdl_course_modules", array("id"=>$cmid));
	$id = $mdl_crse_data['instance'];
	$name = getSanitizedData($_POST['name']);
	$intro = getSanitizedData($_POST['intro']);
	
	$date = $_POST['att_date'];
	$time = $_POST['due_by'];

	if($date != "" && $time != "") {
		$duedate = strtotime("$date $time");
	} else if($date != "" && $time ==  "") {
		$duedate = strtotime("$date 23:59:59");
	} else {
		$duedate = 0;
	}

	$url_link = getSanitizedData($_POST['url_link']);
	$grade = intval($_POST['grade']);

	$query = "UPDATE mdl_assign SET name = ?, intro = ?, duedate = ?, grade = ?, url_link = ? WHERE id = ?";
	$stmt = $db->prepare($query);
	$stmt->execute(array($name, $intro, $duedate, $grade, $url_link, $id));

	$linkUpdateArr = [
		"assignment_id" => $id,
		"link" => $url_link,
		"link_name" => null,
		"id" => $id
	];

	if($url_link != "") {
		$check = GetRecord("pms_assignment_links", array("assignment_id"=>$id));
		$query = "UPDATE pms_assignment_links SET link = ? WHERE assignment_id = ?";
		$stmt = $db->prepare($query);
		$stmt->execute(array($url_link, $id));
	}
	
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
	$list = GetAssignmentsList($_POST['subId'], $_POST['cmid']);
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
} else if($type == "addAssignment") {
	$date = $_POST['att_date'];
	$time = $_POST['due_by'];

	if($date != "" && $time != "") {
		$duedate = strtotime("$date $time");
	} else if($date != "" && $time ==  "") {
		$duedate = strtotime("$date 23:59:59");
	} else {
		$duedate = 0;
	}
	
	$subject_id = intval($_POST['cat_id']);
	$course_id = GetCreateCourseID4Assessment($subject_id, "Assignments");

	// $duedate = date('Y-m-d H:i:s', strtotime("$date $time"));
	$duedate = strtotime("$date $time");

	$insertArr = [
		"course" => $course_id,
		"name" => getSanitizedData($_POST['name']),
		"intro" => getSanitizedData($_POST['intro']),
		"introformat" => 0,
		"duedate" => $duedate,
		"grade" => intval($_POST['grade']),
		"timemodified" => time(),
		"alwaysshowdescription" => 1,
		"submissiondrafts" => 1,
		"url_link" => getSanitizedData($_POST['url_link'])
	];
	
	$autoid = InsertRecord("mdl_assign", $insertArr);
	$sectionInfo = GetRecord("mdl_course_sections", array("course"=>$course_id, "section"=>1));
	if($sectionInfo) {
		$section_id = $sectionInfo['id'];
	} else {
		$datai = [
			"course" => $course_id,
			"section" => 1,
			"summary" => '',
			"summaryformat" => 1,
			"visible" => 1,
			"sequence" => ''
		];
		$section_id = InsertRecord("mdl_course_sections", $datai);
	}

	$moduleInfo = GetRecord("mdl_modules", array("name"=>"assign"));
	$module_id = $moduleInfo['id'];

	$cm_data = [
		"course" => $course_id,
		"module" => $module_id,
		"instance" => $autoid,
		"section" => $section_id,
		"added" => time()
	];
	$cmid = InsertRecord("mdl_course_modules", $cm_data);

	$sequence = $sectionInfo['sequence'];
	if($sequence == "") {
		$sequence = $cmid;
	} else {
		$sequence .= ",".$cmid;
	}
	$query = "UPDATE mdl_course_sections SET sequence = ? WHERE id = ?";
	$stmt = $db->prepare($query);
	$stmt->execute(array($sequence, $sectionInfo['id']));

	ClearCourseCache($course_id);
	$getChapters = GetRecords("mdl_course_modules", array("course"=>$course_id));
	PublishContent($course_id);
        foreach ($getChapters as $getChapter) {
          $thisCMID = $getChapter['id'];
          $records1 = GetQueryRecords("SELECT id, cmid FROM section_wise_chapter_enable WHERE class = ? AND section = ? AND courseid = ? AND cmid = ?", array(1,'A',$course_id, $thisCMID));
          if(count($records1) == 0) {
            InsertRecord("section_wise_chapter_enable", array("class"=>1, "section"=>'A', "courseid"=>$course_id, "cmid"=>$thisCMID, "enable"=>1, "updated_by"=>$login_userid));
          } else {
            $query = "UPDATE section_wise_chapter_enable SET enable = ?, updated_by = ? WHERE courseid = ?";
            $stmt = $db->prepare($query);
            $stmt->execute(array(1, $login_userid, $course_id));
          }
        }
	$link = getSanitizedData($_POST['url_link']);
	$linkInsertArr =[];
	if($link) {
		$linkInsertArr = [
			"assignment_id" => $autoid,
			"link" => $link,
			"link_name" => null,
			"created_by" => $login_userid,
			"created_on" => date("Y-m-d H:i:s")
		];
	}

	$linkId = InsertRecord("pms_assignment_links", $linkInsertArr);

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
				"created_by" => $login_userid,
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