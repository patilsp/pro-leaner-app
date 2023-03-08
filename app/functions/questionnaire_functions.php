<?php
function getTopics4Questionnaire($class_auto_id)
{
	global $db;
	global $master_db;
	try{
		$topics = array();
		if($class_auto_id != "") {
			$classsearch = "CLASS ".$class_auto_id;
		  	$query = "SELECT id FROM $master_db.mdl_course_categories WHERE name = ? AND depth = 1";
	  		$stmt = $db->prepare($query);
	  		$stmt->execute(array($classsearch));
	  		$rowcount = $stmt->rowCount();
	  		if($rowcount > 0){
	  			while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
	  				$query1 = "SELECT id,name FROM $master_db.mdl_course_categories WHERE parent = ? AND depth = 2 ORDER BY sortorder";
			  		$stmt1 = $db->prepare($query1);
			  		$stmt1->execute(array($fetch['id']));
			  		$rowcount1 = $stmt1->rowCount();
			  		if($rowcount1 > 0){
			  			while($fetch1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
			  				$query2 = "SELECT id,name FROM $master_db.mdl_course_categories WHERE parent = ? AND depth = 3 ORDER BY sortorder";
					  		$stmt2 = $db->prepare($query2);
					  		$stmt2->execute(array($fetch1['id']));
					  		$rowcount2 = $stmt2->rowCount();
					  		if($rowcount2 > 0){
					  			while($fetch2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
					  				$query3 = "SELECT id, fullname FROM $master_db.mdl_course WHERE category = ? AND id IN (SELECT course FROM  $master_db.mdl_questionnaire) ORDER BY sortorder";
							  		$stmt3 = $db->prepare($query3);
							  		$stmt3->execute(array($fetch2['id']));
							  		$rowcount3 = $stmt3->rowCount();
							  		if($rowcount3 > 0){
							  			while($fetch3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
							  				$topic_id_arr = array();
						  					$topic_id_arr['id'] = $fetch3['id'];
						  					$topic_id_arr['description'] = $fetch3['fullname'];
						  					array_push($topics, $topic_id_arr);
							  			}
						  			}
					  			}
				  			}
			  			}
		  			}
	  			}
	  			return $topics;
  			}
		} else{
			$query = "SELECT * FROM topics";
	  		$stmt = $db->query($query);
	  		$rowcount = $stmt->rowCount();
	  		if($rowcount > 0){
				while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
				    array_push($topics, array("id"=>$fetch['id'], "description"=>$fetch['topic_name']));
			  	}
			  	return $topics;
		  	}
  		}
  		$rowcount = $stmt->rowCount();
  		
  	}catch(Exception $exp){
		print_r($exp);
		return "false";
	}
}

function getQuestionnaire($course_id)
{
	global $db;
	global $master_db;
	try {
		$questionnaire = array();
		$query = "SELECT mq.id, mq.name FROM $master_db.mdl_questionnaire mq, $master_db.mdl_course_modules cm WHERE cm.course = ? AND cm.module = 25 AND cm.instance = mq.id AND cm.visible = 1";
		$stmt = $db->prepare($query);
		$stmt->execute(array($course_id));
		while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
			array_push($questionnaire, array("id"=>$fetch['id'], "description"=>$fetch['name']));
		}
		return $questionnaire;
  	} catch(Exception $exp){
		print_r($exp);
		return "false";
	}
}

function getQuestions($question_no)
{
	global $db;
	global $master_db;
	try {
		$questionnaire = array();
		$query = "SELECT id, name, content FROM $master_db.mdl_questionnaire_question WHERE survey_id = ? AND deleted = 'n' AND required = 'y' AND type_id = 5";
		$stmt = $db->prepare($query);
		$stmt->execute(array($question_no));
		while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
			$text = strip_tags($fetch['content']);
			$desc = substr($text, 0, 50);
			array_push($questionnaire, array("id"=>$fetch['id'], "description"=>$desc));
		}
		return $questionnaire;
  	} catch(Exception $exp){
		print_r($exp);
		return "false";
	}
}

function getSituationInfo($situationid)
{
	global $db;
	global $master_db;
	try {
		$situation = array();
		$query = "SELECT id, name, content FROM $master_db.mdl_questionnaire_question WHERE id = ? AND deleted = 'n' AND required = 'y'";
		$stmt = $db->prepare($query);
		$stmt->execute(array($situationid));
		while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
			$situation['QuestionText'] = str_replace("
", "", $fetch['content']);
			$situation['QuestionId'] = $fetch['id'];
		}
		
		//Get Correct Response Options
		$correctOptions = array();
		$query = "SELECT id, choice_id FROM $master_db.questionnaire_correct_response WHERE qid = ?";
		$stmt = $db->prepare($query);
		$stmt->execute(array($situationid));
		while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
			array_push($correctOptions, $fetch['choice_id']);
		}

		//Get Options Icon
		$optionIcons = array();
		$query = "SELECT id, option_icon FROM $master_db.questionnaire_option_icon WHERE qid = ?";
		$stmt = $db->prepare($query);
		$stmt->execute(array($situationid));
		while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
			array_push($optionIcons, $fetch['option_icon']);
		}

		//Get Question Audio Source
		$situation['questionAudio'] = '';
		$situation['feedbackImg'] = '';
		$optionIcons = array();
		$query = "SELECT audioSrc, feedbackImg FROM $master_db.questionnaire_intro_audio WHERE qid = ?";
		$stmt = $db->prepare($query);
		$stmt->execute(array($situationid));
		while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
			$situation['questionAudio'] = $fetch['audioSrc'];
			$situation['feedbackImg'] = $fetch['feedbackImg'];
		}
		
		//Options
		$options = array();
		$query = "SELECT id, content FROM $master_db.mdl_questionnaire_quest_choice WHERE question_id = ?";
		$stmt = $db->prepare($query);
		$stmt->execute(array($situationid));
		while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
			$re = false;
			if(in_array($fetch['id'], $correctOptions))
				$re = true;

			//get choosed optionIcon
			$choosedOptionIcon = '';
			$smileOptId = $fetch['id'].'-smile';
			$notSmileOptId = $fetch['id'].'-notSmile';

			if(in_array($smileOptId, $optionIcons))
				$choosedOptionIcon = 'smile';
			else if(in_array($notSmileOptId, $optionIcons))
				$choosedOptionIcon = 'notSmile';

			$content = trim(preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $fetch['content']));
			array_push($options, array("id"=>$fetch['id'], "description"=>$content, "response"=>$re, "choosedOptionIcon"=>$choosedOptionIcon));
		}
		$situation['Options'] = $options;
		
		//Feedback
		$feedback = array();
		$query = "SELECT * FROM $master_db.scenario_feedback WHERE situation_id = ?";
		$stmt = $db->prepare($query);
		$stmt->execute(array($situationid));
		while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
			array_push($feedback, array("grade"=>$fetch['grade'], "description"=>$fetch['feedback'], "feedbackAudio"=>$fetch['audioSrc'], "feedbackId"=>$fetch['id']));
		}
		if(count($feedback) == 0)
			$feedback = array(array("grade"=>"A", "description"=>""),array("grade"=>"B", "description"=>""),array("grade"=>"C", "description"=>""),array("grade"=>"D", "description"=>""),array("grade"=>"E", "description"=>""));
		$situation['Feedback'] = $feedback;
		
		return $situation;
  	} catch(Exception $exp){
		print_r($exp);
		return "false";
	}
}
?>