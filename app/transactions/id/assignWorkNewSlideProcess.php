<?php
	include_once "../../session_token/checksession.php";
	include "../../configration/config.php";
	include "../../configration/config_schools.php";
	include "../../functions/db_functions.php";
	require_once "../../functions/common_functions.php";
	$logged_user_id=$_SESSION['cms_userid'];
	try{
		/*print_r($_POST);
		print_r($_FILES);die;*/
		$prev_slide_id = explode(",", $_POST['prev_slide_id']);
		$lesson_prev_slide_id = array();
		$i = 0;
		foreach ($prev_slide_id as $gvalue) {
			$explode_value = explode(":", $gvalue);
			$lesson_prev_slide_id[$i]['lesson_id'] = $explode_value[0];
			$lesson_prev_slide_id[$i]['prev_slide_id'] = $explode_value[1];
			$i++;
		}
		
		$prev_slide_id = json_encode($lesson_prev_slide_id);
		if(count($lesson_prev_slide_id) == 1) {
			if($lesson_prev_slide_id[0]['lesson_id'] == "") {
				$prev_slide_id = NULL;
			}
		}
		if($_POST['lesson_id'] == ""){
			$_POST['lesson_id'] = 0;
		}
		if($_POST['template_id'] == ""){
			$_POST['template_id'] = 0;
		}
		if($_POST['layout_id'] == ""){
			$_POST['layout_id'] = 0;
		}
		$lesson_id = getSanitizedData($_POST['lesson_id']);
		$main_status = getSanitizedData($_POST['main_status']);
		$class_id = getSanitizedData($_POST['slide_classid']);
		$topic_id = getSanitizedData($_POST['slide_topicid']);
		$template_id = getSanitizedData($_POST['template_id']);
		$layout_id = getSanitizedData($_POST['layout_id']);
		$assign_to = $_POST['assign_to'];
		$work_type = $_POST['work_type'];
		foreach ($work_type as $value) {
			if($value != "")
				$work_type = getSanitizedData($value);
		}
		$assign_date = date("Y-m-d H:i:s");

		//$response = array();
		$status = "";
		$message = "";
		if($main_status == 15){
			$role_type = $_POST['role_type'];
			$title = "Add content";
			$inputs = "Add New slides";
			$status_cw = $main_status;
			$user_cw = getSanitizedData($_POST['user_cw']);
			$inst_cw = getSanitizedData($_POST['inst_cw']);

			/*$status_vd = $main_status;
			$user_vd = getSanitizedData($_POST['user_vd']);
			$inst_vd = getSanitizedData($_POST['inst_vd']);
			*/
			$status_gd = $main_status;
			if(isset($user_gd)){
				$user_gd = getSanitizedData($_POST['user_gd']);
				$inst_gd = getSanitizedData($_POST['inst_gd']);

				$status_tt = $main_status;
				$user_tt = getSanitizedData($_POST['user_tt']);
				$inst_tt = getSanitizedData($_POST['inst_tt']);
			}

			//If Content Writer, check id exists in course_folder_name. If not return
			$status = true;
			foreach ($assign_to as $key => $value) {
				if($role_type == "CW") {
					
					$info = GetRecord("course_folder_name", array("course_id"=>$topic_id));
					if(!isset($info['id'])) {
						$status = false;
						$message = "Inform to Tech Team saying '<b>Selected Course is not mapped in CMS</b>'";
					}
				}
			}

			if($status) {
				$autoid_status = InsertRecord("tasks", array("task_name" => $title,
				"inputs" => $inputs,
				"class_id" => $class_id,
				"topics_id" => $topic_id,
				"slide_id" => $prev_slide_id,
				"lesson_id" => $lesson_id,
				"template_id" => $template_id,
				"layout_id" => $layout_id,
				"work_type" => $work_type,
				"status_id" => $main_status,
				"users_id" => $logged_user_id
				));
			
				if($autoid_status > 0) {
					foreach ($assign_to as $key => $value) {
						if($role_type == "CW"){
							$autoid_status1 = InsertRecord("task_assign", array("user_id" => $user_cw,
							"status" => $status_cw,
							"assign_date" =>  $assign_date,
							"tasks_id" => $autoid_status
							));
							if($autoid_status1 > 0) {
								$autoid_status2 = InsertRecord("task_details", array("user_id" => $logged_user_id,
								"instructions" => $inst_cw,
								"attachments" =>  '',
								"task_assign_id" => $autoid_status1,
								"status" => $main_status
								));
								if($autoid_status2 == 0) {
									$status =false;
									$slide = "notok";
									$message ="Not able to insert the task_details";
								}

								//Upload Images
								$dir_path = "taskFiles/$autoid_status/$autoid_status1/$autoid_status2/";
								if(! file_exists($dir_path))
									mkdir($dir_path, 0777, true);
								$uploaded_files = upload_multiple_images("cw_files", $dir_path);
								if(count($uploaded_files) > 0) {
									$data = json_encode($uploaded_files);
									$query = "UPDATE task_details SET attachments = ? WHERE id = ?";
									$stmt = $db->prepare($query);
									$stmt->execute(array($data, $autoid_status2));
								}
							} else {
								$status =false;
								$slide = "notok";
								$message ="Not able to insert the task_assign";
							}
						}
						if($role_type == "VD"){
							$autoid_status1 = InsertRecord("task_assign", array("user_id" => $user_vd,
							"status" => $status_vd,
							"assign_date" =>  $assign_date,
							"tasks_id" => $autoid_status
							));
							if($autoid_status1 > 0) {
								$autoid_status2 = InsertRecord("task_details", array("user_id" => $logged_user_id,
								"instructions" => $inst_vd,
								"attachments" =>  '',
								"task_assign_id" => $autoid_status1,
								"status" => $main_status
								));
								if($autoid_status2 == 0) {
									$status =false;
									$slide = "notok";
									$message ="Not able to insert the task_details";
								}

								//Upload Images
								$dir_path = "taskFiles/$autoid_status/$autoid_status1/$autoid_status2/";
								if(isset($_FILES['vd_files'])){
									if(! file_exists($dir_path))
										mkdir($dir_path, 0777, true);
									$uploaded_files = upload_multiple_images("vd_files", $dir_path);
								}
								if(count($uploaded_files) > 0) {
									$data = json_encode($uploaded_files);
									$query = "UPDATE task_details SET attachments = ? WHERE id = ?";
									$stmt = $db->prepare($query);
									$stmt->execute(array($data, $autoid_status2));
								}
							} else {
								$status =false;
								$slide = "notok";
								$message ="Not able to insert the task_assign";
							}
						}
						if($role_type == "GD"){
							$autoid_status1 = InsertRecord("task_assign", array("user_id" => $user_gd,
							"status" => $status_gd,
							"assign_date" =>  $assign_date,
							"tasks_id" => $autoid_status
							));
							if($autoid_status1 > 0) {
								$autoid_status2 = InsertRecord("task_details", array("user_id" => $logged_user_id,
								"instructions" => $inst_gd,
								"attachments" =>  '',
								"task_assign_id" => $autoid_status1,
								"status" => $main_status
								));
								if($autoid_status2 == 0) {
									$status =false;
									$slide = "notok";
									$message ="Not able to insert the task_details";
								}

								//Upload Images
								$dir_path = "taskFiles/$autoid_status/$autoid_status1/$autoid_status2/";
								if(isset($_FILES['gdfiles'])){
									if(! file_exists($dir_path))
										mkdir($dir_path, 0777, true);
									$uploaded_files = upload_multiple_images("gdfiles", $dir_path);
								}
								if(count($uploaded_files) > 0) {
									$data = json_encode($uploaded_files);
									$query = "UPDATE task_details SET attachments = ? WHERE id = ?";
									$stmt = $db->prepare($query);
									$stmt->execute(array($data, $autoid_status2));
								}
							} else {
								$status =false;
								$slide = "notok";
								$message ="Not able to insert the task_assign";
							}
						}
						if($role_type == "TT"){
							$autoid_status1 = InsertRecord("task_assign", array("user_id" => $user_tt,
							"status" => $status_tt,
							"assign_date" =>  $assign_date,
							"tasks_id" => $autoid_status
							));
							if($autoid_status1 > 0) {
								$autoid_status2 = InsertRecord("task_details", array("user_id" => $logged_user_id,
								"instructions" => $inst_tt,
								"attachments" =>  '',
								"task_assign_id" => $autoid_status1,
								"status" => $main_status
								));
								if($autoid_status2 == 0) {
									$status =false;
									$slide = "notok";
									$message ="Not able to insert the task_details";
								}

								//Upload Images
								$dir_path = "taskFiles/$autoid_status/$autoid_status1/$autoid_status2/";
								$uploaded_files = "";
								if(isset($_FILES['ttfiles'])){
									if(! file_exists($dir_path))
										mkdir($dir_path, 0777, true);
									$uploaded_files = upload_multiple_images("ttfiles", $dir_path);
								}
								if(count($uploaded_files) > 0) {
									$data = json_encode($uploaded_files);
									$query = "UPDATE task_details SET attachments = ? WHERE id = ?";
									$stmt = $db->prepare($query);
									$stmt->execute(array($data, $autoid_status2));
								}
							} else {
								$status =false;
								$slide = "notok";
								$message ="Not able to insert the task_assign";
							}
						}

						//Send Email
						require_once "../../../lib/emailer/class.smtp.php";
						require_once "../../../lib/emailer/class.phpmailer.php";
						
						$Host = $url = "smtp.gmail.com";
						ini_set("SMTP","$url");
						$From = $username = "noreply@prepmyskills.com";
						$FromName = "PrepMySkills - System";
						$password = "Noreply@2017";
						$mail = new PHPMailer();
						$mail->IsSMTP();                    // send via SMTP
						$mail->Host     = $Host; 
						$mail->SMTPAuth = true;             // turn on SMTP authentication
						$mail->Username = $username;  
						$mail->Password = $password; 
						$mail->From     = $From;
						$mail->FromName = $FromName;
						//Get name
						$info = GetRecord("users", array("id"=>$user_cw));
						$toname = $info['first_name']." ".$info['last_name'];
						$topic_info = GetRecord("$master_db.mdl_course", array("id"=>$topic_id));
						$topic_name = $topic_info['fullname'];

						$mainbody = "<b>Dear $toname,</b><br/><br/>";
						$mainbody .= "New Task: Class $class_id, $topic_name has assigned to you";
						$mainbody .= "<br/><br/>Please login to <a href=\"https://".$_SERVER['HTTP_HOST']."/cms/\">Content Management System</a> and complete the task at the earliest";
						$mainbody .= "<br/><br/><b>Note:</b> This is auto generated mail. Please do not reply to this email.";
						$mainbody .= "<br/><br/><br/>";
						$mainbody .= "Thanking you,<br/><b>Prepmyskills Team</b><br/>Bangalore.";
						$mail->AddAddress($info['email'] , $toname);
						$sql1 = "SELECT * FROM masters_cron_email WHERE cronid = 9";
					    $stmt1 = $dbs->query($sql1);
					    while($fetch1 = $stmt1->fetch(PDO::FETCH_ASSOC))
					    {
					        $cron_employee_id = $fetch1['empid'];
					        $mailtype = $fetch1['mailtype'];

					        $sql2 = "SELECT first_name,last_name,email_id FROM prepmyskills_users WHERE id = ?";
					        $stmt2 = $dbs->prepare($sql2);
					        $stmt2->execute(array($cron_employee_id));
					        while($fetch2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
					            $employee_mailid = $fetch2['email_id'];
					        

					            $val = $employee_mailid;
					            $fname = $fetch2['first_name'];
					            $lname = $fetch2['last_name'];
					            $key = $fname." ".$lname;
					        }

					        if($mailtype == 'To'){       
					            $mail->AddAddress($val , $key); 
					        }
					        
					        if($mailtype == 'Cc') {
					            $mail->AddCC($val , $key); 
					        }
					    
					        if($mailtype == 'BCc'){
					            $mail->AddBCC($val , $key); 
					        }
					    }
						$mail->SMTPSecure = 'ssl';
						$mail->Port = '465';
						$mail->SMTPDebug = false;
						$mail->WordWrap = 50; // set word wrap
						$mail->IsHTML(true);  
						$mail->Subject  = "CMS - New Task Assigned";
						$mail->Body     =  $mainbody;
						$result = $mail->Send();

					}

					$autoid_status = InsertRecord("review_status", array("class_id" => $class_id,
					"topic_id" => $topic_id,
					"slide_id" => $prev_slide_id,
					"status" => $main_status,
					"updated_by" => $logged_user_id,
					"updated_on" => $assign_date
					));

					$status =true;
					$slide = "notok";
					$message ="Task has been Created Successfully";
				} else {
					$status =false;
					$slide = "notok";
					$message ="Not able to create the task";
				}
			}
		} else {
			$autoid_status = InsertRecord("review_status", array("class_id" => $class_id,
			"topic_id" => $topic_id,
			"slide_id" => $prev_slide_id,
			"status" => $main_status,
			"updated_by" => $logged_user_id,
			"updated_on" => $assign_date
			));

			$status =true;
			$slide = "ok";
			$message ="Slide Status Updated Successfully";
		}

		$response = array("status"=>$status, "message"=>$message, "slide"=>$slide);
		echo json_encode($response);
	} catch(Exception $exp){
    print_r($exp);
	}
?>