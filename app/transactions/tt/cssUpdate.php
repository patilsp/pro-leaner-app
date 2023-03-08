<?php
	include_once "../../session_token/checksession.php";
	include_once "../../configration/config.php";
	include "../../functions/common_functions.php";
	include "../../functions/db_functions.php";

	if(isset($_POST['path']))
	{
		foreach($_POST['FileContent'] as $key=>$value)
		{
			$cssFileContent = $_POST['FileContent'][$key];
			$path = $_POST['path'][$key];
			$temp = explode("/", $path);
			$onlyFileName = end($temp);
			unset($temp[count($temp)-1]);
			$temp1 = implode("/",$temp);
			$temp1 = str_replace("contents", "contents-edited",$temp1);
			if(! file_exists($temp1))
				mkdir($temp1, 0777, true);
			$edited_path = $temp1."/".time()."_".$onlyFileName;
			rename($path, $edited_path);
			file_put_contents($path, $cssFileContent);
		}
		echo "success";
	}
  else
  {
		echo "fail";
	}
?>