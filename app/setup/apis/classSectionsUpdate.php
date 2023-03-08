<?php session_start();
  include "../../configration/config.php";
  require_once "../../functions/db_functions.php";
  
  $type = $_POST['type'];
  $output = array();
  $output['status'] = false;
  $output['message'] = "";
  $status = false;
  $message = "";
  $snackbar = true;
  $login_userid = $_SESSION['cms_userid'];
  
if($type == "createSectionBasedOnCount") {
	if(isset($_POST['section_count_class'])) {
		//$alphas = range('A', 'ZZ');
		//$alphas2 = range('AA', 'ZZ');
		$alphas= array();
		for ($i = 'A'; $i < 'ZZ'; $i++) 
    		$alphas[] = $i;
		$insert_classes = array();
		foreach($_POST['section_count_class'] as $class=>$count) {
			$count = intval($count);
			if($count == 0) {
				continue;
			}
			$insert_classes[] = $class;
			// $insert_classes[] = [];
			$current_sections = GetRecords("masters_sections", array("class"=>$class));
			$existing_sections = array();
			foreach ($current_sections as $key => $value) {
				$existing_sections[] = $value['section'];
			}
			$sequence = count($existing_sections);
			for($i = 1; $i <= $count; $i++) {
				$autoid = 0;
				foreach($alphas as $alpha) {
					if(! in_array($alpha, $existing_sections)) {
						//Insert
						++$sequence;
						$autoid = InsertRecord("masters_sections", array("class"=>$class, "section"=>$alpha, "sequence"=>$sequence, "created_on"=>date("Y-m-d H:i:s"), "created_by"=>$login_userid));
						$existing_sections[] = $alpha;
						break;
					}
				}
			}
		}
		if(count($insert_classes) == 0) {
			$message = "No Sections has been added";
		} else if(count($insert_classes) == 1) {
			$thisClass = $insert_classes[0];
			$record = GetQueryRecords("SELECT module FROM cpmodules WHERE cpmodules.id = ?", array($thisClass));
			$className = $record[0]['module'];
			$message = 'You added <span class="font-weight-bold m-0">'.$_POST['section_count_class'][$thisClass].' sections under '.$className.'</span> successfully';
			$status = true;
		} else if(count($insert_classes) > 1) {
			$message = 'Sections has been successfully add for the classes <span class="font-weight-bold m-0">'.implode(", ",$insert_classes).' </span>';
			$status = true;
		}
	} else {
		$message = "Mandatory Fields are not sent";
	}
} else if($type == "createClasses") {
	if(isset($_POST['class'])) {
		$created_classes = array();
		foreach($_POST['class'] as $catid) {
			$query = "UPDATE cpmodules SET visibility = ? WHERE id = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array(1, $catid));

			$info = GetRecord("cpmodules", array("id"=>$catid));
			$created_classes[] = $info['module'];
		}
		$msg_class= "";
		$start = $end = 0;
		foreach($created_classes as $key=>$class) {
			if($start == 0) {
				$start = $end = $class;
			} else if($end == $class -1) {
				$end = $class;
			}
			if(isset($created_classes[$key + 1]) && ($end + 1) != $created_classes[$key + 1]) {
				if($start == $end) {
					$msg_class .= "$start,";
				} else if($start == $end - 1) {
					$msg_class .= "$start,$end,";
				} else {
					$msg_class .= "$start - $end,";	
				}
				$start = $end = 0;
			}
		}
		$msg_class = trim($msg_class, ",");
		//$message = "You have added '".implode("', '", $created_classes)."' successfully";
		$message = "You have added classes ".$msg_class." successfully";
		$status = true;
	} else {
		$message = "Mandatory Fields are not sent";
	}
} else if($type == "deleteSection") {
	if(isset($_POST['id'])) {
		$section_id = intval($_POST['id']);
		$info = GetRecord("masters_sections", array("id"=>$section_id));
		if($info) {
			//Check students are enrolled or not
			$records = GetRecords("users", array("class"=>$info['class'], "section"=>$info['section']));
			if(count($records) == 0) {
				$count = DeleteRecord("masters_sections", array("id"=>$info['id']));
				if($count) {
					$_SESSION['open_class'] = $info['class'];
					$message = "Section deleted successfully";
					$status = true;
				} else {
					$message = "Section deletion failed";
				}
			} else {
				$message = "Section cannot be deleted as some students are enrolled";
			}
		} else {
			$message = "Invalid Section";
		}
	} else {
		$message = "Mandatory Fields are not sent";
	}
} else if($type == "renameClass") {
	$snackbar = false;
	$output['oldClass'] = "";
	if(isset($_POST['classname'], $_POST['catid'])) {
		$catid = intval($_POST['catid']);
		$classname = getSanitizedData($_POST['classname']);
		$info = GetRecord("cpmodules", array("id"=>$catid, "visibility"=>1));
		if($info) {
			$output['oldClass'] = $info['module'];
			$query = "UPDATE cpmodules SET module = ? WHERE id = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($classname, $catid));
			$status = true;
			$message = "Data updated successfully";
		} else {
			$message = "Invalid data sent";
		}
	} else {
		$message = "Mandatory Fields are not sent";
	}
} else if($type == "deleteClass") {
	if(isset($_POST['id'])) {
		$catid = intval($_POST['id']);
		$info = GetRecord("cpmodules", array("id"=>$catid, "visibility"=>1));
		if($info) {
			//Check sections are tagged or not
			$records = GetRecords("masters_sections", array("class"=>$info['id']));
			if(count($records) == 0) {
				$query = "UPDATE cpmodules SET visibility = ? WHERE id = ?";
				$stmt = $db->prepare($query);
				$stmt->execute(array(0, $catid));

				// $query = "UPDATE mdl_course_categories SET visible = ? WHERE id = ?";
				// $stmt = $db->prepare($query);
				// $stmt->execute(array(0, $catid));

				// $info = GetRecord("mdl_course_categories", array("id"=>$catid));
				$className = $info['module'];
				$status = true;
				$message = "You deleted <b>".$className."</b> successfully";
			} else {
				$message = "Class cannot be deleted as sections are created";
			}
		} else {
			$message = "Invalid data sent";
		}
	} else {
		$message = "Mandatory Fields are not sent";
	}
} else if($type == "renameSection") {
	$snackbar = false;
	if(isset($_POST['sectionname'], $_POST['secid'])) {
		$secid = intval($_POST['secid']);
		$sectionname = ucwords(strtolower($_POST['sectionname']));
		$info = GetRecord("masters_sections", array("id"=>$secid));
		if($info) {
			$class = $info['class'];
			$oldSection = $info['section'];
			//Get Section exists or not
			$check = GetRecord("masters_sections", array("class"=>$class, "section"=>$sectionname));
			if($check) {
				$status = false;
				$output['oldSection'] = $oldSection;
				$message = "Section \"$sectionname\" already exists. Please enter different section name";
			} else {
				//Check students are enrolled in this or not
				$check = GetRecord("users", array("class"=>$class, "section"=>$oldSection));
				if($check) {
					$status = false;
					$output['oldSection'] = $oldSection;
					$message = "Cannot rename the section as Students are already enrolled in this section";
				} else {
					$query = "UPDATE masters_sections SET section = ? WHERE id = ?";
					$stmt = $db->prepare($query);
					$stmt->execute(array($sectionname, $secid));
					$status = true;
					$message = "Data updated successfully";
				}
			}
		} else {
			$message = "Invalid data sent";
		}
	} else {
		$message = "Mandatory Fields are not sent";
	}
} else if($type == "reOrderClass") {
	$snackbar = false;
	if(isset($_POST['sequence'])) {
		$sequence_list = explode(",", $_POST['sequence']);
		$count = 0;
		foreach($sequence_list as $key=>$list) {
			if($list != "") {
				$catid = str_replace("card", "", $list);

				$query = "UPDATE master_class SET sequence = ? WHERE categoryid = ?";
				$stmt = $db->prepare($query);
				$stmt->execute(array($key + 1, $catid));
			}
		}
		$status = true;
		$message = "Class sequence updated";
	} else {
		$message = "Mandatory Fields are not sent";
	}
} else if($type == "reOrderSection") {
	$snackbar = false;
	if(isset($_POST['sequence'])) {
		$sequence_list = explode(",", $_POST['sequence']);
		$count = 0;
		foreach($sequence_list as $key=>$list) {
			if($list != "") {
				$id = str_replace("sectionDiv", "", $list);

				$query = "UPDATE masters_sections SET sequence = ? WHERE id = ?";
				$stmt = $db->prepare($query);
				$stmt->execute(array($key + 1, $id));
			}
		}
		$status = true;
		$message = "Section sequence updated";
	} else {
		$message = "Mandatory Fields are not sent";
	}
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