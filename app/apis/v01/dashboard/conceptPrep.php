<?php
// required headers
// header("Access-Control-Allow-Origin: http://localhost/");
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Methods: POST");
// header("Access-Control-Max-Age: 3600");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
require_once "../../headersValidation.php";

require "../../../functions/db_functions.php";

require "../../../functions/common_functions.php";

include '../validate_token.php';
$request_method = "POST";
if($request_method == "POST") {
	$response = array();
	$status = false;
	$message = "";
	$input = json_decode(file_get_contents('php://input'), true);
	
  $jwt=isset($input['token']) ? $input['token'] : "";
  $userid = '';
  if (isset($userData)) {

    $userid = $userData->id;
    $classid = $userData->class;
    
    
    if(isset($input['type'])) {

  		
  		require('../../../configration/config.php');
  	
         
  		$type = $input['type'];
  		$login_userid = $userid;
         
  		try
  		{
        $userid = $userid;
  			
  			if(isset($input['viewClass']) && intval($input['viewClass']) > 0) {
  				$userClass = $input['viewClass'];
  			} elseif($classid>0) {
  				$userClass = $classid;
  			}else {
                $userClass = 1;
            }
  			//$userClass = 4;
  			// $schoolcode = getSanitizedData($_COOKIE['school_code']);

  			if($type == "getSubjects") {
  				$subjects = array();	
                  $bgcolors = [ "#7c60d5","#f56759","#1bdf48", "#7B69D1","#F7625B","#26DB51","#8F86D8","#EF6E61","#1ED64C","#574CCF","#D54E45","#19D74F","#8C80D4","#F46E69","#25D348","#7166D0","#EE6F68","#0FD14B","#4D42CD","#C45442"];

                  $bgimages = ["math","english","science","math","english","science", "math","english","science","math","english","science","math","english","science","math","english","science", "math","english","science","math","english","science" ];
                    
                  $i = 0;
  				$query = "SELECT id, module FROM cpmodules WHERE parentId = ? AND type = ? AND deleted = ? ORDER BY sequence";
  				$stmt = $db->prepare($query);
  				$stmt->execute(array($userClass, 'subject', 0));
  				while($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
  					$iconColor = $bgcolors[$i];
  					$bodyBg = $bgcolors[$i]; $i++;
  					$subText = '';
  					if(strtolower($rows['module']) == 'english') {
  						//$iconColor = '#5b38ca';
  						//$bodyBg = '#7c60d5';
  						$subText = 'Everything you need to know about the language of global opportunities. ';
  					} elseif(strtolower($rows['module']) == 'math') {
  						//$iconColor = '#cc6b01';
  						//$bodyBg = '#f56759';
  						$subText = 'Where the questions may seem difficult but the answers are always simple.';
  					} elseif(strtolower($rows['module']) == 'science') {
  						//$iconColor = '#1bdf48';
  						//$bodyBg = '#1bdf48';
  						$subText = 'Learning the secrets of life and universe.';
  					}

  					$headers = apache_request_headers();
  					$valid_hosts = array("localhost", "skillprep.co", "test.skillprep.co");
  					if($headers['Host'] == "test.skillprep.co" || $headers['Host'] == "skillprep.co" || $headers['Host'] == "prepmyskills.com" || $headers['Host'] == "b2c.skillprep.co") {
  						$protocol = "https";
  					} else {
  						$protocol = "http";
  					}
  					$subImgSrc = $web_root."/img/subject/".strtolower($bgimages[$i]).".svg";
  					
  					$subject = array("subId"=>$rows['id'], "subName"=>$rows['module'], "titleColor"=>"#ffffff", "iconColor"=>$iconColor, "bodyBg"=>$bodyBg, "image"=>$subImgSrc, "subText"=>$subText, "visible"=>true);
  					array_push($subjects, $subject);
  				}
  				$result['subjects'] = $subjects;			
  				$status = true;
  			} else if($type == "getChapters" && isset($input['subId']) && intval($input['subId']) > 0) {
          $id = $input['subId'];
  				$chapters = array();	
          $enabledtopics = array();
          $uquery = "SELECT masters_sections.section FROM users JOIN masters_sections ON users.section = masters_sections.id WHERE users.id = ? LIMIT 1";
          $stmt1 = $db->prepare($uquery);
          $stmt1->execute(array($userid));
          $data = $stmt1->fetch(PDO::FETCH_ASSOC);
          $section = '';
          if (!empty($data)) {
            $section = $data["section"];
          }
          
          $query = "SELECT id, module FROM cpmodules WHERE parentId = ? AND type = ? AND deleted = ? ORDER BY sequence";
  				$stmt = $db->prepare($query);
  				$stmt->execute(array($id, 'chapter', 0));
                
  				while($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $query2 = "SELECT cmid FROM section_wise_chapter_enable WHERE class = ? AND section = ? AND courseid = ? AND enable = ?";
            $stmt2 = $db->prepare($query2);
            $stmt2->execute(array($classid,$section,$rows['id'],1));
            $totalcount = $stmt2->rowCount();
            if ($totalcount > 0) {
    					$chapter = array("chapId"=>$rows['id'], "chapName"=>$rows['module'], "visible"=>true);
    					array_push($chapters, $chapter);
            }
  				}
               
  				$result['chapters'] = $chapters;			
  				$status = true;
  			} else if($type == "getTopicSubTopics" && isset($input['chapId']) && intval($input['chapId']) > 0) {
				$id = $input['chapId'];
						$topicsSubTopics = array();
						$subTopicData = array();
				$enabledtopics = array();
						//get topic details
						$query = "SELECT id, module FROM cpmodules WHERE parentId = ? AND type = ? AND deleted = ? ORDER BY sequence";
						$stmt = $db->prepare($query);
						$stmt->execute(array($id, 'topic', 0));
				$uquery = "SELECT masters_sections.section FROM users JOIN masters_sections ON users.section = masters_sections.id WHERE users.id = ? LIMIT 1";
				$stmt1 = $db->prepare($uquery);
				$stmt1->execute(array($userid));
				$data = $stmt1->fetch(PDO::FETCH_ASSOC);
				$section = '';
				if (!empty($data)) {
					$section = $data["section"];
				}
				$query2 = "SELECT cmid FROM section_wise_chapter_enable WHERE class = ? AND section = ? AND courseid = ? AND enable = ?";
				$stmt2 = $db->prepare($query2);
				$stmt2->execute(array($classid,$section,$id,1));
				while($rows2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
					array_push($enabledtopics, $rows2["cmid"]);
				}
					
						while($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
					if (in_array($rows['id'], $enabledtopics)) {
					$topic = array();
								$topic['topicName'] = $rows['module'];
								$topic['topicId'] = $rows['id'];
								//get sub topic details
								$query1 = "SELECT id, module FROM cpmodules WHERE parentId = ? AND type = ? AND deleted = ? ORDER BY sequence";
								$stmt1 = $db->prepare($query1);
								$stmt1->execute(array($rows['id'], 'subTopic', 0));
								while($rows1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
								
									//get total Slides count of the sub topic and user access slides count of the sub topic
									$query2 = "SELECT id FROM cpadd_slide_list WHERE sub_topic_id = ?";
									$stmt2 = $db->prepare($query2);
									$stmt2->execute(array($rows1['id']));
									$totSlideCount = $stmt2->rowCount();
									$subTopicSlideIds = $stmt2->fetchAll(PDO::FETCH_ASSOC);
									$slideIds = array();
									foreach ($subTopicSlideIds as $key => $value) {
										array_push($slideIds, $value['id']);
									}
									$slideIdsString = implode(',', $slideIds);
								
									//get user access slides count of the sub
									$totAccessSlideCount = 0; 
									if($slideIdsString != '') {
										$query3 = "SELECT DISTINCT(cms_cp_add_slide_list_id) FROM conceptprep_user_responses WHERE cms_cp_add_slide_list_id IN ($slideIdsString)";
										$stmt3 = $db->query($query3);
										$totAccessSlideCount = $stmt3->rowCount();
									}

									$totAccessSlidePercentage = 0;
									if($totSlideCount != 0  && $totAccessSlideCount != 0)
										$totAccessSlidePercentage = round(($totAccessSlideCount / $totSlideCount * 100));

									$topic['children'][] = array("subTopicId"=>$rows1['id'], "subTopicName"=>$rows1['module'], "totSlideCount"=>$totSlideCount, "totAccessSlideCount"=>$totAccessSlideCount, "totAccessSlidePercentage"=>$totAccessSlidePercentage, "visible"=>true);

								}
								array_push($topicsSubTopics, $topic);
					}
						}

						$result['topicsSubTopics'] = $topicsSubTopics;	
						
						$assignments = array();	
						$query = "SELECT id, name, duedate FROM assignment_assign WHERE course = ? AND visible = ? ";
						$stmt = $db->prepare($query);
						$stmt->execute(array($id,  1));
						while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
							$assignments[] = array("assignId"=>$row['id'], "assignName"=>$row['name'] , "dueDate"=>$row['duedate']);
						}
						$result['courseAssignments'] = $assignments;	
						$status = true;
  			} else if($type == "getSlides" && isset($input['sub_topic_id']) && intval($input['sub_topic_id']) > 0) {
  				$sub_topic_id = $input['sub_topic_id'];
  				$slides = array();	
  				$query = "SELECT cpasl.id, cpasl.slide_json, cpasl.slide_title, cpasl.slide_file_path, cpasl.layout_id, r.layoutfilepath_html, r.qzone_slide_path, r.name FROM cpadd_slide_list cpasl, resources r WHERE sub_topic_id = ? AND cpasl.layout_id = r.id ORDER BY sequence";
  				$stmt = $db->prepare($query);
  				$stmt->execute(array($sub_topic_id));
  				while($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
  					$slideid = $rows['id'];
  					$slideJSON = $rows['slide_json'];
  				    $slide_title = $rows['slide_title'];
  				    $generated_slide = $rows['slide_file_path'];
  				    $layoutid = $rows['layout_id'];
  				    $templateName = $rows['name'];

  				    $headers = apache_request_headers();
  					$valid_hosts = array("localhost", "skillprep.co", "test.skillprep.co");
  					if($headers['Host'] == "test.skillprep.co" || $headers['Host'] == "skillprep.co" || $headers['Host'] == "prepmyskills.com" || $headers['Host'] == "b2c.skillprep.co") {
  						$protocol = "https";
  					} else {
  						$protocol = "http";
  					}
  					$protocol."://".$_SERVER['HTTP_HOST']."/cms/".$filepath;

  					$slideLayoutHTML = $protocol.'://'.$_SERVER['HTTP_HOST'].'/cms/'.str_replace('contents', 'cpcontents', $rows['qzone_slide_path']).'?api_end_point=getactivitydata.php&qust_id='.$slideid.'&user_Id='.$login_userid;
  				    $slideLayoutPHP = $protocol.'://'.$_SERVER['HTTP_HOST'].'/cms/'.str_replace('contents', 'cpcontents', $rows['qzone_slide_path']);
  				    $slideLayoutPHP = str_replace("html", "php", $slideLayoutPHP);
  				    if($layoutid == 0 || $rows['qzone_slide_path'] == ""){
  				      $slideLayoutHTML = $rows['slide_file_path'];
  				    }

  				    //get slide template type - 1-lesson slide, 2-pratice slide and 3-question slide
  				    $slideTemplateType = 2;
  				    if (strpos($templateName,'Layout') !== false) {
  					    $slideTemplateType = 1;
  					}else if($templateName == 'SA' || $templateName == 'mcq') {
  				    	$slideTemplateType = 3;
  				    }

  				    $responseSlideData = array("slideTemplateType"=>$slideTemplateType, "slideTitle"=>$slide_title, "slidePath"=>$slideLayoutHTML, "slideid"=>$slideid);

  					array_push($slides, $responseSlideData);
  				}
  				$result = $slides;			
  				$status = true;
  			} else if($type == "saveSlideAccess" && isset($input['slideId']) && intval($input['slideId']) > 0) {
  				$slideId = $input['slideId'];
  				$category = $input['templateType'];
  				$slideDetailsJSON = json_encode($input['slideDetails']);
  				if(!isset($input['slideId'])) {
  					$response_status = NULL;
  				}
  				$query = "INSERT INTO  conceptprep_user_responses (userid, cms_cp_add_slide_list_id, category, response, response_status) VALUES (?, ?, ?, ?, ?)";
  				$stmt = $db->prepare($query);
  				$stmt->execute(array($login_userid, $slideId, $category, $slideDetailsJSON, $response_status));
     				$result['lastInsertId'] = $db->lastInsertId();			
  				$status = true;
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
  }
} else {
	$response = array();
	$response['status'] = false;
	$response['Message'] = "Unexpected HTTP Request Method";
	http_response_code(405);
	echo json_encode($response);
}