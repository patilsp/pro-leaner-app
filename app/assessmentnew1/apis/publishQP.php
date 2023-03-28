<?php
	include_once "../../../session_token/checksessionajax.php";
	include "../../../configration/config.php";
	include "../../../functions/db_functions.php";

	/*echo "<pre/>";
	print_r($_POST);die;*/
	$qustIds = $_POST['qustIds'];

	foreach ($qustIds as $id) {
		$query = "UPDATE qustpaper SET publishStatus = 'published' WHERE id = ?";
	    $stmt = $db->prepare($query);
	    $stmt->execute(array($id));
    }
    echo $status = true;
?>