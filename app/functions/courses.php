<?php
/*
$params - should be pass like below structure and key name should same as below.

Array
(
    [0] => Array
        (
            [fullname] => dwedwedwe
            [shortname] => dwedwedwe-15960497410
            [categoryid] => 494
        )

    [1] => Array
        (
            [fullname] => wedewdew
            [shortname] => wedewdew-15960497411
            [categoryid] => 494
        )

)
*/
function CreateCourseIntoMoodle($params) {
	require_once('MoodleRest.php');
	global $admin_base_url;
	global $admin_ws_token;

	$token = $admin_ws_token;
	$server = $admin_base_url; 
	$ws_function = 'core_course_create_courses';
	$courses = $params;
	//$courses = array($course); 

	$param = array("courses" => $courses);
	$MoodleRest = new MoodleRest($server.'/webservice/rest/server.php', $token);

	$return = $MoodleRest->request($ws_function, $param, MoodleRest::METHOD_POST);
	return $return;
}

function EnrollCohortInMoodle($params) {
	require_once('MoodleRest.php');
	global $admin_base_url;
	global $admin_ws_token;

	$token = $admin_ws_token;
	$server = $admin_base_url; 
	$ws_function = 'pms_enrol_cohort';
	$courses = $params;

	$param = array("courses" => $courses);
	$MoodleRest = new MoodleRest($server.'/webservice/rest/server.php', $token);

	$return = $MoodleRest->request($ws_function, $param, MoodleRest::METHOD_POST);
	return $return;
}

/*
$params here - pass the array(course id1, course id2)
*/
function DeleteCourseIntoMoodle($params) {
	require_once('MoodleRest.php');
	global $admin_base_url;
	global $admin_ws_token;

	$token = $admin_ws_token;
	$server = $admin_base_url; 
	$ws_function = 'core_course_delete_courses';
	$courses = $params;
	$param = array("courseids" => $courses);
	$MoodleRest = new MoodleRest($server.'/webservice/rest/server.php', $token);

	$return = $MoodleRest->request($ws_function, $param, MoodleRest::METHOD_POST);
	return $return;
}

function ClearCourseCache($course_id) {
	global $db;
	$query = "UPDATE mdl_course SET sectioncache = NULL, modinfo = NULL WHERE id = ?";
	$stmt = $db->prepare($query);
	$stmt->execute(array($course_id));
}

function PublishContent($course_id) {
	global $db;
	global $web_root;
	$records = GetRecordsDistinct("add_slide_list", array("topic_id"=>$course_id), "lesson_id");		
	foreach($records as $record) {
		$lid = $record['lesson_id'];
		DeleteRecord("mdl_lesson_pages", array("lessonid"=>$lid));
		DeleteRecord("mdl_lesson_answers", array("lessonid"=>$lid));
		$query = "UPDATE add_slide_list SET skills4life_master_slide_id = NULL WHERE lesson_id = ?";
		$stmt = $db->prepare($query);
		$stmt->execute(array($lid));
	}
	$prev_lesson_id = 0;
	$records = GetRecords("add_slide_list", array("topic_id"=>$course_id), array("lesson_id","sequence"));
	foreach($records as $record)
	{
		if($record['prev_slide_id'] > 0)
		{
			$prev_slide_id = $record['prev_slide_id'];
		}
		else if($record['lesson_id'] != $prev_lesson_id)
		{
			$prev_slide_id = 0;
		}

		$lesson_id = $record['lesson_id'];
		$html_file = $record['slide_file_path'];
		$html_file1 = str_replace($web_root."app","",$html_file);
		$html_file1 = str_replace("https://test.skillprep.co/bhelcms/app","",$html_file1);
		$title = $record['slide_title'];
		//AddPopUp($record);
		
		CopyContentToSkills4life($html_file);
		$inserted_pageid_db = intval($record['skills4life_master_slide_id']);
		if($inserted_pageid_db > 0)
			continue;

		$inserted_pageid = insertUpdateSlide($lesson_id, $prev_slide_id, $html_file1, $title);
		if($inserted_pageid > 0)
		{
			$query = "UPDATE add_slide_list SET skills4life_master_slide_id = ?, status = ? WHERE id = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($inserted_pageid, 2, $record['id']));

			CopyContentToSkills4life($html_file);
		}
		$prev_slide_id = $inserted_pageid;
		$prev_lesson_id = $lesson_id;
	}
	$topic_name = $course_id;
	if(count($records) > 0)  {
		CopyCSSToSkills4life($html_file, $topic_name);
		CopyJSToSkills4life($html_file, $topic_name);
		CopyImagesToSkills4life($html_file, $topic_name);
	}
}


function CopyContentToSkills4lifepms($sourcePath)
{
	try {
		global $db;
		global $web_root;
		global $dir_root;
		global $cms_dirname;
		global $skills4life_dirname;

		$cms_path = str_replace($web_root, $dir_root, $sourcePath);
		$s4l_path = str_replace("$cms_dirname/app", $skills4life_dirname, $cms_path);
		$temp1 = $temp = explode("/", $s4l_path);
		unset($temp1[count($temp1) - 1]);
		$temp2 = implode("/", $temp1);
		if(! file_exists($temp2)) {
			mkdir($temp2, 0777, true);
		}
		copy($cms_path, $s4l_path);

	} catch(Exception $exp) {
		echo "<pre/>";
		print_r($exp);
	}
}

function CopyCSSToSkills4lifepms($htmlPath, $topicName)
{
	try {
		global $db;
		global $web_root;
		global $dir_root;
		global $cms_dirname;
		global $skills4life_dirname;

		$cms_path = str_replace($web_root, $dir_root, $htmlPath);
		$s4l_path = str_replace("$cms_dirname/app", $skills4life_dirname, $cms_path);
		$temp1 = $temp = explode("/", $s4l_path);
		unset($temp1[count($temp1) - 1]);
		$s4l_path = implode("/", $temp1)."/css";

		$temp1 = $temp = explode("/", $cms_path);
		unset($temp1[count($temp1) - 1]);
		$cms_path = implode("/", $temp1)."/css";

		if(! file_exists($s4l_path)) {
			mkdir($s4l_path, 0777, true);
		}
		cpy($cms_path, $s4l_path);

		$cms_path = $dir_root."app/contents/css/".$topicName;
		$s4l_path = str_replace("$cms_dirname/app", $skills4life_dirname, $cms_path);
		if(! file_exists($s4l_path)) {
			mkdir($s4l_path, 0777, true);
		}
		cpy($cms_path, $s4l_path);

	} catch(Exception $exp) {
		echo "<pre/>";
		print_r($exp);
	}
}

function CopyJSToSkills4lifepms($htmlPath, $topicName)
{
	try {
		global $db;
		global $web_root;
		global $dir_root;
		global $cms_dirname;
		global $skills4life_dirname;

		$cms_path = str_replace($web_root, $dir_root, $htmlPath);
		$s4l_path = str_replace("$cms_dirname/app", $skills4life_dirname, $cms_path);
		$temp1 = $temp = explode("/", $s4l_path);
		unset($temp1[count($temp1) - 1]);
		$s4l_path = implode("/", $temp1)."/js";

		$temp1 = $temp = explode("/", $cms_path);
		unset($temp1[count($temp1) - 1]);
		$cms_path = implode("/", $temp1)."/js";

		if(! file_exists($s4l_path)) {
			mkdir($s4l_path, 0777, true);
		}
		cpy($cms_path, $s4l_path);

		$cms_path = $dir_root."app/contents/js/".$topicName;
		$s4l_path = str_replace("$cms_dirname/app", $skills4life_dirname, $cms_path);
		if(! file_exists($s4l_path)) {
			mkdir($s4l_path, 0777, true);
		}
		cpy($cms_path, $s4l_path);

	} catch(Exception $exp) {
		echo "<pre/>";
		print_r($exp);
	}
}

function CopyImagesToSkills4lifepms($htmlPath, $topicName)
{
	try {
		global $db;
		global $web_root;
		global $dir_root;
		global $cms_dirname;
		global $skills4life_dirname;

		$cms_path = str_replace($web_root, $dir_root, $htmlPath);
		$s4l_path = str_replace("$cms_dirname/app", $skills4life_dirname, $cms_path);
		$temp1 = $temp = explode("/", $s4l_path);
		unset($temp1[count($temp1) - 1]);
		$s4l_path = implode("/", $temp1)."/images";

		$temp1 = $temp = explode("/", $cms_path);
		unset($temp1[count($temp1) - 1]);
		$cms_path = implode("/", $temp1)."/images";

		if(! file_exists($s4l_path)) {
			mkdir($s4l_path, 0777, true);
		}
		cpy($cms_path, $s4l_path);

		$cms_path = $dir_root."app/contents/images/graphics/".$topicName;
		$s4l_path = str_replace("$cms_dirname/app", $skills4life_dirname, $cms_path);
		if(! file_exists($s4l_path)) {
			mkdir($s4l_path, 0777, true);
		}
		cpy($cms_path, $s4l_path);

		$cms_path = $dir_root."app/contents/images/templates/".$topicName;
		$s4l_path = str_replace("$cms_dirname/app", $skills4life_dirname, $cms_path);
		if(! file_exists($s4l_path)) {
			mkdir($s4l_path, 0777, true);
		}
		cpy($cms_path, $s4l_path);

	} catch(Exception $exp) {
		echo "<pre/>";
		print_r($exp);
	}
}

//Insert a New Slide
function insertUpdateSlidepms($desti_lesson_id, $desti_destprevid, $file_path, $title="Content Slide") {
	global $db;
	global $master_db;

	try{
		$inserted_pageid = 0;
		//$master_db = "sp_2021_master";
		$time = time();
		$contents = '<div style="text-align: center;"><object class="mp4downloader_tagChecked" data="../..'.$file_path.'?ver='.$time.'" width="100%" height="700"> </object></div>';
		/*$querySch = "SELECT mysql_database FROM skillpre_schools.masters_school WHERE mysql_database = ? OR master_school_dbname = ? AND replicate = 1";
		$stmtSch = $db->prepare($querySch);
		$stmtSch->execute(array($master_db, $master_db));
		while($rowsSch = $stmtSch->fetch(PDO::FETCH_ASSOC))
		{*/
			// $thisdb = $rowsSch['mysql_database'];
			//Slide inserting in respective selected location
			if($desti_destprevid == 0) {
				$first_slide_id = 0;
				$get_lessons = GetRecords("mdl_lesson_pages", array("lessonid"=>$desti_lesson_id, "prevpageid"=>0));
				foreach ($get_lessons as $get_lesson) {
					$first_slide_id = $get_lesson['id'];
				}

				//insert into the mdl_lesson_pages table
				$autoid_less_pages = InsertRecord("mdl_lesson_pages", array("lessonid" => $desti_lesson_id,
				"prevpageid" => 0,
				"nextpageid" => $first_slide_id,
				"qtype" => '20',
				"qoption" => 0,
				"layout" => 1,
				"display" => 1,
				"timecreated" => time(),
				"timemodified" => 0,
				"title" => $title,
				"contents" => $contents,
				"contentsformat" => 1,
				"status" => 0
				));
				$inserted_pageid = $autoid_less_pages;

				if($autoid_less_pages > 0) {
					$autoid = InsertRecord("mdl_lesson_answers", array("lessonid" => $desti_lesson_id,
					"pageid" => $autoid_less_pages,
					"jumpto" => '-1',
					"grade" => 0,
					"score" => 0,
					"flags" => 0,
					"timecreated" => time(),
					"timemodified" => 0,
					"answer" => 'Next',
					"answerformat" => 0,
					"response" => null,
					"responseformat" => 0
					));
				}

				$query_up = "UPDATE mdl_lesson_pages SET prevpageid=? WHERE id=?";
		  		$stmt_up = $db->prepare($query_up);
		  		$stmt_up->execute(array($autoid_less_pages, $first_slide_id));

		  		//As this is first slide, you should add Previous Button to 2nd slide (if exists)
		  		if($first_slide_id > 0) {
		  			$id = InsertRecord("mdl_lesson_answers", array("lessonid" => $desti_lesson_id,
						"pageid" => $first_slide_id,
						"jumpto" => "-40",
						"grade" => 0,
						"score" => 0,
						"flags" => 0,
						"timecreated" => time(),
						"timemodified" => 0,
						"answer" => 'Previous',
						"answerformat" => 0,
						"response" => "",
						"responseformat" => 0
						));
		  		}
		  	} else {
				$get_lessons = GetRecords("mdl_lesson_pages", array("id"=>$desti_destprevid));
				foreach ($get_lessons as $get_lesson) {
					$nextPageID = $get_lesson['nextpageid'];
				}

				//insert into the mdl_lesson_pages table
				$autoid_mlp = InsertRecord("mdl_lesson_pages", array("lessonid" => $desti_lesson_id,
				"prevpageid" => $desti_destprevid,
				"nextpageid" => $nextPageID,
				"qtype" => '20',
				"qoption" => 0,
				"layout" => 1,
				"display" => 1,
				"timecreated" => time(),
				"timemodified" => 0,
				"title" => $title,
				"contents" => $contents,
				"contentsformat" => 1,
				"status" => 13
				));
				
				$inserted_pageid = $autoid_mlp;

				$query1 = "UPDATE mdl_lesson_pages SET nextpageid=? WHERE id=?";
		  		$stmt1 = $db->prepare($query1);
		  		$stmt1->execute(array($autoid_mlp, $desti_destprevid));
		  		$rowcount1 = $stmt1->rowCount();

		  		if($nextPageID != 0) {
					$query1 = "UPDATE mdl_lesson_pages SET prevpageid=? WHERE id=?";
			  		$stmt1 = $db->prepare($query1);
			  		$stmt1->execute(array($autoid_mlp, $nextPageID));
			  		$rowcount1 = $stmt1->rowCount();
		  		}

		  		//insert into the mdl_lesson_answers table
				$autoid = InsertRecord("mdl_lesson_answers", array("lessonid" => $desti_lesson_id,
				"pageid" => $autoid_mlp,
				"jumpto" => "-40",
				"grade" => 0,
				"score" => 0,
				"flags" => 0,
				"timecreated" => time(),
				"timemodified" => 0,
				"answer" => 'Previous',
				"answerformat" => 0,
				"response" => "",
				"responseformat" => 0
				));

				$autoid = InsertRecord("mdl_lesson_answers", array("lessonid" => $desti_lesson_id,
				"pageid" => $autoid_mlp,
				"jumpto" => -1,
				"grade" => 0,
				"score" => 0,
				"flags" => 0,
				"timecreated" => time(),
				"timemodified" => 0,
				"answer" => 'Next',
				"answerformat" => 0,
				"response" => "",
				"responseformat" => 0
				));
			}
		// }
		return $inserted_pageid;
	} catch(Exception $exp) {
		echo "<pre/>";
		print_r($exp);
	}
}

function cpypms($source, $dest){
	if(!is_dir($dest)){
        mkdir($dest, 0777, true);
    }
    if(is_dir($source)) {
        $dir_handle=opendir($source);
        while($file=readdir($dir_handle)){
            if($file!="." && $file!=".."){
                if(is_dir($source."/".$file)){
                    if(!is_dir($dest."/".$file)){
                        mkdir($dest."/".$file, 0777, true);
                    }
                    cpy($source."/".$file, $dest."/".$file);
                } else {
                    copy($source."/".$file, $dest."/".$file);
                }
            }
        }
        closedir($dir_handle);
    } else {
        //copy($source, $dest);
    }
}

function uploadMultipleImages($source_ref, $dest_path)
{
	$uploaded_files = array();
	foreach ($_FILES[$source_ref]['name'] as $key1 => $value1) {
		if($_FILES[$source_ref]['error'][$key1] == 0)
		{
			$extension = explode('.', $_FILES[$source_ref]['name'][$key1]);
			$new_name = rand() . '.' . end($extension);
			$destination = $dest_path . $new_name;
			$original_name = $_FILES[$source_ref]['name'][$key1];
			move_uploaded_file($_FILES[$source_ref]['tmp_name'][$key1], $destination);
			array_push($uploaded_files, array("Path"=>$destination, "OriginalName"=>$original_name));
		}
	}
	return $uploaded_files;
}