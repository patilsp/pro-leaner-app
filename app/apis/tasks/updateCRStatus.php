<?php
	include "../../configration/config.php";
  	include "../../functions/common_functions.php";
  	include "../../functions/db_functions.php";

  	$autoid = getSanitizedData($_POST['autoid']);
	$review_status = getSanitizedData($_POST['status']);
	$review_date = getSanitizedData($_POST['date']);

  	if($status_date != ""){
  	  	$update_var = "review_status = ? AND review_date = ?";
  	  	$exe = $stmt->execute(array($data, $autoid_status2));
  	}
	$query = "UPDATE masters_class_topics_mapping SET review_status = ? WHERE id = ?";
	$stmt = $db->prepare($query);
	$stmt->execute(array($data, $autoid_status2));

?>