<?php
  include_once "../../../session_token/checksessionajax.php";
  include "../../../configration/config.php";
  include "../../../functions/db_functions.php";

  try {
    /*echo "<pre/>";
    print_r($_POST);die;*/
    $status = '';
    $msg = '';
  	$logged_user_id=$_SESSION['assess_userid'];
    $updated_on = date("Y-m-d H:i:s");
    $mapQustDetId = getSanitizedData($_POST['mapQustDetId']);
    $mapClassId = getSanitizedData($_POST['mapClassId']);
    $mapClassSubId = getSanitizedData($_POST['mapClassSubId']);
    $getCatId = GetRecord("setup_map_class_category", array("classId"=>$mapClassId));
    $mapCatId = '';
    if(!empty($getCatId)) {
      $mapCatId = $getCatId['catId'];
    }
    
    
    $query = "UPDATE questiondetails SET catId = ?, classId = ?, subId = ?, updatedBy = ?, updatedOn = ? WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute(array($mapCatId, $mapClassId, $mapClassSubId, $logged_user_id, $updated_on, $mapQustDetId));
    $status = true;
    $msg = "Mapped Successfully";

    $output['status'] = $status;
    $output['message'] = $msg; 
    echo json_encode($output);
  }	catch(Exception $exp) {
  	echo "<pre/>";
  	print_r($exp);
  }

?>