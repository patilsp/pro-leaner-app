<?php
include "../../../session_token/checksession.php";
include "../../../configration/config.php";
include "../../../configration/config_schools.php";
include "../../../functions/common_functions.php";

$type = $_GET['type'];
try {
if($type == "getUniqueTopics") {
	$allTopics = array();
	$type = $_POST['type'];
	$existing_badge_topics = array();
	$query = "SELECT courseid FROM badge_master";
	$stmt = $dbs->query($query);
	while($rows1 = $stmt->fetch(PDO::FETCH_ASSOC)) {
		array_push($existing_badge_topics, $rows1['courseid']);
	}

	for($class = 1; $class < 11; $class++) {
		$topics = getTopics($class);
		foreach ($topics as $key => $value) {
			$topics[$key]['class'] = $class;
			if(in_array($value['id'], $existing_badge_topics)) {
				$topics[$key]['badgeStatus'] = 1;
			} else {
				$topics[$key]['badgeStatus'] = 0;
			}
		}
		if(count($allTopics) == 0) {
			$allTopics = $topics;
		} else {
			$allTopics = array_merge($allTopics, $topics);
		}

	}
	$groupByTopics = array();
	foreach ($allTopics as $key => $value) {
		$topic_name = $value['description'];
		if($type == "New" && !$value['badgeStatus'])
			$groupByTopics[$topic_name][] = $value['class']."|".$value['id']."|".$value['badgeStatus']."|".$topic_name;
		else if($type == "Update" && $value['badgeStatus'])
			$groupByTopics[$topic_name][] = $value['class']."|".$value['id']."|".$value['badgeStatus']."|".$topic_name;
	}
	$options = array();
	foreach ($groupByTopics as $key => $value) {
		$options[$key] = implode('@', $groupByTopics[$key]);
	}
	if(count($options) == 0) {
		echo '<option value="">-No Topics-</option>';
	} else {
		echo '<option value="">-Select Topic-</option>';
		ksort($options);
		foreach ($options as $key => $value) {
			echo '<option value="'.$value.'">'.$key.'</option>';
		}
	}
} else if($type == "save") {
	if(isset($_POST['type'], $_POST['topic'], $_POST['classes'], $_FILES['badge-color-png'], $_FILES['badge-color-svg'], $_FILES['badge-black-png'], $_FILES['badge-black-svg'])) {
		$queryInsert = "INSERT INTO badge_master (class, courseid, coursename, icon_active_png, icon_active_svg, icon_inactive_png, icon_inactive_svg, updated_on, updated_by) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), ?)";
		$stmtInsert = $dbs->prepare($queryInsert);

		$queryUpdate = "UPDATE badge_master SET coursename = ?, icon_active_png = ?, icon_active_svg = ?, icon_inactive_png = ?, icon_inactive_svg = ?, updated_on = NOW(), updated_by = ? WHERE courseid = ?";
		$stmtUpdate = $dbs->prepare($queryUpdate);
		foreach ($_POST['classes'] as $key => $value) {
			$temp = explode("|", $value);
			$class = $temp[0];
			$topicid = $temp[1];
			$status = $temp[2];
			$topicname = $temp[3];
			//upload Images
			$uploadPath1 = $dir_root_production."../skills4lifeionic/";
			$uploadPath2 = $dir_root_production."../skills4life1920/";
			$uploadPath3 = $dir_root_production."../skills4life/";
			if(file_exists($uploadPath1)) {
				$subPath = "src/assets/images/badge_icons";
				$uploadPath = $uploadPath1.$subPath;
			} else if(file_exists($uploadPath2)) {
				$subPath = "assets/images/badge_icons";
				$uploadPath = $uploadPath2.$subPath;
			} else if(file_exists($uploadPath3)) {
				$subPath = "assets/images/badge_icons";
				$uploadPath = $uploadPath3.$subPath;
			}

			$files = array("activepng"=>"badge-color-png","activesvg"=>"badge-color-svg", "inactivepng"=>"badge-black-png","inactivesvg"=>"badge-black-svg");
			$files_paths = array();
			foreach ($files as $key => $value) {
				if($_FILES[$value]['name']) {
					$filename = $_FILES[$value]["name"];
					$source = $_FILES[$value]["tmp_name"];
					$type = $_FILES[$value]["type"];
					$name = explode(".", $filename);
					$target = $uploadPath."/$key/".$filename;
					$files_paths[$key] = $subPath."/$key/".$filename;
					if(! file_exists($uploadPath."/$key")) {
						mkdir($uploadPath."/$key", 0777, true);
					}
					move_uploaded_file($source, $target);
				}
			}

			if($status) {
				//Update
				$stmtUpdate->execute(array($topicname, $files_paths['activepng'], $files_paths['activesvg'], $files_paths['inactivepng'], $files_paths['inactivesvg'], $_SESSION['cms_userid'], $topicid));
			} else {
				//Insert
				$stmtInsert->execute(array($class, $topicid, $topicname, $files_paths['activepng'], $files_paths['activesvg'], $files_paths['inactivepng'], $files_paths['inactivesvg'], $_SESSION['cms_userid']));

			}
		}
		echo json_encode(array("status"=>true, "Message"=>"Badge Icons uploaded successfully"));
	} else {
		echo json_encode(array("status"=>false, "Message"=>"All Mandatory Fields are not filled"));
	}
}
} catch(Exception $exp) {
	print_r($exp);
}
?>