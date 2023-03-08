<?php  
include "../../configuration/config.php";
include "../../functions/db_functions.php";
$output = '';  
if(isset($_POST['id']))
{
	$id= getSanitizedData($_POST['id']);
	$record = GetRecord("resources",array("id"=>$id));
	$num_count = count($record);
	if($num_count >0)
	{
		$img_name = $record['filename'];	
		$img_size = $record['filesize']." KB";
		$updated_on = date("d-m-Y H:i:s",strtotime($record['updated_on']));
		$status =true;
		$name = $img_name;
		$size = $img_size;
		$dtime = $updated_on;
	}
	else
	{	
		$status =false;
		$message = "Info Not Available";
	}
	
	$response = array("status"=>$status,"name"=>$name,"size"=>$size,"datetime"=>$dtime);
	echo json_encode($response);
}  
?>  