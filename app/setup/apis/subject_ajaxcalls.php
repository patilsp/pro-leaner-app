<?php session_start();
  include "../../configration/config.php";
  require_once "../../functions/db_functions.php";
  include "../functions/common_function.php";
  // require_once "../../functions/classes.php";
  require_once "../../functions/subjects.php";
  
  $type = $_POST['type'];
  $output = array();
  $output['status'] = false;
  $output['message'] = "";
  $status = false;
  $message = "";
  $snackbar = true;
  $login_userid = $_SESSION['cms_userid'];;
  $ctime = date("Y-m-d H:i:s");
  
if($type == "addParentSubject") {
	if(isset($_POST['name'], $_POST['category'], $_POST['class_string'])) {
		$validation = true;
		foreach($_POST['name'] as $key=>$value) {
			$subject_name = $value;
			$category = intval($_POST['category'][$key]);
			$classes = explode(",", $_POST['class_string'][$key]);
			if($subject_name != "") {
				// if(! validateSubjectNameCharacters($subject_name)) {
				// 	$validation = false;
				// 	$message = "Subject Name contains invalid characters in Row: ".($key + 1);
				// 	break;
				// }
				// if($category == 0) {
				// 	$validation = false;
				// 	$message = "Category should be selected for Row: ".($key + 1);
				// 	break;
				// }
				// if(! is_array($classes) || count($classes) == 0) {
				// 	$validation = false;
				// 	$message = "Classes should be selected for Row: ".($key + 1);
				// 	break;	
				// }
			}
		}
		if(!$validation) {
			$status = false;
		} else {
			$class_category_ids = array();
			$classes = getClassNames("1");
			foreach($classes as $thisClass) {
				$class_category_ids[$thisClass['id']] = $thisClass['id'];
			}
			//Validation is success;
			$records = GetRecords("cpmodules", array("parentId" => 1,"level" => 2), array());
			$sequence = count($records);
			foreach($_POST['name'] as $key=>$value) {
				$subject_name = $value;
				$category = intval($_POST['category'][$key]);
				$classes = explode(",", $_POST['class_string'][$key]);
				if($subject_name != "") {
					//Insert into Subject Master
					// if($sub_id > 0) {
						foreach($classes as $thisClass) {
							++$sequence;
							$sub_id = InsertRecord("cpmodules", array("module"=>$subject_name, "category_id"=>$category, "parentId"=>$thisClass, "sequence"=>$sequence, "created_by"=>$login_userid, "created_on"=>$ctime,"level" => 2,"type" => "subject"));
							if(! isset($class_category_ids[$thisClass])) {
								$status = false;
								$message .= "Subject: $subject_name & Class: $thisClass are  not tagged because $thisClass is not activated.  ";
								continue;
							}
							$parent_class_id = $class_category_ids[$thisClass];
							// InsertRecord("masters_subject_classes", array("subject_id"=>$sub_id, "class"=>$thisClass, "category_id"=>$category));
							//Insert into Moodle
							// $moodle_response = InsertCategoryIntoMoodle(array("name"=>$subject_name, "parent"=>$parent_class_id));
							// if(count($moodle_response)  == 0) {
							// 	$status = false;
							// 	$message .= "Subject: $subject_name & Class: $thisClass are  not tagged because Insertion to Moodle failed.  ";
							// 	continue;
							// } else if(! isset($moodle_response[0]['id'])) {
							// 	$status = false;
							// 	$message .= "Subject: $subject_name & Class: $thisClass are  not tagged because Insertion to Moodle failed. Error - ".$moodle_response['message']."  ";
							// 	continue;
							// } else {
							// 	$insert_cat_id = $moodle_response[0]['id'];
							// }
							// InsertRecord("masters_subject_classes", array("subject_id"=>$sub_id, "class"=>$thisClass, "category_id"=>$insert_cat_id));
						}
					// }
				}
			}
			if($message == "") {
				$status = true;
				$message = "Subjects created sucessfully";
			}
		}
	} else {
		$status = false;
		$message = "Mandatory Fields are missing";
	}
} else if($type == "addSubLevel") {
	if(isset($_POST['child_subject_name'], $_POST['child_subject_parent_id'])) {
		//Check if any courses are added under this
		$subject_names = array();
		if(is_array($_POST['child_subject_name'])) {
			$subject_names = $_POST['child_subject_name'];
		} else {
			$subject_names[] = $_POST['child_subject_name'];
		}
		$validation = true;
		foreach($subject_names as $key=>$subject_name) {
			if(! validateSubjectNameCharacters($subject_name)) {
				$validation = false;
				$message = "Subject Name contains invalid characters in Row: ".($key + 1);
				break;
			}
		}
		if($validation) {
			foreach($subject_names as $subject_name) {
				$parent = intval($_POST['child_subject_parent_id']);
				$checkParent = GetRecord("cpmodules", array("id"=>$parent));
				// if(!$checkParent) {
				// 	$status = false;
				// 	$message = "Invalid Subject Reference sent";
				// } else {
				if (!$checkParent) {
					$depth = 3;
				} else {
					$depth = $checkParent['level'] + 1;
				}
					$checkCourses = array(); //GetRecords("mdl_course", array("category"=>$parent));
					if(count($checkCourses) > 0) {
						$status = false;
						$message = "Cannot create sub level as Chapters are created inside";
					} else {
						$records = GetRecords("cpmodules", array("parentId"=>$parent), array());
						$sequence = count($records);
						++$sequence;
						$sub_id = InsertRecord("cpmodules", array("module"=>$subject_name, "category_id"=>0, "level"=>$depth, "parentId"=>$parent, "sequence"=>$sequence, "created_by"=>$login_userid, "created_on"=>$ctime,"type" => "chapter"));
						// $records = GetRecords("masters_subject_classes", array("subject_id"=>$parent));
						// foreach($records as $record) {
						// 	$parent_class_id = $record['category_id'];
						// 	$thisClass = $record['class'];
						// 	//Insert into Moodle
						// 	$moodle_response = InsertCategoryIntoMoodle(array("name"=>$subject_name, "parent"=>$parent_class_id));
						// 	if(count($moodle_response)  == 0) {
						// 		$status = false;
						// 		$message .= "Subject: $subject_name & Class: $thisClass are  not tagged because Insertion to Moodle failed.  ";
						// 		continue;
						// 	} else {
						// 		$insert_cat_id = $moodle_response[0]['id'];
						// 	}
						// 	InsertRecord("masters_subject_classes", array("subject_id"=>$sub_id, "class"=>$record['class'], "category_id"=>$insert_cat_id));
						// }
						$_SESSION['open_subject'] = $parent;
						$status = true;
						$message = "Sub level created successfully";
					// }
				}
			}
		} else {
			$status = false;
		}
	} else {
		$status = false;
		$message = "Mandatory Fields are missing";
	}
} else if($type == "renameSubject") {
	if(isset($_POST['subjectname'], $_POST['sub_id'])) {
		$sub_id = intval($_POST['sub_id']);
		$subject_name = $_POST['subjectname'];
		$info = GetRecord("cpmodules", array("id"=>$sub_id));
		if($info) {
			$output['oldSubjectName'] = $info['module'];
			if(strlen($subject_name) == 0) {
				$status = false;
				$message = "Subject Name cannot be blank";
			} else {
				// $records = GetRecords("masters_subject_classes", array("subject_id"=>$sub_id));
				// foreach($records as $record) {
				// 	//Update to Moodle
				// 	$moodle_response = UpdateCategoryIntoMoodle(array("name"=>$subject_name, "id"=>$record['category_id']));
				// }
				if($message == "") {
					//Update Subject Name into Mastr
					$query = "UPDATE cpmodules SET module = ? WHERE id = ?";
					$stmt = $db->prepare($query);
					$stmt->execute(array($subject_name, $sub_id));
					$status = true;
					$message = "Subject Name updated successfully";
				}
			}
		} else {
			$message = "Invalid data sent";
		}
	} else {
		$status = false;
		$message = "Mandatory Fields are missing";
	}
	$snackbar = false;
} else if($type == "deleteSubject") {
	if(isset($_POST['id'])) {
		$sub_id = intval($_POST['id']);
		$info = GetRecord("cpmodules", array("id"=>$sub_id));
		if($info) {
			//Check if any sub levels are there are not
			$check1 = GetRecords("cpmodules", array("parentId"=>$sub_id));
			if(count($check1) > 0) {
				$message = "Cannot delete Subject as Sub Subjects are created";
			} else {
				//$checkCourses = GetRecords("mdl_course", array("category"=>$sub_id));
				//if(count($checkCourses) > 0) {
				if(false) {
					$status = false;
					$message = "Cannot delete Subject as Chapters are created inside";
				} else {
					$records = GetRecords("masters_subject_classes", array("subject_id"=>$sub_id));
					// foreach($records as $record) {
					// 	//Update to Moodle
					// 	$moodle_response = DeleteCategoryFromMoodle(array("id"=>$record['category_id'], "newparent"=>1));
					// }
					if($message == "") {
						//Delete Subject Name into Master
						$query = "DELETE FROM cpmodules WHERE id = ?";
						$stmt = $db->prepare($query);
						$stmt->execute(array($sub_id));

						$query = "DELETE FROM masters_subject_classes WHERE subject_id = ?";
						$stmt = $db->prepare($query);
						$stmt->execute(array($sub_id));

						$status = true;
						$message = "Subject deleted successfully";
						$snackbar = false;
					}
				}
			}
		} else {
			$status = false;
			$message = "Invalid data sent";
		}
	} else {
		$status = false;
		$message = "Mandatory Fields are missing";
	}
} else if($type == "reOrderSubjectL1") {
	if(isset($_POST['reload']) && $_POST['reload'])
		$snackbar = true;
	else
		$snackbar = false;
	if(isset($_POST['sequence'])) {
		$sequence_list = explode(",", $_POST['sequence']);
		$count = 0;
		foreach($sequence_list as $key=>$list) {
			if($list != "") {
				$id = str_replace("card", "", $list);

				$query = "UPDATE cpmodules SET sequence = ? WHERE id = ?";
				$stmt = $db->prepare($query);
				$stmt->execute(array($key + 1, $id));

				$records = GetQueryRecords("SELECT GROUP_CONCAT(category_id) AS catids FROM `masters_subject_classes` WHERE subject_id = ?", array($id));
				$catids = $records[0]['catids'];
				// if($catids != '') {
				// 	$query = "UPDATE mdl_course_categories SET sortorder = ? WHERE id IN ($catids)";
				// 	$stmt = $db->prepare($query);
				// 	$stmt->execute(array($key + 1));
				// }
			}
		}
		$status = true;
		$message = "Subject sequence updated";
	} else {
		$message = "Mandatory Fields are not sent";
	}
} else if($type == "getSubjectDetails") {
	if(isset($_POST['sub_id'])) {
		$sub_id = intval($_POST['sub_id']);
		$info = GetRecord("cpmodules", array("id"=>$sub_id));
		if($info) {
			$subname = $info["module"];
			$records = GetQueryRecords("SELECT GROUP_CONCAT(parentId) AS classes FROM `cpmodules` WHERE module = ?", array($subname));
			$classes = $records[0]['classes'];
			$status = true;
			$output['Result'] = array("category_id"=>$info['category_id'], "classes"=>$classes);
			$snackbar = false;
		} else {
			$status = false;
			$message = "Invalid data sent";
		}
	} else {
		$status = false;
		$message = "Mandatory Fields are missing";
	}
} else if($type == "updateSubjectDetailsL1") {
	if(isset($_POST['par_sub_edit_category'], $_POST['subject_id'])) {
		$sub_id = intval($_POST['subject_id']);
		$category_id = intval($_POST['par_sub_edit_category']);
		$info = GetRecord("cpmodules", array("id"=>$sub_id));
		if($info) {
			$query = "UPDATE cpmodules SET category_id = ? WHERE id = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($category_id, $sub_id));

			$records = GetQueryRecords("SELECT GROUP_CONCAT(class) AS classes FROM `masters_subject_classes` WHERE subject_id = ?", array($sub_id));
			$classes_before = explode(",", $records[0]['classes']);
			// $classes_after = $_POST['par_sub_edit_classes'];
			$classes_after = [];
			$remove_classes = array_diff($classes_before, $classes_after);
			$remove_classes = array_filter($remove_classes);
			// foreach($remove_classes as $thisClass) {
			// 	$record1 = GetRecord("masters_subject_classes", array("subject_id"=>$sub_id, "class"=>$thisClass));
			// 	$category_id = $record1['category_id'];
			// 	DeleteCategoryFromMoodle(array("id"=>$record1['category_id']));
			// }
			// if(count($remove_classes) > 0) {
			// 	$remove_classes_string = implode(",", $remove_classes);
			// 	$query = "DELETE FROM masters_subject_classes WHERE subject_id = ? AND class IN ($remove_classes_string)";
			// 	$stmt = $db->prepare($query);
			// 	$stmt->execute(array($sub_id));
			// }

			$class_category_ids = array();
			$classes = getClassNames("1");
			foreach($classes as $thisClass) {
				$class_category_ids[$thisClass['id']] = $thisClass['id'];
			}
			$insert_classes = array_diff($classes_after, $classes_before);
			foreach($insert_classes as $thisClass) {
				$parent_class_id = $class_category_ids[$thisClass];
				//Insert into Moodle
				// $moodle_response = InsertCategoryIntoMoodle(array("name"=>$info['name'], "parent"=>$parent_class_id));
				// if(count($moodle_response)  == 0) {
				// 	$status = false;
				// 	$message .= "Subject: $subject_name & Class: $thisClass are  not tagged because Insertion to Moodle failed.  ";
				// 	continue;
				// } else {
				// 	$insert_cat_id = $moodle_response[0]['id'];
				// }
				// $query = "UPDATE mdl_course_categories SET sortorder = ? WHERE id = ?";
				// $stmt = $db->prepare($query);
				// $stmt->execute(array($info['sequence'], $insert_cat_id));
				// InsertRecord("masters_subject_classes", array("subject_id"=>$sub_id, "class"=>$thisClass, "category_id"=>$category_id));
			}
			$status = true;
			$message= "Subject Details changed successfully";
			$snackbar = false;
		} else {
			$status = false;
			$message = "Invalid data sent";
		}
	} else {
		$status = false;
		$message = "Mandatory Fields are missing";
	}
} else if($type == "addSubChildLevel") {
	if(isset($_POST['sub_child_subject'], $_POST['sub_child_subject_parent_id'])) {
		//Check if any courses are added under this
		$subject_names = array();
		if(is_array($_POST['sub_child_subject'])) {
			$subject_names = $_POST['sub_child_subject'];
		} else {
			$subject_names[] = $_POST['sub_child_subject'];
		}
		$validation = true;
		foreach($subject_names as $key=>$subject_name) {
			if(! validateSubjectNameCharacters($subject_name)) {
				$validation = false;
				$message = "Subject Name contains invalid characters in Row: ".($key + 1);
				break;
			}
		}
		if($validation) {
			foreach($subject_names as $subject_name) {
				$parent = intval($_POST['sub_child_subject_parent_id']);
				$checkParent = GetRecord("cpmodules", array("id"=>$parent));
				$type = $_POST["sub_child_subject_type"];
				if(!$checkParent) {
					$status = false;
					$message = "Invalid Subject Reference sent";
				} else {
					$depth = $checkParent['level'] + 1;
					$checkCourses = array(); //GetRecords("mdl_course", array("category"=>$parent));
					if(count($checkCourses) > 0) {
						$status = false;
						$message = "Cannot create sub level as Chapters are created inside";
					} else {
						$records = GetRecords("cpmodules", array("parentId"=>$parent), array());
						$sequence = count($records);
						++$sequence;
						if($depth==5){
							$type = "subTopic";
						}
						$sub_id = InsertRecord("cpmodules", array("module"=>$subject_name, "category_id"=>0, "level"=>$depth, "parentId"=>$parent, "sequence"=>$sequence, "created_by"=>$login_userid, "created_on"=>$ctime,"type" => $type));
						$records = GetRecords("masters_subject_classes", array("subject_id"=>$parent));
						foreach($records as $record) {
							$parent_class_id = $record['category_id'];
							//Insert into Moodle
							// $moodle_response = InsertCategoryIntoMoodle(array("name"=>$subject_name, "parent"=>$parent_class_id));
							// if(count($moodle_response)  == 0) {
							// 	$status = false;
							// 	$message .= "Subject: $subject_name & Class: $thisClass are  not tagged because Insertion to Moodle failed.  ";
							// 	continue;
							// } else {
							// 	$insert_cat_id = $moodle_response[0]['id'];
							// }
							// InsertRecord("masters_subject_classes", array("subject_id"=>$sub_id, "class"=>$record['class'], "category_id"=>$record['category_id']));
						}
						//Get main Subject
						$ms = GetRecord("cpmodules", array("id"=>$parent));
						$_SESSION['open_subject'] = $ms['parentId'];
						$status = true;
						$message = "Sub level created successfully";
					}
				}
			}
		} else {
			$status = false;
		}
	} else {
		$status = false;
		$message = "Mandatory Fields are missing";
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