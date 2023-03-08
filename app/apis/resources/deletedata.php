<?php
include "../../configuration/config.php";
include "../../functions/db_functions.php";
if(isset($_POST['id']))
{
$id= getSanitizedData($_POST['id']);
$delete = DeleteRecord("resources",array("id"=>$id));
//echo "gjgj";die();
}
?>