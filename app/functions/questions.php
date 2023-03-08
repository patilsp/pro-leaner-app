<?php
function CreateGetQuestionCategory($class,$subject,$course,$topic,$subtopic, $category, $difficulty) {
	try {
		$record = GetRecord("question_categories", array("class"=>$class,"subject"=>$subject,"course_id"=>$course,"topic"=>$topic,"subtopic"=>$subtopic, "pms_qcategory_id"=>$category, "pms_difficulty_id"=>$difficulty));
		if($record) {
			return $record['id'];
		} else {
			$responses = CreateQuestionCategory($class,$subject,$course,$topic,$subtopic,$category, $difficulty);
			if(isset($responses)) {
			    return $responses;
			} else {
				return $responses;
			}
		}
	} catch(Exception $exp) {
		echo "<pre />";
		print_r($exp);
	}
}

function CreateQuestionCategory($class,$subject,$course,$topic,$subtopic, $category, $difficulty, $parent = 0) {
	try {
		$courseInfo = GetRecord("cpmodules", array("id"=>$course));
		$categoryInfo = GetRecord("masters_questions_categories", array("id"=>$category));
		$difficultyInfo = GetRecord("masters_questions_difficulty", array("id"=>$difficulty));
		$name = $courseInfo['module']." - ".$categoryInfo['qcategory_name']." - ".$difficultyInfo['qdifficulty_name'];
		// print_r($course);

		// print_r($courseInfo);
		// print_r($categoryInfo);
		// print_r($difficultyInfo);
		// exit;
		$name = $categoryInfo['qcategory_name']." - ".$difficultyInfo['qdifficulty_name'];
		//  require_once('MoodleRest.php');
		global $admin_base_url;
		global $admin_ws_token;
		global $db;

		$token = $admin_ws_token;
		$server = $admin_base_url; 
		$ws_function = 'pms_question_category';
		$scategory = array(
		    "name" => $name,
		    "parent" => $parent,
		    "course_id" => $course,
		    "pms_qcategory_id" => $category,
		    "pms_difficulty_id" => $difficulty,
		);
		$categories = array($scategory);
		$param = array("categories" => $categories);
		// $MoodleRest = new MoodleRest($server.'/webservice/rest/server.php', $token);

		// $return = $MoodleRest->request($ws_function, $param, MoodleRest::METHOD_POST);
		// print_r($return);
		// exit;
		$data = [
		          "name" => $name,
		          "info" => $name,
		          "class" => $class,
		          "subject" => $subject,
		          "course_id" => $course,
		          "topic" => $topic,
		          "subtopic" => $subtopic,
		          "pms_qcategory_id" => $category,
		          "pms_difficulty_id" => $difficulty
		        ];
		$return = InsertRecord("question_categories", $data);
		if(isset($return[0]['id'])) {
			$cid = $return[0]['id'];
			$query = "UPDATE question_categories SET class = ?,subject = ?,course_id = ?,topic = ?,subtopic = ?, pms_qcategory_id = ?, pms_difficulty_id = ? WHERE id = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($class,$subject,$course,$topic,$subtopic,$category, $difficulty, $cid));
		}
		return $return;
	} catch(Exception $exp) {
		echo "<pre />";
		print_r($exp);
	}
}
function CreateQuestionCategoryInMoodle($course, $category, $difficulty, $parent = 0) {
	try {
		// $courseInfo = GetRecord("qb_course", array("id"=>$course));
		$categoryInfo = GetRecord("masters_questions_categories", array("id"=>$category));
		$difficultyInfo = GetRecord("masters_questions_difficulty", array("id"=>$difficulty));
		// print_r($course);

		// print_r($courseInfo);
		// print_r($categoryInfo);
		// print_r($difficultyInfo);
		// exit;
		$name = $categoryInfo['qcategory_name']." - ".$difficultyInfo['qdifficulty_name'];
		//  require_once('MoodleRest.php');
		global $admin_base_url;
		global $admin_ws_token;
		global $db;

		$token = $admin_ws_token;
		$server = $admin_base_url; 
		$ws_function = 'pms_question_category';
		$scategory = array(
		    "name" => $name,
		    "parent" => $parent,
		    "course_id" => $course,
		    "pms_qcategory_id" => $category,
		    "pms_difficulty_id" => $difficulty,
		);
		$categories = array($scategory);
		$param = array("categories" => $categories);
		// $MoodleRest = new MoodleRest($server.'/webservice/rest/server.php', $token);

		// $return = $MoodleRest->request($ws_function, $param, MoodleRest::METHOD_POST);
		// print_r($return);
		// exit;
		if(isset($return[0]['id'])) {
			$cid = $return[0]['id'];
			$query = "UPDATE qb_questions SET course_id = ?, pms_qcategory_id = ?, pms_difficulty_id = ? WHERE id = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($course, $category, $difficulty, $cid));
		}
		return $return;
	} catch(Exception $exp) {
		echo "<pre />";
		print_r($exp);
	}
}
function editQuestion($params) {
	try {
		global $admin_base_url;
		global $admin_ws_token;
		$token = $admin_ws_token;
		$server = $admin_base_url;
		$answersarr = [];
		$data = [
			          "category" => $params["category"],
			          "name" => $params["name"],
			          "questiontext" => $params["questiontext"],
			          "qtype" => $params["qtype"]
			        ];
		$return = InsertRecord("quiz_question", $data);
		if($params["qtype"] == "multichoice" || $params["qtype"] == "multichoicem") {
			$single = 1;
			if ($params["qtype"] == "multichoicem") {
				$single = 0;
			}
			foreach ($params["options"] as $key => $value) {
				$data1 = [
						"question" => $return,
						"answer" => $value["answer"],
						"fraction" => $value["fraction"]
				];
				$answerid = InsertRecord("question_answers", $data1);
				array_push($answersarr, $answerid);
			}
			$ansids = implode(",", $answersarr);
			$data2 = [
						"question" => $return,
						"answers" => $ansids,
						"single" => $single
				];
			InsertRecord("question_multichoice", $data2);
		} else if($params["qtype"] == "ddmatch") {
			foreach ($params["options"] as $key => $value) {
				$data1 = [
						"question" => $return,
						"questiontext" => $value["subquestiontext"],
						"answertext" => $value["answer"]
				];
				$answerid = InsertRecord("question_ddmatch_sub", $data1);
				array_push($answersarr, $answerid);
			}
			$ansids = implode(",", $answersarr);
			$data2 = [
						"question" => $return,
						"subquestions" => $ansids
				];
			InsertRecord("question_ddmatch", $data2);

		} else if($params["qtype"] == "shortanswer") {
			foreach ($params["options"] as $key => $value) {
				$data1 = [
						"question" => $return,
						"answer" => $value["answer"]
				];
				$answerid = InsertRecord("question_answers", $data1);
				array_push($answersarr, $answerid);
			}
			$ansids = implode(",", $answersarr);
			$data2 = [
						"question" => $return,
						"answers" => $ansids
				];
			InsertRecord("question_shortanswer", $data2);
		}
		return $return;
	} catch(Exception $exp) {
		echo "<pre />";
		print_r($exp);
	}
}
function createQuestion($params) {
	try {
		global $admin_base_url;
		global $admin_ws_token;
		$token = $admin_ws_token;
		$server = $admin_base_url;
		$answersarr = [];
		$data = [
			          "category" => $params["category"],
			          "name" => $params["name"],
			          "questiontext" => $params["questiontext"],
			          "qtype" => $params["qtype"]
			        ];
		$return = InsertRecord("quiz_question", $data);
		if($params["qtype"] == "multichoice" || $params["qtype"] == "multichoicem") {
			$single = 1;
			if ($params["qtype"] == "multichoicem") {
				$single = 0;
			}
			foreach ($params["options"] as $key => $value) {
				$data1 = [
						"question" => $return,
						"answer" => $value["answer"],
						"fraction" => $value["fraction"]
				];
				$answerid = InsertRecord("question_answers", $data1);
				array_push($answersarr, $answerid);
			}
			$ansids = implode(",", $answersarr);
			$data2 = [
						"question" => $return,
						"answers" => $ansids,
						"single" => $single
				];
			InsertRecord("question_multichoice", $data2);
		} else if($params["qtype"] == "ddmatch") {
			foreach ($params["options"] as $key => $value) {
				$data1 = [
						"question" => $return,
						"questiontext" => $value["subquestiontext"],
						"answertext" => $value["answer"]
				];
				$answerid = InsertRecord("question_ddmatch_sub", $data1);
				array_push($answersarr, $answerid);
			}
			$ansids = implode(",", $answersarr);
			$data2 = [
						"question" => $return,
						"subquestions" => $ansids
				];
			InsertRecord("question_ddmatch", $data2);

		} else if($params["qtype"] == "shortanswer") {
			foreach ($params["options"] as $key => $value) {
				$data1 = [
						"question" => $return,
						"answer" => $value["answer"]
				];
				$answerid = InsertRecord("question_answers", $data1);
				array_push($answersarr, $answerid);
			}
			$ansids = implode(",", $answersarr);
			$data2 = [
						"question" => $return,
						"answers" => $ansids
				];
			InsertRecord("question_shortanswer", $data2);
		}
		return $return;
	} catch(Exception $exp) {
		echo "<pre />";
		print_r($exp);
	}
}
function createQuestionInMoodle($params) {
	try {
		// require_once('MoodleRest.php');
		global $admin_base_url;
		global $admin_ws_token;
		$token = $admin_ws_token;
		$server = $admin_base_url; 
		$ws_function = 'pms_create_question';
		$questions = array($params);
		$param = array("questions" => $questions);
		$MoodleRest = new MoodleRest($server.'/webservice/rest/server.php', $token);
		$return = $MoodleRest->request($ws_function, $param, MoodleRest::METHOD_POST);
		return $return;
	} catch(Exception $exp) {
		echo "<pre />";
		print_r($exp);
	}
}

function getQuestions($class,$subject,$course_id,$topic,$subtopic,$category_id = "All", $difficulty_id = "All") {
	try {
		$cond = array();
		if ($class != '') {
			$cond['class'] = $class;
		}
		if ($subject != '') {
			$cond['subject'] = $subject;
		}
		if ($course_id != '') {
			$cond['course_id'] = $course_id;
		}
		if ($topic != '') {
			$cond['topic'] = $topic;
		}
		if ($subtopic != '') {
			$cond['subtopic'] = $subtopic;
		}
		if($category_id != "All") {
			$cond['pms_qcategory_id'] = $category_id;
		}
		if($difficulty_id != "All") {
			$cond['pms_difficulty_id'] = $difficulty_id;
		}
		$courseInfo = GetRecord("cpmodules", array("id"=>$course_id));
		$courseName = $courseInfo['module'];
		$questions = array();
		$records = GetRecords("question_categories", $cond, array("id"));
		foreach($records as $record) {
			$this_cat_id = $record['id'];
			$records1 = GetRecords("quiz_question", array("category"=>$this_cat_id), array("id"));
			foreach($records1 as $record1) {
				$qd = GetQuestionDetail($record1['id']);
				// $subtopicInfo = GetRecord("cpmodules", array("id"=>$record1['subtopic']));
				// $subtopicName = $subtopicInfo['module'];
				// $qd['QuestionSubtopicName'] = $subtopicName;
				// $qd['QuestionCourseName'] = $courseName;
				// $qd['QuestionCategory'] = getPMSCategoryName($record['pms_qcategory_id']);
				// $qd['QuestionDifficulty'] = getPMSDifficultyName($record['pms_difficulty_id']);
				$qd['Subtopic'] = $qd['Subtopic'];
				$qd['Action'] = '<div class="d-flex action_img"><div data-toggle="modal" data-target="#viewQustModal" class="viewQustModal"  data-id="'.$record1['id'].'">
                  <img class="action_tooltip" src="../../img/qb/view.svg" role="button" data-toggle="tooltip" data-placement="top" data-html="true" title="View this Question">
                </div>';
                $qd['qtype2'] = $qd['qtype'];
                if($qd['qtype'] == "multichoice" && $qd['single'] == 1) {
                	$filename = "editqustmultichoice.php?id=".$record1['id'];
                } else if($qd['qtype'] == "multichoicem" && $qd['single'] == 0) {
                	$filename = "editqustmultichoicem.php?id=".$record1['id'];
                	$qd['qtype2'] = "multichoicem";
                } else if($qd['qtype'] == "shortanswer") {
                	$filename = "editqustshortanswer.php?id=".$record1['id'];
                } else if($qd['qtype'] == "ddmatch") {
                	$filename = "editqustddmatch.php?id=".$record1['id'];
                }
                // $filename = '';
                $qd['Action'] .= '<a class="action_tooltip" href="'.$filename.'" target="_blank" data-toggle="tooltip" data-placement="top" data-html="true" title="Edit this Question"><img src="../../img/qb/edit.svg" role="button" class="mx-3"></a>';
                $qd['Action'] .= '<div data-toggle="modal" class="deleteQuestion" data-target="#delteQustModal" data-id="'.$record1['id'].'">
                  <img data-toggle="tooltip" role="button" data-placement="top" data-html="true" title="Delete this item" class="action_tooltip" src="../../img/qb/delete.svg">
                </div></div>';
                $qd['qtype2_code'] = $qd['qtype2'];
                $qd['qtype2'] = getQuestionTypeDescription($qd['qtype2']);
				$questions[] = $qd;
			}
		}
		return $questions;
	} catch(Exception $exp) {
		print_r($exp);
	}
}

function getQuestionTypeDescription($code) {
	$info = GetRecord("pms_quiz_questiontypes", array("code"=>$code));
	return $info['description'];
}

function getPMSCategoryName($id) {
	global $db;
	$record = GetRecord("masters_questions_categories", array("id"=>$id));
	return $record['qcategory_name'];
}

function getPMSDifficultyName($id) {
	global $db;
	$record = GetRecord("masters_questions_difficulty", array("id"=>$id));
	return $record['qdifficulty_name'];
}

function GetQuestionDetail($qid) {
	try {
		$response = array();
		$questionInfo = GetRecord("quiz_question", array("id"=>$qid));
		$view_question = "";
		$view_question_qp = "";
		if($questionInfo) {
			$category = $questionInfo["category"];
			$categorylist = GetRecord("question_categories", array("id"=>$category));
			$response['Subtopic'] = '';
			if ($categorylist) {
				$subtopiclist = GetRecord("cpmodules", array("id"=>$categorylist["subtopic"]));
				$response['Subtopic'] = $subtopiclist['module'];
			}
			$response['QuestionID'] = $questionInfo['id'];
			$response['QuestionText'] = $questionInfo['questiontext'];
			$response['name'] = $questionInfo['name'];
			$response['QuestionMoodleCategory'] = $questionInfo['category'];
			$qtype2 = $qtype = $response['qtype'] = $questionInfo['qtype'];
			$response['QuestionPureText'] = strip_tags(mb_substr($questionInfo['questiontext'], 0, 12, 'utf-8'));
			if(strlen(strip_tags($questionInfo['questiontext'])) > 12) {
				$response['QuestionPureText'] .= " ... ";
			}
			$view_question .= '<div class="col-12"><h5 class="mb-3 font-weight-bold">'.strip_tags($questionInfo['questiontext']).'</h5>';
			//Extract the Images and 
			preg_match_all('/<img[^>]+>/i',$questionInfo['questiontext'], $images);
			$img = array();
			foreach( $images[0] as $key=>$img_tag)
			{
			    preg_match_all('/(src)=("[^"]*")/i',$img_tag, $img[$key]);
			}
			$ImageSource = array();
			foreach($img as $key=>$value) {
				$ImageSource[] = $value[2][0];
			}
			$response['ImageSource'] = $ImageSource;
			if(count($ImageSource) > 0) {
				$view_question .= '<div class="d-flex flex-wrap justify-content-center qust_img">';
				foreach ($ImageSource as $key => $value) {
				 	$view_question .= '<img src='.$value.' style="max-width: 150px; width: 100%" class="mr-3 mb-3">';
				}
				$view_question .= '</div>';
			}
			$view_question .= '</div>';
			$view_question_qp = str_replace(" font-weight-bold", "", $view_question);
			if($qtype == "multichoice" || $qtype == "multichoicem") {
				$options = array();
				$recordO = GetRecord("question_multichoice", array("question"=>$qid));
				$answers = explode(",", $recordO['answers']);
				$response['single'] = $recordO['single'];
				if($response['single'] == "0") {
					$qtype2 = "multichoicem";
				}
				$response['shuffleanswers'] = $recordO['shuffleanswers'];
				$view_question .= '<div class="col-12 mt-3 options"><ol class="font-weight-bold">';
				foreach($answers as $answer) {
					$res = GetOptionDetail($answer);
					if(!isset($res['OptionID'])) {
						continue;
					}
					$options[] = $res;
					if($res['fraction'] > 0) {
						$view_question .= '<li class="right_ans p-3">'.$res['DisplayOptionText'].'</li>';
					} else {
						$view_question .= '<li class="p-3">'.$res['DisplayOptionText'].'</li>';
					}
				}
				$view_question .= '</ol></div>';
				$view_question_qp = str_replace(" font-weight-bold", "", $view_question);
				$response['Options'] = $options;
			} else if($qtype == "ddmatch") {
				$options = array();
				$recordO = GetRecord("question_ddmatch", array("question"=>$qid));
				$answers = explode(",", $recordO['subquestions']);
				$response['shuffleanswers'] = $recordO['shuffleanswers'];
				$view_question .= '<div class="col-12 mt-3 px-5" id="view_match_the_following">
		            <div class="form-group w-100 mx-auto" id="match_qust_ans_section">
		              <ol class="row p-0" id="match_header_blk">
		                <li class="col-12 d-flex text-center" id="match_heading">
		                  <input type="text" name="option" placeholder="Type here" value="Question" class="form-control border-0 text-center col-6 bg-transparent font-weight-bold" disabled="disabled">
		                  <input type="text" name="option" placeholder="Type here" value="Answer" class="form-control border-0 text-center col-6 bg-transparent font-weight-bold" disabled="disabled">
		                </li>
		              </ol>
		              <ol class="row">';
		    $view_question_qp .= '<div class="col-12 mt-3 px-5" id="view_match_the_following">
		            <div class="form-group w-100 mx-auto" id="match_qust_ans_section">
		              <ol class="row p-0" id="match_header_blk">
		                <li class="col-12 d-flex text-center" id="match_heading">
		                  <input type="text" name="option" placeholder="Type here" value="Question" class="form-control border-0 text-center col-6 bg-transparent font-weight-bold" disabled="disabled">
		                </li>
		              </ol>
		              <ol class="row">';          
				foreach($answers as $answer) {
					$recordSQ = GetRecord("question_ddmatch_sub", array("id"=>$answer));
					$options[] = array("OptionID"=>$recordSQ['id'], "subQuestion" => $recordSQ['questiontext'], "answerText" =>$recordSQ['answertext']);
					$view_question .= '<li class="w-100 mb-3">
		                  <div class="d-flex">
		                    <input type="text" name="option" placeholder="Type here" value="'.$recordSQ['questiontext'].'" class="form-control mr-3" disabled="disabled">
		                    <input type="text" name="option" placeholder="Type here" value="'.$recordSQ['answertext'].'" class="form-control" disabled="disabled">
		                  </div>
		                </li>';
		      $view_question_qp .= '<li class="w-100 mb-3">
		                  <div class="d-flex">
		                    <input type="text" name="option" placeholder="Type here" value="'.$recordSQ['questiontext'].'" class="form-control mr-3" disabled="disabled">
		                  </div>
		                </li>';
				}
				$view_question .= '</ol>
		            </div>
		          </div>';
		    $view_question_qp .= '</ol></div></div>';
				$response['Options'] = $options;
			} else if($qtype == "shortanswer") {
				$options = array();
				$recordO = GetRecord("question_shortanswer", array("question"=>$qid));
				$answers = explode(",", $recordO['answers']);
				foreach($answers as $key=>$answer) {
					if($key == 0) {
						$thisOption = GetOptionDetail($answer);
						$response['Answer'] = $thisOption;
						if (!isset($thisOption['OptionText'])) {
							$thisOption['OptionText'] = '';
						}
						$view_question .= '<div class="col-12 mt-3 px-5" id="view_shot_descp_options">
            					<h6 class="font-weight-bold">Answer</h6>'.nl2br($thisOption['OptionText']);
            			$view_question .= '<br /><h6 class="font-weight-bold">Keywords</h6><ol type="a" class="font-weight-bold">';
					} else {
						$thisOption = GetOptionDetail($answer);
						$options[] = $thisOption;
						if (!isset($thisOption['OptionText'])) {
							$thisOption['OptionText'] = '';
						}
						$view_question .= '<li class="p-2">'.$thisOption['OptionText'].'</li>';
					}
				}
				$view_question .= '</ol></div>';
				$response['Options'] = $options;
			}
			$qtypeInfo = GetRecord("pms_quiz_questiontypes", array("code"=>$qtype2));
			$response['qtype2'] = $qtype2;
			$response['qtypeDescription'] = $qtypeInfo['description'];
		}
		$response['viewQuestion'] = $view_question;
		$response['viewQuestionQP'] = $view_question_qp;
		return $response;
	} catch(Exception $exp) {
		print_r($exp);
	}
}

function GetOptionDetail($oid) {
	try {
		$response = array();
		$record = GetRecord("question_answers", array("id"=>$oid));
		if($record) {
			$response['OptionID'] = $record['id'];
			$response['OptionText'] = $record['answer'];
			$response['DisplayOptionText'] = $record['answer'];
			$response['fraction'] = $record['fraction'];
			//Extract the Images and
			$images = array(); 
			preg_match_all('/<img[^>]+>/i',str_replace("'","\"", $record['answer']), $images);
			$img = array();

			foreach( $images[0] as $key=>$img_tag)
			{
			    preg_match_all('/(src)=("[^"]*")/i',$img_tag, $img[$key]);
			}
			$ImageSource = array();
			foreach($img as $key=>$value) {
				$ImageSource[] = $value[2][0];
			}
			$response['ImageSource'] = $ImageSource;
		}
		return $response;
	} catch(Exception $exp) {
		print_r($exp);
	}
}

function GetCreateCourseID4Assessment($category_id, $course_name = "Assessments") {
	try {
		global $DB;
		$assessment_name = $course_name;
		$check = GetRecord("mdl_course", array("fullname"=>$assessment_name, "category"=>$category_id));
		if($check) {
			return $check['id'];
		} else {
			//Create new Course
			$data = array();
	  		$data['fullname'] = $assessment_name;
	  		$data['shortname'] = $assessment_name."-".time();
	  		$data['categoryid'] = $category_id;
	      	$data['numsections'] = 10;
		    //$params = array_reverse($params);
		  	$course = CreateCourseIntoMoodle(array($data));
		  	$enrol_cohorts_input = array();
		    if(isset($course[0]['id'])) {
		      foreach($course as $singleCourse) {
		        $course_id = $singleCourse['id'];
		        $datai = [
		          "course" => $course_id,
		          "section" => 1,
		          "summary" => '',
		          "visible" => 1
		        ];
		        InsertRecord("mdl_course_sections", $datai);

		        //Get Class of this course
		        $catInfo = GetRecord("mdl_course_categories", array("id"=>$category_id));
		        $path_ids = array_values(array_filter(explode("/", $catInfo['path'])));
		        $class_id = $path_ids[0];
		        $classInfo = GetRecord("master_class", array("categoryid"=>$class_id));
		        $class = $classInfo['code'];
		        $enrol_cohorts_input[] = array("course_id"=>$course_id, "class_id"=>$class);
		      }
		      EnrollCohortInMoodle($enrol_cohorts_input);
		    }
		    if(isset($course_id)) {
		    	return $course_id;
		    } else {
		    	return 0;
		    }
		}
	} catch(Exception $exp) {
		print_r($exp);
	}
}

function CreateQuizInMoodle($quiz_data, $course_id, $visible) {
	global $db;
	/* $quiz_data = [
		"course" => $course_id,
		"name" => $quiz_data['name'],
		"intro" => '',
		'preferredbehaviour' => '',
		'questions' => '',
		'password' =>  '',
		'subnet' => '',
		'browsersecurity' => ''
	];*/
	$quiz_id = InsertRecord("mdl_quiz", $quiz_data);

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

	$moduleInfo = GetRecord("mdl_modules", array("name"=>"quiz"));
	$module_id = $moduleInfo['id'];

	$cm_data = [
		"course" => $course_id,
		"module" => $module_id,
		"instance" => $quiz_id,
		"section" => $section_id,
		"added" => time(),
		"visible" => $visible
	];
	$cmid = InsertRecord("mdl_course_modules", $cm_data);

	$sequence = $sectionInfo['sequence'];
	if($sequence == "") {
		$sequence = $cmid;
	} else if($cmid != "") {
		$sequence .= ",".$cmid;
	}
	$query = "UPDATE mdl_course_sections SET sequence = ? WHERE id = ?";
	$stmt = $db->prepare($query);
	$stmt->execute(array($sequence, $sectionInfo['id']));

	ClearCourseCache($course_id);
	return $quiz_id;
}

function UpdateQuizName($quiz_id, $quiz_name) {
	global $db;
	$query = "UPDATE mdl_quiz SET name = ? WHERE id  = ?";
	$stmt = $db->prepare($query);
	$stmt->execute(array($quiz_name, $quiz_id));
}

function AddQuestionsToQuiz($quiz_id, $all_questions, $marks) {
	try {
		require_once('MoodleRest.php');
		global $admin_base_url;
		global $admin_ws_token;
		$token = $admin_ws_token;
		$server = $admin_base_url; 
		$ws_function = 'pms_add_quiz_questions';
		$temp = explode(",", $all_questions);
		$params_questions = array();
		foreach($temp as $temp1) {
			if(isset($marks[$temp1])) {
				$thisMarks = floatval($marks[$temp1]);
			} else {
				$thisMarks = 0;
			}
			array_push($params_questions, array("qid"=>$temp1, "marks"=>$thisMarks));
		}
		$params = [
			"quiz_id" => $quiz_id,
			"questions" => $params_questions
		];

		$questions = array($params);
		$param = array("questions" => $questions);
		$MoodleRest = new MoodleRest($server.'/webservice/rest/server.php', $token);
		$return = $MoodleRest->request($ws_function, $param, MoodleRest::METHOD_POST);
		return $return;
	} catch(Exception $exp) {
		echo "<pre />";
		print_r($exp);
	}	
}

function GetQuestionPapers($subject_id, $class= 0, $section = 'All') {
	try {
		$return = array();
		$course_id = GetCreateCourseID4Assessment($subject_id);
		$cmids = GetRecords("mdl_course_modules", array("course"=>$course_id, "module"=>16));
		foreach($cmids as $cmidRecord) {
			$quiz_id = $cmid = $cmidRecord['instance'];
			$quizInfo = GetRecord("mdl_quiz", array("id"=>$quiz_id));
			$evaluation_completed = $assessment_taken = 0;
			//Get Number of Students taken Assessment
			if($class > 0) {
				$this_studentslist = getStudentsList($class, $section);
				$studentsstring = "0";
				$this_studentslist_ids = array();
				if(count($this_studentslist) > 0) {
					foreach($this_studentslist as $record) {
						array_push($this_studentslist_ids, $record['id']);
					}
					$studentsstring = implode(",", $this_studentslist_ids);
				}
				$attempts = GetQueryRecords("SELECT id FROM mdl_quiz_attempts WHERE quiz = ? AND userid IN ($studentsstring) AND state = 'finished'", array($quiz_id));
				$assessment_taken = count($attempts);

				$cmid = GetCMID("quiz", $quiz_id);
				$evaluations = GetQueryRecords("SELECT id FROM pms_evaluations WHERE cmid = ? AND student_id IN ($studentsstring)", array($cmid));
				$evaluation_completed = count($evaluations);
			}
			$return[] = array("id"=>$quiz_id, "qp_code"=>$quizInfo['intro'], "name"=>$quizInfo['name'], "total"=>intval($quizInfo['sumgrades']), "avg_difficulty"=>"-NA-", "visible"=>$cmidRecord['visible'], "AssessmentsTaken"=>$assessment_taken, "EvaluationsCompleted"=>$evaluation_completed);
		}
		return $return;
	} catch(Exception $exp) {
		echo "<pre />";
		print_r($exp);
	}
}

function DeleteQuiz($course_id, $quiz_id) {
	global $db;

	$query = "DELETE FROM mdl_quiz WHERE id = ?";
	$stmt = $db->prepare($query);
	$stmt->execute(array($quiz_id));

	$moduleInfo = GetRecord("mdl_modules", array("name"=>"quiz"));
	$module_id = $moduleInfo['id'];

	$cmidInfo = GetRecord("mdl_course_modules", array("module"=>$module_id, "instance"=>$quiz_id));
	$cmid = $cmidInfo['id'];

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
}

function GetQuizDetails($quiz_id) {
	try {
		$return = array();
		$info = GetRecord("mdl_quiz", array("id"=>$quiz_id));
		if($info) {
			$return['id'] = $info['id'];
			$return['title'] = $info['name'];
			$return['time_allowed'] = $info['timelimit'] / (60 * 60);
			$return['sumgrades'] = $info['sumgrades'];
			$return['intro'] = $info['intro'];
			$return['attempts'] = $info['attempts'];
			$course_id = $info['course'];
			$return['course'] = $course_id;
			$categoryInfo = GetRecord("mdl_course", array("id"=>$course_id));
			$return['subject_id'] = $categoryInfo['category'];

			//Get Chapters
			$chapters = GetRecord("pms_quiz_add_cols", array("quiz_id"=>$quiz_id));
			if($chapters) {
				$return['chapters'] = $chapters['chapters'];
				$return['difficulty'] = $chapters['difficulty'];
			} else {
				$return['chapters'] = "";
				$return['difficulty'] = "";
			}
			$questions = explode(",", $info['questions']);
			$page = 1;
			$section_total = 0;
			$sections = array();
			$single_section = array("questions"=>array(), "label_ref"=>array(), "SectionTotal"=>0);
			$section_questions = array();
	        foreach($questions as $question) {
	          if($question > 0) {
	            if(count($single_section['label_ref']) == 0) {
	            	//Add the question if question type is description
	            	$thisQuestionInfo = GetRecord("mdl_question", array("id"=>$question));
	            	if($thisQuestionInfo['qtype'] == "description") {
	            		$single_section['label_ref']['id'] = $question;	
	            	} else {
	            		$single_section['questions'][] = $question;
	            		$single_section['label_ref']['id'] = 0;
	            	}
	            } else {
	            	$single_section['questions'][] = $question;
	            	$marks = GetRecord("mdl_quiz_question_instances", array("quiz" => $quiz_id,"question" => $question), array());
	            	$single_section['SectionTotal'] += $marks['grade'];//Get marks

	            }
	            // $section_questions[]  = $question;
	          }
	          if($question == 0) {
	            $sections[] = $single_section;
	            $single_section = array("questions"=>array(), "label_ref"=>array(), "SectionTotal"=>0);
	          }
	        }
	        $return['Questions'] = $sections;
	        //Get Marks
	        $recordsMarks = GetQueryRecords("SELECT * FROM mdl_quiz_question_instances WHERE quiz = ? AND question IN (".$info['questions'].")", array($quiz_id));
	        $marks = array();
	        foreach($recordsMarks as $rM) {
	        	$marks[$rM['question']] = intval($rM['grade']);
	        }
	        $return['Marks'] = $marks;
		}
		return $return;
	} catch(Exception $exp) {
		print_r($exp);
	}
}

function GetAssignments($subject_id, $class= 0, $section = 'All') {

	try {
		$return = array();
		$course_id = GetCreateCourseID4Assessment($subject_id,'Assignments');
		$cmids = GetRecords("mdl_course_modules", array("course"=>$course_id));

		foreach($cmids as $cmidRecord) {
			$cmid = $cmidRecord['id'];
			$instance_id = $cmidRecord['instance'];
			$module_id =$cmidRecord['module'];
			$evaluation_completed = $assessment_taken = 0;
			//Get Number of Students taken Assessment
			$this_studentslist = getStudentsList($class, $section);
			$studentsstring = "0";
			$this_studentslist_ids = array();
			if(count($this_studentslist) > 0) {
				foreach($this_studentslist as $record) {
					array_push($this_studentslist_ids, $record['id']);
				}
				$studentsstring = implode(",", $this_studentslist_ids);
			}
			if($module_id ==16 ) {
				$quiz_details = GetRecord("mdl_quiz",array('id' =>$instance_id));
				$name = $quiz_details['name'];
				$grade = $quiz_details['sumgrades'];
				
				$attempts = GetQueryRecords("SELECT id FROM mdl_quiz_attempts WHERE quiz = ? AND userid IN ($studentsstring) AND state = 'finished'", array($instance_id));
				$assessment_taken = count($attempts);

				$evaluations = GetQueryRecords("SELECT id FROM pms_evaluations WHERE instance_id = ? AND student_id IN ($studentsstring)", array($instance_id));
				$evaluation_completed = count($evaluations);
				
			} else {

				$assignments = GetRecord("mdl_assign",array('id' =>$instance_id),array('id'));
				$name = $assignments['name'];
				$grade = $assignments['grade'];
				$attempts = GetQueryRecords("SELECT DISTINCT(userid) FROM mdl_assign_submission WHERE assignment = ? AND userid IN ($studentsstring)", array($instance_id));
				$assessment_taken = count($attempts);
				$evaluations = GetQueryRecords("SELECT DISTINCT(userid) FROM mdl_assign_grades WHERE assignment = ? AND userid IN ($studentsstring)", array($instance_id));
				$evaluation_completed =count($evaluations);
				$total = count($this_studentslist);
			
			}

			$return[] = array("cmid"=>$cmid, "name"=>$name,"AssessmentsTaken"=>$assessment_taken, "EvaluationsCompleted"=>$evaluation_completed,"total"=>$total);
		}

		return $return;
	} catch(Exception $exp) {
		echo "<pre />";
		print_r($exp);
	}
}

