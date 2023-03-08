<?php
require_once "../../session_token/checksession.php";
require_once "../../configration/config.php";
//require_once $dir_root."app/session_token/checktoken.php";
require_once "../../functions/common_functions.php";
require_once $dir_root."app/functions/db_functions.php";
$token=$_SESSION['token'];
$logged_user_id=$_SESSION['cms_userid'];
$user_type = $_SESSION['cms_usertype'];
$topics_id = $_GET['topic'];
$class_id = $_GET['class'];
try{
  $records = GetRecords("$master_db.mdl_lesson", array("course"=>$topics_id));
  foreach($records as $record)
  {
    $lesson_id = $record['id'];
  }
  
  $page = GetRecord("$master_db.mdl_lesson_pages", array("lessonid"=>$lesson_id));
  $saving_path = $page['contents'];
  $saving_path = DecryptContent($saving_path);

}catch(Exception $exp){
  print_r($exp);
  return "false";
}
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
    <link href="../../../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../../../lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../../../lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../../../lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../../../lib/ajax_loader/jquery.mloading.css" rel="stylesheet">
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
    <?php include("../../fixed-blocks/slide_sidebar.php"); ?>
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <?php include("../../fixed-blocks/slide_header_add.php"); ?>
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pagetitle">
        
      </div><!-- d-flex -->

      <div class="br-pagebody">
        <!-- start you own content here -->
        <div class="br-section-wrapper">
          <h6 class="br-section-label">Adding New Slide</h6>
          

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
                  <iframe id="pre_iframe" width="100%" height="670px" id="data" srcdoc=""></iframe>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>
          <form class="layout_form" name="layout_form">
            <input type="hidden" name="action_type" id="action_type" value="" />
            <input type="hidden" name="dir_path" id="dir_path" value="" />
            <input type="hidden" name="webpath" id="webpath" value="" />
            <input type="hidden" name="saving_path" id="saving_path" value="<?php echo $saving_path; ?>" />
            <input type="hidden" name="dir_root" id="dir_root" value="<?php echo $dir_root; ?>" />
            <div id="div1"></div>
          </form>

          <iframe id='iframe_id' frameborder="0" width='100%' height='675px' src=""></iframe>
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
                <a href="<?php echo $web_root; ?>app/taskList.php" class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20 close_save" data-dismiss="modal">
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
    <script src="../../../lib/ajax_loader/jquery.mloading.js"></script>
    <script src="../../../js/cms.js"></script>
    <script>
      $(function(){
        'use strict';

        $(".close_save").click(function(){
          $("#div1").html("");
        });

        $(".templates").click(function(){
          var templateid = $(this).attr("data-id");
          $.ajax({
              url:"getLayouts.php",
              method:'POST',
              data:"templateid="+templateid+"&type=getLayouts",
              success:function(data)
              {
                $(".templates_div").hide(1000);
                $(".layouts_div").html(data);
                $(".layouts_div").show(1000);
                $(".nolayouts").click(function(){
                  $(".templates_div").show(1000);
                  $(".layouts_div").hide(1000);
                });

                $(".layout").click(function(){
                  var layoutfilepath = $(this).attr("data-id");
                  //$("iframe").attr("src",layoutfilepath);
                  $.ajax({
                    url:"getLayoutFile.php",
                    method:'POST',
                    data:"layoutfilepath="+layoutfilepath + "&type=getFullLayout",
                    success:function(data)
                    {
                      var res = $.parseJSON(data);
                      $("#div1").html(res['data']);
                      var respath = res['file_path_name'];
                      var webpath = res['web_root'];
                      console.log(respath);

                      $("#preview").click(function(event){
                        event.preventDefault();
                        $("#action_type").val("preview");
                        $("#dir_path").val(respath);
                        $("#webpath").val(webpath);
                        console.log(respath);
                        $.ajax({
                          url:respath+'?'+ "type=preview",
                          method:'POST',
                          data:new FormData(document.layout_form),
                          contentType:false,
                          processData:false,
                          success:function(data)
                          {
                            $("#privew").modal("show");
                            //$("#data").html(data);
                            $("#pre_iframe").attr("srcdoc",data);
                          },
                          beforeSend: function(){
                            $(".mLoading").addClass("active");
                          },
                          complete: function(){
                            $(".mLoading").removeClass("active");
                          }
                        }); 
                      });

                      $("#save").click(function(event){
                        event.preventDefault();
                        $("#action_type").val("save");
                        $("#dir_path").val(respath);
                        $("#webpath").val(webpath);
                        //console.log($("#action_type").val());
                        $.ajax({
                          url:respath+'?'+ "type=preview",
                          method:'POST',
                          data:new FormData(document.layout_form),
                          contentType:false,
                          processData:false,
                          success:function(data)
                          {
                            $("#modalsuccess").modal("show");
                          },
                          beforeSend: function(){
                            $(".mLoading").addClass("active");
                          },
                          complete: function(){
                            $(".mLoading").removeClass("active");
                          }
                        }); 
                      });
                    },
                    beforeSend: function(){
                      $(".mLoading").addClass("active");
                    },
                    complete: function(){
                      $(".mLoading").removeClass("active");
                    }
                  });
                });
              },
              beforeSend: function(){
                $("body").mLoading()
              },
              complete: function(){
                $("body").mLoading('hide')
              }
          });
        });
      });
    </script>
  </body>
</html>
