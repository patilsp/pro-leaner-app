<?php
	include_once "../../session_token/checksession.php";
	include "../../configration/config.php";
	include "../../functions/db_functions.php";
	require_once "../../functions/common_functions.php";
	
	try{
		$logged_user_id=$_SESSION['cms_userid'];
		$assign_date = date("Y-m-d H:i:s");

		$response = array();
		$status = "";
		$message = "";
		$query = "SELECT * FROM tasks";
  		$stmt_tk = $db->query($query);
  		$rowcount = $stmt_tk->rowCount();
  		while($fetch = $stmt_tk->fetch(PDO::FETCH_ASSOC)){
  			$up_status_cw = 13;
  			$tasks_id = $fetch['id'];
  			$up_inst_cw = "";
  			$slide_id = $fetch['slide_id'];
  			$topic_id = $fetch['topics_id'];
  			$class_id = $fetch['class_id'];

  			$query1 = "SELECT id FROM task_assign WHERE tasks_id = ? AND status NOT IN (5,13) ORDER BY id DESC LIMIT 1";
	  		$stmt1 = $db->prepare($query1);
	  		$stmt1->execute(array($tasks_id));
	  		$rowcount = $stmt1->rowCount();
	  		if($rowcount == 0) {
	  			continue;
	  		}
	  		while($fetch1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
	  			$task_assi_id = $fetch1['id'];
  			}

  			$query = "UPDATE task_assign SET status = ? WHERE tasks_id = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($up_status_cw, $tasks_id));

			$autoid_status2 = InsertRecord("task_details", array("user_id" => $logged_user_id,
			"instructions" => $up_inst_cw,
			"attachments" =>  '',
			"task_assign_id" => $task_assi_id,
			"status" => $up_status_cw
			));

		
		
			$query = "UPDATE $master_db.mdl_lesson_pages SET status = ? WHERE id = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($up_status_cw, $slide_id));

			$autoid_status = InsertRecord("review_status", array("class_id" => $class_id,
			"topic_id" => $topic_id,
			"slide_id" => $slide_id,
			"status" => $up_status_cw,
			"updated_by" => $logged_user_id,
			"updated_on" => $assign_date
			));

			if ($up_status_cw == 13) {
				$records = GetRecords("$master_db.mdl_lesson_pages", array("id"=>$slide_id));
				if (count($records) != 0) {
					foreach($records as $record)
			      	{
				        $slide_path = DecryptContent($record['contents']);
			        }
				}
				/** Start Function copying all images from source to destination **/
				$source = pathinfo($slide_path);
				$source = $dir_root."app/".$source['dirname']."/images";
				$dest = pathinfo($slide_path);
				$dest = $dir_root_production.$dest['dirname']."/images";
				$copy_folder = cpy($source, $dest);
				/** End Function copying all images from source to destination **/

				$data = file_get_contents($web_root."app/".$slide_path);
				$data = str_replace($web_root."app/contents/assets", "../../../../assets", $data);
				$info = pathinfo($slide_path);
				$dir_path = $info['dirname'];
			  	$data = str_replace($web_root."app/".$dir_path."/", "", $data);
			  	file_put_contents($dir_root_production.$slide_path, $data);
			}
		}//end of task while loop

		$status =true;
		$message ="Slide Published Successfully";

		$response = array("status"=>$status, "message"=>$message);
		echo json_encode($response);
	} catch(Exception $exp){
		echo "<pre/>";
    	print_r($exp);
	}
?>