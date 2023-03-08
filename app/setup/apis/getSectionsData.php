<?php
session_start();
include_once $_SESSION['dir_root']."app/session_token/checksession.php";
include $_SESSION['dir_root']."app/configration/config.php";
include "../functions/common_function.php";
include $_SESSION['dir_root']."app/functions/db_functions.php";
global $db;

$classList = array();
$class = $_POST["id"];
$classList[] = array("code"=>$class);

$response = array();
foreach($classList as $rows) {
	$sections = array();
	$query1 = "SELECT id, section FROM masters_sections WHERE class = '".$rows['code']."' ORDER BY sequence";
	$stmt1 = $db->query($query1);
	$rowcount1 = $stmt1->rowCount();
	while($rows1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
		array_push($sections, array("Section"=>$rows1['section'], "id"=>$rows1['id']));
		
	}
	$response[$rows['code']] = $sections;

}
$data["result"] = $response;
echo json_encode($data);