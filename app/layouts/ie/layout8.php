<?php
  $web_root = $_POST['webpath'];
  $file_path = $_POST['dir_path'];
  $actual_path = str_replace($web_root."app/", "", $file_path);
  $info = pathinfo($actual_path);
  $dir_path = $info['dirname'];
  $action_type = $_POST['action_type'];

  $h1 = $_POST['h2'];
  
  
  if(isset($_FILES['img']))
  {
    if($_FILES['img']['error'][0] != 4)
    {
      foreach($_FILES['img']['name'] as $k=>$value)
      {
        if($_FILES['img']['error'][$k] == 4)
          continue;
        $filetmp1 = $_FILES["img"]["tmp_name"][$k];
        $filename1 = $_FILES["img"]["name"][$k];
        $filetype1 = $_FILES["img"]["type"][$k];
        $filesize1 = $_FILES["img"]["size"][$k];
        $filepath1 = "";
        $ext = pathinfo($filename1, PATHINFO_EXTENSION);
        if($action_type == "preview")
        { 
          if(! file_exists("images")){
            $path ="images";
            mkdir($path,0755,true);
          }
        
          $filepath1 = "images/".$filename1;          
        }
        else
        {
          echo $prefix_path = $_POST['dir_root']."app/".$_POST["saving_path"]."/";
          if(! file_exists($prefix_path."images")){
            $path = $prefix_path."images";
            mkdir($path,0755,true);
          }
        
          $filepath1 = $prefix_path."images/".$filename1;

        }
        if (move_uploaded_file($_FILES["img"]["tmp_name"][$k], $filepath1)) 
        {
          //echo "File : ", $_FILES['img']['name'][$k] ," is valid, and was successfully uploaded.\n";
        } else{ echo "Err";}
      }
    }
  }

  $text = "";
  foreach($lp as $key => $value){
    $li = $value;
    if($li != ""){
        $text.='<li> <img id="_objective1" src="striving6_images/natural btn.png"  style="float:left">
          <p style="margin-left:30px;">'.$li.'</p>
        </li>';
      } else {
        continue;
      }
  }



$output ='

<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>PREPMYSKILLS - CBSE PROGRAM</title>

		<link href="../assets/css/bootstrap.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" href="css/lessons/062vsie17.css">
	</head>
    <body>
		
		<!-- Page container -->
		<div class="container-fluid">
			<!-- Page content -->
			<div class="page-content">
				<!-- Main content -->
				<div class="content-wrapper">
					<div class="row">
						<div class="col-md-12  col-sm-12 col-xs-12 template img-responsive"> 
							
                             	
                                <div id="_objective">
                                 	<h2>'.$h1[0].'</h2>
                                </div>
                            
								<div class="container-fluid">
								    <div class="row">
								        <div class="col-lg-4 _content5">
								            <img class="img1" src="images/'.$_FILES['img']['name'][0].'" class="img-responsive" align="middle" style="float:left">
								        </div>
								        <div class="col-lg-4 _content5">
								            <img class="img2" src="images/'.$_FILES['img']['name'][1].'" class="img-responsive" align="middle" style="float:left">
								        </div>
								        <div class="col-lg-4 _content5">
								            <img class="img3" src="images/'.$_FILES['img']['name'][2].'" class="img-responsive" align="middle" style="float:left">
								        </div>								        
								    </div>
								</div>        
						</div>
					</div>
				</div>
			</div>
		</div>	
						        
 </body>


<script type="text/javascript" src="../assets/js/core/libraries/jquery.min.js"></script>
<script type="text/javascript" src="../assets/js/core/libraries/bootstrap.min.js"></script>
<script>
	
</script>

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



	
