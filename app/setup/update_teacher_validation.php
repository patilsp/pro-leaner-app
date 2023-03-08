<?php
	include_once "../session_token/checksession.php";
  	include_once "../configration/config.php";
  	//include_once "session_token/checktoken.php";
  	require_once "../functions/db_functions.php";
  	$login_userid=$_SESSION['cms_userid'];
	$ctime = date("Y-m-d H:i:s");
	if(isset($_POST['update']))
	{	
		$user_auto_id = getSanitizedData($_POST['user_auto_id']);    
	    $fname 	= getSanitizedData($_POST['fname']);
		$lname 	= getSanitizedData($_POST['lname']);
		$email 	= getSanitizedData($_POST['email']);
		// $role =   getSanitizedData($_POST['role']);
		$username =   getSanitizedData($_POST['username']);
		$phone =   getSanitizedData($_POST['phone']);
		$password =   md5(($_POST['password']));
		// $designation =   getSanitizedData($_POST['designation']);
		// $dept =   getSanitizedData($_POST['dept']);

		$query = "UPDATE users SET first_name = ?, last_name = ?, email=?, username = ?,phone = ? where id = ? ";
		$result=$db->prepare($query);
		$result->execute(array($fname,$lname,$email,$username,$phone,$user_auto_id));

		if ($password != "") {
			$query = "UPDATE users SET password = ? where id = ? ";
			$result=$db->prepare($query);
			$result->execute(array($password,$user_auto_id));
		}

		$classes = [];
		$teacher_id = $user_auto_id;
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

				$query = "DELETE FROM teacher_subject_mapping WHERE user_id = ?";
				$stmt = $db->prepare($query);
				$stmt->execute(array($teacher_id));
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

	    header('Location:teachers.php');
	
	}
	
?>