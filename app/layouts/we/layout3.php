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
        $text.='<li> <img id="_objective1" src="value6_images/value btn.png"  style="float:left">
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
        <link rel='stylesheet prefetch' href='../../../../assets/css/animate.min.css'>
        <link rel="stylesheet" type="text/css" href="css/lessons/061wemm04.css">
        <style type="text/css">
           
         

        .carousel-indicators li {
            display: inline-block;
            width: 20px;
            height: 20px;
            margin: 1px;
            text-indent: -999px;
            border: 5px solid #9E9E9E;
            border-radius: 10px;
            cursor: pointer;
            background-color: #000\9;
            background-color: transparent;
        }


        .carousel-indicators .active {
            display: inline-block;
            width: 20px;
            height: 20px;
            margin: 1px;
            text-indent: -999px;
            border: 10px solid green;
            border-radius: 20px;
            cursor: pointer;
            background-color: transparent;
        }

        /* Animation delays */
        .carousel-caption img:first-child {
          -webkit-animation-delay: 1s;
          animation-delay: 1s;
        }
        .carousel-caption img:nth-child(2) {
          -webkit-animation-delay: 2s;
          animation-delay: 2s;
        }
        </style>
    </head>
 

    <body> 
        <div id="myCarousel" class="carousel slide" data-ride="carousel">

          <ol class="carousel-indicators">
              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#myCarousel" data-slide-to="1"></li>
              <li data-target="#myCarousel" data-slide-to="2"></li>
              <li data-target="#myCarousel" data-slide-to="3"></li>
              <li data-target="#myCarousel" data-slide-to="4"></li>
              <li data-target="#myCarousel" data-slide-to="5"></li>
              <li data-target="#myCarousel" data-slide-to="6"></li>
              <li data-target="#myCarousel" data-slide-to="7"></li>
              <li data-target="#myCarousel" data-slide-to="8"></li>
              <li data-target="#myCarousel" data-slide-to="9"></li>
              <li data-target="#myCarousel" data-slide-to="10"></li>
              <li data-target="#myCarousel" data-slide-to="11"></li>
              <li data-target="#myCarousel" data-slide-to="12"></li>
              <li data-target="#myCarousel" data-slide-to="13"></li>
              <li data-target="#myCarousel" data-slide-to="14"></li>
              <li data-target="#myCarousel" data-slide-to="15"></li>
              <li data-target="#myCarousel" data-slide-to="16"></li>
              <li data-target="#myCarousel" data-slide-to="17"></li>
              <li data-target="#myCarousel" data-slide-to="18"></li>
          </ol>
            <!-- Wrapper for slides -->
            <div class="container-fluid">
                <div class="row template">
                    <div class="col-xs-offset-2 col-xs-8">
                        <div class="carousel-inner">
                            <div class="item active">
                
                                <div class="carousel-content">
                                    
                                    <div class ="col-md-6 col-sm-6 col-xs-12 img_block _content5">  
                                         <img src="images/'.$_FILES['img']['name'][0].'" class="center-block img-responsive" >

                                     </div> 


                                     
                                </div>
                            </div>
                            
                            <div class="item">
                                <div class="carousel-content">
                                    <div class ="col-md-6 col-sm-6 col-xs-12 img_block _content5">  
                                      <img src="images/'.$_FILES['img']['name'][0].'"  class="center-block img-responsive" >
                                   </div> 
                                   
                                          
                                </div>
                            </div>    
                            
                            <div class="item">
                                <div class="carousel-content">
                                    
                                     <div class ="col-md-6 col-sm-6 col-xs-12 img_block _content5 carousel-caption">  
                                        <img  src="images/'.$_FILES['img']['name'][0].'"    class="center-block img-responsive" >
                                        <img class="_content5b" data-animation="animated bounceInDown"  src="images/'.$_FILES['img']['name'][0].'"   class="center-block img-responsive" >
                                        <img class="_content5c" data-animation="animated bounceInRight" src="images/'.$_FILES['img']['name'][0].'"  class="center-block img-responsive" >
                                     </div> 
                                 </div>
                            </div>    
                            
                            
                            <div class="item">
                                <div class="carousel-content">
                                    
                                     <div class ="col-md-6 col-sm-6 col-xs-12 img_block _content5 carousel-caption">  
                                          <img src="images/'.$_FILES['img']['name'][0].'"   class="center-block img-responsive" >
                                          <img class="_content5b" data-animation="animated bounceInDown" src="images/'.$_FILES['img']['name'][0].'"   class="center-block img-responsive" >
                                          <img class="_content5c" data-animation="animated bounceInRight" src="images/'.$_FILES['img']['name'][0].'"   class="center-block img-responsive" >
                          
                                     </div> 
                                          
                                </div>
                            </div>    
                            
                            <div class="item">
                                <div class="carousel-content">
                                    
                                    <div class ="col-md-6 col-sm-6 col-xs-12 img_block _content5 carousel-caption">  
                                        <img src="images/'.$_FILES['img']['name'][0].'"  class="center-block img-responsive" >
                                        <img class="_content5bb" data-animation="animated bounceInDown"  src="images/'.$_FILES['img']['name'][0].'"   class="center-block img-responsive" >
                                        <img class="_content5cc" data-animation="animated bounceInRight" src="images/'.$_FILES['img']['name'][0].'"   class="center-block img-responsive" >
                          
                                    </div>  
                                          
                                </div>
                            </div>    
                            
                            <div class="item">
                                <div class="carousel-content">
                                    <div class ="col-md-6 col-sm-6 col-xs-12 img_block _content5">  
                                       <img src="images/'.$_FILES['img']['name'][0].'"   class="center-block img-responsive" >
                                    </div>  
                                          
                                </div>
                            </div>    
                            
                             <div class="item">
                                <div class="carousel-content">
                                    
                                     <div class ="col-md-6 col-sm-6 col-xs-12 img_block _content5 carousel-caption">  
                                        <img src="images/'.$_FILES['img']['name'][0].'"   class="center-block img-responsive" >
                                        <img class="_content5d" data-animation="animated bounceInRight"  src="images/'.$_FILES['img']['name'][0].'"  class="center-block img-responsive" >
                    
                                      </div>  
                                          
                                </div>
                            </div>    
                            
                             <div class="item">
                                <div class="carousel-content">
                                    <div class ="col-md-6 col-sm-6 col-xs-12 img_block _content5 carousel-caption">  
                                        <img src="images/'.$_FILES['img']['name'][0].'"   class="center-block img-responsive" >
                                        <img class="_content6c" data-animation="animated bounceInDown" src="images/'.$_FILES['img']['name'][0].'"   class="center-block img-responsive" >
                                        <img class="_content6b" data-animation="animated bounceInRight"  src="images/'.$_FILES['img']['name'][0].'"   class="center-block img-responsive" >
                    
                                    </div>  
                                </div>
                            </div>    
                            
                             <div class="item">
                                <div class="carousel-content">
                                    
                                    <div class ="col-md-6 col-sm-6 col-xs-12 img_block _content5">  
                                       <img src="images/'.$_FILES['img']['name'][0].'"   class="center-block img-responsive" >
                          
                                   </div> 
                                          
                                </div>
                            </div>    
                            
                             <div class="item">
                                <div class="carousel-content">
                                    
                                     <div class ="col-md-6 col-sm-6 col-xs-12 img_block _content5 carousel-caption">  
                                          <img src="images/'.$_FILES['img']['name'][0].'"   class="center-block img-responsive" >
                                          <img class="_content7b" data-animation="animated bounceInDown"  src="images/'.$_FILES['img']['name'][0].'"   class="center-block img-responsive" >
                                          <img class="_content7c" data-animation="animated bounceInRight" src="images/'.$_FILES['img']['name'][0].'"   class="center-block img-responsive" >
                          
                                     </div> 
                                          
                                </div>
                            </div>    
                            
                             <div class="item">
                                <div class="carousel-content">
                                    
                                      <div class ="col-md-6 col-sm-6 col-xs-12 img_block _content5 carousel-caption">  
                                          <img src="images/'.$_FILES['img']['name'][0].'"   class="center-block img-responsive" >
                                          <img class="_content8b" data-animation="animated bounceInRight" src="images/'.$_FILES['img']['name'][0].'"   class="center-block img-responsive" >
                          
                                      </div>  
                                          
                                </div>
                            </div>    
                            
                             <div class="item">
                                <div class="carousel-content">
                                    
                                      <div class ="col-md-6 col-sm-6 col-xs-12 img_block _content5">  
                                        <img src="images/'.$_FILES['img']['name'][0].'"  class="center-block img-responsive" >
                          
                                      </div>  
                                          
                                </div>
                            </div>    
                            
                             <div class="item">
                                <div class="carousel-content">
                                    
                                     <div class ="col-md-6 col-sm-6 col-xs-12 img_block _content5 carousel-caption">  
                                          <img src="images/'.$_FILES['img']['name'][0].'"   class="center-block img-responsive" >
                                          <img class="_content9c" data-animation="animated bounceInRight" src="images/'.$_FILES['img']['name'][0].'"  class="center-block img-responsive" >
                                          <img class="_content9b" data-animation="animated bounceInDown"  src="images/'.$_FILES['img']['name'][0].'"   class="center-block img-responsive" >
                    
                          
                                      </div>  
                                          
                                </div>
                            </div>    
                            
                            <div class="item">
                                <div class="carousel-content">
                                    
                                     <div class ="col-md-6 col-sm-6 col-xs-12 img_block _content5">  
                                        <img src="images/'.$_FILES['img']['name'][0].'"   class="center-block img-responsive" >
                          
                                     </div> 
                                          
                                </div>
                            </div>    
                            
                             <div class="item">
                                <div class="carousel-content">
                                    
                                     <div class ="col-md-6 col-sm-6 col-xs-12 img_block _content5 carousel-caption">  
                                          <img src="images/'.$_FILES['img']['name'][0].'"   class="center-block img-responsive" >
                                          <img class="_content10b" data-animation="animated bounceInRight" src="images/'.$_FILES['img']['name'][0].'"   class="center-block img-responsive" >
                          
                                      </div>  
                                          
                                </div>
                            </div>    
                            
                             <div class="item">
                                <div class="carousel-content">
                                    
                                     <div class ="col-md-6 col-sm-6 col-xs-12 img_block _content5 carousel-caption">  
                                          <img src="images/'.$_FILES['img']['name'][0].'"   class="center-block img-responsive" >
                                          <img class="_content11b" data-animation="animated bounceInRight" src="images/'.$_FILES['img']['name'][0].'"  class="center-block img-responsive" >
                          
                                      </div>  
                                          
                                </div>
                            </div>    
                            
                             <div class="item">
                                <div class="carousel-content">
                                    
                                     <div class ="col-md-6 col-sm-6 col-xs-12 img_block _content5 carousel-caption">  
                                          <img src="images/'.$_FILES['img']['name'][0].'"   class="center-block img-responsive" >
                                          
                                          <img class="_content12c" data-animation="animated bounceInDown" src="images/'.$_FILES['img']['name'][0].'"   class="center-block img-responsive" >
                                          <img class="_content12b" data-animation="animated bounceInRight" src="images/'.$_FILES['img']['name'][0].'"   class="center-block img-responsive" >
                    
                          
                                      </div>  
                                          
                                </div>
                            </div>    
                            
                             <div class="item">
                                <div class="carousel-content">
                                    
                                     <div class ="col-md-6 col-sm-6 col-xs-12 img_block _content5 carousel-caption">  
                                        <img src="images/'.$_FILES['img']['name'][0].'"  class="center-block img-responsive" >
                                        <img class="_content13b" data-animation="animated bounceInRight" src="images/'.$_FILES['img']['name'][0].'"   class="center-block img-responsive" >
                    
                                      </div>  
                                          
                                </div>
                            </div>    
                            
                             <div class="item">
                                <div class="carousel-content">
                                    
                                    <div class ="col-md-6 col-sm-6 col-xs-12 img_block _content5">  
                                      <img src="images/'.$_FILES['img']['name'][0].'"   class="center-block img-responsive" >
                                    </div>  
                                          
                                </div>
                            </div>    
                        </div>    
                    </div>                                                                              
                </div>
            </div>
          
        
            
        </div>

         


        <!-- core script -->
        <script type="text/javascript" src="../assets/js/core/libraries/jquery.min.js"></script>
        <script type="text/javascript" src="../assets/js/core/libraries/bootstrap.min.js"></script>

        <script>

        $(".carousel").carousel({
             interval: 5000,
        });

         //Animation part for tooltip
        (function( $ ) {

          //Function to animate slider captions 
          function doAnimations( elems ) {
            //Cache the animationend event in a variable
            var animEndEv = "webkitAnimationEnd animationend";
            
            elems.each(function () {
              var $this = $(this),
                $animationType = $this.data("animation");
                $this.addClass($animationType).one(animEndEv, function () {
                $this.removeClass($animationType);
              });
            });
          }
          
          //Variables on page load 
          var $myCarousel = $('#myCarousel'),
          $firstAnimatingElems = $myCarousel.find('.item:first').find("[data-animation ^= 'animated']");
            
          //Initialize carousel 
          $myCarousel.carousel();
          
          //Animate captions in first slide on page load 
          doAnimations($firstAnimatingElems);
          
          //Pause carousel  
          $myCarousel.carousel('pause');
          
          
          //Other slides to be animated on carousel slide event 
          $myCarousel.on('slide.bs.carousel', function (e) {
            var $animatingElems = $(e.relatedTarget).find("[data-animation ^= 'animated']");
            doAnimations($animatingElems);
          });  
        })(jQuery);
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



  
    
    
