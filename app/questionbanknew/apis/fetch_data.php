<?php 

 

include_once "../../session_token/checksession.php";
include_once "../../configration/config.php";
//include_once "session_token/checktoken.php";
require_once "../../functions/db_functions.php";
require('../../configration/config.php');

$output= array();
// $allQusts = GetRecords("qp_questiondetails", array('deleted'=>0));
// $total_all_rows = count($allQusts);

$position_filter = '';
if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	if($search_value != ''){
		$position_filter = "and (qp_master_questiontypes.name LIKE '%".$search_value."%' OR qp_questions.question like '%".$search_value."%')";
	}
}

if(isset($_POST['fclass']) && $_POST['fclass']>0){
	$position_filter .= " AND qp_questiondetails.classId =".$_POST['fclass'];
}

if(isset($_POST['fsubect']) && $_POST['fsubect']>0){
	$position_filter .= " AND qp_questiondetails.subId =".$_POST['fsubect'];
}

if(isset($_POST['fchapter']) && $_POST['fchapter']>0){
	$position_filter .= " AND qp_questiondetails.chapId =".$_POST['fchapter'];
}

if(isset($_POST['ftopic']) && $_POST['ftopic']>0){
	$position_filter .= " AND qp_questiondetails.topicId =".$_POST['ftopic'];
}

if(isset($_POST['fsbubtopic']) && $_POST['fsbubtopic']>0){
	$position_filter .= " AND qp_questiondetails.subtopicId =".$_POST['fsbubtopic'];
}

$sql = "SELECT  `qp_questiondetails`.*,`qp_questions`.`id`AS qid ,`qp_master_questiontypes`.`name` AS questiontype,`qp_questions`.`question` AS question FROM `qp_questiondetails` INNER JOIN `qp_questions` ON `qp_questiondetails`.`id` = `qp_questions`.`qustDetailsId` LEFT JOIN `qp_master_questiontypes` ON `qp_questiondetails`.`qustType` = `qp_master_questiontypes`.`id`  WHERE `qp_questiondetails`.`deleted` = 0 ".$position_filter."";
// if($_POST['length'] != -1)
// {
// //   $start = $_POST['start'];
// //   $length = $_POST['length'];
// //   $sql .= " LIMIT  ".$start.", ".$length;
// }
 
$stmt = $db->query($sql);
$total_all_rows = $stmt->rowCount();

if($_POST['length'] != -1)
{
	$start = $_POST['start'];
	$length = $_POST['length'];
	$sql .= " LIMIT  ".$start.", ".$length;
}


$stmt = $db->query($sql);
$count_rows = $stmt->rowCount();
$data = array();

if($position_filter != ''){
	$total_all_rows = $count_rows;
}

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    
	$sub_array = array();
    $sub_array[] = $row['question'];
    $sub_array[] = $row['questiontype'];
	$sub_array[] = '<a href="javascript:void();" data-tooltip="View" data-id="'.$row['id'].'" data-qustType="'.$row['qustType'].'" class="viewbtn mr-2"><img src="'.$web_root.'/assets/images/icons/eye.png" class="tableIcon view-icon" alt="Edit"></a><a href="javascript:void();" data-tooltip="Edit" data-id="'.$row['id'].'" data-qustType="'.$row['qustType'].'" class="editbtn" ><img src="'.$web_root.'/assets/images/icons/edit.svg" class="tableIcon" alt="Edit"></a>  <a href="javascript:void();" data-tooltip="Delete" data-id="'.$row['id'].'" data-qustType="'.$row['qustType'].'" class="deleteBtn deletebutton ms-2" ><img src="'.$web_root.'/assets/images/icons/delete.svg" class="tableIcon " alt="Delete"></a>';
	$sub_array[] = $row['id'];
	
	$data[] = $sub_array;
}



$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	 'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);

