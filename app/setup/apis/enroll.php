<?php session_start();
  include "../../configration/config.php";
  require_once "../../functions/db_functions.php";
  include "../functions/common_function.php";
  
  $type = $_POST['type'];
  $output = array();
  $output['status'] = false;
  $output['message'] = "";
  $status = false;
  $message = "";
  $snackbar = true;
  $ctime = date("Y-m-d H:i:s");
  $login_userid = $_SESSION['cms_userid'];

	if($type == "getSelectData"){
		if(isset($_POST['id'])){
			$id = $_POST['id'];
			$catid = explode('-',$id);
			$getSection = GetRecords("masters_sections", array("class"=>$catid[0]));
			$getSubjects = GetRecords("cpmodules", array("parentId"=>$catid[0],"type" => "subject","deleted" => 0));
			$subjectarray = '<option value="">-Choose Subject-</option>';
			foreach($getSubjects as $key=>$value){
				$subjectarray .= '<option value="'.$value['id'].'">'.$value['module'].'</option>';
				// $records1 = GetRecords("cpmodules", array("parentId"=>$value['id']));
				// $records[$key]['child'] = $value;
				// foreach($records[$key]['child'] as $key1=>$value1){
					
				// 	$records2 = GetRecords("cpmodules", array("parentId"=>$value1['id']));
				// 	if(count($records2) > 0) {
				// 		$subjectarray .= '<option class="font-weight-bold" value="'.$value1['id'].'">&nbsp;&nbsp;'.$value1['module'].'</option>';
				// 	} else {
				// 		$subjectarray .= '<option value="'.$value1['id'].'">&nbsp;&nbsp;'.$value1['module'].'</option>';	
				// 	}
				// 	$records[$key]['child'][$key1]['sub_child'] = $records2;
				// 	foreach($records[$key]['child'][$key1]['sub_child'] as $key2=>$value2){
				// 		$subjectarray .= '<option  value="'.$value2['id'].'">&nbsp;&nbsp;&nbsp;&nbsp;'.$value2['module'].'</option>';

				// 	}
				// }
			}
			$section = '<option value="">-Choose Section-</option>';
			foreach($getSection as $key=>$value){
				$section .= '<option value="'.$value['section'].'">'.$value['section'].'</option>';
			}
			$section1 = '<option value="">-Choose Section-</option>';
			foreach($getSection as $key=>$value){
				$section1 .= '<option value="'.$value['id'].'">'.$value['section'].'</option>';
			}
			$status = true;
			$message = "Class Section and Subjects fetched";
			$output['Result']['Section'] = $section;
			$output['Result']['Section1'] = $section1;
			$output['Result']['Subject'] = $subjectarray;
			$snackbar = false;
		}else{
			$status = false;
			$message = "Mandatory Fields are missing";
		}
	}else if($type == "saveData"){
		if(isset($_POST['teacher_id'])){
			$classes = [];
			$teacher_id = $_POST['teacher_id'];
			$section 	= $_POST['section'];
			$class 		= $_POST['class'];
			$subject 	= $_POST['subject'];

			$class 		= explode(',',$class);
			$section 	= explode(',',$section);
			$subject 	= explode(',',$subject);
			$checkclass = in_array("", $class);
			$checksection = in_array("", $section);
			$checksubject = in_array("", $subject);

			if($checkclass != 1 && $checksection != 1 && $checksubject != 1){
				for ($i=0; $i < sizeof($class); $i++) { 
					$cls = explode('-',$class[$i]);
					$classes[] = $cls[0];
				}
	
				for ($i=0; $i < sizeof($class); $i++) { 
					$sub_id = InsertRecord("teacher_subject_mapping", array("user_id"=>$teacher_id, "class"=>$classes[$i], "section"=>$section[$i], "courseid"=>$subject[$i],'updated_by'=>$login_userid,"updated_on"=>$ctime));
				}
				$snackbar = true;
				$status = true;
				$message = "Teacher Assigned successfully";
				
			}else{
				$status = false;
				$message = "Mandatory Fields Required";
			}
			
		}else{
			$status = false;
			$message = "Something Went Wrong Try Again!";
		}
	}else if($type == "updateData"){
		if(isset($_POST['teacher_id'])){
			$classes = [];
			$teacher_id = $_POST['teacher_id'];
			$section 	= $_POST['section'];
			$class 		= $_POST['class'];
			$subject 	= $_POST['subject'];
			$table_id 	= $_POST['tableid'];

			$class 		= explode(',',$class);
			$section 	= explode(',',$section);
			$subject 	= explode(',',$subject);
			$table_id 	= explode(',',$table_id);

			$checkclass = in_array("", $class);
			$checksection = in_array("", $section);
			$checksubject = in_array("", $subject);

			if($checkclass != 1 && $checksection != 1 && $checksubject != 1){
				for ($i=0; $i < sizeof($class); $i++) { 
					$cls = explode('-',$class[$i]);
					$classes[] = $cls[0];
				}

				$query = "DELETE FROM teacher_subject_mapping WHERE user_id = ?";
				$stmt = $db->prepare($query);
				$stmt->execute(array($teacher_id));

				for ($i=0; $i < sizeof($class); $i++) {
					$sub_id = InsertRecord("teacher_subject_mapping", array("user_id"=>$teacher_id, "class"=>$classes[$i], "section"=>$section[$i], "courseid"=>$subject[$i],'updated_by'=>$login_userid,"updated_on"=>$ctime));
				}
				$status = true;
				$message = "Teacher Subjects Mapping data updated Successfully";
				$snackbar = true;
				
			}else{
				$status = false;
				$message = "Mandatory Fields Required";
			}
			
		}else{
			$status = false;
			$message = "Something Went Wrong Try Again!";
		}
	}else if($type == "getClassData"){
		if(isset($_POST['id'])){
			$id = $_POST['id'];
			$Section = $_POST['Section'];
			$catid = explode('-',$id);
			$table_body = "";
			$selected = "";
			$count = 0;

			$records = GetQueryRecords("SELECT DISTINCT(id) as subject_id FROM cpmodules WHERE parentId =". $catid[0]);

			foreach($records as $keySubject=>$valueSubject){
				$getSubjects = GetRecords("cpmodules", array("id"=>$valueSubject['subject_id'], "level"=>2));
				foreach($getSubjects as $keyCategory=>$valueCategory){
					$getcategory = GetRecords("masters_subject_category",array("id"=>$valueCategory['category_id']));
					
					foreach($getcategory as $keycatname=>$valuecatname){
						if($valuecatname['mandatory'] == 1) {
							$finalcategory[$valueCategory['category_id']][][$valueCategory['id']]=$valueCategory['module'];
						} else if($valuecatname['id'] == $valueCategory['category_id']) {
							$finalcategory[$valueCategory['category_id']][][$valueCategory['id']]=$valueCategory['module'];
						}
					}
					
				}
			}
			foreach($finalcategory as $keyfinal=>$valuefinal){
				$getcategory = GetRecords("masters_subject_category",array("id"=>$keyfinal));
				$count++;
				if($getcategory[0]['mandatory'] == 1){
					foreach($valuefinal as $keycat => $valuecat){
						foreach($valuecat as $keyval =>$valueIndex){
							$table_body .= '<tr id="multipleSelect'.$keyfinal.'" value="'.$keyval.'">';
							$table_body .= '<td>'.$getcategory[0]['name'].'</td>';
							$table_body .= '<td>'.$valueIndex.'</td>';
							$table_body .= '<tr>';
						}
						
					}
				}else{
					$table_body .='<tr>';
					$table_body .='<td class="cat_td">'.$getcategory[0]['name'].'</td>';
					$table_body .='<td><select class="form-control sub_opts" name="select'.$keyfinal.'" id="multipleSelect'.$keyfinal.'"  multiple="multiple">';
					foreach($valuefinal as $keycat => $valuecat){
						foreach($valuecat as $keyval =>$valueIndex){
							$getcategory = GetRecords("class_subject_assignment",array("subjectid"=>$keyval,"section"=>$Section));
						//print_r($getcategory);

							if(count($getcategory)>0){
								$selected = ' selected="selected"';
							}else{
								$selected = "";
							}
							$table_body .= '<option value="'.$keyval.'" '.$selected.'>'.$valueIndex.'</option>';
						}	
						
					}
					$table_body .='</select></td>';
					$table_body .='</td>';
				}
				
			}

			$output['Result'] = $table_body;
			$output['Count'] = $count;
			
		}else{
			$status = false;
			$message = "Mandatory Fields are missing";
		}
	}else if($type == "saveClassData"){
		if(isset($_POST['class'])){
			$class_id 	= $_POST['class'];
			$section_id = $_POST['section'];
			$subject 	= $_POST['subjects'];
			$class_id = explode('-',$class_id);
			$subjects = explode(',',$subject);
			$finalarray  = array();

			$query = "DELETE FROM class_subject_assignment WHERE class = ? AND section = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($class_id[0],$section_id));

			$records = GetQueryRecords("SELECT DISTINCT(id) as subject_id FROM cpmodules WHERE parentId =". $class_id[0]);
			foreach($records as $keySubject=>$valueSubject){
				$getSubjects = GetRecords("cpmodules", array("id"=>$valueSubject['subject_id']));
				foreach($getSubjects as $keyCategory=>$valueCategory){
					$getcategory = GetRecords("masters_subject_category",array("id"=>$valueCategory['category_id']));
					foreach($getcategory as $keycatname=>$valuecatname){
						if($valuecatname['mandatory'] == 1){
							InsertRecord("class_subject_assignment", array("class"=>$class_id[0], "section"=>$section_id, "categoryid"=>$valueCategory['category_id'],"subjectid"=>$valueCategory['id']));
						}
					}
					
				}
			}
			foreach($subjects as $keysub=>$valuesub){
				if(isset($valuesub)){
					$getSubjects = GetRecords("cpmodules", array("id"=>$valuesub));
					
					foreach($getSubjects as $keycatname=>$valuecatname){
						InsertRecord("class_subject_assignment", array("class"=>$class_id[0], "section"=>$section_id, "categoryid"=>$valuecatname['category_id'],"subjectid"=>$valuesub));
					}
				}
			}
			// Fetching Student Data and subjects
			$table_head = '';
			$table_body = '';
			$recordStudent = GetQueryRecords("SELECT * FROM users WHERE class =". $class_id[0]." AND section = '".$section_id."'");
			$getclasssub = GetRecords("class_subject_assignment",array("class"=>$class_id[0],"section"=>$section_id));
			foreach($getclasssub as $keycsec => $valuecsec){
				$getcategory = GetRecords("masters_subject_category",array("id"=>$valuecsec['categoryid']));
				foreach($getcategory as $keycats =>$valuecats){
					if($valuecats['mandatory']!=1){
						$finalarray[$valuecsec['categoryid']][$valuecats['id']]=$valuecats['name'];
					}
				}
			}
			$table_head .= '<tr>';
			$table_head .= '<th>S.No.</th>';
			$table_head .= '<th>Admn No.</th>';
			$table_head .= '<th>Name</th>';
			foreach($finalarray as $keyhead => $valuehead){
				foreach($valuehead as $keyheadV => $valueheadV){
					$table_head .= '<th>'.$valueheadV.'</th>';
				}
			}
			$table_head .= '</tr>';
			$selected = '';
			
			foreach($recordStudent as $keyStu => $valueStu){
				$key = $keyStu + 1;
				$table_body .= '<tr>';
				$table_body .= '<td>'.$key.'</td><td>'.$valueStu['admission'].'</td><td>'.$valueStu['first_name'].'</td><input type="hidden" name="userid" value="'.$valueStu['id'].'">';
				foreach($finalarray as $keyfinal=>$valuefinal){
					$table_body .='<td><select class="form-control studentSubjects" name="select@'.$valueStu['id'].'@'.$keyfinal.'" id="multiple@'.$valueStu['id'].'@'.$keyfinal.'">';
					//$table_body .='<option value="">-Choose Subject-</option>';
						foreach($valuefinal as $keyheadV => $valueheadV){
							$getclasssub_val = GetRecords("class_subject_assignment",array("class"=>$class_id[0],"section"=>$section_id,"categoryid"=>$keyheadV));
							foreach($getclasssub_val as $classkey => $classvalue){
								$getcategory = GetRecords("cpmodules",array("id"=>$classvalue['subjectid']));
								//Get Category ID
								$mscInfo = GetRecord("cpmodules", array("id"=>$getcategory[0]['id'], "parentId"=>$class_id[0]));
								foreach($getcategory as $checkkey=>$checkvalue) {
									$getuser = GetRecords("student_subject_mapping",array("user_id"=>$valueStu['id'],"course_id"=>$mscInfo['category_id']));
									if(count($getuser)>0){
										$selected = ' selected="selected"';
									}else{
										$selected = ' ';
									}
									$table_body .='<option value="'.$mscInfo['category_id'].'" '.$selected.'>'.$getcategory[0]['module'].'</option>';
									
								}
								

							}
						}
					$table_body .= '</select></td>';
				}
				$table_body .= '/<tr>';
			}
			
			//print_r($finalarray);
			$output['tableHead'] = $table_head;
			$output['tableBody'] = $table_body;
			$snackbar = false;
			$status = true;
			//$message = "Subjects Updated Sucessfull";
		}else{
			$status = false;
			$message = "Mandatory Fields are missing";
		}
	}else if($type == "updateStudentData"){
		if(isset($_POST['userid'])){
			$user_id 	= $_POST['userid'];
			$subject 	= $_POST['subject'];
			$class_id 	= $_POST['class_id'];
			$class_id = explode('-',$class_id);
			// echo "<pre />";
			// print_r($subject);
			for ($i=0; $i < sizeof($user_id); $i++) {
				$query = "DELETE FROM student_subject_mapping WHERE user_id = ?";
				$stmt = $db->prepare($query);
				$stmt->execute(array($user_id[$i]));
				$temp1 = $subject[$user_id[$i]];
				$temp2 = explode("~", $temp1);
				foreach($temp2 as $temp3) {
					$temp4 = explode("|", $temp3);
					$category_id = $temp4[0];
					$selected_subject = $temp4[1];
					InsertRecord("student_subject_mapping", array("user_id"=>$user_id[$i], "course_id"=>$selected_subject,"subject_id"=>$category_id,"updated_by"=>$login_userid));
				}
			}
			$status = true;
			$message = "Subjects Assigned Successfully";
			$snackbar = false;

		}else{
			$status = false;
			$message = "Mandatory Fields Required";
		}
	} else if($type == "getTeacherSearchData") {
		$search = $_POST['search'];
		$teacherList = getTeacherLists($search);
		$div = "";
		foreach($teacherList as $key=>$list) {
			$div .= '<div class="position-relative mx-auto " id="card_blk">
              <div class="card mb-3 border-0 shadow">
				<form action="enroll_teacher_assign.php" method="post">
					<div class="card-header d-flex align-items-center">
						<p class="mb-0 mr-3 font-weight-medium">'.($key+1).'</p>
						<p class="mr-auto m-0 font-weight-medium">'. $list['firstname'].' '.$list['lastname'].'</p>';

			if($list['count']>0) {
				// <img src="https://cdn3.iconfinder.com/data/icons/flat-actions-icons-9/792/Tick_Mark_Dark-512.png" class="mr-4" style="width: 25px">
				$div .= '<a href="../admin/accessright.php?id='.Encrypt($list['id']).'&action=teacher" class="btn btn-md btn-blue py-1 mr-2">Edit Access Rights</a>
						<input type="submit" value="Edit" name="submit" class="btn btn-md btn-blue py-1 px-4">';
			} else {
				$div .= '<a href="../admin/accessright.php?id='.Encrypt($list['id']).'&action=teacher" class="btn btn-md btn-blue py-1 mr-2">Edit Access Rights</a>
					<input type="submit" value="Assign" name="submit" class="btn btn-md btn-yellow py-1">';
			}
			$div .= '<input type="hidden" name="teachId" value="'.$list['id'].'">
					</div>
				</form>
              </div>
            </div>';
        }
		$output['Result'] = $div;
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