<?php
  $web_root = $_POST['webpath'];
  $file_path = $_POST['dir_path'];
  $actual_path = str_replace($web_root."app/", "", $file_path);
  $info = pathinfo($actual_path);
  $dir_path = $info['dirname'];
  $action_type = $_POST['action_type'];

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
        $text.='<li> <img id="_objective1" src="social6_images/social6btn.png"  style="float:left">
          <p style="margin-left:30px;">'.$li.'</p>
        </li>';
      } else {
        continue;
      }
  }



$output ='


<html>
    <head>
        <meta charset="utf-8"/>
        <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <title>
            PREPMYSKILLS - CBSE PROGRAM
        </title>
        <link href="../assets/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="css/lessons/061lsss03.css" rel="stylesheet" type="text/css"/>
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
                            <div class="_content1">
                                <div id="_objective">
                                    <h2>
                                       '.$h1[0].'
                                    </h2>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 content_part">
                                <ul class="_content2">
                                   '.$text.'
                                </ul>
                                
                                <div class="col-md-6 col-sm-6 col-xs-12 _content5">
                                    <img class="img-responsive" src="images/'.$_FILES['img']['name'][0].'"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="../assets/js/core/libraries/jquery.min.js" type="text/javascript">
    </script>
    <script src="../assets/js/core/libraries/bootstrap.min.js" type="text/javascript">
    </script>
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
