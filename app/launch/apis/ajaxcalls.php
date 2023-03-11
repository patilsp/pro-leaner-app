<?php
require_once "../../session_token/checksession.php";
require_once "../../configration/config.php";
require_once "../../functions/db_functions.php";
require_once "../../functions/common_functions.php";
require_once "../../functions/subjects.php";
$type = $_POST['type'];
$login_userid = $_SESSION['cms_userid'];
$role_id = $_SESSION['user_role_id'];

if($type == "getSectionsSubjectMapping") {
	$tbody = '<option value="">-Select Section-</option>';
	$classes = intval($_POST['classes']);
	$sections = GetRecords("teacher_subject_mapping", array("user_id"=>$login_userid, "class"=>$classes));
	if($role_id <= 13){
		$stmt1 = $db->prepare("SELECT DISTINCT(section) as section FROM masters_sections where class=? ORDER BY section");
      	$stmt1->execute(array($classes));
	}
	else{
		$stmt1 = $db->prepare("SELECT DISTINCT(section) as section FROM teacher_subject_mapping where class = ? AND user_id = ? ORDER BY section");
      	$stmt1->execute(array($classes, $login_userid));
	}
	$sections = $stmt1->fetchAll(PDO::FETCH_ASSOC);
	$cksecarr = array();
	foreach($sections as $section) {
		if(!in_array($section['section'], $cksecarr)){
			array_push($cksecarr, $section['section']);
			$tbody .= '<option value="'.$section['section'].'">'.$section['section'].'</option>';
		}
	}
	echo $tbody;
} else if(isset($_POST['module']) && $_POST['module'] == "enable_disable_chap"){
	$selectedClass = intval($_POST['classes']);
	$selectedSection = $_POST['sections'];
	$subjects = GetRecords("teacher_subject_mapping", array("user_id"=>$login_userid, "class"=>$selectedClass, "section"=>$selectedSection));
	$subjects_arry = array();
	foreach ($subjects as $key => $value) {
		$subjects_arry[] = $value['courseid'];
	}
	$selectedClass = intval($_POST['classes']);
	$role_id = 9;
	$response = GetContentEnableSubjects($selectedClass, $selectedSection, $login_userid, $role_id);
	echo $response['OptionsHTML'];
	/*$pillars = getPillars($selectedClass);
	$tbody = '<option value="">-Select Subject-</option>';
	foreach($pillars as $id=>$name) {

		if(in_array($id, $subjects_arry))
			$tbody .= '<option value="'.$id.'">'.$name.'</option>';
	}
	echo $tbody;*/
} else if($type == "getTopics") {
	try{
		$tbody = '<option value="">-Select Chapter-</option>';
		
		$classsearch = "CLASS ".$_POST['classes'];
		$subjectsearch = $_POST['subject'];
		$query3 = "SELECT id, module FROM cpmodules WHERE parentId = ? AND type = 'chapter' AND level = 3 and deleted=0 ORDER BY id";
  		$stmt3 = $db->prepare($query3);
  		$stmt3->execute(array($subjectsearch));
  		$rowcount3 = $stmt3->rowCount();
  		if($rowcount3 > 0){
  			while($fetch3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
  				$courseid = $fetch3['id'];
  				$coursename = $fetch3['module'];

  				$tbody .= '<option value="'.$courseid.'">'.$coursename.'</option>';
  			}
		}
			echo $tbody;
	}catch(Exception $exp){
		echo "<pre/>";
		print_r($exp);
		return "false";
	}
} else if($type == "getChapters") {
	try{
		$i = 0;
		$topic_id = $_POST['topic'];
		$section_wise_chap_enable = array();
		$query = "SELECT cmid FROM section_wise_chapter_enable WHERE class = ? AND section = ? AND courseid = ? AND enable = 1";
		$stmt = $db->prepare($query);
		$stmt->execute(array($_POST['class'], $_POST['section'], $_POST['topic']));
		while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$section_wise_chap_enable[] = $fetch['cmid'];
		}
		//this module will get from mdl_modules table
		$data = "";
		$query0 = "SELECT sequence FROM mdl_course_sections WHERE course = ? AND sequence != '' ORDER BY section";
		$stmt0 = $db->prepare($query0);
		$stmt0->execute(array($topic_id));
		if($stmt0->rowCount() > 0) {
			$data .= '<div class="box-body table-responsive">
	                <table id="data_table" class="table table-bordered">
	                  <thead>
	                    <tr>
	                      <th class="text-center">S.No</th>
	                      <th class="text-center">Lesson</th>
	                      <th class="text-center">Enable</th>
	                    </tr>
	                  </thead>
	                  <tbody>';
		}
		while($fetch0 = $stmt0->fetch(PDO::FETCH_ASSOC)) {
			$sequences = $fetch0['sequence'];
			
			$cmids = GetQueryRecords("SELECT id, module, instance FROM mdl_course_modules WHERE id IN ($sequences) ORDER BY FIELD(id, $sequences)", array($topic_id));
			
			foreach($cmids as $cmid) {
				$modInfo = GetRecord("mdl_modules", array("id"=>$cmid['module']));
				$modname = $modInfo['name'];
				$table_name = "mdl_".$modname;
				$instance_id = $cmid['instance'];
				$instanceInfo = GetRecord($table_name, array("id"=>$instance_id));
				if($instanceInfo) {
					$name = $instanceInfo['name'];
		      $lesson_id = $instance_id;
		      $thiscMID = $cmid['id'];

		      $checked = "";
		      if(in_array($thiscMID, $section_wise_chap_enable))
		      	$checked = 'checked="checked"';
		      $data .='
                <tr>
                    <td align="center">
                        '.++$i.'
                    </td>
                    <td>
                        '.$name.'
                    </td>
                    <td  align="center">
                        <input type="checkbox" '.$checked.' class="parent'.$thiscMID.'" id="module'.$thiscMID.'" name="useraccess[]" value="'.$thiscMID.'" />
                        <label for="module'.$thiscMID.'"></label>
                    </td>
                </tr>';
		      
				}
			}
		}
		if($stmt0->rowCount() > 0) {
			$data .= '</tbody>
	                </table>
	              </div>';
		}
		echo $data;
	} catch(Exception $exp) {
		echo "<pre/>";
		print_r($exp);
	}
} else if($type == "getChaptersNew") {
	try{
		$i = 0;
		$topic_id = $_POST['topic'];
		$section_wise_chap_enable = array();
		$query = "SELECT cmid FROM section_wise_chapter_enable WHERE class = ? AND section = ? AND courseid = ? AND enable = 1";
		$stmt = $db->prepare($query);
		$stmt->execute(array($_POST['class'], $_POST['section'], $_POST['topic']));
		while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$section_wise_chap_enable[] = $fetch['cmid'];
		}
		//this module will get from mdl_modules table
		$data = "";
		$query0 = "SELECT * FROM cpmodules WHERE parentId = ? AND type = 'topic' AND level = 4 AND deleted = 0 ORDER BY id";
		$stmt0 = $db->prepare($query0);
		$stmt0->execute(array($topic_id));
		if($stmt0->rowCount() > 0) {
			$data .= '<div class="box-body table-responsive">
	                <table id="data_table" class="table table-bordered">
	                  <thead>
	                    <tr>
	                      <th class="text-center">S.No</th>
	                      <th class="text-center">Lesson</th>
	                      <th class="text-center">Enable</th>
	                    </tr>
	                  </thead>
	                  <tbody>';
		}
		while($cmid = $stmt0->fetch(PDO::FETCH_ASSOC)) {
			// $sequences = $fetch0['id'];
			
			// $cmids = GetQueryRecords("SELECT id, module, instance FROM mdl_course_modules WHERE id IN ($sequences) ORDER BY FIELD(id, $sequences)", array($topic_id));
			
			// foreach($cmids as $cmid) {
				// $modInfo = GetRecord("mdl_modules", array("id"=>$cmid['module']));
			$modname = $cmid['module'];
				// $table_name = "mdl_".$modname;
			$instance_id = $cmid['id'];
			// $instanceInfo = GetRecord($table_name, array("id"=>$instance_id));
			// if($instanceInfo) {
			$name = $cmid['module'];
		    // $lesson_id = $instance_id;
		     $thiscMID = $cmid['id'];

		    $checked = "";
		    if(in_array($thiscMID, $section_wise_chap_enable))
		      	$checked = 'checked="checked"';
		     $data .='
                <tr>
                    <td align="center">
                        '.++$i.'
                    </td>
                    <td>
                        '.$name.'
                    </td>
                    <td  align="center">
                        <input type="checkbox" '.$checked.' class="parent'.$thiscMID.'" id="module'.$thiscMID.'" name="useraccess[]" value="'.$thiscMID.'" />
                        <label for="module'.$thiscMID.'"></label>
                    </td>
                </tr>';
		      
				// }
			// }
		}
		if($stmt0->rowCount() > 0) {
			$data .= '</tbody>
	                </table>
	              </div>';
		}
		echo $data;
	} catch(Exception $exp) {
		echo "<pre/>";
		print_r($exp);
	}
}  else if($type == "ChapterEnableDisable") {
	$topic_id = $_POST['topic'];
	$selectedCMIDS = isset($_POST['useraccess']) ? $_POST['useraccess'] : array();
	$getChapters = GetRecords("cpmodules", array("parentId"=>$topic_id));
	foreach ($getChapters as $getChapter) {
		$thisCMID = $getChapter['id'];
		if(in_array($thisCMID, $selectedCMIDS)) {
			$enable = 1;
		} else {
			$enable = 0;
		}
	
		$records1 = GetQueryRecords("SELECT id, cmid FROM section_wise_chapter_enable WHERE class = ? AND section = ? AND courseid = ? AND cmid = ?", array($_POST['class'], $_POST['section'], $_POST['topic'], $thisCMID));
		if(count($records1) == 0) {
			InsertRecord("section_wise_chapter_enable", array("class"=>$_POST['class'], "section"=>$_POST['section'], "courseid"=>$_POST['topic'], "cmid"=>$thisCMID, "enable"=>$enable, "updated_by"=>$login_userid));
		} else {
			$query1 = "UPDATE section_wise_chapter_enable SET enable = :enable, updated_by = :updated_by WHERE id = :id";
			$stmt_update = $db->prepare($query1);
			$stmt_update->bindParam(':enable', $enable, PDO::PARAM_INT);
			$stmt_update->bindParam(':updated_by', $login_userid, PDO::PARAM_INT);
			$stmt_update->bindParam(':id', $records1[0]['id'], PDO::PARAM_INT);
			$stmt_update->execute();
		}
		InsertRecord("section_wise_chapter_enable_log", array("class"=>$_POST['class'], "section"=>$_POST['section'], "courseid"=>$_POST['topic'], "cmid"=>$thisCMID, "enable"=>$enable, "updated_by"=>$login_userid));
	}
	echo json_encode(array("status"=>true, "message"=>"Materials launched successfully"));
}