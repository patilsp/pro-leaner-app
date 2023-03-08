<?php
	session_start();
	// include_once "../../../session_token/checksession.php";
	include "../../configration/config.php";
	include "../../configration/config_schools.php";
	include "../../functions/db_functions.php";
	require_once "../../functions/common_functions.php";
	$logged_user_id=$_SESSION['cms_userid'];
	try{
		/*print_r($_POST);
		print_r($_FILES);die;*/
		
		$main_status = getSanitizedData($_POST['main_status']);
		$class_id = getSanitizedData($_POST['classId']);
		$subject_id = getSanitizedData($_POST['subId']);
		$assign_to = $_POST['assign_to'];
		$assign_date = date("Y-m-d H:i:s");

		//$response = array();
		$status = "";
		$message = "";
		if($main_status == 15){
			$role_type = 'CW';
			$title = "Add content";
			$inputs = "Add New slides";
			$status_cw = $main_status;
			$user_cw = getSanitizedData($_POST['user_cw']);
			$inst_cw = getSanitizedData($_POST['inst_cw']);

			if(true) {
				$autoid_status = InsertRecord("cptasks", array("task_name" => $title,
				"inputs" => $inputs,
				"class_id" => $class_id,
				"subject_id" => $subject_id,
				"status_id" => $main_status,
				"users_id" => $logged_user_id
				));
			
				if($autoid_status > 0) {
					foreach ($assign_to as $key => $value) {
						if($role_type == "CW"){
							$autoid_status1 = InsertRecord("cptask_assign", array("user_id" => $user_cw,
							"status" => $status_cw,
							"assign_date" =>  $assign_date,
							"tasks_id" => $autoid_status
							));
							if($autoid_status1 > 0) {
								$autoid_status2 = InsertRecord("cptask_details", array("user_id" => $logged_user_id,
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
									$query = "UPDATE cptask_details SET attachments = ? WHERE id = ?";
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
						$password = "hajztywlrouqquzo";
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
						$subject_info = GetRecord("cpmodules", array("id"=>$subject_id));
						$subject_name = $subject_info['module'];
						$class_info = GetRecord("cpmodules", array("id"=>$class_id));
						$class_name = $class_info['module'];

						$mainbody = "<b>Dear $toname,</b><br/><br/>";
						$mainbody .= "New Task: $class_name, $subject_name has assigned to you";
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

					$status =true;
					$slide = "notok";
					$message ="Task has been Created Successfully";
				} else {
					$status =false;
					$slide = "notok";
					$message ="Not able to create the task";
				}
			}
		}

		$response = array("status"=>$status, "message"=>$message, "slide"=>$slide);
		echo json_encode($response);
	} catch(Exception $exp){
    print_r($exp);
	}
?>