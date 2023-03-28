<?php
	// include_once "../../../session_token/checksessionajax.php";
	// include "../../../configration/config.php";
	// include "../../../functions/db_functions.php";
	// include "../../../functions/common_functions.php";

	include_once "../../session_token/checksession.php";
	include_once "../../configration/config.php";
	//include_once "session_token/checktoken.php";
	require_once "../../functions/common_functions.php";
	require_once "../../functions/db_functions.php";
	
	require('../../configration/config.php');

	
	/*echo "<pre/>";
	print_r($_POST);
	echo "<pre/>";die;*/
	echo $data = getQustsHtml($_POST['questionDetailsId']);
	
?>