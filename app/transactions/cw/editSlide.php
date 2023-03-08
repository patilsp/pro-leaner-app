<?php
require_once "../../session_token/checksession.php";
require_once "../../configration/config.php";
//require_once $dir_root."app/session_token/checktoken.php";
require_once $dir_root."app/functions/db_functions.php";
$token=$_SESSION['token'];
$logged_user_id=$_SESSION['cms_userid'];
$user_type = $_SESSION['cms_usertype'];

$class_id = $_GET['class'];
$topic_id = $_GET['topic'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Meta -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title></title>

    <!-- vendor css -->
    <link rel="stylesheet" href="../../../lib/Monkey-Inline-master/build/css/monkeyInlineStyle.min.css">
    <link href="../../../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../../../lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../../../lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../../../lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <!-- CMS CSS -->
    <link rel="stylesheet" href="../../../css/cms.css">
    <style type="text/css">
      .br-section-wrapper {
        padding: 10px;
      }
      .modal-full {
          min-width: 100%;
          margin: 0;
      }

      .modal-full .modal-content {
          min-height: 100vh;
      }
    </style>
  </head>

  <body>

    <!-- ########## START: LEFT PANEL ########## -->
    <?php include("../../fixed-blocks/edit_slide_sidebar.php"); ?>
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <?php include("../../fixed-blocks/slide_header.php"); ?>
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pagetitle">
        
      </div><!-- d-flex -->

      <div class="br-pagebody">
        <!-- start you own content here -->
        <div class="br-section-wrapper">
          <h6 class="br-section-label">Edit Slide</h6>
          

          <!-- Modal -->
          <div class="modal fade" id="privew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-full" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <object width="100%" height="670px" id="data" data=""></object>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>
          <div id="div1" class="monkey-inline"></div>
          <!-- LARGE MODAL -->
          
        </div>

        <!-- MODAL ALERT MESSAGE -->
        <div id="modalsuccess" class="modal fade">
          <div class="modal-dialog" role="document">
            <div class="modal-content tx-size-sm">
              <div class="modal-body tx-center pd-y-20 pd-x-20">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <i class="icon ion-ios-checkmark-outline tx-100 tx-success lh-1 mg-t-20 d-inline-block"></i>
                <h4 class="tx-success tx-semibold mg-b-20">Congratulations!</h4>
                <p class="mg-b-20 mg-x-20" id="success_msg"> Slide generated Successfully.</p>
                <a href="<?php echo $web_root; ?>app/taskList.php" class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20" data-dismiss="modal">
                  Close</a>
              </div><!-- modal-body -->
            </div><!-- modal-content -->
          </div><!-- modal-dialog -->
        </div><!-- modal -->
      </div><!-- br-pagebody -->
    </div><!-- br-mainpanel -->
    

    <!-- ########## END: MAIN PANEL ########## -->
    <script src="../../../lib/jquery/jquery.js"></script>
    <script src="../../../lib/popper.js/popper.js"></script>
    <script src="../../../lib/bootstrap/js/bootstrap.js"></script>
    <script src="../../../lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="../../../lib/moment/moment.js"></script>
    <script src="../../../lib/jquery-ui/jquery-ui.js"></script>
    <script src="../../../lib/jquery-switchbutton/jquery.switchButton.js"></script>
    <script src="../../../lib/peity/jquery.peity.js"></script>
    <script src="../../../lib/Monkey-Inline-master/build/monkeyInline.js"></script>
    <script src="../../../js/cms.js"></script>
    <script>
      var Monkey = new MonkeyInline();
      Monkey.run();
      $(function(){
        'use strict';

        //$(".temp_blk, .lay_blk").hide();
       /* $("#topic").change(function(){
          var classdata = $("#class").val();
          var topic = this.value;
          if(classdata != "" && topic != "") {
            $(".temp_blk").show(1000);
            $(".ct_blk").hide(1000);
          }
        });*/

        $(".templates").click(function(){
          //$(".lay_blk").show(1000);
          //$(".ct_blk, .temp_blk").hide(1000);
          //console.log();
          var templateid = $(this).attr("data-id");
          $("#div1").load("<?php echo $web_root ?>app/"+templateid);
        });
        
        $("#preview").click(function(event){
            event.preventDefault();
            $.ajax({
              url:"<?php echo $web_root; ?>app/contents/goodmanners/layout2.php",
              method:'POST',
              data:new FormData(document.user_form),
              contentType:false,
              processData:false,
              success:function(data)
              {
                $("#privew").modal("show");
                $("#data").attr("data","<?php echo $web_root; ?>app/contents/goodmanners/abc_demo.html");
              }
            }); 
        });

        $("#save").click(function(){
          //$("#modalsuccess").modal("show");
          var resdata = $("#div1").html();
          var slide_path = $(".templates").attr("data-id");
          $.ajax({
            url:"<?php echo $web_root; ?>app/contents/goodmanners/layout2.php",
            method:'POST',
            data:"data1="+resdata+"&slide_path="+slide_path,
            success:function(data)
            {
              console.log(data);
            }
          });
        });
      });
    </script>
  </body>
</html>
