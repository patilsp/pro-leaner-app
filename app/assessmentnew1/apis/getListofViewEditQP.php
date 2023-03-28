<?php
 
  include "../../configration/config.php";
  require_once "../../functions/db_functions.php";
  // include "../functions/common_function.php";

$output= array();
 
// $users = GetRecords("qp_qustpaper", array());
// $total_all_rows = count($users);

$sql = "SELECT qp_qustpaper.id,  qp_qustpaper.title, qp_qustpaper.totMarks, qp_qustpaper.publishStatus,qp_qustpaperclasssubid.publish_date,qp_qustpaperclasssubid.classId,qp_qustpaperclasssubid.sectionId  FROM qp_qustpaper,qp_qustpaperclasssubid where qp_qustpaper.id = qp_qustpaperclasssubid.qustPaperId ";
 
if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= "  AND (title like '%".$search_value."%'";
	$sql .= " OR publishStatus like '%".$search_value."%')";
}

if(isset($_POST['fclass']) && $_POST['fclass']>0){
	$sql .= " AND classId =".$_POST['fclass'];
}

if(isset($_POST['fsubect']) && $_POST['fsubect']>0){
	$sql .= " AND subId =".$_POST['fsubect'];
}

if(isset($_POST['fchapter']) && $_POST['fchapter']>0){
	$sql .= " AND chapId =".$_POST['fchapter'];
}

if(isset($_POST['ftopic']) && $_POST['ftopic']>0){
	$sql .= " AND topicId =".$_POST['ftopic'];
}

if(isset($_POST['fsbubtopic']) && $_POST['fsbubtopic']>0){
	$sql .= " AND subtopicId =".$_POST['fsbubtopic'];
}
 
$stmt = $db->query($sql);
$total_all_rows = $stmt->rowCount();

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$column_name." ".$order."";
}
else
{
	$sql .= " ORDER BY qp_qustpaper.id desc";
}

if($_POST['length'] != -1)
{
	$start = $_POST['start'];
	$length = $_POST['length'];
	$sql .= " LIMIT  ".$start.", ".$length;
}

$stmt = $db->query($sql);
$count_rows = $stmt->rowCount();
$data = array();
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	$sub_array = array();
	$checkbox = '';
	if($row['publishStatus'] != 'published'){
		$checkbox = '<div class="form-check">
  <input class="form-check-input qpIds" name="qustIds[]" type="checkbox" value="'.$row['id'].'" id="flexCheckDefault">
</div>';
	}
	$sub_array[] = $row['title'];
	$sub_array[] = date("d/m/Y",strtotime($row["publish_date"]));
	$sub_array[] = $row['totMarks'];
	$studentscount = GetQueryRecords("SELECT COUNT(*) as studentcount FROM users JOIN masters_sections ON users.section = masters_sections.id WHERE users.class = '".$row["classId"]."' AND masters_sections.section = '".$row["sectionId"]."' AND masters_sections.class = '".$row["classId"]."'");
	if (!empty($studentscount)) {
		$sub_array[] = $studentscount[0]["studentcount"];
	} else {
		$sub_array[] = 0;
	}
	$subcount = GetQueryRecords("SELECT COUNT(*) as stucount FROM qp_candidate_assess_response WHERE assessId = '".$row["id"]."' AND (submittedStatus = 'submitted' OR submittedStatus = 'evaluated')");
	if (!empty($subcount)) {
		$sub_array[] = '<button data-title="'.$row['title'].'" data-attr="'.$row['id'].'" class="btn btn-info btn_evaluate" type="button">'.$subcount[0]["stucount"].'</button>';
	} else {
		$sub_array[] = 0;
	}
	// $sub_array[] = '<button data-title="'.$row['title'].'" data-attr="'.$row['id'].'" class="btn btn-info btn_evaluate" type="button">Evaluate Question</button> ';
	$sub_array[] = '<a href="javascript:void();" data-tooltip="Edit" data-title="'.$row['title'].'" data-id="'.$row['id'].'"  class="editBtn btn btn-sm btn-icon btn-light btn-warning mr-1"><i class="bi bi-pencil-square"></i></a> <a href="javascript:void();" data-tooltip="View" data-title="'.$row['title'].'" data-id="'.$row['id'].'"  class="viewBtn btn btn-sm btn-icon btn-light btn-success mr-1"><i class="bi bi-eye-fill"></i></a>';
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
