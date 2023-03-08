<?php
function InsertRecord($table_name, $data = array())
{
	global $db;
	if(count($data) > 0)
	{
		$column_string = "";
		$values_string = "";
		foreach($data as $columnname=>$value)
		{
			$column_string .= $columnname.",";
			$values_string .= "?, ";
			$replacedata[] = $value;
		}
		$column_string = trim($column_string, ",");
		$values_string = trim($values_string, ", ");
		try {
			$query = "INSERT INTO $table_name ($column_string) VALUES ($values_string)";
			$stmt = $db->prepare($query);
			$stmt->execute($replacedata);
			return $db->lastInsertId();
		} catch(PDOException $ex) {
			//WriteExceptionLog($ex);
			echo "<pre>";
			print_r($ex);
		}	
	}
	else
	{
		return 0;
	}
}

function getSanitizedData($data)
{
	$data = htmlspecialchars(stripslashes(strip_tags($data)));
	/*if(empty($data))
		$data = NULL;*/
	return $data;
}

function DeleteRecordAudit($table_name, $data, $autoid)
{
	$rowstring = json_encode($data);
	$login_id = $_SESSION['bf_userid'];
	$ctime = date("Y-m-d H:i:s");
	InsertRecord("deletehistory_audit", array(
												"id"=>"''", 
												"userid"=>$login_id, 
												"table_name"=>$table_name,
												"refid"=>$autoid,
												"data"=>$rowstring,
												"deleted_on"=>$ctime
											)
				);
	
}

function DeleteRecord($table_name, $data)
{
	global $db;
	if(count($data) > 0)
	{
		$cond_string = "";
		$replacedata = array();
		foreach($data as $columnname=>$value)
		{
			$cond_string .= $columnname." = ?, ";
			$replacedata[] = $value;
		}
		$cond_string = trim($cond_string, ", ");
		try {
			$query = "DELETE FROM $table_name WHERE $cond_string";
			$stmt = $db->prepare($query);
			$stmt->execute($replacedata);
			return $stmt->rowCount();
		} catch(PDOException $ex) {
			//WriteExceptionLog($ex);
			echo "<pre>";
			print_r($ex);
		}	
	}
	else
	{
		return 0;
	}
}

function GetRecord($table_name, $comparision_data)
{
	global $db;
	$cond_string = "1";
	$replacedata = array();
	foreach($comparision_data as $columnname=>$value)
	{
		$cond_string .= " AND ".$columnname." = ?";
		$replacedata[] = $value;
	}
	//print_r($replacedata);
	//$cond_string = trim($cond_string, ", ");
	try {
		$query = "SELECT * FROM $table_name WHERE $cond_string LIMIT 1";
		$stmt = $db->prepare($query);
		$stmt->execute($replacedata);
		return $stmt->fetch(PDO::FETCH_ASSOC);
	} catch(PDOException $ex) {
		//WriteExceptionLog($ex);
		echo "<pre>";
		print_r($ex);
	}
}

function GetRecords($table_name, $comparision_data, $orderby_data=array())
{
	global $db;
	$cond_string = "1";
	$replacedata = array();
	
	foreach($comparision_data as $columnname=>$value)
	{
		$cond_string .= " AND ".$columnname." = ?";
		$replacedata[] = $value;
	}
	$cond_string = trim($cond_string, ", ");
	$order_by = "";
	if(count($orderby_data) > 0)
	 $order_by = " ORDER BY ".implode(",",$orderby_data);
	try {
		$query = "SELECT * FROM $table_name WHERE $cond_string $order_by";
		$stmt = $db->prepare($query);
		$stmt->execute($replacedata);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	} catch(PDOException $ex) {
		//WriteExceptionLog($ex);
		echo "<pre>";
		print_r($ex);
	}
}

function GetRecordsDistinct($table_name, $comparision_data, $return_column, $orderby_data=array())
{
	global $db;
	$cond_string = "1";
	$replacedata = array();
	
	foreach($comparision_data as $columnname=>$value)
	{
		$cond_string .= " AND ".$columnname." = ? ";
		$replacedata[] = $value;
	}
	$cond_string = trim($cond_string, ", ");
	$order_by = "";
	if(count($orderby_data) > 0)
	 $order_by = " ORDER BY ".implode(",",$orderby_data);
	try {
		$query = "SELECT DISTINCT($return_column) FROM $table_name WHERE $cond_string $order_by";
		$stmt = $db->prepare($query);
		$stmt->execute($replacedata);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	} catch(PDOException $ex) {
		//WriteExceptionLog($ex);
		echo "<pre>";
		print_r($ex);
	}
}

function GetQueryRecords($query, $replacedata=array())
{
	global $db;
	try {
		if(count($replacedata) > 0)
		{
			$stmt = $db->prepare($query);
			$stmt->execute($replacedata);
		}
		else
		{
			$stmt = $db->query($query);
		}	
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	} catch(PDOException $ex) {
		//WriteExceptionLog($ex);
		echo "<pre>";
		print_r($ex);
	}
}

function Convert_Date_MySQL($date)
{
	if(empty($date))
		$date = NULL;
	else if($date == "1970-01-01 00:00:00" || $date == "0000-00-00 00:00:00" || $date == "1970-01-01" || $date == "0000-00-00")
		$date = NULL;
	else
		$date = date("Y-m-d", strtotime($date));
	return $date;
}
function Convert_Date_user($date)
{
	if(empty($date))
		$date = NULL;
	else if($date == "1970-01-01 00:00:00" || $date == "0000-00-00 00:00:00" || $date == "1970-01-01" || $date == "0000-00-00")
		$date = NULL;
	else
		$date = date("d-m-Y", strtotime($date));
	return $date;
}
?>