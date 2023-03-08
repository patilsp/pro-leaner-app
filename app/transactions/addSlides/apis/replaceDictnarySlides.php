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


	$slides = GetRecords("add_slide_list", array("layout_id"=>'5263'), array("sequence"));
  	if(count($slides) > 0) {
        foreach ($slides as $slide) {
        	$class_id = $slide['class'];
			$topics_id = $slide['topic_id'];
			$lesson_id = $slide['lesson_id'];
			$layoutid = $slide['layout_id'];
			$folder_path = getFolderName($topics_id);
			$folder_path2 = $dir_root_production."contents/".$folder_path;

			$query = "SELECT pw.slide_id, pw.class, pw.topic_id, pw.deleted_on, pw.word, pw.meaning, asl.id FROM popup_words pw, add_slide_list asl WHERE pw.class = ? AND pw.topic_id = ? AND pw.deleted_on IS NULL AND asl.id IN (pw.slide_id)";
			$stmt = $db->prepare($query);
			$stmt->execute(array($class_id, $topics_id));
			$words = array();
			while($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$words[] = array("word"=>$rows['word'], "meaning"=>$rows['meaning']);
			}

			$accordion = "";
			if(count($words) > 0) {
				/*echo "<pre/>";
				print_r($words);die;*/
				$i = 0;
				foreach ($words as $key => $value) {
					if($i == 0){
						$show = "show";
						$expanded = "true";
					} else{
						$show = "";
						$expanded = "false";
					}
					$accordion .= '<div class="card mb-4">
					                  <div class="card-header bg-white" id="heading'.$i.'" role="button">
					                    <div class="mb-0 d-flex justify-content-between" data-toggle="collapse" data-target="#collapse'.$i.'" aria-expanded="'.$expanded.'" aria-controls="collapse'.$i.'">
					                      <h4 class="m-0 font-weight-normal">'.$value['word'].'</h4>
					                      <p class="m-0">Show Meaning</p>
					                    </div>
					                  </div>

					                  <div id="collapse'.$i.'" class="collapse '.$show.'" aria-labelledby="heading1" data-parent="#accordionBlk">
					                    <div class="card-body">
					                      <h5>'.$value['meaning'].'</h5>
					                    </div>
					                  </div>
					                </div>';
		            $i++;
				}

				$sequence_num = 1;
				//echo "string - ".$item;
				$ppt_file_path = str_replace($dir_root, $web_root, $item);
				
				//$object = new stdClass();
				$file_name = "DictionaryWords";
			   	

			   	
			    $new_file_name = $class_id.$topics_id.$lesson_id.$layoutid;

			   	//var_dump($object);

				$output ='
			    <!DOCTYPE html>
					<html>
					<head>
						<title>Skills4life - PMS</title>
						<meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0" />
						<link rel="stylesheet" type="text/css" href="../../../bootstrap_4.1.3/css/bootstrap.min.css">
					  <link rel="stylesheet" type="text/css" href="../../../assets/fonts/San-Francisco-Font/fonts.css">
						<link rel="stylesheet" type="text/css" href="../../../css/static_layouts/lessons/layout8.4.css">
					</head>
					<body>
					  <form id="layout_form" name="layout_form" enctype="multipart/form-data">
					  	<div class="container-fluid">
					        <div class="row h-100">
					            <h1 class="display_center_text mx-auto d-block my-4">Let us quickly recall the Key Words and their meanings.</h1>
					            <div class="col-12 p-0 h-100">
					              <div class="accordion" id="accordionBlk">
					                '.$accordion.'
					              </div>
					            </div>
					        </div>
					    </div>
					  </form>
						<script src="../../../bootstrap_4.1.3/js/jquery-3.3.1.min.js"></script>
						<script src="../../../bootstrap_4.1.3/js/bootstrap.min.js"></script>
						<script>
						    $(document).ready(function () {
						        $(".collapse.show").each(function () {
						            $(this).prev(".card-header").find("p").text("Hide Meaning");
						        });
						        $(".collapse").on("show.bs.collapse", function () {
					                $(this).prev(".card-header").find("p").text("Hide Meaning");
					            }).on("hide.bs.collapse", function () {
					                $(this).prev(".card-header").find("p").text("Show Meaning");
					            });
						    });
						</script>
					</body>
					</html>';
			    
			    $data1 = GetRecord("course_folder_name", array("course_id"=>$topics_id, "deleted"=>0));
				$getFolderNameHTML = $data1['folder_name']."/class".$class_id."/lesson/";
				
			    $getFolderNameHTML = $dir_root_production."contents/".$getFolderNameHTML;
			    if(! file_exists($getFolderNameHTML)){
			      mkdir($getFolderNameHTML,0755,true);
			    }

			    file_put_contents($getFolderNameHTML.$new_file_name.".html", $output);
			    echo $slidePath = str_replace($dir_root_production, $web_root, $getFolderNameHTML.$new_file_name.".html");echo "<br/>";
			} else {
				$status =false;
				$message ="No Dictionary Words";
				echo $message; echo "<br/>";
				$getSlides = "";
			}
		}
	} else {
		echo "no slides availlable with this dictnary layout";
	}
} catch (Exception $exp) {
	echo "<pre/>";
	print_r($exp);
}