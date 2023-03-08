<?php
session_start();
include_once $_SESSION['dir_root']."app/session_token/checksession.php";
include $_SESSION['dir_root']."app/configration/config.php";
include "../functions/common_function.php";
include $_SESSION['dir_root']."app/functions/db_functions.php";
include $_SESSION['dir_root']."app/functions/common_functions.php";
try{
	/*echo "<pre/>";
	print_r($_POST);
	print_r($_FILES);die;*/
	//$tags = getSanitizedData($_POST['tags']);
	//$tags_array = explode(",", $tags);
	$logged_user_id=$_SESSION['cms_userid'];


	$slides = GetRecords("add_slide_list", array("layout_id"=>'3', "slide_title"=>'Wordssmith2'), array("sequence"));
  	if(count($slides) > 0) {
        foreach ($slides as $slide) {
        	$class_id = $slide['class'];
			$topics_id = $slide['topic_id'];
			$lesson_id = $slide['lesson_id'];
			$layoutid = $slide['layout_id'];
			$slidePath = $slide['slide_file_path'];
			$filePath = str_replace($web_root.'app/', $dir_root_production, $slidePath);
			$slide_json = json_decode($slide['slide_json'], true);

			//echo "------".$filePath;die;
			
			$img1 = str_replace($web_root."app/contents/", "", $slide_json['img1']);


			// https://prepmyskills.com/cms/app/contents/GoodManners/class3/lesson/9959.html			

			$output ='
		    <!DOCTYPE html>
		    <html>
		    <head>
		      <title>Layout 1.0 - Introduction Slide - Image + Title goes here...</title>
		      <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0" />
		      <link rel="stylesheet" type="text/css" href="../../../bootstrap_4.1.3/css/bootstrap.min.css">
		      <link rel="stylesheet" type="text/css" href="../../../assets/fonts/San-Francisco-Font/fonts.css">
		      <link rel="stylesheet" type="text/css" href="../../../css/static_layouts/lessons/Layout1.0.css">
		    </head>
		    <body>
		      <form id="layout_form" name="layout_form" enctype="multipart/form-data">
		        <div class="container-fluid">
		          <div class="row h-100 d-flex align-items-center" id="img_block">
		            <div class="col-12">
		              <input type="hidden" name="img1" class="image" value="" />
		              <img src="../../../'.$img1.'" id="modal_img" class="img-fluid mx-auto d-block" />
		            </div>
		          </div>
		        </div>
		      </form>

		      <script src="../../../bootstrap_4.1.3/js/jquery-3.3.1.min.js"></script>
		      <script src="../../../bootstrap_4.1.3/js/bootstrap.min.js"></script>
		    </body>
		    </html>';
		    
		    $myfile = fopen($filePath, "w") or die("Unable to open file!");
		    fwrite($myfile, $output);
			fclose($myfile);
		    echo $slidePath = $slidePath;echo "<br/>";
		}
	} else {
		echo "no slides availlable with this Layout1.0 layout";
	}
} catch (Exception $exp) {
	echo "<pre/>";
	print_r($exp);
}