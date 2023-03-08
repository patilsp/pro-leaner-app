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
        $text.='<li> <img id="_objective1" src="natural6_images/natural btn.png"  style="float:left">
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
<link rel="stylesheet" type="text/css" href="css/lessons/062vsne04.css">
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
              <h2>'.$h1[0].'</h2>
            </div>
          </div>
          <!-- <div id="_try" class="pull-right"></div> -->
          <div class ="col-md-6 col-sm-12 col-xs-12 _content_part2">
            <ul class="_content2">
                '.$text.'
            </ul>
            
          </div>
          <div class="col-md-12 col-xs-12 col-sm-12 _content_part3">
            <center class="_content5">
              '.$text.'
            </center>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Core JS files --> 
<script type="text/javascript" src="../assets/js/core/libraries/jquery.min.js"></script> 
<script type="text/javascript" src="../assets/js/core/libraries/bootstrap.min.js"></script> 
<script>
	$(function(){
		$("._content1,._content2,._content3,._content4,._content5,._content6,._content7,._content8,._content9").hide();
		$("._content1").fadeOut("slow").delay(1000).fadeIn("slow");
		$("._content2").fadeOut("slow").delay(2000).fadeIn("slow");
		$("._content3").fadeOut("slow").delay(3000).fadeIn("slow");
		$("._content4").fadeOut("slow").delay(4000).fadeIn("slow");
		$("._content5").fadeOut("slow").delay(5000).fadeIn("slow");
		$("._content6").fadeOut("slow").delay(6000).fadeIn("slow");
		$("._content8").fadeOut("slow").delay(8000).fadeIn("slow");
		$("._content9").fadeOut("slow").delay(8000).fadeIn("slow");
		$("._content7").fadeOut("slow").delay(7000).fadeIn("slow");		
	});
</script> 
<!-- Modal -->
<div class="modal fade  bs-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content" style="background-color:#48c102;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body"> <img class="stranger1_popup center-block img-responsive" src="natural6_images/4_a.png"> </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<!--Model--> 
<!-- Modal-1 -->
<div class="modal fade  bs-example-modal-sm" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content" style="background-color:#48c102;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body"> <img class="stranger1_popup center-block img-responsive" src="natural6_images/4a.png"> </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<!--Model-1--> 
<!-- Modal-2 -->
<div class="modal fade  bs-example-modal-sm" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content" style="background-color:#48c102;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body"> <img class="stranger1_popup center-block img-responsive" src="natural6_images/4c.png"> </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<!--Model-2-->
</body>
</html>
