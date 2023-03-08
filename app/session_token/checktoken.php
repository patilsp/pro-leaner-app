<?php
$validtoken = false;
if(isset($_GET['xy']))
{
	if($_GET['xy'] === $_SESSION['token'])
		$validtoken = true;
}
else if(isset($_POST['xy']))
{
	if($_POST['xy'] === $_SESSION['token'])
		$validtoken = true;
}
else
{
	$validtoken = false;
}
if(!$validtoken)
{ //echo "ERROR"; echo $_SESSION['token'].$_GET['xy'].$_POST['xy'];die; 
	header("Location: ../error_pages/securityerror.php");
	die;
}
?>