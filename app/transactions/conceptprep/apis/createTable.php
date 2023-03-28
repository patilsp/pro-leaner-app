<?php
	include_once "../../../session_token/checksession.php";
	include "../../../configration/config.php";
	include "../../../configration/config_schools.php";
	include "../../../functions/db_functions.php";
	require_once "../../../functions/common_functions.php";
	$logged_user_id=$_SESSION['cms_userid'];
	$role_id = $_SESSION['user_role_id'];
	$token=$_SESSION['token'];

	try{
		$response = [];
		$class_name = array();
		$subject_name = array();
		$chapter_name = array();
		$topic_name = array();
		$sub_topic_name = array();
		//$lessons_name = GetRecords("$master_db.mdl_course");
		$class_id = $_GET["classid"];
		
		$ActiveSubjects = GetRecords("cpmodules", array("deleted"=>0));
		foreach ($ActiveSubjects as $activeSubject) {
			if($activeSubject['type'] == 'class')
				$class_name[$activeSubject['id']] = $activeSubject['module'];
			if($activeSubject['type'] == 'subject')
				$subject_name[$activeSubject['id']] = $activeSubject['module'];
			if($activeSubject['type'] == 'chapter')
				$chapter_name[$activeSubject['id']] = $activeSubject['module'];
			if($activeSubject['type'] == 'topic')
				$topic_name[$activeSubject['id']] = $activeSubject['module'];
			if($activeSubject['type'] == 'subTopic')
				$sub_topic_name[$activeSubject['id']] = $activeSubject['module'];
		}
		//Userid - Employee
		$employees = array();
		$users = GetRecords("users", array());
		foreach($users as $user) {
			$employees[$user['id']] = $user['first_name']." ".$user['last_name'];
		}

		$tasks = array();
		$cond = '';
		if ($class_id != '') {
			$cond = " AND t.class_id='".$class_id."'";
		}
		if($role_id == 1 || $role_id == 8) {
		 $query = "select t.id as task_id,t.task_name,t.class_id,t.subject_id,s.name,ta.id as task_ass_id,ta.user_id as tassign_user_id, r.name as dept from cptasks t, status s, cptask_assign ta, users u, roles r where ta.status = s.id and t.id=ta.tasks_id and ta.user_id=u.id and u.roles_id= r.id AND u.roles_id != 1 AND s.name != 'Publish' AND s.name != 'Review' $cond ORDER BY ta.id desc";
	  		
		$stmt = $db->query($query);
	  	} else {
  			$query = "select t.id as task_id,t.task_name,t.class_id,t.subject_id,s.name,ta.id as task_ass_id,ta.user_id as tassign_user_id, r.name as dept from cptasks t, status s, cptask_assign ta, users u, roles r where ta.status = s.id and t.id=ta.tasks_id and ta.user_id=u.id and u.roles_id= r.id AND ta.user_id='".$logged_user_id."' AND s.name != 'Publish' $cond ORDER BY ta.id desc";
	  		$stmt = $db->query($query);	
  		}
  		$rowcount = $stmt->rowCount();
  		while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
  			$slide_ids = '';
  			if(is_array($slide_ids)){
  				$slide_ids = "Add slides for Existing Topic";
  			}

  			//checking only layout 6 layout slides
  			$query_addSlide = "SELECT task_assign_id, layout_id FROM cpadd_slide_list WHERE layout_id IN (10, 23, 24, 25, 26) AND task_assign_id = '".$fetch['task_ass_id']."'";
		  	$stmt_addSlide = $db->query($query_addSlide);
		  	$rowcount_addSlide = $stmt_addSlide->rowCount();

		  	$add_slide_list_tb = GetRecords("cpadd_slide_list", array("task_assign_id"=>$fetch['task_ass_id']), array("sequence"));
		  	$slideContentContains = "";
			if(count($add_slide_list_tb) > 0) {
				//echo "<pre/>";
				//print_r($add_slide_list_tb);
				foreach($add_slide_list_tb as $slide)
				{
				  	//checking any slides contains empty json data except DictionaryWords layout and slide_json column contains null values
					$ignoreLayouts_ids = array(0, 5263);
					$slideJSON = json_decode($slide['slide_json']);
					$objectToArray = (array)$slideJSON;
					$layout_id = $slide['layout_id'];
					// echo "<pre/>";
					// print_r($objectToArray);
					if(!in_array($layout_id, $ignoreLayouts_ids)) {
					      foreach ($objectToArray as $key => $value)
						  {
						  	//echo 'key---'.$objectToArray[$key];
						  	if(isset($objectToArray[$key]) && !is_array($objectToArray[$key])){
							    //this means key exists and the value is not a array
							    if(trim($objectToArray[$key]) != '') {
							    	//value is null or empty string or whitespace only
								    $slideContentContains = "";
							    	break;
						    	} else {
									//echo "else 111";echo '<br/>';
									$slideContentContains = 'slide Empty - ';
								}
							} elseif (is_array($objectToArray[$key])) {
								foreach ($value as $key1 => $value1)
					  			{
					  				//echo "value 1---".$value1;echo "<br/>";
					  				if(trim($value[$key1]) != '') {
					  					//value is null or empty string or whitespace only
						  				//echo "value if 1---".$value1;echo "<br/>";
					  					$slideContentContains = "";
							    		break;
						    		} else {
						    			$slideContentContains = 'slide Empty - ';
						    		}
				  				}
							} else {
								//echo "else end";echo '<br/>';
								$slideContentContains = 'slide Empty - ';
							}
						  }
					}

					if($slideContentContains != "")
						break;
				}
			}

			// echo "slideContentContains---".$slideContentContains;echo "<br/>";
  			
		    // array_push($tasks, array("title"=>$fetch['task_name'], "dept"=>$fetch['dept'], "class"=>$fetch['class_id'], "subjectName"=>$subject_name[$fetch['subject_id']], "chapterName"=>$chapter_name[$fetch['chapter_id']], "topicName"=>$topic_name[$fetch['topic_name']], "subTopicName"=>$sub_topic_name[$fetch['sub_topic_id']], "class_id"=>$fetch['class_id'], "subject_id"=>$fetch['subject_id'], "status"=>$fetch['name'], "task_ass_id"=>$fetch['task_ass_id'], "task_id"=>$fetch['task_id'], "layout6"=>$rowcount_addSlide, "slide_id"=>$slide_ids,"task_userid"=>$fetch['tassign_user_id'],"template_id"=>$fetch['template_id'],"layout_id"=>$fetch['layout_id'], "AssignedTo"=>$employees[$fetch['tassign_user_id']], "slideContentEmptyContains"=>$slideContentContains));
			$assignment_link = '<a href="'.$web_root.'app/Assignment/assignment.php?class='.$fetch["class_id"].'&subject='.$fetch["subject_id"].'&xy='.$token.'&task_assi_id='.$fetch["task_ass_id"].'&task_id='.$fetch["task_id"].'&task_userid='.$fetch["tassign_user_id"].'" class="btn btn-warning" style="width:100px;"> Assignment </a>';
			$btndisplayClass = 'd-block';
            if($fetch['name'] == "Review" || $fetch['name'] == "Publish") {
                $btn_lable = "Review";
                if($role_id != 1) {
                    if($role_id == 8){
                        $btndisplayClass = 'd-block';
                    } else{
                        $btndisplayClass = 'd-none';
                    }
                }
            } elseif ($fetch['name'] == "QC") { 
                $btn_lable = "Final QC";
            } else {
                $btn_lable = "WIP";
            }
            $content_column = '<a href="'.$web_root.'app/transactions/conceptprep/slideCreate.php?class='.$fetch['class_id'].'&subject='.$fetch['subject_id'].'&xy='.$token.'&task_assi_id='.$fetch['task_ass_id'].'&task_id='.$fetch['task_id'].'&task_userid='.$fetch['tassign_user_id'].'" class="btn btn-primary '.$btndisplayClass.'">'.$btn_lable.' </a>';
		    array_push($tasks, array("title"=>$fetch['task_name'], "dept"=>$fetch['dept'], "className"=>$class_name[$fetch['class_id']], "subjectName"=>$subject_name[$fetch['subject_id']], "class_id"=>$fetch['class_id'], "subject_id"=>$fetch['subject_id'], "status"=>$fetch['name'], "task_ass_id"=>$fetch['task_ass_id'], "task_id"=>$fetch['task_id'], "layout6"=>$rowcount_addSlide, "slide_id"=>$slide_ids,"task_userid"=>$fetch['tassign_user_id'],"AssignedTo"=>$employees[$fetch['tassign_user_id']], "slideContentEmptyContains"=>$slideContentContains,"assignment"=>$assignment_link,"content_column" => $content_column));
	  	}
	  	// return $tasks;
		echo json_encode($tasks);
	} catch(Exception $exp){
    print_r($exp);
	}
?>