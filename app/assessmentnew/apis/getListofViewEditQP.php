<?php
session_start();
  include "../../configration/config.php";
  require_once "../../functions/db_functions.php";
  // include "../functions/common_function.php";

$output= array();

$users = GetRecords("qp_qustpaper", array());
$total_all_rows = count($users);

$sql = "SELECT * FROM qp_qustpaper ";
if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE title like '%".$search_value."%'";
	$sql .= " OR publishStatus like '%".$search_value."%'";
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$column_name." ".$order."";
}
else
{
	$sql .= " ORDER BY id desc";
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
	$sub_array[] = ucwords($row['publishStatus']);
	$sub_array[] = $row['totMarks'];
	$sub_array[] = '<a href="javascript:void();" data-tooltip="Edit" data-title="'.$row['title'].'" data-id="'.$row['id'].'"  class="editBtn" style="margin-right:2rem"><i class="bi bi-pencil-square"></i></a> <a href="javascript:void();" data-tooltip="View" data-title="'.$row['title'].'" data-id="'.$row['id'].'"  class="viewBtn" style="margin-right:2rem"><i class="bi bi-eye-fill"></i></a>';
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
