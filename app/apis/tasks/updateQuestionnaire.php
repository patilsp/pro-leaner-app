<?php
include_once "../../session_token/checksession.php";
include "../../configration/config.php";
include "../../functions/db_functions.php";
include "../../functions/questionnaire_functions.php";

try {
$type = $_GET['type'];

if($type == "getTopics") {
	$class_auto_id = $_POST['class1'];
	$res = getTopics4Questionnaire($class_auto_id);
	if(count($res) == 0) {
		echo "<option value=\"\">-No Topics Found-</option>";
	} else {
		echo "<option value=\"\">-Select Topic-</option>";
		foreach($res as $topic) {
			echo "<option value=\"".$topic['id']."\">".$topic['description']."</option>";
		}
	}
} else if ($type == "getQuestionnaire") {
	$course_id = $_POST['topic'];
	$res = getQuestionnaire($course_id);
	if(count($res) == 0) {
		echo "<option value=\"\">-No Scenarios Found-</option>";
	} else {
		echo "<option value=\"\">-Select Scenario-</option>";
		foreach($res as $topic) {
			echo "<option value=\"".$topic['id']."\">".$topic['description']."</option>";
		}
	}
} else if($type == "getQuestionRef") {
	$question_ref = $_POST['questionnaire'];
	$res = getQuestions($question_ref);
	if(count($res) == 0) {
		echo "<option value=\"\">-No Situations Found-</option>";
	} else {
		echo "<option value=\"\">-Select Situation-</option>";
		foreach($res as $topic) {
			echo "<option value=\"".$topic['id']."\">".$topic['description']."</option>";
		}
	}
} else if($type == "getSituationInfo") {
	try {
	$situationid = $_POST['questionno'];
	$res = getSituationInfo($situationid);
	$res['QuestionText'] = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $res['QuestionText']);
	$res['QuestionAudio'] = $res['questionAudio'];
	$res['feedbackImg'] = $res['feedbackImg'];

	// Question Audio
	$qustAudio = '<div class="d-flex align-items-center card-header px-1 bg-warning text-white font-weight-bold h6"><label class="d-flex align-items-center mb-0" for="title">Question Audio</label><input type="file" data-id="'.$res['QuestionId'].'" class="form-control-file qustAudioFile ml-3" id="qustAudioFile'.$res['QuestionId'].'" name="qustAudioFile"></div>';
	if($res['QuestionAudio'] != ''){
		$qustAudio = '
					<div class="d-flex align-items-center card-header px-1 bg-warning text-white font-weight-bold h6">
						<label class="d-flex align-items-center mb-0" for="title">Question Audio</label>
						<input type="file" data-id="'.$res['QuestionId'].'" class="form-control-file qustAudioFile mx-2" id="qustAudioFile'.$res['QuestionId'].'" name="qustAudioFile">
						<audio controls id="qustaudio'.$res['QuestionId'].'">
						  	<source src="../../contents/audio/'.$res['QuestionAudio'].'" type="audio/mpeg">
							Your browser does not support the audio element.
						</audio>
					</div>';
	}
	$res['QuestionAudio'] = $qustAudio;

	// Feedback Image
	$feedImage = '<div class="card">
                <div class="card-header d-flex align-items-center bg-warning text-white font-weight-bold h6">
                  <label class="d-flex align-items-center mb-0" for="title">Feedback Image</label><input type="file" data-id="'.$res['QuestionId'].'" class="form-control-file feedbackImageFile ml-3" id="feedbackImageFile'.$res['QuestionId'].'" name="feedbackImageFile">
                </div>
                <div class="card-body d-flex align-items-center justify-content-center" id="feedbackImage'.$res['QuestionId'].'">
                  <img src="../../../img/dummy.png" class="w-100" style="max-width: 200px;">
                </div>
              </div>';
	if($res['feedbackImg'] != ''){
		$feedImage = '
					<div class="card">
		                <div class="card-header d-flex align-items-center bg-warning text-white font-weight-bold h6">
		                  <label class="d-flex align-items-center mb-0" for="title">Feedback Image</label><input type="file" data-id="'.$res['QuestionId'].'" class="form-control-file feedbackImageFile ml-3" id="feedbackImageFile'.$res['QuestionId'].'" name="feedbackImageFile">
		                </div>
		                <div class="card-body d-flex align-items-center justify-content-center" id="feedbackImage'.$res['QuestionId'].'">
		                  <img src="../../contents/images/scenario/'.$res['feedbackImg'].'" class="w-100" style="max-width: 200px;">
		                </div>
		              </div>
					';
	}
	$res['feedbackImg'] = $feedImage;

	$display = "";
	if(isset($res['Options'])) {
		foreach($res['Options'] as $key => $option) {
			if($option['response'])
				$checked = 'checked="checked"';
			else
				$checked = "";

			//select option icon
			$notSelect = '';
			$smileSelect = '';
			$notSmileSelect = '';
			if($option['choosedOptionIcon'] == 'smile')
				$smileSelect = 'selected="selected"';
			else if($option['choosedOptionIcon'] == 'notSmile')
				$notSmileSelect = 'selected="selected"';

			// $display .= "<label class=\"checkbox-inline\"><select name=\"icons[]\" class=\"form-control\"><option value='' $notSelect>-Select Option Icon</option><option $smileSelect value='".$option['id']."-smile'>Smile</option><option $notSmileSelect value='".$option['id']."-notSmile'>Not Smile</option></select><input type=\"checkbox\" name=\"responses[]\" value=\"".$option['id']."\" $checked>&nbsp;&nbsp;<span>".$option['description']."</span></label><br />";

			$display .= "<label class=\"checkbox-inline\"><input type=\"checkbox\" name=\"responses[]\" value=\"".$option['id']."\" $checked>&nbsp;&nbsp;<span>".$option['description']."</span></label><br />";
		}
	}
	$res['Display'] = $display;
	
	$feedback_display = "";
	if(isset($res['Feedback'])) {
		$min = array("A"=>5, "B"=>4, "C"=>3, "D"=>2, "E"=>0);
		$max = array("A"=>5, "B"=>4, "C"=>3, "D"=>2, "E"=>1);
		
		foreach($res['Feedback'] as $fb) {
			$feedAudio = '<input type="file" class="form-control-file feedAudioFile ml-3" id="feedbackAudioFile'.$fb['grade'].'" data-grade="'.$fb['grade'].'" name="feedbackAudioFile" data-id="'.$fb['feedbackId'].'">';
			if($fb['feedbackAudio'] != ''){
				$feedAudio = '
							<div class="d-flex align-items-center ml-3">
								<input type="file" data-grade="'.$fb['grade'].'" class="form-control-file feedAudioFile mr-2"  id="feedbackAudioFile'.$fb['grade'].'" name="feedbackAudioFile" data-id="'.$fb['feedbackId'].'">
								<audio controls id="audio'.$fb['grade'].'">
								  	<source src="../../contents/audio/'.$fb['feedbackAudio'].'" type="audio/mpeg">
									Your browser does not support the audio element.
								</audio>
							</div>';
			}

			$feedback_display .= '<div class="form-group"><label class="d-flex align-items-center" for="title">Grade '.$fb['grade'].':<span class="required_icon" style="color:red;">*</span> '.$feedAudio.'</label><textarea name="grade['.$fb['grade'].']" class="form-control" cols="100" required>'.$fb['description'].'</textarea><input type="hidden" name="minmarks['.$fb['grade'].']" value="'.$min[$fb['grade']].'" /><input type="hidden" name="maxmarks['.$fb['grade'].']" value="'.$max[$fb['grade']].'" /></div>';
		}
	}
	$res['FeedbackDisplay'] = $feedback_display;
	
	echo json_encode($res);
	} catch(Exception $exp) {
		print_r($exp);
	}
} else if($type == "saveCorrectResponses") {
	$response = array();
	$response['status'] = false;
	if(!isset($_POST['responses'], $_POST['class1'], $_POST['questionnaire'], $_POST['topic'], $_POST['questionno'])) {
		$response['Message'] = "All Mandatory fields are not selected";
	} else if($_POST['class1'] == "" || !is_numeric($_POST['class1'])) {
		$response['Message'] = "Invalid Class Value";
	} else if($_POST['topic'] == "" || !is_numeric($_POST['topic'])) {
		$response['Message'] = "Invalid Topic Value";
	} else if($_POST['questionnaire'] == "" || !is_numeric($_POST['questionnaire'])) {
		$response['Message'] = "Invalid Scenario Value";
	} else if($_POST['questionno'] == "" || !is_numeric($_POST['questionno'])) {
		$response['Message'] = "Invalid Situation Value";
	} else if(count($_POST['responses']) != 5) {
		$response['Message'] = "Please select extactly 5 responses";
	} else if(strlen($_POST['grade']['A']) == 0) {
		$response['Message'] = "Please enter feedback text for Grade A";
	} else if(strlen($_POST['grade']['B']) == 0) {
		$response['Message'] = "Please enter feedback text for Grade B";
	} else if(strlen($_POST['grade']['C']) == 0) {
		$response['Message'] = "Please enter feedback text for Grade C";
	} else if(strlen($_POST['grade']['D']) == 0) {
		$response['Message'] = "Please enter feedback text for Grade D";
	} else if(strlen($_POST['grade']['E']) == 0) {
		$response['Message'] = "Please enter feedback text for Grade E";
	} else {
		$qid = $_POST['questionno'];
		$querySch = "SELECT mysql_database FROM skillpre_schools.masters_school WHERE mysql_database = ? OR master_school_dbname = ?";
		$stmtSch = $db->prepare($querySch);
		$stmtSch->execute(array($master_db, $master_db));
		while($rowsSch = $stmtSch->fetch(PDO::FETCH_ASSOC))
		{
			$thisdb = $rowsSch['mysql_database'];
			DeleteRecord("$thisdb.questionnaire_correct_response", array("qid"=>$qid));
			foreach($_POST['responses'] as $answer)
			{
				InsertRecord("$thisdb.questionnaire_correct_response", array("qid"=>$qid, "choice_id"=>$answer));
			}

			//insert option icon
			/*DeleteRecord("$thisdb.questionnaire_option_icon", array("qid"=>$qid));
			foreach($_POST['icons'] as $icon)
			{
				InsertRecord("$thisdb.questionnaire_option_icon", array("qid"=>$qid, "	option_icon"=>$icon));
			}*/
			
			//Update Feedback
			foreach($_POST['grade'] as $thisgrade=>$feedback)
			{
				$record = GetRecord("$thisdb.scenario_feedback", array("situation_id"=>$qid, "grade"=>$thisgrade));
				if(isset($record['id'])) {
					$query = "UPDATE $master_db.scenario_feedback SET feedback = ? WHERE id = ?";
					$stmt = $db->prepare($query);
					$stmt->execute(array($feedback, $record['id']));
				} else {
					InsertRecord("$thisdb.scenario_feedback", array("situation_id"=>$qid, "grade"=>$thisgrade, "min"=>intval($_POST['minmarks'][$thisgrade]), "max"=>intval($_POST['maxmarks'][$thisgrade]), "feedback"=>$feedback));
				}
			}
			
			//Check in Activity Masters
			$am_info = GetRecord("$thisdb.quiz_activities_masters", array("quiz_id"=>$qid, "type"=>"ScenarioC"));
			if(!isset($am_info['id'])) {
				$class1 = intval($_POST['class1']);
				$topic = intval($_POST['topic']);
				$activityname = "Scenario";
				InsertRecord("$thisdb.quiz_activities_masters", array("class"=>$class1, "term"=>"T1", "module"=>"MODULE", "level2"=>"L3", "topic"=>$topic, "activity"=>$activityname, "quiz_id"=>$qid, "type"=>"ScenarioC", "year"=>date("Y"), "visible"=>1));
			}
			
			$response['status'] = true;
			$response['Message'] = "Data updated successfully";
		}
	}
	echo json_encode($response);
}

} catch(Exception $exp){
	print_r($exp);
}
?>