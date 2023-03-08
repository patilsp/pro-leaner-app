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
        $text.='<li> <img id="_objective1" src="harmony6_images/value btn.png"  style="float:left">
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
		<link rel="stylesheet" type="text/css" href="css/lessons/061vssow02.css">
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
					<div class="row">
						<div class="col-md-12  col-sm-12 col-xs-12 template img-responsive"> 
							<div class="_content1" >
                             	
                                <div id="_objective">
                                 	<h2><b>'.$h1[0].' </b></h2>
                                </div>
                            </div>
                            
                            <!-- <div id="_try" class="pull-right"></div> -->
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
</html> 



	
