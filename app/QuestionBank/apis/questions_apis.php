<?php session_start();
  include "../../configration/config.php";
  require_once "../../functions/db_functions.php";
  require_once "../../functions/common_functions.php";
  require_once "../../functions/questions.php";
  require_once "../../functions/courses.php";
  require_once "../../functions/subjects.php";
  
  $type = $_POST['type'];
  $output = array();
  $output['status'] = false;
  $output['message'] = "";
  $output['success_message'] = "";
  $success_message = "";
  $status = false;
  $message = "";
  $snackbar = false;
  $login_userid = $_SESSION['cms_userid'];
  if($type == "getQuestionCategoryiesDifficulty") {
  	$result = array();
  	$options = "";
  	$records = GetRecords("masters_questions_categories", array(), array("qcategory_name"));
		if(count($records) == 0) {
			$options .= '<option value="">Categories are not added</option>';
		} else if(count($records) == 1) {
			$options .= '<option value="'.$records[0]['id'].'">'.$records[0]['qcategory_name'].'</option>';
		} else if(count($records) > 1) {
			$options .= '<option value="">-Select Category-</option>';
			foreach($records as $record) {
				$options .= '<option value="'.$record['id'].'">'.$record['qcategory_name'].'</option>';
			}
		}
		$result['Category'] = $options;
		$options = "";
		$records = GetRecords("masters_questions_difficulty", array(), array());
		if(count($records) == 0) {
			$options .= '<option value="">Difficulty are not added</option>';
		} else if(count($records) == 1) {
			$options .= '<option value="'.$records[0]['id'].'">'.$records[0]['qdifficulty_name'].'</option>';
		} else if(count($records) > 1) {
			$options .= '<option value="">-Select Difficulty-</option>';
			foreach($records as $record) {
				$options .= '<option value="'.$record['id'].'">'.$record['qdifficulty_name'].'</option>';
			}
		}
    $result['Difficulty'] = $options;
    $output['Result'] = $result;
    $status = true;
  } else if($type == "getQuestionCategoryiesDifficultyAll") {
    $result = array();
    $options = "";
    $records = GetRecords("masters_questions_categories", array(), array("qcategory_name"));
    if(count($records) == 0) {
      $options .= '<option value="">Categories are not added</option>';
    } else if(count($records) == 1) {
      $options .= '<option value="'.$records[0]['id'].'">'.$records[0]['qcategory_name'].'</option>';
    } else if(count($records) > 1) {
      $options .= '<option value="All">All</option>';
      foreach($records as $record) {
        $options .= '<option value="'.$record['id'].'">'.$record['qcategory_name'].'</option>';
      }
    }
    $result['Category'] = $options;
    $options = "";
    $options2 = "";
    $records = GetRecords("masters_questions_difficulty", array(), array("qdifficulty_name"));
    if(count($records) == 0) {
      $options = $options2 = '<option value="">Difficulty are not added</option>';
    } else if(count($records) == 1) {
      $options2 = $options = '<option value="'.$records[0]['id'].'">'.$records[0]['qdifficulty_name'].'</option>';
    } else if(count($records) > 1) {
      $options = '<option value="All">All</option>';
      $options2 = '<option value="">-Select Difficulty-</option>';
      foreach($records as $record) {
        $options .= '<option value="'.$record['id'].'">'.$record['qdifficulty_name'].'</option>';
        $options2 .= '<option value="'.$record['id'].'">'.$record['qdifficulty_name'].'</option>';
      }
    }
    $result['Difficulty'] = $options;
    $result['Difficulty2'] = $options2;
    $options = "";
    $records = GetRecords("pms_quiz_questiontypes", array(), array("description"));
    if(count($records) == 0) {
      $options .= '<option value="">Question Types are not added</option>';
    } else if(count($records) == 1) {
      $options .= '<option value="'.$records[0]['code'].'">'.$records[0]['description'].'</option>';
    } else if(count($records) > 1) {
      $options .= '<option value="All">All</option>';
      foreach($records as $record) {
        $options .= '<option value="'.$record['code'].'">'.$record['description'].'</option>';
      }
    }
    $result['QTypes'] = $options;
    $output['Result'] = $result;
    $status = true;
  } else if($type == "getCourses") {
    $subject_id = intval($_POST['subject_id']);
    $options = "";
    $records = GetRecords("cpmodules", array("parentId"=>$subject_id, "level"=>3, "type"=>'chapter'), array("module"));
    if(count($records) == 0) {
      $options .= '<option value="">No Chaptes added</option>';
    } else if(count($records) == 1) {
      $options .= '<option value="">-Select Chapter-</option>';
      $options .= '<option value="'.$records[0]['id'].'">'.$records[0]['module'].'</option>';
    } else if(count($records) > 1) {
      $options .= '<option value="">-Select Chapter-</option>';
      foreach($records as $record) {
        // if($record['fullname'] == "Assessments" || $record['fullname'] == "Assignments") {
        //   continue;
        // }
        $options .= '<option value="'.$record['id'].'">'.$record['module'].'</option>';
      }
    }
    $status = true;
    $output['Result'] = $options;
  } else if($type == "getTopics") {
    $courseid = intval($_POST['courseid']);
    $options = "";
    $records = GetRecords("cpmodules", array("parentId"=>$courseid, "level"=>4, "type"=>'topic'), array("module"));
    if(count($records) == 0) {
      $options .= '<option value="">No Topics added</option>';
    } else if(count($records) == 1) {
      $options .= '<option value="">-Select Topic-</option>';
      $options .= '<option value="'.$records[0]['id'].'">'.$records[0]['module'].'</option>';
    } else if(count($records) > 1) {
      $options .= '<option value="">-Select Topic-</option>';
      foreach($records as $record) {
        // if($record['fullname'] == "Assessments" || $record['fullname'] == "Assignments") {
        //   continue;
        // }
        $options .= '<option value="'.$record['id'].'">'.$record['module'].'</option>';
      }
    }
    $status = true;
    $output['Result'] = $options;
  } else if($type == "getSubTopics") {
    $topicid = intval($_POST['topicid']);
    $options = "";
    $records = GetRecords("cpmodules", array("parentId"=>$topicid, "level"=>5, "type"=>'subTopic'), array("module"));
    if(count($records) == 0) {
      $options .= '<option value="">No Sub Topics added</option>';
    } else if(count($records) == 1) {
      $options .= '<option value="'.$records[0]['id'].'">'.$records[0]['module'].'</option>';
    } else if(count($records) > 1) {
      $options .= '<option value="">-Select Sub Topic-</option>';
      foreach($records as $record) {
        // if($record['fullname'] == "Assessments" || $record['fullname'] == "Assignments") {
        //   continue;
        // }
        $options .= '<option value="'.$record['id'].'">'.$record['module'].'</option>';
      }
    }
    $status = true;
    $output['Result'] = $options;
  } else if($type == "editQuestion") {
    $class = intval($_POST['selectedClass']);
    $subject = intval($_POST['selectedSubject']);
    $course = intval($_POST['course']);
    $topic = intval($_POST['topic']);
    $subtopic = intval($_POST['subtopic']);
    $category = intval($_POST['category']);
    $difficulty = intval($_POST['difficulty']);
    $qtype = getSanitizedData($_POST['qtype']);
    $question_text = trim($_POST['questiontext']);
  } else if($type == "saveQuestion") {
  	$class = intval($_POST['selectedClass']);
  	$subject = intval($_POST['selectedSubject']);
  	$course = intval($_POST['course']);
    $topic = intval($_POST['topic']);
    $subtopic = intval($_POST['subtopic']);
    $category = intval($_POST['category']);
  	$difficulty = intval($_POST['difficulty']);
  	$qtype = getSanitizedData($_POST['qtype']);
  	$question_text = trim($_POST['questiontext']);
    $buttontype = '';
    $qid = '';
    if (isset($_POST["buttontype"])) {
      $buttontype = $_POST["buttontype"];
      $qid = $_POST["qid"];
    }
  	$qcategory_id = CreateGetQuestionCategory($class,$subject,$course,$topic,$subtopic, $category, $difficulty);

  	if($qcategory_id > 0) {
			$question = array();
			if(isset($_POST['qid'])) {
				$question['id']  = intval($_POST['qid']);
			}
			$question['category'] = $qcategory_id;
			$question['name'] = time();
			$question['questiontext'] = $question_text;
			if(isset($_POST['shuffleanswers'])) {
				$question['shuffleanswers'] = intval($_POST['shuffleanswers']);
			} else {
				$question['shuffleanswers'] = 0;
			}
			if($qtype == "multichoice" || $qtype == "multichoicem") {
				$question['qtype'] = $qtype;
  			if($qtype == "multichoice") {
  				$question['single'] = 1;
  			} else {
  				$question['single'] = 0;
  			}
  			$options = array();
  			foreach($_POST['answer'] as $key=>$value) {
  				if($value != "") {
  					$oid = 0;
  					if(isset($_POST['oid'][$key])) {
  						$oid = intval($_POST['oid'][$key]);
  					}
  					$options[] = array("id"=>$oid, "answer"=>$value, "fraction"=>$_POST['fraction'][$key]);
  				}
  			}
  			$question['options'] = $options;
			} else if($qtype == "ddmatch") {
  			$question['qtype'] = $qtype;
  			$options = array();
  			foreach($_POST['subquestiontext'] as $key=>$value) {
  				if($value != "" || $_POST['answer'][$key] != "") {
  					$oid = 0;
  					if(isset($_POST['oid'][$key])) {
  						$oid = intval($_POST['oid'][$key]);
  					}
  					$options[] = array("id"=>$oid, "subquestiontext"=>$value, "answer"=>$_POST['answer'][$key]);
  				}
  			}
  			$question['options'] = $options;
  		} else if($qtype == "shortanswer") {
				$question['qtype'] = $qtype;
				$options = array();
  			foreach($_POST['answer'] as $key=>$value) {
  				if($value != "") {
  					$oid = 0;
  					if(isset($_POST['oid'][$key])) {
  						$oid = intval($_POST['oid'][$key]);
  					}
  					$options[] = array("id"=>$oid, "answer"=>$value, "fraction"=>$_POST['fraction'][$key]);
  				}
  			}
  			$question['options'] = $options;
  		}
      if ($buttontype == "editQuestion") {
        $qid = $_POST["qid"];
        DeleteRecord("question_answers", array("question"=>$qid));
        DeleteRecord("question_multichoice", array("question"=>$qid));
        DeleteRecord("question_shortanswer", array("question"=>$qid));
        DeleteRecord("question_ddmatch_sub", array("question"=>$qid));
        DeleteRecord("question_ddmatch", array("question"=>$qid));
        // DeleteRecord("question_match_sub", array("question"=>$qid));
        // DeleteRecord("question_match", array("question"=>$qid));
        $count = DeleteRecord("quiz_question", array("id"=>$qid));
      }
      $response = createQuestion($question);
  		$output['temp'] = $response;
  		if($response != '') {
        $snackbar = true;
			  $status = true;
        if(isset($_POST['qid'])) {
          $message = "Question updated successfully";
        } else {
          $message = "Question created successfully";
        }
			} else {
				$status = false;
				$message = "Question Creation failed";
			}
  	} else {
  		$status = false;
  		$message = "Question Creation Failed. Ref: Category Creation failed";
      $output['temp'] = $qcategory_id;
  	}
  } else if($type == "displayQuestions") {
    $classes = intval($_POST['class']);
    $subject = intval($_POST['subject']);
  	$course_id = intval($_POST['course_id']);
    $topic = intval($_POST['topic']);
    $subtopic = intval($_POST['subtopic']);
  	$questionsList = getQuestions($classes,$subject,$course_id,$topic,$subtopic);
  	$output['Result'] = $questionsList;
    $status = true;
  } else if($type == "viewQuestion") {
  	$qid = intval($_POST['qid']);
  	$output['Result'] = GetQuestionDetail($qid);
  	$status = true;
  } else if($type == "deleteQuestion") {
  	$qid = intval($_POST['qid']);
  	//Check if this is added to any of the Question Paper or not
  	$records = GetQueryRecords("SELECT id, name FROM quiz WHERE questions LIKE '$qid,%' OR '%,$qid,%'", array());
  	if(isset($records[0]['id'])) {
  		$status = false;
  		$message = "Cannot delete this question as it is added to Question Paper - ".$records[0]['name'];
  	} else {
  		//Delete Options
  		DeleteRecord("question_answers", array("question"=>$qid));
  		DeleteRecord("question_multichoice", array("question"=>$qid));
  		DeleteRecord("question_shortanswer", array("question"=>$qid));
  		DeleteRecord("question_ddmatch_sub", array("question"=>$qid));
  		DeleteRecord("question_ddmatch", array("question"=>$qid));
  		// DeleteRecord("question_match_sub", array("question"=>$qid));
  		// DeleteRecord("question_match", array("question"=>$qid));
  		$count = DeleteRecord("quiz_question", array("id"=>$qid));
  		if($count > 0) {
  			$status = true;
  			$message = "Question Deleted successfully";
  		} else {
  			$status = false;
  			$message = "No records found";
  		}
  	}
  } else if($type == "filterQuestions") {
    $course_id = intval($_POST['course_id']);
    $category = getSanitizedData($_POST['category']);
    $difficulty = getSanitizedData($_POST['difficulty']);
    $qtype = getSanitizedData($_POST['qtype']);
    $questionsList = getQuestions($course_id, $category, $difficulty);
    $html = "";
    foreach($questionsList as $key=>$question) {
      if($qtype != "All" && $qtype != $question['qtype2_code']) {
        unset($questionsList[$key]);
        continue;
      }
      $html .= '<div class="card bg-transparent mb-3">
                  <div class="card-body bg-transparent py-2">
                    <div class="form-check d-flex align-items-center">
                      <input class="form-check-input qust_list mt-0" id="qust'.$question['QuestionID'].'" name="questions[]" type="checkbox" value="'.$question['QuestionID'].'"> <label class="form-check-label w-100 pl-1" role="button" for="qust'.$question['QuestionID'].'">'.$question['QuestionPureText'].'</label>
                      <button class="btn btn-md btn-light-blue px-2 viewQuestion" data-toggle="modal" data-target="#AddviewQustModal" data-id="'.$question['QuestionID'].'">Quick View</button>
                    </div>
                  </div>
                </div>';
    }
    $output['LOQ'] = $html;
    $output['Result'] = $questionsList;
    $status = true;
  } else if($type == "saveQuestionPaper") {
    
    $modname = getSanitizedData($_POST['title']);
    $intro = getSanitizedData($_POST['qust_paper_code']);
    if($intro == "") {
      $intro = " ";
    }
    $chapters = $_POST['course'];
    $subject_id = intval($_POST['selectedSubject']);
    if(isset($_POST['courseName'])) {
      $courseName = getSanitizedData($_POST['courseName']);
      $course_id = GetCreateCourseID4Assessment($subject_id, $courseName);
      $visible = 1;
      $difficulty = NULL;
    } else {
      $course_id = GetCreateCourseID4Assessment($subject_id);
      $visible = 0;
      $difficulty = intval($_POST['qpDifficulty']);
    }
    $time_in_hours = floatval($_POST['time_allowed']);
    $time_in_seconds = $time_in_hours * 60 * 60;
    $sum_grades = floatval($_POST['total_marks']);
    $no_of_pages = count($_POST['sect_title']);
    $temp = "";
    $attempts = intval($_POST['attempts']);
    foreach($_POST['section_question_ids'] as $key=>$value) {
      if($value != "") {
        $temp .= "0,";
      }
    }
    $temp = trim($temp, ",");
    if($course_id > 0) {
      $quiz_data = [
        "course" => $course_id,
        "name" => $modname,
        "intro" => $intro,
        "introformat" => 1,
        "timelimit" => $time_in_seconds,
        "preferredbehaviour" => "deferredfeedback",
        "overduehandling" => "autoabandon",
        "sumgrades" => $sum_grades,
        "grade" => $sum_grades,
        "password" => "",
        "subnet" => "",
        "browsersecurity" => "",
        "questions" => "",
        "attempts" => $attempts
      ];
      //Check If Quiz already exists or not
      if(isset($_POST['quiz_id'])) {
        $quiz_id = intval($_POST['quiz_id']);
        $queryu = "UPDATE mdl_quiz SET name = ?, intro = ?, timelimit = ?, sumgrades = ?, grade = ? WHERE id = ?";
        $stmtu = $db->prepare($queryu);
        $stmtu->execute(array($modname, $intro, $time_in_seconds, $sum_grades, $sum_grades, $quiz_id));
        $check = null;
      } else {
        $check = GetRecord("mdl_quiz", array("name"=>$modname, "course"=>$course_id));
      }
      if(!$check) {
        if(isset($_POST['quiz_id'])) {

        } else {
          $quiz_id = CreateQuizInMoodle($quiz_data, $course_id, $visible);
        }
        if($quiz_id >  0) {
          $chapters = implode(",", $_POST['course']);
          $check2 = GetRecord("pms_quiz_add_cols", array("quiz_id"=>$quiz_id));
          if($check2) {
            $queryu = "UPDATE pms_quiz_add_cols SET chapters = ?, difficulty = ? WHERE quiz_id = ?";
            $stmtu = $db->prepare($queryu);
            $stmtu->execute(array($chapters, $difficulty, $quiz_id));
          } else {
            $datai = [
              "quiz_id" => $quiz_id,
              "chapters" => $chapters,
              "difficulty" => $difficulty
            ];
            InsertRecord("pms_quiz_add_cols", $datai);
          }
          //Add Questions to Quiz
          $all_questions = "";
          foreach($_POST['sect_title'] as $key=>$label) {
            if($_POST['section_question_ids'][$key] == "") {
              continue;
            }
            $description = getSanitizedData($label);
            if(isset($_POST['sect_title_id'][$key])) {
              $label_id = intval($_POST['sect_title_id'][$key]);
              $queryu = "UPDATE mdl_question SET questiontext = ? WHERE id = ?";
              $stmtu = $db->prepare($queryu);
              $stmtu->execute(array($description, $label_id));
            } else {
              if($description == "") {
                $description = " ";
              }
              $question_data = [
                "category" => 1,
                "parent" => 0,
                "name" => "Description - ".$key,
                "questiontext" => $description,
                "questiontextformat" => 0,
                "generalfeedback" => '',
                "generalfeedbackformat" => 1,
                "defaultmark" => 0,
                "penalty" => 0,
                "qtype" => "description",
                "length" => 0,
                "hidden" => 0,
                "timecreated" => time(),
                "timemodified" => time(),
                "createdby" => $login_userid,
                "modifiedby" => $login_userid
              ];
              $label_id = InsertRecord("mdl_question", $question_data);
            }
            if(strlen($all_questions) > 0) {
              $all_questions .= ",";
            }
            $all_questions .= $label_id.",".$_POST['section_question_ids'][$key].",0";
          }
          if(strlen($all_questions) > 0) {
            $marks = $_POST['marks'];
            $aq_response = AddQuestionsToQuiz($quiz_id, $all_questions, $marks);
            /*$queryu = "UPDATE mdl_quiz SET questions = ? WHERE id = ?";
            $stmtu = $db->prepare($queryu);
            $stmtu->execute(array($all_questions, $quiz_id));*/
            $output['aq_response'] = $aq_response;
          }
          $status = true;
          $snackbar = true;
          if(isset($_POST['courseName'])) {
            if(isset($_POST['quiz_id'])) {
              $message = "Worksheet updated successfully";
            } else {
              $message = "Worksheet created successfully";
            }
          } else {
            if(isset($_POST['quiz_id'])) {
              $message = "Question Paper updated successfully";
            } else {
              $message = "Question Paper created successfully";
            }
          }
        }
      } else {
        $status = false;
        $message = "Question Paper name already exists. Please choose different name";
      }
    } else {
      $status = false;
      $message = "Assessment Course creation failed";
    }
  } else if($type == "getQuestionPapers") {
    $subject_id = intval($_POST['subject_id']);
    $qps = GetQuestionPapers($subject_id);
    foreach($qps as $key=>$qp) {
      $encypted = Encrypt($qp['id']);
      $qps[$key]['Action'] = '<a class="action_tooltip" href="EditQuestionPaper.php?id='.$encypted.'" data-toggle="tooltip" data-placement="top" data-html="true" title="Edit this Question Paper"><img src="../../assets/images/qb/edit.svg" role="button" class="mx-3"></a>';
      $qps[$key]['Action'] .= '<div data-toggle="modal" class="deleteQuiz" data-target="#delteQustModal" data-id="'.$qp['id'].'">
        <img data-toggle="tooltip" role="button" data-placement="top" data-html="true" title="Delete this Question Paper" class="action_tooltip" src="../../assets/images/qb/delete.svg">
      </div>';
    }
    $output['Result'] = $qps;
    $status = true;
  } else if($type == "deleteQuiz") {
    $quiz_id = intval($_POST['quiz_id']);
    $check = GetRecord("mdl_quiz", array("id"=>$quiz_id));
    if($check['id']) {
      DeleteQuiz($check['course'], $quiz_id);
      $status = true;
      $message = "Question Paper deleted successfully";
    } else {
      $status = false;
      $message = "Question Paper already deleted (or) Does not exist";
    }
  } else if($type == "getQuestionPaperList") {
    $result = array();
    $subject_id = intval($_POST['subject_id']);
    $qps = GetQuestionPapers($subject_id);
    foreach($qps as $key=>$qp) {

      if($qp['visible'] == 1) {

        $qps[$key]['checkbox'] = '';

        $qps[$key]['Action'] = '<div class="d-flex align-items-center"><div class="tick_icon"><img class="mr-2" src="../../assets/images/content/right_mark.png"></div><div><button class="btn btn-md btn-light-blue viewPreview" data-toggle="modal" data-target="#preview_question_paper" data-id="'.$qp['id'].'">Preview</button></div></div>';

      } else {
        $qps[$key]['checkbox'] = '<input class="form-check-input qust_paper_list m-0 position-relative" type="checkbox" name="instance_quiz_id" value="'.$qp['id'].'">';
        $qps[$key]['Action'] = '<div class="d-flex align-items-center"><div class="tick_icon"></div><div><button class="btn btn-md btn-light-blue viewPreview" data-toggle="modal" data-target="#preview_question_paper"s data-id="'.$qp['id'].'">Preview</button></div></div>';
      }

      if(isset($_POST['filter']) && $_POST['filter'] == "published"){
        if($qp['visible'] == 0) {
          unset($qps[$key]);
        }
      } elseif (isset($_POST['filter']) && $_POST['filter'] == "notpublished") {
        if($qp['visible'] == 1) {
          unset($qps[$key]);
        }
      }
    }
    $qps = array_values($qps);
    $output['Result'] = $qps;
    $status = true;
  } else if($type == "publishQuestionPaper") {
    $instance_quiz_ids = $_POST['instance_quiz_ids'];
    $moduleInfo = GetRecord("mdl_modules", array("name"=>"quiz"));
    $module_id = $moduleInfo['id'];
    $queryu = "UPDATE mdl_course_modules SET visible = 1 WHERE instance IN($instance_quiz_ids) AND module = '$module_id'";
    $stmtu = $db->query($queryu);
    $rowcount = $stmtu->rowCount();
    //Clear Course Cache
    $records = GetQueryRecords("SELECT DISTINCT(course) FROM mdl_course_modules WHERE instance IN($instance_quiz_ids) AND module = '$module_id'");
    foreach($records as $record) {
      ClearCourseCache($record['course']);
    }
    if($rowcount){
      $status = true;
      $message = "Question Paper published successfully";
    } else {
      $status = false;
      $message = "Failed to Update";
    }
  } else if($type == "DeleteImage") {
    $image_path = getSanitizedData($_POST['img_src']);
    $path = str_replace($web_root."app/", "", $image_path);
    $delete_path = "../../".$path;
    if(file_exists($delete_path)) {
      unlink($delete_path);
    }
    $query = "DELETE FROM question_images WHERE final_path = ?";
    $stmt = $db->prepare($query);
    $stmt->execute(array($path));
    $status = true;
  } else if($type == "validateExcel") {
    include '../../../assets/lib/Excel/Classes/PHPExcel/IOFactory.php';
    $filetmp1 = $_FILES["file"]["tmp_name"];
    $filename1 = $_FILES["file"]["name"];
    $filetype1 = $_FILES["file"]["type"];
    //Using this function, find the image extension
    $ext = pathinfo($filename1, PATHINFO_EXTENSION);
    
    $fh = fopen ($filetmp1, "rb");
    $data = fread ($fh, 16);
    $header = unpack ("C1highbit/"."A3signature/"."C2lineendings/"."C1eof/"."C1eol", $data);
    $hexa_check = bin2hex($header['signature']);

    move_uploaded_file($_FILES["file"]["tmp_name"],$_FILES["file"]["name"] );
    $inputFileName = $_FILES["file"]["name"];  
    //  Read your Excel workbook
    try {
      $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
      $objReader = PHPExcel_IOFactory::createReader($inputFileType);
      $objPHPExcel = $objReader->load($inputFileName);
    } catch (Exception $e) {
      die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
    }
    
    $rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
    $array_data = array();
    foreach ($rowIterator as $row) {
      $cellIterator = $row->getCellIterator();
      $cellIterator->setIterateOnlyExistingCells(false);
      $rowIndex = $row->getRowIndex();
      //$array_data[$rowIndex] = array('A' => '', 'B' => '', 'C' => '', 'D' => '', 'E' => '', 'F' => '', 'G' => '');
    
      foreach ($cellIterator as $cell) {
        if($cell->getCalculatedValue() != "") {
          $colIndex = PHPExcel_Cell::columnIndexFromString($cell->getColumn())-1;
          $array_data[$rowIndex][$colIndex] = trim(preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $cell->getCalculatedValue()));
        }
      }
    }
    /*echo "<pre />";
    print_r($array_data);*/
    unlink($inputFileName);
    //Fetch all the usernames
    $existing_usernames = array();
    $query = "SELECT username FROM mdl_user";
    $result=$db->query($query);
    while($rows = $result->fetch(PDO::FETCH_ASSOC))
      $existing_usernames[] = strtolower($rows['username']);
    $submit = 1;
    $no_of_errors = 0;
    $prod = $array_data;
    $tbody = "";
    $ques_sno = -1;
    $excel_usernames = array();
    for($i = 2; $i <= count($prod) && count($prod) < 1002; $i++)
    {
      $error = "";
      $classcode = "";
      //Validate all the fields
      if(!isset($prod[$i]['6']))
        $prod[$i]['6'] = "";
      if(!isset($prod[$i]['5']))
        $prod[$i]['5'] = "";
      if(!isset($prod[$i]['4']))
        $prod[$i]['4'] = "";
      if(!isset($prod[$i]['3']))
        $prod[$i]['3'] = "";
      if(!isset($prod[$i]['2']))
        $prod[$i]['2'] = "";
      if(!isset($prod[$i]['1']))
        $prod[$i]['1'] = "";
      if(!isset($prod[$i]['0']))
        $prod[$i]['0'] = "";
      
      if($prod[$i]['6'] == "")
       $error .= "Please enter Questin Text. ";   
      if($prod[$i]['5'] == "")
       $error .= "Please enter Type of Question. ";   
      if($prod[$i]['4'] == "")
       $error .= "Please enter Difficulty of Question. ";
      if($prod[$i]['3'] == "")
       $error .= "Please enter Question Category. ";
      if($prod[$i]['2'] == "")
       $error .= "Please enter Chapter. ";
      if($prod[$i]['1'] == "")
       $error .= "Please enter Subject. ";
      if($prod[$i]['0'] == "")
       $error .= "Please enter Class. ";

      //Get the list of classes
      $thisclass = $prod[$i]['0'];
      $stmt3 = $db->prepare("SELECT code , description , roman FROM master_class WHERE visibility = 1 AND ( code = ?  OR description = ?  OR roman = ?  )");
      $stmt3->execute(array($thisclass,$thisclass,$thisclass));                                                      
      if($rows = $stmt3->fetch(PDO::FETCH_ASSOC))
      {
        $classcode = $rows['code'];
        $classdesc = $rows['description'];
      }
      else
      {
         $error .= "Invalid Class entered. Ex: For Class 10, it should be 10 (or) Ten (or) X. ";
      }

      //check valid subject name
      $subject_id = "";
      $subjects = getSubject_array_format($classcode);
      $subject_id = array_search($prod[$i]['1'],$subjects);
      /*echo "<pre/>";
      print_r($subjects);*/
      if(!in_array($prod[$i]['1'], $subjects)){
        $error .= "Given subject not found for the this class. ";
      }

      

      //check chapter name
      $chapter_id = "";
      $chapter_array = array();
      $chapter = GetQueryRecords("SELECT id, fullname FROM mdl_course WHERE category = '$subject_id'", array());
      foreach ($chapter as $key => $value) {
        $chapter_array[$value['id']] = $value['fullname'];
      }
      $chapter_id = array_search($prod[$i]['2'],$chapter_array);
      if(!in_array($prod[$i]['2'], $chapter_array)){
        $error .= "Given chapter not found for the this class and subject. ";
      }

      //check Question Category
      $cat_id = "";
      $cat_array = array();
      $records_cat = GetRecords("masters_questions_categories", array(), array("qcategory_name"));
      foreach($records_cat as $record) {
        $cat_array[$record['id']] = $record['qcategory_name'];
      }
      $cat_id = array_search($prod[$i]['3'],$cat_array);
      if(!in_array($prod[$i]['3'], $cat_array)){
        $error .= "Given *Question Category* not found. ";
      }

      //check Difficulty of Question
      $diff_id = "";
      $diff_qust_array = array();
      $records_qust_diff = GetRecords("masters_questions_difficulty", array(), array("qdifficulty_name"));
      foreach($records_qust_diff as $record) {
        $diff_qust_array[$record['id']] = $record['qdifficulty_name'];
      }
      $diff_id = array_search($prod[$i]['4'],$diff_qust_array);
      if(!in_array($prod[$i]['4'], $diff_qust_array)){
        $error .= "Given *Difficulty of Question* not found. ";
      }

      //check Type of Question
      $qtype_code = "";
      $qtype_array = array();
      $records_qtype = GetRecords("pms_quiz_questiontypes", array(), array("description"));
      foreach($records_qtype as $record) {
        if($record['code'] == "multichoice" || $record['code'] == "multichoicem")
          $qtype_array[$record['code']] = $record['description'];
      }
      $qtype_code = array_search($prod[$i]['5'],$qtype_array);
      if(!in_array($prod[$i]['5'], $qtype_array)){
        $error .= "Given *Type of Question* not found. ";
      }
      
      $excel_classnames[] = strtolower($prod[$i]['0']);
      $tbody .= '<tr><td class="text-center">Excel Row #'.$i.'</td>';
      if($error != "")
      {

        $submit = 0;
        $no_of_errors++;
        $tbody .= '<td class="text-danger font-weight-bold col-4">'.$error.'</td>
            <td><input type="text" value="'.$classcode.'" style="background:none; border:none;" readonly="readonly"  /></td>
            <td><input type="text" value="'.$prod[$i]['1'].'" style="background:none; border:none;" readonly="readonly"  /></td>
            <td><input type="text" value="'.$prod[$i]['2'].'" style="background:none; border:none;" readonly="readonly"  /></td>
            <td><input type="text" value="'.$prod[$i]['3'].'" style="background:none; border:none;" readonly="readonly"  /></td>
            <td><input type="text" value="'.$prod[$i]['4'].'" style="background:none; border:none;" readonly="readonly"  /></td>
            <td><input type="text" value="'.$prod[$i]['5'].'" style="background:none; border:none;" readonly="readonly"  /></td>
            <td><input type="text" value="'.$prod[$i]['6'].'" style="background:none; border:none;" readonly="readonly"  /></td>';
            for($o = 7; $o<100;$o++) {
              if(isset($prod[$i][$o])) {
                $option_text = $prod[$i][$o];
                $option_response = $prod[$i][$o+1]; //Update this logic
                if($option_response == "correct"){
                  $option_response = 1;
                } else{
                  $option_response = 0;
                }
                $tbody .= '<td><input type="text" name="option_text[]" value="'.$option_text.'" style="background:none; border:none;" readonly="readonly"  /></td>
                          <td><input type="text" name="option_response[]" value="'.$prod[$i][$o+1].'" style="background:none; border:none;" readonly="readonly"  /></td>';
                $o++;
              } else {
                break;
              }
            }
            $tbody .= '
            </tr>';
      } else {
        $ques_sno++;
        $tbody .= '<td>
                    <input type="text" name="classcode[]" value="'.$classcode.'" style="background:none; border:none;" readonly="readonly"  />
                  </td>
                  <td>
                    <input type="text" value="'.$prod[$i]['1'].'" style="background:none; border:none;" readonly="readonly"  />
                    <input type="hidden" name="subject_id[]" value="'.$subject_id.'" style="background:none; border:none;" readonly="readonly"  />
                  </td>
                  <td>
                    <input type="text" value="'.$prod[$i]['2'].'" style="background:none; border:none;" readonly="readonly"  />
                    <input type="hidden" name="chapter_id[]" value="'.$chapter_id.'" style="background:none; border:none;" readonly="readonly"  />
                  </td>
                  <td>
                    <input type="text" value="'.$prod[$i]['3'].'" style="background:none; border:none;" readonly="readonly"  />
                    <input type="hidden" name="cat_id[]" value="'.$cat_id.'" style="background:none; border:none;" readonly="readonly"  />
                  </td>
                  <td>
                    <input type="text" value="'.$prod[$i]['4'].'" style="background:none; border:none;" readonly="readonly"  />
                    <input type="hidden" name="diff_id[]" value="'.$diff_id.'" style="background:none; border:none;" readonly="readonly"  />
                  </td>
                  <td>
                    <input type="text" value="'.$prod[$i]['5'].'" style="background:none; border:none;" readonly="readonly"  />
                    <input type="hidden" name="qtype_code[]" value="'.$qtype_code.'" style="background:none; border:none;" readonly="readonly"  />
                  </td>
                  <td><input type="text" name="qust_txt[]" value="'.$prod[$i]['6'].'" style="background:none; border:none;" readonly="readonly"  /></td>';
        for($o = 7; $o<100;$o++) {
          if(isset($prod[$i][$o])) {
            $option_text = $prod[$i][$o];
            $option_response = $prod[$i][$o+1]; //Update this logic
            if($option_response == "correct"){
              $option_response = 1;
            } else{
              $option_response = 0;
            }
            $tbody .= '<td><input type="text" name="option_text['.$ques_sno.'][]" value="'.$option_text.'" style="background:none; border:none;" readonly="readonly"  /></td>
                      <td>
                        <input type="text" value="'.$prod[$i][$o+1].'" style="background:none; border:none;" readonly="readonly"  />
                        <input type="hidden" name="option_response['.$ques_sno.'][]" value="'.$option_response.'" style="background:none; border:none;" readonly="readonly"  />
                      </td>';
            $o++;
          } else {
            break;
          }
        }
        $tbody .= '
            </tr>';
      }
    }
    $output['List'] = $tbody;
    if($no_of_errors > 0)
      $upload_ok = false;
    else
      $upload_ok = true;
    $output['UploadStatus']  = $upload_ok;
    $output['NoOfErrors'] = $no_of_errors;
    $status = true;
    if(count($prod) >= 1002) {
      $status = false;
      $message = "Maximum number of records to upload should be less than 1000";
    }
  } else if($type == "uploadvalidateExcel") {
    $class = $_POST['classcode'];
    foreach ($class as $key => $value) {
      $class = intval($value);
      $subject = intval($_POST['subject_id'][$key]);
      $course = intval($_POST['chapter_id'][$key]);
      $category = intval($_POST['cat_id'][$key]);
      $difficulty = intval($_POST['diff_id'][$key]);
      $qtype = getSanitizedData($_POST['qtype_code'][$key]);
      $question_text = trim($_POST['qust_txt'][$key]);
      $qcategory_id = CreateGetQuestionCategory($course, $category, $difficulty);
      
      if($qcategory_id > 0) {
        $question = array();
        $question['category'] = $qcategory_id;
        $question['name'] = time();
        $question['questiontext'] = $question_text;
        $question['shuffleanswers'] = 0;
        if($qtype == "multichoice" || $qtype == "multichoicem") {
          $question['qtype'] = "multichoice";
          if($qtype == "multichoice") {
            $question['single'] = 1;
          } else {
            $question['single'] = 0;
          }
          $options = array();
          foreach($_POST['option_text'][$key] as $key1=>$value1) {
            if($value1 != "") {
              $oid = 0;
              $options[] = array("id"=>$oid, "answer"=>$value1, "fraction"=>$_POST['option_response'][$key][$key1]);
            }
          }
          $question['options'] = $options;
        }
        $response = createQuestionInMoodle($question);
        $output['temp'] = $response;
        if(isset($response[0]['id'])) {
          $snackbar = true;
          $status = true;
          $success_message = "Question created successfully";
        } else {
          $status = false;
          $message .= "Question Creation failed. ";
        }
      } else {
        $status = false;
        $message .= "Question Creation Failed. Ref: Category Creation failed. ";
      }
    }
  } else if($type == "setCancel4QP") {
    $quiz_id = intval($_POST['quiz_id']);
    $moduleInfo = GetRecord("mdl_modules", array("name"=>"quiz"));
    $module_id = $moduleInfo['id'];
    $cmInfo = GetRecord("mdl_course_modules", array("instance"=>$quiz_id, "module"=>$module_id));
    $course_id = $cmInfo['course'];
    $courseInfo = GetRecord("mdl_course", array("id"=>$course_id));
    $category_id = $courseInfo['category'];
    $categoryInfo = GetRecord("mdl_course_categories", array("id"=>$category_id));
    $path = $categoryInfo['path'];
    $temp = explode("/", $path);
    $temp = array_values(array_filter($temp));
    $class_category_id = $temp[0];
    $subject_id = $category_id;
    $classInfo = GetRecord("master_class", array("categoryid"=>$class_category_id));
    $class = $classInfo['code'];
    $_SESSION['QP_Cancel_Class'] = $class;
    $_SESSION['QP_Cancel_Subject'] = $subject_id;
    $status = true;
    $output['Result'] = array("Class"=>$class, "subject"=>$subject_id);
  } else if($type == "previewQP") {
    $quiz_id = intval($_POST['quiz_id']);
    $quizInfo = GetQuizDetails($quiz_id);
    $sections = $quizInfo['Questions'];
    $html = "";
    foreach($sections as $thisSection) {
      $label_ref_details = GetQuestionDetail($thisSection['label_ref']['id']);
      if(isset($label_ref_details['QuestionText'])) {
        $label_name = $label_ref_details['QuestionText'];
      } else {
        $label_name = "";
      }

      $html .= '<div class="d-flex w-100 mb-4 prev_section_heading">
                      <div class="p-2 flex-grow-1">
                        <h4 class="font-weight-bold"><u>'.$label_name.'</u></h4>
                      </div>
                      <div class="p-2 flex-shrink-1">
                        <h4 class="font-weight-bold">Marks: <span id="preview_section_marks">'.intval($thisSection['SectionTotal']).'</span></h4>
                      </div>
                    </div>';

       // Loop Question by Question
       foreach($thisSection['questions'] as $key1=>$qid) {
            $thisQuestion = GetQuestionDetail($qid);
            $qtype = $thisQuestion['qtype'];
            $qtype2 = $thisQuestion['qtype2'];
            $marks = GetRecord("mdl_quiz_question_instances", array("quiz" => $quiz_id,"question" => $qid), array());
            
            $html .= '
                <div class="row">

                   <div class="col-12 mb-4">

                      <div class="card bg-transparent">

                         <div class="card-header text-center">
                            <h3 class="font-weight-bold text-center mb-0 w-100">Question'.' '.($key1+1).'</h3>
                         </div>

                         <div class="card-body">

                            <div class="row" id="preview_question_list">

                               <div class="col-8">

                                  <h3 class="card-title">'.getSanitizedData($thisQuestion['QuestionText']).'</h3>';

                                   if(count($thisQuestion['ImageSource']) > 0) {
                                        $html .= '
                                         <img class="qust_img my-3" src='.$thisQuestion['ImageSource'][0].'>';

                                        
                                      }
                                                             
                                    //Multichoice Options
                                    if($qtype == "multichoice") {

                                      $Options = $thisQuestion['Options'];
                                      
                                      foreach($Options as $option) {

                                        if ($qtype2 == 'multichoicem') {

                                            if(count($option['ImageSource']) > 0) {
                                            $html .= '
                                              <div class="form-check">
                                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" disabled="disabled">&nbsp&nbsp
                                                 <img src='.$option['ImageSource'][0].' width="150px">
                                              </div>
                                              ';
                                            } else {
                                              $html .= '<div class="form-check">
                                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="" disabled="disabled">
                                                <label class="form-check-label" for="exampleRadios1">
                                                  '.strip_tags($option['OptionText']).'
                                                </label>
                                              </div>';
                                            }
                                            
                                        } else {

                                             if(count($option['ImageSource']) > 0) {
                                              $html .= '
                                              <div class="form-check">
                                                 <input class="form-check-input" type="checkbox" value="" id="defaultCheck2" disabled="disabled">&nbsp; &nbsp;
                                                 <img src='.$option['ImageSource'][0].' width="150px">
                                              </div>
                                              ';
                                            } else {
                                              $html .= '
                                              <div class="form-check">
                                                 <input class="form-check-input" type="checkbox" value="" id="defaultCheck2" disabled="disabled">
                                                 <label class="form-check-label" for="defaultCheck2">
                                                 '.strip_tags($option['OptionText']).'
                                                 </label>
                                              </div>
                                              '; 
                                            }
                                        }
                                       
                                      }
                                    } else if($qtype == "essay" || $qtype == "shortanswer") {
                                      $html .= '
                                      <textarea class="form-control bg-transparent" placeholder="Type your answer here" rows="15" disabled="disabled"></textarea>
                                      ';
                                    } else if($qtype == "ddmatch") {
                                      // echo "<pre />";
                                      // print_r($thisQuestion['Options']);
                                      $Options = $thisQuestion['Options'];
                                      // print_r($Options);
                                      foreach($Options as $option) {

                                        $html .= '
                                         <div class="d-flex mb-3">
                                          <div class="w-50 drag_drop_qust_option mr-5 py-3">
                                            <h4 class="text-center">'.strip_tags($option['subQuestion']).'</h4>
                                          </div>
                                          <div class="w-50 drag_drop_qust_option mr-5 py-3">
                                            <h4 class="text-center">'.strip_tags($option['subQuestion']).'</h4>
                                          </div>
                                        </div>
                                        ';
                                      }
                                      
                                    } 

                                    $html .= '</div><div class="col-4">
                                      <h4 class="font-weight-bold text-right preview_qust_mark">'.intval($marks['grade']).'</h4>
                                   </div>';
                                   
                                    $html .= '
                                </div>

                            </div>

                        </div>

                       </div>
                    </div>
          ';
      }
                              
        
    }
    $output['Result'] = $html;
    $output['Title'] = $quizInfo['title'];
    $status = true;

  }

	$output['status'] = $status;
	$output['message'] = $message;
  $output['success_message'] = $success_message;
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
