<?php
  $web_root = $_POST['webpath'];
  $file_path = $_POST['dir_path'];
  $actual_path = str_replace($web_root."app/", "", $file_path);
  $info = pathinfo($actual_path);
  $dir_path = $info['dirname'];
  $action_type = $_POST['action_type'];

  $h1 = $_POST['h2'];
  $lp = $_POST["lp"];
  

  $text = "";
  foreach($lp as $key => $value){
    $li = $value;
    if($li != ""){
        $text.='<li> <img id="_objective1" src="emotional6_images/emotional6btn.png"  style="float:left">
          <p style="margin-left:30px;">'.$li.'</p>
        </li>';
      } else {
        continue;
      }
  }



$output ='

<!Doctype HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>PREPMYSKILLS - CBSE PROGRAM</title>

		<link href="../assets/css/bootstrap.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" href="css/lessons/061lses09.css">
	</head>
	<body>
	
		<!-- Page container -->
		<div class="container-fluid">
			<!-- Page content -->
			<div class="page-content">
				<!-- Main content -->
				<div class="content-wrapper">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12 template img-responsive">
							<div class="col-md-12 col-sm-12 col-xs-12 _content_part">
								<div class="_content1">
						         	<div id="_objective">
								 		<h2>'.$h1[0].'</h2>
								 	</div>
							 	</div>
							
							 	<div class="col-md-12 col-sm-12 col-xs-12">
									<ul class="_content_part2">
										 '.$text.'
									</ul>
								</div>
							</div>
						</div>  
                    </div>  
                </div>
            </div>
       	</div>
       	<!-- Core JS files -->
		<script type="text/javascript" src="../assets/js/core/libraries/jquery.min.js"></script>
		<script type="text/javascript" src="../assets/js/core/libraries/bootstrap.min.js"></script>
		<script type="text/javascript" src="../assets/js/core/libraries/jquery-ui.min.js"></script>
		<script type="text/javascript" src="../assets/js/core/libraries/jquery.ui.touch-punch.min.js"></script>
		<script>
			$(function(){
				$("._content1,._content2,._content3,._content4,._content5,._content6,._content7,._content8,._content9,._content10").hide();
				$("._content1").fadeOut("slow").delay(1000).fadeIn("slow");
				$("._content2").fadeOut("slow").delay(2000).fadeIn("slow");
				$("._content3").fadeOut("slow").delay(3000).fadeIn("slow");
				$("._content4").fadeOut("slow").delay(4000).fadeIn("slow");
				$("._content5").fadeOut("slow").delay(5000).fadeIn("slow");
				$("._content6").fadeOut("slow").delay(6000).fadeIn("slow");
				$("._content7").fadeOut("slow").delay(7000).fadeIn("slow");
				$("._content8").fadeOut("slow").delay(8000).fadeIn("slow");
				$("._content9").fadeOut("slow").delay(9000).fadeIn("slow");
				$("._content10").fadeOut("slow").delay(10000).fadeIn("slow");
			});
			jQuery.browser = {};
			(function () {
			    jQuery.browser.msie = false;
			    jQuery.browser.version = 0;
			    if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
			        jQuery.browser.msie = true;
			        jQuery.browser.version = RegExp.$1;
			    }
			})();
			$("#widget").draggable();
		</script>
   	</body>
</html>';
if($action_type == "preview") {
  $data = $output;
  //Replace Global CSS & JS Path
  $data = str_replace('../', $web_root.'app/layouts/', $data);

  //Internal CSS
  $data = str_replace('href="css/', 'href="'.$web_root.'app/'.$dir_path.'/css/', $data);

  //Internal JS
  //$data = str_replace('src="js/', 'src="'.$web_root.'app/'.$dir_path.'/js/', $data);

  $origScriptSrc = array();
  // read all image tags into an array
  preg_match_all('/<script[^>]+>/i',$data, $srcTags); 

  for ($i = 0; $i < count($srcTags[0]); $i++) {
    // get the source string
    preg_match('/src="([^"]+)/i',$srcTags[0][$i], $script);

    // remove opening 'src=' tag, can`t get the regex right
    $origScriptSrc[] = str_ireplace( 'src="', '',  $script[0]);  
  }
  $origScriptSrc = array_unique($origScriptSrc);
  foreach ($origScriptSrc as $key => $value) {
    $sub_value = strpos($value, "http");
    if($sub_value === false){
      $data = str_replace($value, $web_root.'app/'.$dir_path.'/'.$value, $data);
    }
  }

  $origImageSrc = array();
  // read all image tags into an array
  preg_match_all('/<img[^>]+>/i',$data, $imgTags); 
  if(count($imgTags) > 0)
  {
    for ($i = 0; $i < count($imgTags[0]); $i++) {
      // get the source string
      preg_match('/src="([^"]+)/i',$imgTags[0][$i], $imgage);
      if(count($imgage) > 0){
        // remove opening 'src=' tag, can`t get the regex right
        $origImageSrc[] = str_ireplace( 'src="', '',  $imgage[0]);
      }
      preg_match('/src=\'([^\']+)/i',$imgTags[0][$i], $imgage);
      if(count($imgage) > 0){
        // remove opening 'src=' tag, can`t get the regex right
        $origImageSrc[] = str_ireplace( 'src=\'', '',  $imgage[0]);
      }  
    }
  }
  // will output all your img src's within the html string
  $origImageSrc = array_unique($origImageSrc);
  foreach ($origImageSrc as $key => $value) {
    $data = str_replace($value, $web_root.'app/'.$dir_path.'/'.$value, $data);
  }
  echo $data;
} else {
  $dir_root = $_POST['dir_root'];
  $saving_path = $_POST['saving_path'];
  file_put_contents($dir_root.'app/'.$saving_path.'/'.time().'.html', $output);
  echo "success";
}
?>
