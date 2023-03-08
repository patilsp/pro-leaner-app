<?php
  //print_r($_REQUEST);die;
  $web_root = $_GET['webpath'];
  $file_path = $_GET['dir_path'];
  $actual_path = str_replace($web_root."app/", "", $file_path);
  $info = pathinfo($actual_path);
  $dir_path = $info['dirname'];
  $action_type = $_GET['action_type'];

  $h1 = $_POST['h2'];
  $lp = $_POST["lp"];
  
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
          $orgislidepath_img = pathinfo($_GET["saving_path"]);
          $orgislidepath_img = $orgislidepath_img['dirname'];
          $prefix_path = $_GET['dir_root']."app/".$orgislidepath_img."/";
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
        $text.='<li> <img id="_objective1" src="images/bullet_point/bullet2.png"  style="float:left">
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
		<link rel="stylesheet" type="text/css" href="css/lesson/032lsgm07.css">
		<!-- Core JS files -->
		
		<script type="text/javascript" src="../assets/js/core/libraries/jquery.min.js"></script>
		<script type="text/javascript" src="../assets/js/core/libraries/bootstrap.min.js"></script>
		<script>
			$(function(){
				$("._content1,._content2,._content3,._content4,._content5,._content6,._content7,._content8").hide();
				$("._content1").fadeOut("slow").delay(1000).fadeIn("slow");
				$("._content2").fadeOut("slow").delay(2000).fadeIn("slow");
				$("._content3").fadeOut("slow").delay(3000).fadeIn("slow");
				$("._content4").fadeOut("slow").delay(4000).fadeIn("slow");
				$("._content5").fadeOut("slow").delay(5000).fadeIn("slow");
				$("._content6").fadeOut("slow").delay(6000).fadeIn("slow");
				$("._content7").fadeOut("slow").delay(7000).fadeIn("slow");
				$("._content8").fadeOut("slow").delay(8000).fadeIn("slow");
			});
		</script>
		<style>
			
        </style>
	</head>
    <body>
		
		<!-- Page container -->
		<div class="container-fluid">
			<!-- Page content -->
			<div class="page-content">
				<!-- Main content -->
				<div class="content-wrapper">
					<div class="row mydivs">
						<div class="col-md-12  col-sm-12 col-xs-12 template img-responsive"> 
							<div class="_content1" >
                             	
                                <div id="_objective">
                                 	<h2>'.$h1[0].'  </h2>
                                </div>
                            </div>
                            
                             <div class ="col-md-12 col-sm-12 col-xs-12 content_part">  
								 
								 <ul class="_content2">
							         '.$text.'
							    </ul>      
							    
							        
                            
                            </div>
		                </div>
		            </div>
		        </div>
		    </div>  
		</div>                  
    </body>
</html>';

if($action_type == "preview") {
  $data = $output;
  $data = str_replace("'", '"', $data);
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
  $dir_root = $_GET['dir_root'];
  $saving_path = pathinfo($_GET['saving_path']);
  $saving_path = $saving_path['dirname'];
  //Replace Global CSS & JS Path
  $data = str_replace('../', '../../../../', $output);
  preg_match_all('/href="css([^"]+)/i',$data, $matches);
  $css_push_path = pathinfo($matches[0][0]);
  $css_push_pathh = str_replace('href="', "", $css_push_path['dirname']);
  $css_push_pathh_dir = str_replace('href="css', "", $css_push_path['dirname']);
  $css_path = $matches[1][0];
  $layoutfilepath = pathinfo($_GET['layoutfilepath']);
  $layoutfilepath = str_replace($web_root, $dir_root, $layoutfilepath['dirname']);
  $get_layout_css = file_get_contents($layoutfilepath."/css".$css_path);

  $orgislidepath_img = pathinfo($_GET["saving_path"]);
  $orgislidepath_img = $orgislidepath_img['dirname'];
  $prefix_path = $_GET['dir_root']."app/".$orgislidepath_img."/css";
  if(! file_exists($prefix_path.$css_push_pathh_dir)){
    $path = $prefix_path.$css_push_pathh_dir;
    mkdir($path,0755,true);
  }

  $source = $layoutfilepath;
  $dest = $saving_path;
  cpy($source, $dest, $dir_root);

  $newFileName = time();
  file_put_contents($dir_root.'app/'.$saving_path.'/'.$css_push_pathh.'/'.$newFileName.'.css', $get_layout_css);
  $final_html_data = str_replace($css_push_path['filename'], $newFileName, $data);
  file_put_contents($dir_root.'app/'.$saving_path.'/'.$newFileName.'.html', $final_html_data);
  echo "success";
}


//copy bullet images from layout folder for add new slides
function cpy($source, $dest, $dir_root){
  $source = $source."/images/bullet_point";
  $dest = $dir_root."app/".$dest."/images/bullet_point";

  if(!is_dir($dest)){
    mkdir($dest, 0777, true);
  }

  if(is_dir($source)) {
      $dir_handle=opendir($source);
      while($file=readdir($dir_handle)){
          if($file!="." && $file!=".."){
              if(is_dir($source."/".$file)){
                  if(!is_dir($dest."/".$file)){
                      mkdir($dest."/".$file, 0777, true);
                  }
                  cpy($source."/".$file, $dest."/".$file);
              } else {
                  copy($source."/".$file, $dest."/".$file);
              }
          }
      }
      closedir($dir_handle);
  } else {
    //copy($source, $dest);
  }
}
?>  



	
