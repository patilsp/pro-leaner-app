<?php
	function getResponsiveTestIssues(){
		global $db;
		global $master_db;
		try {
			$finalData = array();
			$classes = getClasses();
			foreach ($classes as $class_id => $text_class_id) {
				$topics = getTopicsRMVisible($class_id);
				foreach ($topics as $topic) {
					$getFeedbacks = GetQueryRecords("SELECT DISTINCT(device_size) FROM topic_responsive_status WHERE classid=? AND topicid=?", array($class_id,$topic['id']));
					foreach ($getFeedbacks as $getFeedback) {
						$thisarray = array();

						$thisarray['class'] = $class_id;
						$thisarray['topic_name'] = $topic['description'];
						$device_width = $getFeedback['device_size'];
						$getdevicename = GetRecord("device", array("width"=>$device_width));
						$thisarray['device_name'] = $getdevicename['device_name']." - ".$getdevicename['width'];
						$getYesFeedbacks = GetRecords("slide_responsive_status", array("classid"=>$class_id, "topicid"=>$topic['id'], "device_size"=>$device_width));
						if(count($getYesFeedbacks)) {
							foreach ($getYesFeedbacks as $getYesFeedback) {
								if($getYesFeedback['tt_status'] == 1)
									continue;
								//get slide file path
								$page = GetRecord("$master_db.mdl_lesson_pages", array("id"=>$getYesFeedback['slideid']));
								$slide_path = DecryptContent($page['contents']);
								$thisarray['slide_path'] = $slide_path;
								$slide_type = pathinfo($slide_path);
								if(strpos($slide_type['filename'], 'act')) {
									$thisarray['slide_type'] = "Activity";
								} else if(strpos($slide_type['filename'], 'sce')) {
									$thisarray['slide_type'] = "Scenario";
								} else {
									$thisarray['slide_type'] = "Lesson";
								}
								//get username
								$getusername = GetRecord("users", array("id"=>$getYesFeedback['updated_by']));
								$thisarray['updated_by'] = $getusername['first_name'].' '.$getusername['last_name'];
								$thisarray['updated_on'] = date("d-m-Y", strtotime($getYesFeedback['updated_on']));
								$thisarray['slide_id'] = $getYesFeedback['slideid'];
								$thisarray['comment'] = $getYesFeedback['slide_comment'];
								$thisarray['status'] = "issue";
								$thisarray['slide_responsive_status_id'] = $getYesFeedback['id'];
								$thisarray['tt_status'] = $getYesFeedback['tt_status'];
								array_push($finalData, $thisarray);
							}
						} else {
							/*$thisarray['slide_id'] = "";
							$thisarray['status'] = "No Issue";
							$thisarray['tt_status'] = "";
							$thisarray['updated_by'] = "";
							$thisarray['slide_path'] = "";
							$thisarray['slide_type'] = "";
							array_push($finalData, $thisarray);*/
						}
					}
				}
			}
			return $finalData;
		}catch(Exception $exp){
			echo "<pre/>";
			print_r($exp);
		}
	}
?>