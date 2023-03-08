<?php
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

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
$class_id = $_GET['class'];
$topic_id = $_GET['topic'];
$slide_id = $_GET['slide'];
$task_userid = $_GET['task_userid'];

$getTaskStatus = getTaskStatusEdit($task_id,$task_assi_id);
/*echo "<pre/>";
print_r($getTaskStatus);*/
$getStatus = getStatus();
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
      select.form-control:not([size]):not([multiple]) {
        height: auto;
      }
      #cw_reply_style{
        -webkit-box-shadow: 0px -1px 21px 1px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px -1px 21px 1px rgba(0,0,0,0.75);
        box-shadow: 0px -1px 21px 1px rgba(0,0,0,0.75);
      }
    </style>
  </head>

  <body>

    <!-- ########## START: LEFT PANEL ########## -->
    <?php include("../../fixed-blocks/edit_slide_sidebar_getWork.php"); ?>
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
          <h6 class="br-section-label">Review Slide</h6>
          <div id="div1" contenteditable="true"></div>
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
                <p class="mg-b-20 mg-x-20" id="success_msg"></p>
                <a href="<?php echo $web_root; ?>app/taskList.php" class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20 close_save" data-dismiss="modal">
                  Close</a>
              </div><!-- modal-body -->
            </div><!-- modal-content -->
          </div><!-- modal-dialog -->
        </div><!-- modal -->
      </div><!-- br-pagebody -->
    </div><!-- br-mainpanel -->
    
    <div id="modaldemo3" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
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
              <?php
                if(isset($getTaskStatus['AssignedDepartments'])){
                  foreach ($getTaskStatus['AssignedDepartments'] as  $role) {
              ?>
                <?php if($role['user_id'] == $logged_user_id){ 
                    $attachments = json_decode($role['attachments']);
                ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="card bd-0 card_input">
                      <div class="card-header tx-medium bd-0 tx-white bg-info">
                        ID Task Input - status(<?php echo $role['status_name']; ?>)
                      </div><!-- card-header -->
                      <div class="card-body bd bd-t-0 rounded-bottom">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="inst_cw">Instructions:</label>
                              <textarea class="form-control" readonly rows="2" name="inst_cw" id="inst_cw"><?php echo $role['instructions']; ?></textarea>
                            </div>
                          </div>
                          <div class="row">
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
                                    <img src="<?php echo $attachment; ?>" class="card-img-top img-responsive">
                                    <?php } else { ?>
                                    <a href="#">
                                      <img src="images/notImage.png" class="card-img-top img-responsive">
                                    </a>
                                    <?php } ?>
                                  </div> 
                                </div>
                              </div>
                              <?php
                                }
                              ?>
                            </div>
                          </div>
                        </div>
                      </div><!-- card-body -->
                    </div>
                  </div>
                </div>
                <?php } else { 
                    $attachments = json_decode($role['attachments']);
                ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="card bd-0 card_output">
                      <div class="card-header tx-medium bd-0 tx-white bg-warning">
                        Content Writer Task Output - Status(<?php echo $role['status_name']; ?>)
                      </div><!-- card-header -->
                      <div class="card-body bd bd-t-0 rounded-bottom">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="inst_cw">Remarks:</label>
                              <textarea class="form-control" readonly rows="2" name="inst_cw" id="inst_cw"><?php echo $role['instructions']; ?></textarea>
                            </div>
                          </div>
                          <div class="row">
                            <?php
                            if(is_array($attachments))
                              foreach ($attachments as $attachment) {
                                $file_type = explode(".", $attachment);
                                $file_type = $file_type[1];
                            ?>
                            <div class="col-md-2">
                              <div class="card">
                                <div class="card-header">Files</div>
                                <div class="card-body">
                                  <?php if($file_type == "jpg" || $file_type == "jpeg" || $file_type == "png" || $file_type == "gif"){ ?>
                                  <img src="<?php echo $attachment; ?>" class="card-img-top img-responsive">
                                  <?php } else { ?>
                                  <a href="#">
                                    <img src="images/notImage.png" class="card-img-top img-responsive">
                                  </a>
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
                  </div>
                </div>
                <?php } ?>
              <?php
                  }
                }//end of if isset condition
              ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="card bd-0">
                    <div class="card-header tx-medium bd-0 tx-white bg-info">
                      ID Status Update
                    </div><!-- card-header -->
                    <div class="card-body bd bd-t-0 rounded-bottom">
                      <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
                      <input type="hidden" name="topic_id" value="<?php echo $topic_id; ?>">
                      <input type="hidden" name="task_assi_id" value="<?php echo $task_assi_id; ?>">
                      <input type="hidden" name="task_id" value="<?php echo $task_id; ?>">
                      <input type="hidden" name="slide_id" value="<?php echo $slide_id; ?>">
                      <input type="hidden" name="task_userid" value="<?php echo $task_userid; ?>">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="status_cw">Status:</label>
                            <select class="form-control" name="up_status_cw" id="status_cw" required>
                              <option value="">- Select Status -</option>
                              <?php
                                foreach ($getStatus as $auto_id => $status_name) {
                                  if($auto_id == 5 || $auto_id == 13 || $auto_id == 18){
                              ?>
                                  <option value="<?php echo $auto_id; ?>"><?php echo $status_name; ?></option>
                              <?php
                                  }
                                }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-12 inst_attch">
                          <div class="form-group">
                            <label for="inst_cw">Instructions:</label>
                            <textarea class="form-control" rows="2" name="up_inst_cw" id="inst_cw"></textarea>
                          </div>
                        </div>
                        <div class="col-md-12 inst_attch">
                          <div class="form-group">
                            <label for="file_cw">Attach Files:</label>
                            <div class="file-loading">
                              <input id="file-1" type="file" name="up_cw_files[]" multiple class="file" data-overwrite-initial="false">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div><!-- card-body -->
                  </div>
                </div>
              </div>
            </div><!-- modal-body -->
            <div class="modal-footer" style="display:flex;align-items:center;justify-content:flex-end;padding:15px;border-top:1px solid #e9ecef;">
              <a href="<?php echo $web_root; ?>app/taskList.php" class="btn btn-md btn-danger">Cancel</a>
              <input type="submit" name = "submit" value="Submit" class="btn btn-md btn-info" />
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
        $(window).load(function(){
          $(".templates").trigger("click");
        });

        $(".inst_attch").hide();
        $("#status_cw").change(function(){
          var sts = $(this).val();
          if(sts == 5){
            $(".inst_attch").show(1000);
          } else {
            $(".inst_attch").hide(1000);
          }
        });
        $("#inst_btn").hide();
        $("#inst_btn").click(function(){
          console.log($('#modaldemo3.in').length > 0);
          $(".inst_btn").hide();
        });
        $("#success_slide, #fail_slide").hide();
        $(".close").click(function(){
          $(".inst_btn").show();
        });
        $(".templates").click(function(){
          var templateid = $(this).attr("data-id");

          var object = "<object width='100%' height='670px' data="+templateid+'?'+Math.random()*Math.random()+"></object>";
          $('#div1').html(object);
          $("#inst_btn").show(); 
        });
        
        $('#task_reply').on('submit', function(event){
          event.preventDefault();
          $.ajax({
            url:"taskReplyProcess.php",
            method:'POST',
            data:new FormData(this),
            contentType:false,
            processData:false,
            success:function(data)
            {
              console.log(data);
              var json = $.parseJSON(data);
              if(json.status){
                console.log("if");
                $("#modaldemo3").modal("hide");
                $("#modalsuccess").modal('show');
                setTimeout(function(){window.top.location="../../taskList.php"} , 2000);
              } else {
                console.log("else");
                $("#modaldemo3").modal("hide");
                //$("#success_msg").append(json.message)
                $("#modalsuccess").modal('show');
              }
            },
            beforeSend: function(){
              $(".mLoading").addClass("active");
            },
            complete: function(){
              $(".mLoading").removeClass("active");
            }
          });
        })
      });
    </script>
  </body>
</html>
