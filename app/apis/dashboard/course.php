<?php
require_once "../headersValidation.php";

if($request_method == "POST") {
	$response = array();
	$status = false;
	$message = "";
	$input = json_decode(file_get_contents('php://input'), true);
	if(isset($input['type'])) {
		require('../../../config.php');
		require('../../../config_payments.php');
		require('../../../config_schools.php');
		require('../../../config_cms.php');
		global $DB, $USER, $CFG;
		require_once($CFG->libdir.'/datalib.php');
		require "../loginSessionValidation.php";
		require_once "../db_functions.php";
		require_once($CFG->dirroot.'/cohort/locallib.php');
		require_once "../common_functions.php";

		$type = $input['type'];
		$login_userid = $USER->id;

		try
		{
			$userid = $USER->id;
			if(isset($input['viewClass']) && intval($input['viewClass']) > 0) {
				$userClass = $input['viewClass'];
			} else {
				$userClass = $USER->Class;
				if($userClass == "") {
					$userClass = $USER->class;
				}
			}
			$schoolcode = getSanitizedData($_COOKIE['school_code']);

			if($type == "getClasses") {
				$display_classes = getDisplayClasses();
				
				$status = true;
				$result = $display_classes;
			} else if($type == "getCourses") {
				$list = array();
				//Badges Earned
				$badges_ref = array();
				$badges = $DB->get_records("prepmyskills_badges", array('userid'=>$userid), '', 'cmid');
				foreach ($badges as $key => $value) {
					array_push($badges_ref, $value->cmid);
				}
				//Get Favourite Status
				$query = "SELECT * FROM user_favourite_courses WHERE user_id = ?";
				$stmt = $db->prepare($query);
				$stmt->execute(array($userid));
				$myFavouriteTopics = $stmt->fetchAll(PDO::FETCH_ASSOC);
						
				//Get Overall Rating
				$rating = array();
				$query = "SELECT AVG(rating) as rating, course_id FROM user_ratings WHERE academic_year = '$academic_year' GROUP BY course_id;";
				$stmt = $dbs->query($query);
				while($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$rating[$rows['course_id']] = round($rows['rating'], 2);
				}

				$trail_topics = array();
				//If Trial Version user, load them
				if($USER->aim == "Trial") {
					$queryT = "SELECT course_id FROM b2c_full_freetopics WHERE school_id=?";
					$stmtT = $dbs->prepare($queryT);
					$stmtT->execute(array($USER->school));
					$rowcountT = $stmtT->rowCount();
					if($rowcountT) {
						$response['plan'] = 'trial';
						while($rowsT = $stmtT->fetch(PDO::FETCH_ASSOC)) {
							$trail_topics[] = $rowsT['course_id'];
						}
					} else {
						$response['plan'] = 'full';
					}

					

					$expiryData = GetExpiryData($userClass);
					$response['Expiry'] = $expiryData;
				}
				// print_r($trail_topics);
				if(isset($input['catid'])) {
					//Badge Master
					$query = "SELECT * FROM badge_master";
					$stmt = $dbs->query($query);
					$badgeMaster = $stmt->fetchAll(PDO::FETCH_ASSOC);
					if(is_numeric($input['catid'])) {
						$thisCatid = $input['catid'];
					} else {
						$thisCatid = Decrypt($input['catid']);
					}
					$list = getchildren($thisCatid, array(), $badges_ref, $badgeMaster, $myFavouriteTopics, $rating, $trail_topics);

					// Get Category Details
					$response['CategoryInfo'] = $DB->get_record('course_categories', array('id'=>$thisCatid), 'id, name, theme');
					if($response['CategoryInfo']->name == "Profile Builder") {
						$response['CategoryInfo']->back_url = "home";
					} else {
						$response['CategoryInfo']->back_url = "personality-builder";
					}

					//If the requested category is to load Pillars then remove Profile Builder from it
					if(strpos("Class ", $response['CategoryInfo']->name) == 0) {
						foreach($list as $key=>$item) {
							if($item['name'] == "Profile Builder") {
								unset($list[$key]);
							}
						}
						$list = array_values($list);
					}
				} elseif(isset($input['viewClass'])) {
					$trailCourses = array();
					$classnum = $input['viewClass'];

					//Badge Master
					$query = "SELECT * FROM badge_master WHERE class = ?";
					$stmt = $dbs->prepare($query);
					$stmt->execute(array($classnum));
					$badgeMaster = $stmt->fetchAll(PDO::FETCH_ASSOC);

					$category = $DB->get_record_sql("SELECT * FROM {course_categories} WHERE upper(name) LIKE 'CLASS $classnum'");
					$classlist = array('name' => $category->name, 'catid' => $category->id, 'parent' => true);
					$data = getchildren($category->id, array(), $badges_ref, $badgeMaster, $myFavouriteTopics, $rating, $trail_topics);

					$TotalBadges = 0;
					$BadgesEarned = 0;
					foreach ($data as $key => $value) {
						$TotalBadges += $value['TotalBadges'];
						$BadgesEarned += $value['BadgesEarned'];
						if($USER->aim == "Trial") {
							$courses = array();
							seperateCourses($value['children'], $courses);
							$data[$key]['AllCourses'] = $courses;
							//print_r($courses);
							foreach($courses as $thisCourse) {
								if($thisCourse['trail']) {
									array_push($trailCourses, $thisCourse);
								}
							}
						}
					}
					$classlist['TotalBadges'] = $TotalBadges;
					$classlist['BadgesEarned'] = $BadgesEarned;
					$classlist['children'] = $data;
					$classlist['TrailCourses'] = $trailCourses;

					//Points
					$classlist['TotalPoints'] = $DB->get_record_sql('SELECT SUM(points) AS no_of_points FROM {prepmyskills_points} WHERE mdl_userid =  :userid', array("userid"=>$userid))->no_of_points;
					$classlist['TotalPoints'] = intval($classlist['TotalPoints']);
					array_push($list, $classlist);
				} else {
					$display_classes = getDisplayClasses();
					$trailCourses = array();
					foreach($display_classes as $thisClass)
					{
						$classnum = str_replace('class', '', $thisClass);

						//Badge Master
						$query = "SELECT * FROM badge_master WHERE class = ?";
						$stmt = $dbs->prepare($query);
						$stmt->execute(array($classnum));
						$badgeMaster = $stmt->fetchAll(PDO::FETCH_ASSOC);

						$category = $DB->get_record_sql("SELECT * FROM {course_categories} WHERE upper(name) LIKE 'CLASS $classnum'");
						$classlist = array('name' => $category->name, 'catid' => $category->id, 'parent' => true);
						$data = getchildren($category->id, array(), $badges_ref, $badgeMaster, $myFavouriteTopics, $rating, $trail_topics);

						$TotalBadges = 0;
						$BadgesEarned = 0;
						foreach ($data as $key => $value) {
							$TotalBadges += $value['TotalBadges'];
							$BadgesEarned += $value['BadgesEarned'];
							if($USER->aim == "Trial") {
								$courses = array();
								seperateCourses($value['children'], $courses);
								$data[$key]['AllCourses'] = $courses;
								//print_r($courses);
								foreach($courses as $thisCourse) {
									if($thisCourse['trail']) {
										array_push($trailCourses, $thisCourse);
									}
								}
							}
						}
						$classlist['TotalBadges'] = $TotalBadges;
						$classlist['BadgesEarned'] = $BadgesEarned;
						$classlist['children'] = $data;
						$classlist['TrailCourses'] = $trailCourses;
						array_push($list, $classlist);
					}
				}
				
				$status = true;
				$result = $list;
			} else if($type == "getProductPrice") {
				$list = array();
				$expiryData = GetProductPrice($userClass);
				$list['product_price'] = $expiryData;
				
				$status = true;
				$result = $list;
			} else if($type == "getOnlyCourses") {
				$list = array();
				//Badges Earned
				$badges_ref = array();
				$badges = $DB->get_records("prepmyskills_badges", array('userid'=>$userid), '', 'cmid');
				foreach ($badges as $key => $value) {
					array_push($badges_ref, $value->cmid);
				}
				$display_classes = getDisplayClasses();
				$trail_topics = array();
				//If Trial Version user, load them
				if($USER->aim == "Trial") {
					$queryT = "SELECT course_id FROM b2c_full_freetopics WHERE school_id=?";
					$stmtT = $dbs->prepare($queryT);
					$stmtT->execute(array($USER->school));
					while($rowsT = $stmtT->fetch(PDO::FETCH_ASSOC)) {
						$trail_topics[] = $rowsT['course_id'];
					}
				}
				if(isset($input['catid'])) {
					//echo "***".Decrypt($input['catid']);
					//Get class of selected category
					$path = $DB->get_record("course_categories", array("id"=>Decrypt($input['catid'])))->path;
					$temp = explode("/", $path);
					//unset($temp[count($temp)-1]);					
					$temp = array_filter($temp);
					$class_id = reset($temp);
					$classDetails = $DB->get_record("course_categories", array("id"=>$class_id))->name;
					$class = str_replace("Class ", "", $classDetails);
					$comp_catid = Decrypt($input['catid']);
				} else if(isset($input['viewClass'])) {
					$class = intval($input['viewClass']);
					$class_name = "Class ".$class;
					$comp_catid = $DB->get_record("course_categories", array("name"=>$class_name))->id;
				}
				if(in_array($class, $display_classes)) {
					//Badge Master
					$query = "SELECT * FROM badge_master";
					$stmt = $dbs->query($query);
					$badgeMaster = $stmt->fetchAll(PDO::FETCH_ASSOC);

					//Get Favourite Status
					$query = "SELECT * FROM user_favourite_courses WHERE user_id = ?";
					$stmt = $db->prepare($query);
					$stmt->execute(array($userid));
					$myFavouriteTopics = $stmt->fetchAll(PDO::FETCH_ASSOC);
					
					//Get Overall Rating
					$rating = array();
					$query = "SELECT AVG(rating) as rating, course_id FROM user_ratings WHERE academic_year = '$academic_year' GROUP BY course_id;";
					$stmt = $dbs->query($query);
					while($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
						$rating[$rows['course_id']] = round($rows['rating'], 1);
					}

					$list = getchildren($comp_catid, array(), $badges_ref, $badgeMaster, $myFavouriteTopics, $rating, $trail_topics);
				} else {

				}
				
				$courses = array();
				//If the requested category is to load Pillars then remove Profile Builder from it
				if(!isset($input['catid'])) {
					foreach($list as $key=>$item) {
						if($item['name'] == "Profile Builder") {
							unset($list[$key]);
						}
					}
					$list = array_values($list);
				}
				seperateCourses($list, $courses);
				$status = true;
				if($USER->aim == "Trial") {
					$response['userPlan'] = $USER->aim;
					$trialTopics = $fullVersionTopics = array();
					foreach($courses as $course) {
						if($course['trail']) {
							$trialTopics[] = $course;
						} else {
							$fullVersionTopics[] = $course;
						}
					}
					$courses = array();
					$response['TrialTopics'] = $trialTopics;
					$response['FullTopics'] = $fullVersionTopics;
				}
				$result = $courses;
				
			} else if($type == "getChapters") {
				if(isset($input['courseid'])) {
					$courseid = Decrypt($input['courseid']);
					$eligibleStatus = CheckCourseEligibility($courseid);
					if($eligibleStatus['status']) {
						$profile_builder_course = false;
						$modules = get_fast_modinfo($courseid);

						$BadgeEarned = $DB->get_records("prepmyskills_badges", array('userid'=>$userid, "cmid"=>$courseid), '', 'cmid');
						
						$query = "SELECT * FROM badge_master WHERE courseid = ?";
						$stmt = $dbs->prepare($query);
						$stmt->execute(array($courseid));
						if($badgeMaster = $stmt->fetch(PDO::FETCH_ASSOC)) {
							if(count($badgeMaster) == 0) {
								$badgePathPNG = $badgeMaster['icon_inactive_png'];
								$badgePathSVG = $badgeMaster['icon_inactive_svg'];
							} else {
								$badgePathPNG = $badgeMaster['icon_active_png'];
								$badgePathSVG = $badgeMaster['icon_active_svg'];
							}
						}
						$modules->badgePathPNG = $badgePathPNG;
						$modules->badgePathSVG = $badgePathSVG;
						
						$course = $DB->get_record('course', array('id' => $courseid));
						$coursename = $course->fullname;
						$category = $course->category;
						$modules->courseFullName = $coursename;
						$modules->courseDescription = strip_tags($course->summary);
						$path = $DB->get_record('course_categories', array('id' => $category))->path;
						$temp = explode("/", $path);
						if(isset($temp[2]))
						{
							$color_category = $temp[2];
							$categoryname = $DB->get_record('course_categories', array('id' => $color_category))->name;
							$modules->CategoryName = $categoryname;
						}
						else
						{
							$modules->CategoryName = "";
						}

						//360 Degrees Report
						$dev_prof_cmids = array();
						$dev_prof_reports = array();
						$query12 = "SELECT * FROM `360_instrument_master` WHERE active = 1";
						$stmt12 = $db->query($query12);
						while($row12 = $stmt12->fetch(PDO::FETCH_ASSOC)) {
							$thisreport = array();
							$thisreport['ID'] = $row12['id'];
							$dev_prof_cmids[] = $row12['cmid'];
							$thisreport['Name'] = $row12['instrument'];
							$thisreport['cmid'] = $row12['cmid'];
							//Check Questionnaire Status
							$query4= "SELECT id FROM mdl_questionnaire_response WHERE survey_id = ? AND username = ? AND complete='y'";
							$result4 = $db->prepare($query4);
							$result4->execute(array($row12['questionnaire_id'], $USER->id));
							$rowcount = $result4->rowCount();
							if($rowcount) {
								$thisreport['CompletionStatus'] = true;
								$thisreport['ReportLink'] = "#";
								$thisreport['gen_rep_btn'] = true;
							} else {
								$thisreport['CompletionStatus'] = false;
								$thisreport['AttemptLink'] = "#/scenario/".$row12['cmid'];
								$thisreport['gen_rep_btn'] = false;
							}
							$thisreport['report_path'] = "";
							
							$thisreport['report_path'] = "";
							$thisreport['loader'] = false;
							$dev_prof_reports[$row12['cmid']] = $thisreport;

							//Get Course ID
							$this_course_id = $DB->get_record('course_modules', array("id"=>$row12['cmid']))->course;
							if($this_course_id == $courseid) {
								$profile_builder_course = true;
							}
						}
						$modules->DevProfile = $dev_prof_reports;

						
						//Get CMID wise Completion
						$cmids = $DB->get_records('course_modules', array('course' => $courseid, "visible"=>1));
						$no_of_completion = 0;
						foreach($cmids as $cmid_record)
						{
							$completion[$cmid_record->id] = GetCompletionStatus($cmid_record->id);
							if($completion[$cmid_record->id]) {
								$no_of_completion++;
							}
							//ICON Decision
							$icon = "";
							$modid = $cmid_record->module;
							$instance = $cmid_record->instance;
							$module_name = $DB->get_record('modules', array('id' => $modid))->name;
							$cm_name = $DB->get_record($module_name, array('id' => $instance))->name;
							if($module_name == "lesson")
							{
								if(strpos($cm_name, "Activity") !== false)
									$icon = "Activity";
								else if(strpos($cm_name, "Recap") !== false)
									$icon = "Summary";
								else if(strpos($cm_name, "Scenario") !== false)
									$icon = "Scenario";
								else
									$icon = "Concept";
							}
							else if($module_name == "questionnaire")
								$icon = "Scenario";
							else if($module_name == "quiz")
							{
								if(strpos($cm_name, "Assessment") !== false)
									$icon = "CYU";
								else
									$icon = "Activity";
							}
							$Icon[$cmid_record->id] = $icon;
							if(in_array($cmid_record->id, $dev_prof_cmids))
								$DP[$cmid_record->id] = true;
							else
								$DP[$cmid_record->id] = false;
						}
						$modules->DP = $DP;
						$modules->Completion = $completion;
						$modules->CompletionPercentage = round(($no_of_completion / count($cmids) * 100));
						$modules->Icon = $Icon;

						//Content Lock or Show
						$show = 1;
						$modules->CourseStatus = 1;

						$query = "SELECT is_favourite FROM user_favourite_courses WHERE user_id = ? AND course_id = ?";
						$stmt = $db->prepare($query);
						$stmt->execute(array($userid, $courseid));
						if($record = $stmt->fetch(PDO::FETCH_ASSOC)) {
							$is_favourite = $record['is_favourite'];
						} else {
							$is_favourite = false;
						}
						$modules->is_favourite = intval($is_favourite);

						$modules->l1_id = Encrypt(getL1CategoryID($courseid, $userClass));
						$modules->userPlan = $USER->aim;
						$status = true;
						$cms2 = array();
						foreach($modules->cms as $k=>$temp) {
							foreach($temp as $key=>$value) {
								if($key == "id")
									$cms2[$k]['id2'] = Encrypt($value);	
								$cms2[$k]['id'] = $value;	
							}
							//echo "**".$modules->cms[$k]['id'];
							//
						}
						$modules->cms2 = $cms2;
						$modules->NextTopic = getNextChapter($courseid, $userClass);
						$completionText = array();
						if($profile_builder_course) {
							$completionText['Heading'] = "Congratulations!";
							$completionText['Para1'] = "Click on next to continue";
							$completionText['ButtonLabel'] = "Next";
						} else {
							$completionText['Heading'] = "Congratulations!";
							$completionText['Para1'] = "You have reached the end of the topic";
							$completionText['ButtonLabel'] = "Next Topic";
						}
						$modules->completionText = $completionText;
						$result = $modules;
					} else {
						$response['status'] = false;
						$response['userPlan'] = $USER->aim;
						$message = $eligibleStatus['Message'];
					}
				} else {
					http_response_code(401);
					$response['status'] = false;
					$message = "Required parameters are not sent";
				}
			} else if($type == "favourite") {
				if(isset($input['courseid'], $input['favourite'])) {
					$courseid = is_numeric($input['courseid']) ? $input['courseid'] : Decrypt($input['courseid']);
					$is_favourite = intval($input['favourite']);
					$query = "SELECT id FROM user_favourite_courses WHERE user_id = ? AND course_id = ?";
					$stmt = $db->prepare($query);
					$stmt->execute(array($userid, $courseid));
					if($record = $stmt->fetch(PDO::FETCH_ASSOC)) {
						$autoid = $record['id'];
						$query = "UPDATE user_favourite_courses SET is_favourite = ?, updated_on = NOW() WHERE id = ?";
						$stmt = $db->prepare($query);
						$stmt->execute(array($is_favourite, $autoid));
					} else {
						$query = "INSERT INTO user_favourite_courses (user_id, is_favourite, course_id) VALUES (?, ?, ?)";
						$stmt = $db->prepare($query);
						$stmt->execute(array($userid, $is_favourite, $courseid));
					}
					$status = true;
					//Topic Details
					$coursename = $DB->get_record('course', array('id' => $courseid))->fullname;
					if($is_favourite) {
						$message = "$coursename is added to your favourite list";
					} else {
						$message = "$coursename is removed from your favourite list";
					}
				} else {
					$status =false;
					$message = "All mandatory fields are not sent";
				}
			} else if($type == "favouriteList") {
				$category = $DB->get_record_sql("SELECT * FROM {course_categories} WHERE upper(name) LIKE 'CLASS $userClass'");
				$catid = $category->id;

				//Badges Earned
				$badges_ref = array();
				$badges = $DB->get_records("prepmyskills_badges", array('userid'=>$userid), '', 'cmid');
				foreach ($badges as $key => $value) {
					array_push($badges_ref, $value->cmid);
				}

				//Badge Master
				$query = "SELECT * FROM badge_master";
				$stmt = $dbs->query($query);
				$badgeMaster = $stmt->fetchAll(PDO::FETCH_ASSOC);

				//Get Favourite Status
				$query = "SELECT * FROM user_favourite_courses WHERE user_id = ?";
				$stmt = $db->prepare($query);
				$stmt->execute(array($userid));
				$myFavouriteTopics = $stmt->fetchAll(PDO::FETCH_ASSOC);

				$list = getchildren($catid, array(), $badges_ref, $badgeMaster, $myFavouriteTopics, array());

				$courses = array();
				seperateCourses($list, $courses);
				foreach($courses as $key=>$course) {
					if(! $course['is_favourite']) {
						unset($courses[$key]);
					}
				}
				$courses = array_values($courses);
				$status = true;
				$result = $courses;
			} else if($type == "searchCourse") {
				// $search_text = getSanitizedData($input['searchtext']);
				$validCourses = array();
				$query = "SELECT courseid FROM badge_master WHERE class = ?";
				$stmt = $dbs->prepare($query);
				$stmt->execute(array($userClass));
				while($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
					array_push($validCourses, $rows['courseid']);
				}
				//Get the topics which are opened
				$list = $DB->get_records("course", array("visible"=>1));
				$openedTopics = array();
				foreach ($list as $key => $temp) {
					array_push($openedTopics, $temp->id);
				}
				$cond = "";
				if(count($validCourses) > 0)  {
					$string = implode(",", $validCourses);
					$cond .= " AND id IN ($string)";
				}
				if(count($openedTopics) > 0)  {
					$string = implode(",", $openedTopics);
					$cond .= " AND id IN ($string)";
				}

				//Check user school id contains in the b2c_full_freetopics added on 22-07-2021
				$userSchoolId = $USER->school;
				$sch_courseids = array();
				$query_sch_check = "SELECT course_id FROM b2c_full_freetopics WHERE school_id = ?";
				$stmt_sch_check = $dbs->prepare($query_sch_check);
				$stmt_sch_check->execute(array($userSchoolId));
				if($stmt_sch_check->rowCount()) {
					while($rows_sch_check = $stmt_sch_check->fetch(PDO::FETCH_ASSOC)) {
						$sch_courseids[] = $rows_sch_check['course_id'];
					}
					if(count($sch_courseids) > 0)  {
						$string = implode(",", $sch_courseids);
						$cond .= " AND id IN ($string)";
					}
				}

				$result = array();
				if($cond != "") {
					// echo "SELECT id, fullname AS coursename FROM {course} WHERE fullname LIKE '%$search_text%' OR summary LIKE '%$search_text%' $cond";
					$records = $DB->get_records_sql("SELECT id, fullname as coursename, summary as description FROM {course} WHERE 1 $cond ORDER BY fullname");
					$records = array_values($records);
					foreach($records as $key=>$record) {
						$records[$key]->id = Encrypt($record->id);
					}
				}
				$result = $records;
				$status = true;
			} else if($type == "getCoursePrologue") {
				$result = array("Heading"=>"", "Coverage"=>"", "KeySkills"=>"");
				$info = GetRecord("master_class", array("code"=>$userClass));
				if($info) {
					$result = array("Heading"=>$info['cp_heading'], "Coverage"=>$info['cp_coverage'], "KeySkills"=>$info['cp_skills']);
				}
				add_to_log(0, 'CoursePrologue', 'view', $userClass, 0, '', $USER->id);
				$status = true;
			} else if($type == "getProfileBuilderCategory") {
				$records = GetQueryRecords("SELECT id FROM mdl_course_categories WHERE name = 'Class $userClass'");
				$class_id = $records[0]['id'];
				$result = $DB->get_record('course_categories', array('parent'=>$class_id, 'name'=>'Profile Builder'), 'id');
				$result->id2 = Encrypt($result->id);
				$result->url = "/chapter/".$result->id2;
				$status = true;
			} else if($type == "getKeySkills") {
				$keySkills = array();
				$records = GetQueryRecords("SELECT keyskill FROM class_wise_keyskills WHERE $userClass BETWEEN from_class AND to_class ORDER BY sequence, id");
				foreach ($records as $key => $value) {
					$keySkills[] = $value['keyskill'];
				}
				$status = true;
				$result = $keySkills;
			} else {
				http_response_code(401);
				$status = false;
				$message = "Invalid Request";
			}
		} catch(Exception $exp) {
			print_r($exp);
		}
	} else {
		http_response_code(401);
		$response['status'] = false;
		$message = "Required parameters are not sent";
	}
	if($status) {
		$response['Result'] = $result;
	}
	$response['status'] = $status;
	$response['Message'] = $message;
	echo json_encode($response);
} else {
	$response = array();
	$response['status'] = false;
	$response['Message'] = "Unexpected HTTP Request Method";
	http_response_code(405);
	echo json_encode($response);
}