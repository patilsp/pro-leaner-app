<?php
	//include_once "../../session_token/checksession.php";
	include "../../configration/config.php";
	include "../../configration/config_schools.php";
	include "../../functions/db_functions.php";
	$logged_user_id=$_SESSION['cms_userid'];
	try{
		$qid=getSanitizedData($_GET['qust_id']);
		$query = "SELECT slide_json FROM cpadd_slide_list WHERE id = '$qid'";
      	$stmt = $db->query($query);
      	$rowcount = $stmt->rowCount();
      	if($rowcount){
        	while($fetch = $stmt->fetch(PDO::FETCH_ASSOC))
          		$data = $fetch['slide_json'];
        }
		echo $data;
	} catch(Exception $exp){
    	echo "<pre/>";
    	print_r($exp);
    	die;
	}
?>