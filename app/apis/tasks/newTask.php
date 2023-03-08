<?php
	include_once "../../session_token/checksession.php";
	include "../../configration/config.php";
	include "../../functions/db_functions.php";
	require_once "../../functions/common_functions.php";
	try{
		echo "came";
		print_r($_FILES["cw_files"]);
		print_r($_POST);
	} catch(Exception $exp){
    print_r($exp);
	}
?>