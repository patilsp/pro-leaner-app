<?php
	include "../configration/config.php";
	session_start();
try{
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	
	$sql = "SELECT * FROM users WHERE email=? AND password = ?";
	$stmt = $db->prepare($sql);
	$stmt->execute(array($email, $password));
	$rowcount = $stmt->rowCount();
	if($rowcount){
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
					
		require_once "../session_token/csrf.php";
		$token=Token::generate();
		$_SESSION['token'] = str_replace("+","",$token);

		$_SESSION['cms_userid'] = $row['id'];
		$_SESSION['user_role_id'] = $row['roles_id'];
		$_SESSION['cms_name'] = $row['first_name']." ".$row['last_name'];
		$_SESSION['cms_email'] = $row['email'];
		$_SESSION['dir_root'] = $dir_root;

		//geeting role name
		$sql1 = "SELECT * FROM roles WHERE id = ?";
		$stmt1 = $db->prepare($sql1);
		$stmt1->execute(array($_SESSION['user_role_id']));
		$rowcount1 = $stmt1->rowcount();
		if($rowcount1) {
			$row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
			$_SESSION['cms_usertype'] = $row1['name'];
		}

		
		echo "username_exists";
	}
	else {
		echo "username_not_exists";
	}
}catch(PDOException $err) {
	echo "Error: " . $err->getMessage();
}
	?>		
