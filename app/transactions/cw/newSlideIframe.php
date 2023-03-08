<?php
require_once "../../session_token/checksession.php";
require_once "../../configration/config.php";
include "../../functions/common_functions.php";
include "apis/getTaskStatus.php";
//require_once $dir_root."app/session_token/checktoken.php";
require_once $dir_root."app/functions/db_functions.php";

$token=$_SESSION['token'];
$logged_user_id=$_SESSION['cms_userid'];
$user_type = $_SESSION['cms_usertype'];
$task_id = $_GET['task_id'];
$task_assi_id = $_GET['task_assi_id'];
$topics_id = $_GET['topic'];
$class_id = $_GET['class'];
$template_id = $_GET['template_id'];
$layout_id = $_GET['layout_id'];
try{
  $getTaskStatus = getTaskStatus1($task_id,$task_assi_id);
  $getStatus = getStatus();


  $records = GetRecord("$master_db.mdl_lesson", array("course"=>$topics_id));
  $lesson_id = $records['id'];
  
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
      .center{
        position: fixed;
        top: 35%;
        right: -10px;
        width: 110px;
        height: 0px;
        text-align: right;
        z-index: 9999;
        margin-top: -15px;
      }

      .center a{
        transform: rotate(-90deg);
        -webkit-transform: rotate(-90deg); 
        -moz-transform: rotate(-90deg); 
        -o-transform: rotate(-90deg); 
        filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
        display: block; 
        background: #e96f35; 
       text-align:center;
        height: 48px; 
        width: 165px;
        padding: 10px 16px;
        color: #fff; 
        font-family: Arial, sans-serif; 
        font-size: 15px; 
        font-weight: bold; 
        text-decoration: none; 
        border-bottom: solid 1px #333; /*border-left: solid 1px #333; border-right: solid 1px #fff;*/
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
      <div class="br-pagebody">
        <!-- start you own content here -->
        <div class="br-section-wrapper">
          <h6 class="br-section-label">Adding New Slide</h6>
          
          <input type="hidden" name="action_type" id="action_type" value="" />
          <input type="hidden" name="dir_path" id="dir_path" value="" />
          <input type="hidden" name="webpath" id="webpath" value="" />
          <input type="hidden" name="saving_path" id="saving_path" value="<?php echo $saving_path; ?>" />
          <input type="hidden" name="dir_root" id="dir_root" value="<?php echo $dir_root; ?>" />

          <iframe id='iframe_id' name="myframe" frameborder="0" width='100%' height='675px' src=""></iframe>
        </div>
        <style type="text/css">
          #preview .devices-menu {
            width: 100%;
            height: auto;
          }
          #preview ul li{
            list-style: none !important;
            float: left !important;
          }
          #preview .submenu-list {
            width: 100%;
            height: 65px;
          }
          #privew .desktop-icon {
            width: 100%;
            height: 55px;
            background: url(../../../img/responsive_icon/desktop.svg) no-repeat center 80%;
            padding: 20px 50px;
          }
          #privew .tablet-icon {
            width: 100%;
            height: 55px;
            background: url(../../../img/responsive_icon/tablet.svg) no-repeat center 80%;
            padding: 20px 50px;
          }
          #privew .phone-icon {
            width: 100%;
            height: 55px;
            background: url(../../../img/responsive_icon/phone.svg) no-repeat center 80%;
            padding: 20px 50px;
          }
        </style>
        <!-- Modal -->
        <div class="modal fade" id="privew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
          <div class="modal-dialog modal-full" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Preview</h5>
                <div class="devices-menu">
                  <ul>
                    <li class="submenu-list list-desktop" style="list-style: none;float: left;">
                      <a class="desktop-icon hvr-pop" href="javascript:void(0)"></a>
                    </li>
                    <li class="submenu-list list-tablet" style="list-style: none;float: left;"><a class="tablet-icon hvr-pop" href="javascript:void(0)"></a></li>
                    <li class="submenu-list list-phone" style="list-style: none;float: left;"><a class="phone-icon hvr-pop" href="javascript:void(0)"></a></li>
                  </ul>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="iframe_wrapper" id="display" style="transition: all 1s ease; margin: 0px auto">
                  <iframe id="pre_iframe" width="100%" height="670px" id="data" srcdoc=""></iframe>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
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
                <p class="mg-b-20 mg-x-20" id="success_msg"> Slide Sent for Review.</p>
                <a href="<?php echo $web_root; ?>app/taskList.php" class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20 close_save" data-dismiss="modal">
                  Close</a>
              </div><!-- modal-body -->
            </div><!-- modal-content -->
          </div><!-- modal-dialog -->
        </div><!-- modal -->
      </div><!-- br-pagebody -->
    </div><!-- br-mainpanel -->
    
    <div id="modaldemo3" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
      <div class="modal-dialog modal-lg" role="document" style="right: 0;transition: opacity 0.3s linear, right 0.3s ease-out;position: fixed;margin: auto;width: 620px;height: 100%;transform: translate3d(0%, 0, 0);">
        <div class="modal-content tx-size-sm" style="height: 100%;overflow-y: auto;border-radius: 0;border: none;">
          <div class="modal-header pd-x-20" style="padding-left:20px;padding-right:20px;display:flex;align-items:center;justify-content:space-between;padding:15px;border-bottom:1px solid #e9ecef;">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Instruction</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding:0;background:transparent;border:0;-webkit-appearance:none;float:right;font-size:1.3125rem;font-weight:700;line-height:1;color:#000;text-shadow:0 1px 0 #fff;opacity:.5;">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="post" id="task_reply" enctype="multipart/form-data">
            <div class="modal-body pd-20">
              <div class="row">
                <div class="col-xl-12" id="success_slide">
                  <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                    <div class="d-flex align-items-center justify-content-start">
                      <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
                      <span><strong>Well done!</strong> Successful Updated.</span>
                    </div><!-- d-flex -->
                  </div><!-- alert -->
                </div>
                <div class="col-xl-6" id="fail_slide">
                  <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                    <div class="d-flex align-items-center justify-content-start">
                      <i class="icon ion-ios-close alert-icon tx-32"></i>
                      <span><strong>Oh No!</strong> Are you getting error, Please contact tech team.</span>
                    </div><!-- d-flex -->
                  </div>
                </div>
              </div>
              <input type="hidden" name="task_assi_id" id="task_assi_id" value="<?php echo $task_assi_id; ?>"/>
              <input type="hidden" name="slide_path" id="slide_path_get" value=""/>
              <input type="hidden" name="data1" id="final_data" value=""/>
              <div class="row">
                <div class="col-md-12">
                  <?php
                  if(isset($getTaskStatus['AssignedDepartments'])){
                    foreach ($getTaskStatus['AssignedDepartments'] as  $role) {
                ?>
                  <?php if($role['user_id'] != $logged_user_id){ 
                      $attachments = json_decode($role['attachments']);
                  ?>
                  <div class="card">
                    <div class="card-header tx-medium">
                      ID Input - status(<?php echo $role['status_name']; ?>)
                    </div><!-- card-header -->
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="inst_cw">Instructions:</label>
                            <textarea readonly class="form-control" rows="2" name="inst_cw" id="inst_cw"><?php echo $role['instructions']; ?></textarea>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <?php
                          if(is_array($attachments))
                            foreach ($attachments as $attachment) {
                              $file_type = explode(".", $attachment);
                              $file_type = $file_type[1];
                          ?>
                          <div class="col-md-3">
                            <div class="card">
                              <div class="card-header">Files</div>
                              <div class="card-body">
                                <?php if($file_type == "jpg" || $file_type == "jpeg" || $file_type == "png" || $file_type == "gif") { ?>
                                <img src="<?php echo "../id/".$attachment; ?>" class="card-img-top img-responsive">
                                <?php } else { ?>
                                <a href="<?php echo "../id/".$attachment; ?>" download> Download </a>
                                <?php } ?>
                              </div> 
                            </div>
                          </div>
                          <?php
                            }
                          ?>
                        </div>
                      </div>
                    </div><!-- card-body -->
                  </div>
                  <?php } else { 
                    $attachments = json_decode($role['attachments']);
                  ?>
                  <div class="card">
                    <div class="card-header tx-medium">
                      CW Remarks - Status(<?php echo $role['status_name']; ?>)
                    </div><!-- card-header -->
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="cw_remarks">Remarks:</label>
                            <textarea readonly class="form-control" rows="2" name="cw_remarks" id="cw_remarks"><?php echo $role['instructions']; ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div><!-- card-body -->
                  </div>
                  <?php } ?>
                  <?php
                      }
                    }//end of if isset condition
                  ?>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="card" id="cw_reply_style">
                    <div class="card-header tx-medium bd-0 tx-white bg-info">
                      CW Reply
                    </div><!-- card-header -->
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="cw_remarks">Remarks:</label>
                            <textarea class="form-control" rows="2" name="cw_remarks" id="cw_remarks"></textarea>
                          </div>
                        </div>
                      </div>
                    </div><!-- card-body -->
                  </div>
                </div>
              </div>
            </div><!-- modal-body -->
            <div class="modal-footer" style="display:flex;align-items:center;justify-content:flex-end;padding:15px;border-top:1px solid #e9ecef;">
              <button type="button" id="save" class="btn btn-md btn-info">Save &amp; Submit</button>
            </div>
          </form>
        </div>
      </div><!-- modal-dialog -->
    </div>
    <div class="center inst_btn" data-toggle="modal" data-target="#modaldemo3" id="inst_btn">
        <a href="#">Instruction</a>
    </div>
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

        $("#inst_btn").click(function(){
          console.log($('#modaldemo3.in').length > 0);
          $(".inst_btn").hide();
        });
        $("#success_slide, #fail_slide").hide();
        $(".close").click(function(){
          $(".inst_btn").show();
        });

        $(".close_save").click(function(){
          $("#div1").html("");
        });
        $(".templates").click(function(){
          var templateid = $(this).attr("data-id");
          var layout_id = "<?php echo $layout_id; ?>";
          $.ajax({
              url:"getLayouts.php",
              method:'POST',
              data:"templateid="+templateid+"&layout_id="+layout_id+"&type=getLayouts",
              success:function(data)
              {
                $(".templates_div").hide(1000);
                $(".layouts_div").html(data);
                $(".layouts_div").show(1000);
                $(".nolayouts").click(function(){
                  $(".templates_div").show(1000);
                  $(".layouts_div").hide(1000);
                });
                $(".layout").trigger("click");
                console.log($('.layout').trigger("click"));
                $(".layout").click(function(){
                  var layoutfilepath = $(this).attr("data-id");
                  $("iframe").attr("src",layoutfilepath);
                  $.ajax({
                    url:"getLayoutFile.php",
                    method:'POST',
                    data:"layoutfilepath="+layoutfilepath + "&type=getFullLayout",
                    success:function(data)
                    {
                      var res = $.parseJSON(data);
                      //$("#div1").html(res['data']);
                      var respath = res['file_path_name'];
                      var webpath = res['web_root'];
                      //console.log(respath);
                      $("#preview").click(function(event){
                        event.preventDefault();
                        console.log($("#iframe_id").contents().find(document.layout_form));
                        $("#action_type").val("preview");
                        $("#dir_path").val(respath);
                        $("#webpath").val(webpath);
                        var dir_path = $("#dir_path").val();
                        var saving_path = $("#saving_path").val();
                        var dir_root = $("#dir_root").val();
                        $.ajax({
                          url:respath+'?'+"webpath="+webpath+"&dir_path="+dir_path+"&saving_path="+saving_path+"&dir_root="+dir_root+"&action_type=preview",
                          method:'POST',
                          data:new FormData(myframe.document.getElementById("layout_form")),
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
                        var dir_path = $("#dir_path").val();
                        var saving_path = $("#saving_path").val();
                        var dir_root = $("#dir_root").val();
                        $.ajax({
                          url:respath+'?'+"webpath="+webpath+"&dir_path="+dir_path+"&saving_path="+saving_path+"&dir_root="+dir_root+"&layoutfilepath="+layoutfilepath+"&action_type=save",
                          method:'POST',
                          data:new FormData(myframe.document.getElementById("layout_form")),
                          contentType:false,
                          processData:false,
                          success:function(data)
                          {
                            var res = $.parseJSON(data);
                            if(res.status){
                              var cw_remarks = $("#cw_remarks").val();
                              var status = 17;
                              var external_files = res.external_files;
                              var task_assi_id = "<?php echo $task_assi_id; ?>";
                              $.ajax({
                                url:"taskReplyProcessAdd.php",
                                method:'POST',
                                data:"cw_remarks="+cw_remarks+"&status="+status+"&external_files="+external_files+"&task_assi_id="+task_assi_id,
                                success:function(data1)
                                {
                                  $("#modaldemo3").modal("hide");
                                  $("#modalsuccess").modal("show");
                                  window.setTimeout(function () {
                                    location.href = "../../taskListOTR.php";
                                  }, 2000);
                                },
                                beforeSend: function(){
                                  $(".mLoading").addClass("active");
                                },
                                complete: function(){
                                  $(".mLoading").removeClass("active");
                                }
                              });
                            }
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
      $(window).load(function() {
        // executes when complete page is fully loaded, including all frames, objects and images
        $(".templates").trigger("click");
      });

      $(".desktop-icon").click(function () {
        $(".iframe_wrapper").animate({"width": "100%"}, "fast");
      });
      $(".tablet-icon").click(function () {
        $(".iframe_wrapper").animate({"width": "768px"}, "fast");
      });
      $(".phone-icon").click(function () {
        $(".iframe_wrapper").animate({"width": "320px"}, "fast");
      });
    </script>
  </body>
</html>
