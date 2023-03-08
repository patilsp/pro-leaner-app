<?php
	require_once "../../session_token/checksession.php";
	require_once "../../configration/config.php";
	include "../../functions/db_functions.php";
	

	$slides = GetRecords("add_slide_list", array("layout_id"=>'5263'), array("sequence"));
  	if(count($slides) > 0) {
        foreach ($slides as $slide) {
          $slide_file_path = $slide['slide_file_path'];

          $slidePath = str_replace($web_root.'app/', $dir_root_production, $slide_file_path);

          //$replaceTxtArray = array('<span class="close">×</span>');
          echo "slidePath---".$slidePath;echo "<br/>";
			//foreach ($replaceTxtArray as $element) {
          		if (file_exists($slidePath)) {
          			echo "File Existis";echo "<br/>";
					delete_div($slidePath, '<script src="../../../bootstrap_4.1.3/js/bootstrap.min.js"></script>', '<script src="../../../bootstrap_4.1.3/js/bootstrap.min.js"></script> <script>$(document).ready(function(){$(".collapse.show").each(function(){$(this).prev(".card-header").find("p").text("Hide Meaning");});$(".collapse").on("show.bs.collapse",function(){$(this).prev(".card-header").find("p").text("Hide Meaning");}).on("hide.bs.collapse",function(){$(this).prev(".card-header").find("p").text("Show Meaning");});});</script>', $slidePath, 'rip.tmp');
				} else {
					echo "--------------------File not Found------------------------";echo "<br/>";
				}
			//}
		}
  	} else {
  		echo "No Slides availlable with this layout";
  	}

  	function delete_div($file, $target, $replacement, $from, $to){
	    $side = file($file, FILE_IGNORE_NEW_LINES);
	    $reading = fopen($from, 'r');
	    $writing = fopen($to, 'w');

	    $replaced = false;

	    while (!feof($reading)) {
	        $line = fgets($reading);
	        //echo "<pre/>";
	        //print_r($line);
	           if (stristr($line,$target)) {
       			  echo "cameeeee";
	              $line = $replacement;
	              $replaced = true;
	           }
	        fputs($writing, $line);
	    }
	    fclose($reading); fclose($writing);
	    if ($replaced){
	       rename($to, $from);
	    } else {
	       unlink($to);
	    }
	}
?>