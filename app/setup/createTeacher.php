<?php
	include_once "../session_token/checksession.php";
  	include_once "../configration/config.php";
  	//include_once "session_token/checktoken.php";
  	require_once "../functions/db_functions.php";
	try{
		$login_userid=$_SESSION['cms_userid'];
		$ctime = date("Y-m-d H:i:s");
		$fname 	= getSanitizedData($_POST['fname']);
		$lname 	= getSanitizedData($_POST['lname']);
		$email 	= getSanitizedData($_POST['email']);
		// $role =   getSanitizedData($_POST['role']);
		$cpassword =   getSanitizedData($_POST['cpassword']);
		// $username =   getSanitizedData($_POST['username']);
		$phone =   getSanitizedData($_POST['phone']);
		// $designation =   getSanitizedData($_POST['designation']);
		// $dept =   getSanitizedData($_POST['dept']);
		$date_created = date("Y-m-d H:i:s");

		$autoid_status = InsertRecord("users", array("first_name" => $fname,
		"last_name" => $lname,
		"password" => md5($cpassword),
		"email" => $email,
		"date_created" => $date_created,
		"roles_id" => 9,
		// "username" => $username,
		"phone" => $phone,
		// "designation" => $designation,
		// "dept" => $dept,
		));
		$classes = [];
		$teacher_id = $autoid_status;
		$section 	= $_POST['section'];
		$class 		= $_POST['class'];
		$subject 	= $_POST['subject'];
		// $table_id 	= $_POST['tableid'];

		// $class 		= explode(',',$class);
		// $section 	= explode(',',$section);
		// $subject 	= explode(',',$subject);
		// $table_id 	= explode(',',$table_id);

		$checkclass = in_array("", $class);
		$checksection = in_array("", $section);
		$checksubject = in_array("", $subject);

			if($checkclass != 1 && $checksection != 1 && $checksubject != 1){
				for ($i=0; $i < sizeof($class); $i++) { 
					$cls = explode('-',$class[$i]);
					$classes[] = $cls[0];
				}

				// $query = "DELETE FROM teacher_subject_mapping WHERE user_id = ?";
				// $stmt = $db->prepare($query);
				// $stmt->execute(array($teacher_id));
				for ($i=0; $i < sizeof($class); $i++) {
					$sub_id = InsertRecord("teacher_subject_mapping", array("user_id"=>$teacher_id, "class"=>$classes[$i], "section"=>$section[$i], "courseid"=>$subject[$i],'updated_by'=>$login_userid,"updated_on"=>$ctime));
				}
				$status = true;
				$message = "Teacher Subjects Mapping data updated Successfully";
				$snackbar = true;
				
			}else{
				$status = false;
				$message = "Mandatory Fields Required";
			}

		if($autoid_status > 0)
			header('Location:teachers.php');
		else
			header('Location:teachers.php');
	} catch(Exception $exp){
		print_r($exp);
	}
?>