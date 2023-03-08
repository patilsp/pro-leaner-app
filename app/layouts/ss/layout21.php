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
        $text.='<li> <img id="_objective1" src="social10_images/social skills btn.png"  style="float:left">
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
        <link href="css/lessons/102lsss09.css" rel="stylesheet" type="text/css"/>
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
                            <!-- <div id="_try" class="pull-right"></div> -->
                            <div class="col-md-12 col-sm-12 col-xs-12 content_part">
                                
                                <ul class="_content2">
                                    '.$text.'
                                </ul>
                                
                            </div>

                            <div class="_content7 col-md-12 col-sm-12 col-xs-12 table_1">
                                <table border=2 class="table table-responsive">
                                    <tr>
                                        <th width="400px">'.$h1[0].' </th>
                                        <th width="400px">'.$h1[0].' </th>
                                    </tr>
                                   
                                    <tr>
                                        '.$text.'
                                    </tr>
                                   
                                    <tr>
                                        '.$text.'
                                    </tr>
                                 
                                </table>
                                
                            </div>
                        </div>
                          

                    </div>
                </div>
            </div>
        </div>
    
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
    <!-- Modal -->
        
        <!-- Modal -->
        <div class="modal fade  bs-example-modal-sm" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"></h4>
              </div>
              <div class="modal-body">
                <img class="stranger1_popup center-block img-responsive" src="social10_images/short.png">
              </div>
              <div class="modal-footer">        
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>                      
    </body>
</html>
