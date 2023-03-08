<?php 
  session_start();
  include_once $_SESSION['dir_root']."app/session_token/checksession.php";
  include $_SESSION['dir_root']."app/configration/config.php";
  include $_SESSION['dir_root']."app/functions/db_functions.php";
  try {
  $type = $_POST['type'];
  if($type == "getMoveSlideRef") {
  	$class_id = intval($_POST['class']);
  	$topic_id = intval($_POST['topic_id']);
  	$slide_id = intval($_POST['slide_id']);

  	global $master_db;
  	$cs_records = GetRecords("$master_db.mdl_course_sections", array("course"=>$topic_id));
  	foreach($cs_records as $cs_record) {
  		if(strlen($cs_record['sequence']) > 0) {
  			$data = $cs_record['sequence'];
  			$ids = explode(",", $data);
  			foreach($ids as $id) {
  				$cm_record = GetRecord("$master_db.mdl_course_modules", array("id"=>$id, "module"=>13, "visible"=>1));
  				if(isset($cm_record['id'])) {
  					//Belongs to Lesson
  					$lesson_id = $cm_record['instance'];
  					$lesson_info = GetRecord("$master_db.mdl_lesson", array("id"=>$lesson_id));
  					if(isset($lesson_info['id'])) {
  						$options[$lesson_info['name']] = array();
  						$options[$lesson_info['name']][] = array("value"=>$lesson_id."@0", "text"=>"Move to First");
  						$lesson_info['id'];
  						$added_slides = GetRecords("add_slide_list", array("class"=>$class_id, "topic_id"=>$topic_id, "lesson_id"=>$lesson_info['id']), array("sequence"));
  						foreach($added_slides as $added_slide) {
  							$options[$lesson_info['name']][] = array("value"=>$lesson_id."@".$added_slide['sequence'], "text"=>"Move after ".$added_slide['slide_title']);
  						}
  					}
  				}
  			}
  		}
  	}
  	echo "<option value=\"\">-Select-</option>";
  	foreach($options as $name=>$temp1) {
  		echo "<optgroup label=\"".$name."\">";
  		foreach($temp1 as $temp2) {
  			echo "<option value=\"".$temp2['value']."\">".$temp2['text']."</option>";
  		}
  		echo "</optgroup>";
  	}
  } else if($type == "MoveSlide") {
  	$class_id = intval($_POST['class']);
  	$topic_id = intval($_POST['topic_id']);
  	$for_move_slide_id = intval($_POST['for_move_slide_id']);
  	$dest = explode("@",$_POST['dest_ref']);
  	$dest_lessonid = intval($dest[0]);
  	$dest_seq = intval($dest[1]);
  	if($dest_seq == 0) {
  		$query = "UPDATE add_slide_list SET sequence = sequence + 1 WHERE lesson_id = ?";
  		$stmt = $db->prepare($query);
  		$stmt->execute(array($dest_lessonid));

		$query = "UPDATE add_slide_list SET sequence = 1, lesson_id = ? WHERE id = ?";
  		$stmt = $db->prepare($query);
  		$stmt->execute(array($dest_lessonid, $for_move_slide_id));  		
  	} else if($dest_seq > 0) {
  		$query = "UPDATE add_slide_list SET sequence = sequence + 1 WHERE lesson_id = ? AND sequence > ?";
  		$stmt = $db->prepare($query);
  		$stmt->execute(array($dest_lessonid, $dest_seq));

		$query = "UPDATE add_slide_list SET sequence = ?, lesson_id = ? WHERE id = ?";
  		$stmt = $db->prepare($query);
  		$stmt->execute(array($dest_seq+1, $dest_lessonid, $for_move_slide_id));
  	}
  }
  } catch(Exception $exp) {
  	print_r($exp);
  }