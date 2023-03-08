<?php
include_once "../../session_token/checksession.php";
include "../../configration/config.php";
include "../../functions/db_functions.php";
include "../../functions/questionnaire_functions.php";

try {
	/*echo "<pre/>";
	print_r($_FILES);

	print_r($_REQUEST['feedbackId']);die;*/
	//echo $_REQUEST['type'];die;

	$folderName = $_REQUEST['folderName'];
	if($_FILES['file']['name'] != ''){
		$test = explode('.', $_FILES['file']['name']);
		$extension = end($test);
		if($_REQUEST['type'] != 'saveQuestionFeedbackImage') {
			if($_REQUEST['type'] == 'saveQuestionAudio') {    
		    	$name = rand(100,999).'qust.'.$extension;
	    	} else {
	    		$name = rand(100,999).'feed.'.$extension;
	    	}
    	} else {
    		$name = rand(100,999).'dbsce.'.$extension;
    	}
		
		if($_REQUEST['type'] != 'saveQuestionFeedbackImage') {
			$cms_path = $dir_root."app/contents/audio/".$folderName;
			$s4l_path = $dir_root_production."contents/audio/".$folderName;
		} else {
			$cms_path = $dir_root."app/contents/images/scenario/".$folderName;
			$s4l_path = $dir_root_production."contents/images/scenario/".$folderName;
		}

		if(! file_exists($cms_path)) {
			mkdir($cms_path, 0777, true);
		}
		move_uploaded_file($_FILES['file']['tmp_name'], $cms_path.'/'.$name);

		if(! file_exists($s4l_path)) {
			mkdir($s4l_path, 0777, true);
		}

		$sourcePath = $cms_path.'/'.$name;
		$destPath = $s4l_path.'/';
		copy($sourcePath, $destPath.'/'.$name);
	}

	if($_REQUEST['type'] != 'saveQuestionFeedbackImage') {
		if($_REQUEST['type'] == 'saveQuestionAudio') {
			$qustId = $_REQUEST['qustId'];

			$tableName = 'questionnaire_intro_audio';
			$audioSRC = $folderName.'/'.$name;
			$data = GetRecord($master_db.'.'.$tableName, array("qId"=>$qustId));
			if(isset($data['id'])) {
				$file = $data['audioSrc'];
				if($file != ''){
					unlink($dir_root."app/contents/audio/".$file);
					unlink($dir_root_production."contents/audio/".$file);
				}

				$query = "UPDATE $master_db.questionnaire_intro_audio SET audioSrc = ? WHERE qId = ?";
				$stmt = $db->prepare($query);
				$stmt->execute(array($audioSRC, $qustId));
			} else {
				$autoid = InsertRecord($master_db.'.'.$tableName, array("qId" => $qustId,
					"audioSrc" => $audioSRC
				));
			}		
		} else {
			$feedbackId = $_REQUEST['feedbackId'];
			$tableName = 'scenario_feedback';
			$data = GetRecord($master_db.'.'.$tableName, array("id"=>$feedbackId));
			$file = $data['audioSrc'];
			if($file != ''){
				unlink($dir_root."app/contents/audio/".$file);
				unlink($dir_root_production."contents/audio/".$file);
			}

			$audioSRC = $folderName.'/'.$name;
			$query = "UPDATE $master_db.scenario_feedback SET audioSrc = ? WHERE id = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($audioSRC, $feedbackId));
		}
	} else {
		$qustId = $_REQUEST['qustId'];

		$tableName = 'questionnaire_intro_audio';
		$imgSRC = $folderName.'/'.$name;
		$data = GetRecord($master_db.'.'.$tableName, array("qId"=>$qustId));
		if(isset($data['id'])) {
			$file = $data['feedbackImg'];
			if($file != ''){
				unlink($dir_root."app/contents/images/scenario/".$file);
				unlink($dir_root_production."contents/images/scenario/".$file);
			}

			$query = "UPDATE $master_db.questionnaire_intro_audio SET feedbackImg = ? WHERE qId = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($imgSRC, $qustId));
		} else {
			$autoid = InsertRecord($master_db.'.'.$tableName, array("qId" => $qustId,
				"audioSrc" => $imgSRC
			));
		}
	}

	if($_REQUEST['type'] != 'saveQuestionFeedbackImage') {
		echo "../../contents/audio/".$folderName.'/'.$name;
	} else {
		echo "../../contents/images/scenario/".$folderName.'/'.$name;
	}

} catch(Exception $exp){
	print_r($exp);
}
?>