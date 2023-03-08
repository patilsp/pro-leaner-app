<?php 
require_once "../../configration/config.php";
require_once $dir_root."app/functions/db_functions.php";

$type = $_REQUEST['type'];
if($type == "getLayouts")
{
	$templateid = $_POST['templateid'];
	$layout_id = $_POST['layout_id'];
	$records = GetRecords("resources", array("template_id"=>$templateid, "id"=>$layout_id));
	if (count($records) != 0) {
		foreach($records as $record)
		{
			echo '
			<div class="card bd-0">
			    <img class="card-img-top img-fluid" src="'.$web_root.$record['filepath'].'" alt="Image">
			    <div class="card-body rounded-bottom">
			      <button class="d-block mx-auto btn btn-md btn-warning layout" data-id="'.$web_root.$record['layoutfilepath_html'].'">Choose Layout1</button>
			    </div>
			</div>
			';
		}
	} else {
		echo '
			<div class="card bd-0">
			    <img class="card-img-top img-fluid" src="../id/images/notImage.png" alt="Image" class="img-responsive">
			    <div class="card-body rounded-bottom">
			      <button class="d-block mx-auto btn btn-md btn-warning nolayouts" style="word-wrap: break-word;white-space: normal !important;">No Layouts Choose Other Templates</button>
			    </div>
			</div>
			';
	}
}
else if($type == "getFullLayout")
{

}
?>