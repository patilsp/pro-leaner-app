<?php
function getCourse($type) {
	
}

function getSubjects($userClass) {
	global $db;
	$subjects = array();	
	$query = "SELECT id, module FROM cpmodules WHERE parentId = ? AND type = ? AND deleted = ? ORDER BY sequence";
	$stmt = $db->prepare($query);
	$stmt->execute(array($userClass, 'subject', 0));
	while($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$iconColor = '#ffffff';
		$bodyBg = '';
		$subText = '';
		if(strtolower($rows['module']) == 'english') {
			$iconColor = '#5b38ca';
			$bodyBg = '#7c60d5';
			$subText = 'Everything you need to know about the language of global opportunities. ';
		} elseif(strtolower($rows['module']) == 'math') {
			$iconColor = '#cc6b01';
			$bodyBg = '#f56759';
			$subText = 'Where the questions may seem difficult but the answers are always simple.';
		} elseif(strtolower($rows['module']) == 'science') {
			$iconColor = '#1bdf48';
			$bodyBg = '#1bdf48';
			$subText = 'Learning the secrets of life and universe.';
		}

		// $headers = apache_request_headers();
		// $valid_hosts = array("localhost", "skillprep.co", "test.skillprep.co");
		// if($headers['Host'] == "test.skillprep.co" || $headers['Host'] == "skillprep.co" || $headers['Host'] == "prepmyskills.com" || $headers['Host'] == "b2c.skillprep.co") {
		// 	$protocol = "https";
		// } else {
		// 	$protocol = "http";
		// }
		$protocol = "https";
		$subImgSrc = $protocol."://".$_SERVER['HTTP_HOST']."/skills4lifeadmin/apis/app/images/cp/subject/".strtolower($rows['module']).".svg";
					
		$subject = array("subId"=>$rows['id'], "subName"=>$rows['module'], "titleColor"=>"#ffffff", "iconColor"=>$iconColor, "bodyBg"=>$bodyBg, "image"=>$subImgSrc, "subText"=>$subText, "visible"=>true);
					array_push($subjects, $subject);
		}
		$result['subjects'] = $subjects;			
		$status = true;

		return $result;
}