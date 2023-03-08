<?php
	$imagePath = "http://localhost/cms/app/fs/test/Desert.jpg";
	$imgetc = pathinfo($imagePath);
	$newPath = "C:/wamp/www/skills4lifeadmin/dinesh/";
	$ext = '.jpg';
	$newName  = $newPath."a.".$imgetc['extension'];

	$copied = copy($imagePath , $newName);

	if ((!$copied)) 
	{
	    echo "Error : Not Copied";
	}
	else
	{ 
	    echo "Copied Successful";
	}
?>