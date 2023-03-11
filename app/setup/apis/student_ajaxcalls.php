<?php session_start();
  include "../../configration/config.php";
  require_once "../../functions/db_functions.php";
  require_once "../../functions/common_functions.php";
  require_once "../../functions/students.php";

  $type = $_POST['type'];
  $output = array();
  $output['status'] = false;
  $output['message'] = "";
  $status = false;
  $message = "";
  $snackbar = false;
  $login_userid = $_SESSION['ilp_loginid'];
if($type == "getSections") {
	if(isset($_POST['class'])) {
		$options = "";
		$thisClass = intval($_POST['class']);
		$records = GetRecords("masters_sections", array("class"=>$thisClass), array("sequence"));
		if(count($records) == 0) {
			$options .= '<option value="">Sections are not added</option>';
		} else if(count($records) == 1) {
			$options .= '<option value="'.$records[0]['section'].'">'.$records[0]['section'].'</option>';
		} else if(count($records) > 1) {
			$options .= '<option value="">-Select Section-</option>';
			foreach($records as $record) {
				$options .= '<option value="'.$record['section'].'">'.$record['section'].'</option>';
			}
		}
		$status = true;
		$output['Options'] = $options;
	} else {
		$message = "Mandatory Fields are not sent";
	}
} else if($type == "getClasses") {
	$options = "";
	$records = GetRecords("master_class", array("visibility"=>1), array("code"));
	/*echo "<pre/>";
	print_r($records);*/
	if(count($records) == 0) {
		$options .= '<option value="">Classes are not added</option>';
	} else if(count($records) == 1) {
		$options .= '<option value="'.$records[0]['code'].'">'.$records[0]['code'].'</option>';
	} else if(count($records) > 1) {
		$options .= '<option value="">-Select Class-</option>';
		foreach($records as $record) {
			$options .= '<option value="'.$record['code'].'">'.$record['code'].'</option>';
		}
	}
	$status = true;
	$output['Options'] = $options;
} else if($type == "addStudent") {
	if(isset($_POST['autoid'], $_POST['username'], $_POST['firstname'], $_POST['lastname'], $_POST['class'], $_POST['section'])) {

	} else {
		$message = "Mandatory Fields are not sent";
	}
} else if($type == "updateStudenData") {
	$autoid = intval($_POST['autoid']);
	if($autoid == 0) {
		//Insert
		$username = trim(strtolower($_POST['username']));
		$check = GetRecord("mdl_user", array("username"=>$username));
		if($check) {
			if($check['deleted']) {
				$message = "Admission number exists and identified as Deleted";
			} else {
				$message = "Admission No. exists for the Student - ".$check['firstname']." ".$check['lastname'];
			}
		} else {
			//Ready to insert
			$userInfo = array();
			$userInfo['username']  = $username;
			$userInfo['password'] = md5($username);
			$userInfo['idnumber'] = $username;
			$userInfo['email'] = $username."@gmail.com";
			$userInfo['firstname'] = trim($_POST['firstname']);
			$lastname = trim($_POST['lastname']);
			if($lastname == "") {
				$lastname = " ";
			}
			$userInfo['lastname'] = $lastname;
			$userInfo['Class'] = intval($_POST['class']);
			$userInfo['Section'] = $_POST['section'];
			$userInfo['level'] = 0;
			$autoid = CreateUser($userInfo);
			$status = true;
			$message = "Student data added successfully";
		}
	} else {
		//Update
		$userInfo = array();
		$userInfo['firstname'] = $stuFName = trim($_POST['firstname']);
		$stuLName = trim($_POST['lastname']);
		$userInfo['lastname'] = $lastname;
		$userInfo['Class'] = $stuClass = intval($_POST['class']);
		$userInfo['Section'] = $stuSection = $_POST['section'];
		$stuID = $_POST['autoid'];
		$stuAdmissionNo = trim($_POST['username']);

		if($stuLName == "") {
			$stuLName = " ";
		}

		//Check Admission number duplication
		$record = GetQueryRecords("SELECT * FROM mdl_user WHERE id != ? AND (username = ? OR idnumber = ?)", array($stuID, $stuAdmissionNo, $stuAdmissionNo));
		if(count($record) > 0) {
			$status = false;
			$message = "Admission Number already exists for the Student: ".$record[0]['firstname']." ".$record[0]['lastname'];
		} else if(strlen($stuAdmissionNo) == 0) {
			$status = false;
			$message = "Admission Number is mandatory";
		} else if(strlen($stuFName) == 0) {
			$status = false;
			$message = "First Name is mandatory";
		} else if(strlen($stuClass) == 0) {
			$status = false;
			$message = "Class is mandatory";
		} else if(strlen($stuSection) == 0) {
			$status = false;
			$message = "Section is mandatory";
		} else {
			$query = "UPDATE mdl_user SET username = ?, firstname = ?, lastname = ?, idnumber = ? WHERE id = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($stuAdmissionNo, $stuFName, $stuLName, $stuAdmissionNo, $stuID));
			
			//Update Class
			$query = "SELECT * FROM mdl_user_info_data WHERE userid = ? AND fieldid = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($stuID, "2"));
			if($stmt->rowCount())
			{
				$query = "UPDATE mdl_user_info_data SET data = ? WHERE userid = ? AND fieldid = ?";
				$stmt = $db->prepare($query);
				$stmt->execute(array($stuClass, $stuID, "1"));
			}
			else
			{
				$query = "INSERT INTO mdl_user_info_data (id, userid, fieldid, data, dataformat) VALUES (NULL, ?, ?, ?, ?)";
				$stmt = $db->prepare($query);
				$stmt->execute(array($stuClass, "1", $section, "0"));
			}
			
			//Update Section
			$query = "SELECT * FROM mdl_user_info_data WHERE userid = ? AND fieldid = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($stuID, "2"));
			if($stmt->rowCount())
			{
				$query = "UPDATE mdl_user_info_data SET data = ? WHERE userid = ? AND fieldid = ?";
				$stmt = $db->prepare($query);
				$stmt->execute(array($stuSection, $stuID, "2"));
			}
			//Insert into LOG
			$info = $stuID."|".$stuAdmissionNo."|".$stuFName."|".$stuLName."|".$stuClass."|".$stuSection;
			InsertRecord("mdl_log", array("time"=>time(), "userid"=>$login_userid, "ip"=>$_SERVER['REMOTE_ADDR'], "course"=>1, "module"=>"user", "cmid"=>0, "action"=>"update", "info"=>$info));
			
			$status = true;
			$message = "Student data updated successfully";
		}
	}
} else if($type == "getStudentsListDataTable") {
	$records = getStudentList();
	$studentData  = array();
	$i  = 0;
	foreach($records as $row) {
		$token = "";
		$thisData = array();
		$thisData['SNo'] = ++$i;
		$thisData['stuName'] = ($row['firstname']." ".$row['lastname']);
		$thisData['stuFName'] = ($row['firstname']);
		$thisData['stuLName'] = ($row['lastname']);
		$thisData['stuAdmissionNo'] = ($row['idnumber']);
		$thisData['stuClass'] = ($row['Class']);
		$thisData['stuSection'] = ($row['Section']);
		$thisData['stuDOB'] = "";
		$thisData['stuMN'] = "";
		$thisData['stuID'] = $row['id'];
		/*
		
		*/
		$thisData['Action'] = "";
		if(checkModuleActionAccess(13, 5)) {
			$thisData['Action'] .= '<button type="button" class="btn btn-md btn-info btn3d editUser" title="Edit Student" data-toggle="modal" data-target="#student_modal" data-id="'.$row['id'].'"><i class="fa fa-edit"></i></button>';
			$thisData['Action'] .= '&nbsp;&nbsp;<button type="button" class="delete btn btn-md btn-warning btn3d resetPassword" title="Reset Password" data-toggle="modal" data-target="#reset-password" data-id="'.$row['id'].'"><i class="fa fa-lock"></i></button>';
		}
		if(checkModuleActionAccess(13, 3)) {
			$thisData['Action'] .= '&nbsp;&nbsp;<button type="button" class="delete btn btn-md btn-danger btn3d deleteStudent" title="Delete Student" data-href="delete_student.php?id='.$row['id'].'&xy='.$token.'" data-toggle="modal" data-target="#confirm-delete" data-username="'.$thisData['stuName'].'" data-id="'.$row['id'].'"><i class="fa fa-close"></i></button>';
		}
		array_push($studentData, $thisData);
	}
	$status = true;
	$output['List'] = $studentData;
} else if($type == "validateExcel") {
	include '../../../assets/lib/Excel/Classes/PHPExcel/IOFactory.php';
	$filetmp1 = $_FILES["file"]["tmp_name"];
	$filename1 = $_FILES["file"]["name"];
	$filetype1 = $_FILES["file"]["type"];
	//Using this function, find the image extension
	$ext = pathinfo($filename1, PATHINFO_EXTENSION);
	
	$fh = fopen ($filetmp1, "rb");
	$data = fread ($fh, 16);
	$header = unpack ("C1highbit/"."A3signature/"."C2lineendings/"."C1eof/"."C1eol", $data);
	$hexa_check = bin2hex($header['signature']);

	move_uploaded_file($_FILES["file"]["tmp_name"],$_FILES["file"]["name"] );
	$inputFileName = $_FILES["file"]["name"];  
	//  Read your Excel workbook
	try {
		$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load($inputFileName);
	} catch (Exception $e) {
		die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
	}
	
	$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
	$array_data = array();
	foreach ($rowIterator as $row) {
		$cellIterator = $row->getCellIterator();
		$cellIterator->setIterateOnlyExistingCells(false);
		$rowIndex = $row->getRowIndex();
		//$array_data[$rowIndex] = array('A' => '', 'B' => '', 'C' => '', 'D' => '', 'E' => '', 'F' => '', 'G' => '');
	
		foreach ($cellIterator as $cell) {
			if($cell->getCalculatedValue() != "")
				$array_data[$rowIndex][$cell->getColumn()] = trim(preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $cell->getCalculatedValue()));
		}
	}
	unlink($inputFileName);
	//Fetch all the usernames
	$existing_usernames = array();
	$query = "SELECT username FROM mdl_user";
	$result=$db->query($query);
	while($rows = $result->fetch(PDO::FETCH_ASSOC))
		$existing_usernames[] = strtolower($rows['username']);
	$submit = 1;
	$no_of_errors = 0;
    $prod = $array_data;
    $tbody = "";
	$excel_usernames = array();
	for($i = 2; $i <= count($prod) && count($prod) < 1002; $i++)
	{
		$error = "";
		$classcode = "";
		//Validate all the fields
		if(!isset($prod[$i]['E']))
			$prod[$i]['E'] = "";
		if(!isset($prod[$i]['D']))
			$prod[$i]['D'] = "";
		if(!isset($prod[$i]['C']))
			$prod[$i]['C'] = "";
		if(!isset($prod[$i]['B']))
			$prod[$i]['B'] = "";
		if(!isset($prod[$i]['A']))
			$prod[$i]['A'] = "";
			 
		if($prod[$i]['E'] == "")
		 $error = "Please enter Section";
		if($prod[$i]['D'] == "")
		 $error = "Please enter Class";
		//Get the list of classes
		$thisclass = $prod[$i]['D'];
		$stmt3 = $db->prepare("SELECT code , description , roman FROM master_class WHERE visibility = 1 AND ( code = ?  OR description = ?  OR roman = ?  )");
		$stmt3->execute(array($thisclass,$thisclass,$thisclass));                                                      
		if($rows = $stmt3->fetch(PDO::FETCH_ASSOC))
		{
			$classcode = $rows['code'];
			$classdesc = $rows['description'];
		}
		else
		{
		   $error = "Invalid Class entered. Ex: For Class 10, it should be 10 (or) Ten (or) X";
		}
		$student_section = "";
		if($classcode != "") {
			//Validate Section is created or not
			$student_section = $prod[$i]['E'];
			$record = GetRecord("masters_sections", array("class"=>$classcode, "section"=>$student_section));
			if(! isset($record['id']))
				$error = "Section is not created for the Class: $classcode";
			else {
				$student_section = $record['section'];
			}
		}
		if($prod[$i]['C'] == "")
			$prod[$i]['C'] = " ";

		if($prod[$i]['B'] == "")
			$error = "Please enter First Name";
		
		if(preg_match('/[^a-zA-Z.@_\-0-9\/]/i', $prod[$i]['A']))
		  $error = "Admission No.: Value: ".$prod[$i]['A']." - contains some invalid characters.";
		if(in_array(strtolower($prod[$i]['A']),$existing_usernames))
			$error = "Admission No: ".$prod[$i]['A']." exists in database.";
		if(in_array(strtolower($prod[$i]['A']),$excel_usernames))
			$error = "Admission No: ".$prod[$i]['A']." duplicated in the excel sheet.";
		if($prod[$i]['A'] == "")
			$error = "Please enter Admission No.";

		$excel_usernames[] = strtolower($prod[$i]['A']);
		$tbody .= '<tr class="row"><td class="col-1 text-center">'.$i.'</td>';
		if($error != "")
		{
			$submit = 0;
			$no_of_errors++;
			$tbody .= '<td class="col-1"><input type="text" value="'.$prod[$i]['A'].'" style="background:none; border:none;" readonly="readonly"  /></td>
					<td class="col-2"><input type="text" value="'.$prod[$i]['B'].'" style="background:none; border:none;" readonly="readonly"  /></td>
					<td class="col-2"><input type="text" value="'.$prod[$i]['C'].'" style="background:none; border:none;" readonly="readonly"  /></td>
					<td class="col-1"><input type="text" value="'.$classcode.'" style="background:none; border:none;" readonly="readonly"  /></td>
					<td class="col-1"><input type="text" value="'.$student_section.'" style="background:none; border:none;" readonly="readonly"  />
					<td class="text-danger font-weight-bold col-4">'.$error.'</td>
					</tr>';
		} else {
			$tbody .= '<td class="col-1"><input type="text" name="username[]" value="'.$prod[$i]['A'].'" style="background:none; border:none;" readonly="readonly"  /></td>
					<td class="col-2"><input type="text" name="fname[]" value="'.$prod[$i]['B'].'" style="background:none; border:none;" readonly="readonly"  /></td>
					<td class="col-2"><input type="text" name="lname[]" value="'.$prod[$i]['C'].'" style="background:none; border:none;" readonly="readonly"  /></td>
					<td class="col-1"><input type="text" name="Class[]" value="'.$classcode.'" style="background:none; border:none;" readonly="readonly"  /></td>
					<td class="col-1"><input type="text" name="Section[]" value="'.$student_section.'" style="background:none; border:none;" readonly="readonly"  />
					<td class="text-danger font-weight-bold col-4">'.$error.'</td>
					</tr>';
		}
	}
	$output['List'] = $tbody;
	if($no_of_errors > 0)
		$upload_ok = false;
	else
		$upload_ok = true;
	$output['UploadStatus']  = $upload_ok;
	$output['NoOfErrors'] = $no_of_errors;
	$status = true;
	if(count($prod) >= 1002) {
		$status = false;
		$message = "Maximum number of records to upload should be less than 1000";
	}
} else if($type == "uploadvalidateExcel") {
	$no_of_students_inserted = 0;
	for($i = 0; $i < count($_POST['username']); $i++)
	{
		$username = strtolower($_POST['username'][$i]);
		$userInfo = array();
		$userInfo['username']  = $username;
		$userInfo['password'] = md5($username);
		$userInfo['idnumber'] = $username;
		$userInfo['email'] = $username."@gmail.com";
		$userInfo['firstname'] = trim($_POST['fname'][$i]);
		$lastname = trim($_POST['lname'][$i]);
		if($lastname == "") {
			$lastname = ".";
		}
		$userInfo['lastname'] = $lastname;
		$userInfo['Class'] = intval($_POST['Class'][$i]);
		$userInfo['Section'] = ucwords($_POST['Section'][$i]);
		$userInfo['level'] = 0;
		$autoid = CreateUser($userInfo);
		if($autoid > 0) {
			$no_of_students_inserted++;
		}
	}
	if($no_of_students_inserted > 0) {
		$status = true;
		$message = "Student data uploaded and saved successfully";
	} else {
		$status = false;
		$message = "Sorry! No data uploaded";
	}
	$snackbar = true;
} else if($type == "DeleteStudent") {
	$stuID = $_POST['stuID'];
	
	$sql2 ="UPDATE mdl_user SET deleted=1 WHERE id = ?";
	$query2 = $db->prepare($sql2);
	$query2->execute(array($stuID));
	$rowcount2 = $query2->rowCount();
	$response['Message'] = "Student Deleted successfully";
	
	$system_ip = $_SERVER['REMOTE_ADDR'];
	$info = "Student details delete of ".$stuID;
	$time = time();
	$url = "";
	$query = "INSERT INTO mdl_log (id, time, userid, ip, course, module, cmid, action, url, info) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
	$result = $db->prepare($query);
	$result->execute(array($time, $login_userid, $system_ip, 1, 'user', 0, 'student details delete', $url, $info));

	$status = true;
	$message = "Student Deleted successfully";
} else if($type == "resetPassword") {
	if(isset($_POST['password'], $_POST['cpassword'], $_POST['rp_autoid'])) {
		$student_id = intval($_POST['rp_autoid']);
		$password = getSanitizedData($_POST['password']);
		$cpassword = getSanitizedData($_POST['cpassword']);
		if($password == $cpassword) {
			$md5_password = md5($password);
			$query1 = "UPDATE mdl_user SET password = ? WHERE id = ? AND deleted = 0";
			$stmt1 = $db->prepare($query1);
			$stmt1->execute(array($md5_password, $student_id));
			$status = true;
			$message = "Password updated successfully";
		} else {
			$status = false;
			$message = "Password and Confirm Password are not same";
		}
	} else {
		$status = false;
		$message = "Mandatory fields are not sent";
	}
}

$output['status'] = $status;
$output['message'] = $message;
if($snackbar && $output['status']) {
	if($status) {
		$_SESSION['sb_heading'] = "Success!";
	} else {
		$_SESSION['sb_heading'] = "Notice!";
	}
	$_SESSION['sb_message'] = $message;
	if(strlen($message) > 50) {
		$_SESSION['sb_time'] = 15000;
	} else {
		$_SESSION['sb_time'] = 10000;
	}
}
echo json_encode($output);