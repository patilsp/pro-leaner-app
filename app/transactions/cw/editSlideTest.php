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
$class_id = $_GET['class'];
$topic_id = $_GET['topic'];
$slide_id = $_GET['slide'];

$getTaskStatus = getTaskStatus1($task_id,$task_assi_id);
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

      #toast {
          visibility: hidden;
          max-width: 50px;
          height: 50px;
          /*margin-left: -125px;*/
          margin: auto;
          background-color: #333;
          color: #fff;
          text-align: center;
          border-radius: 2px;

          position: fixed;
          z-index: 1;
          left: 0;right:0;
          bottom: 30px;
          font-size: 17px;
          white-space: nowrap;
      }
      #toast #img{
        width: 50px;
        height: 50px;
          
          float: left;
          
          padding-top: 16px;
          padding-bottom: 16px;
          
          box-sizing: border-box;

          
          background-color: #111;
          color: #fff;
      }
      #toast #desc{

          
          color: #fff;
         
          padding: 16px;
          
          overflow: hidden;
        white-space: nowrap;
      }

      #toast.show {
          visibility: visible;
          -webkit-animation: fadein 0.5s, expand 0.5s 0.5s,stay 3s 1s, shrink 0.5s 2s, fadeout 0.5s 2.5s;
          animation: fadein 0.5s, expand 0.5s 0.5s,stay 3s 1s, shrink 0.5s 4s, fadeout 0.5s 4.5s;
      }

      @-webkit-keyframes fadein {
          from {bottom: 0; opacity: 0;} 
          to {bottom: 30px; opacity: 1;}
      }

      @keyframes fadein {
          from {bottom: 0; opacity: 0;}
          to {bottom: 30px; opacity: 1;}
      }

      @-webkit-keyframes expand {
          from {min-width: 50px} 
          to {min-width: 350px}
      }

      @keyframes expand {
          from {min-width: 50px}
          to {min-width: 350px}
      }
      @-webkit-keyframes stay {
          from {min-width: 350px} 
          to {min-width: 350px}
      }

      @keyframes stay {
          from {min-width: 350px}
          to {min-width: 350px}
      }
      @-webkit-keyframes shrink {
          from {min-width: 350px;} 
          to {min-width: 50px;}
      }

      @keyframes shrink {
          from {min-width: 350px;} 
          to {min-width: 50px;}
      }

      @-webkit-keyframes fadeout {
          from {bottom: 30px; opacity: 1;} 
          to {bottom: 60px; opacity: 0;}
      }

      @keyframes fadeout {
          from {bottom: 30px; opacity: 1;}
          to {bottom: 60px; opacity: 0;}
      }
      #img_table img {
          width: 32px;
          height: 32px;
      }
    </style>
  </head>

  <body>

    <!-- ########## START: LEFT PANEL ########## -->
    <?php include("../../fixed-blocks/edit_slide_sidebar_test.php"); ?>
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
                  <h5 class="modal-title" id="exampleModalLongTitle">Preview</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div id="data"></div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          <input type="hidden" name="templateid" id="templateid" value=""/>
          <div id="div1"></div>

          <iframe id='iframe_id' frameborder="0" width='100%' height='675px' src=""></iframe>
          <!-- LARGE MODAL -->
        </div>
      </div><!-- br-pagebody -->
      <div id="toast"><div id="img">Status</div><div id="desc"></div></div>
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
              <input type="submit" name="save_submit" value="Save & Submit" id="save_submit" class="btn btn-md btn-info" />
              <div class="alert alert-info alert-solid" id="save_submit_alert" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                  <i class="icon ion-ios-information alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
                  <span><strong>Processing!</strong> Please Wait...</span>
                </div><!-- d-flex -->
              </div>
              <div class="alert alert-success alert-solid" id="save_submit_alert_succ" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                  <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
                  <span><strong>Updated!</strong> Slide Sent to Review.</span>
                </div><!-- d-flex -->
              </div>
            </div>
          </form>
        </div>
      </div><!-- modal-dialog -->
    </div>
    <div class="center inst_btn" data-toggle="modal" data-target="#modaldemo3" id="inst_btn">
        <a href="#">Instruction</a>
    </div>

    <!-- LARGE MODAL -->
    <div id="resources" class="modal fade">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content tx-size-sm">
          <div class="modal-header pd-x-20">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Images</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body pd-20">
            <div class="row">
              <div class="col-md-12" id="img_table">
                
              </div>
            </div>
          </div><!-- modal-body -->
          <div class="modal-footer">
            <button type="button" class="btn btn-primary tx-size-xs">Save changes</button>
            <button type="button" class="btn btn-secondary tx-size-xs" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->

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
      function launch_toast() {
          var x = document.getElementById("toast")
          x.className = "show";
          setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
      }

      //jQuery( document ).ready(function( $ ) {
      $(function(){
        'use strict';

        $("#save_submit_alert").hide();
        $("#save_submit_alert_succ").hide();

        $("#inst_btn").hide();
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

        $(document).on("click", "button.delli" , function(){
          $(this).closest('li').remove();
        });
        $(document).on("click", "button.addli" , function(){
          $(this).closest('li').clone().insertAfter($(this).closest('li'));
          $(this).closest('ul').find('button').remove();
        });
        $('#div1').on("mouseenter", "li p", function() {
          $(this).append('<button contenteditable="false" class="addli btn btn-md btn-success">+</button><button contenteditable="false" class="delli btn btn-md btn-danger">-</button>');
        });
        $('#div1').on("mouseleave", "li p", function() {
          $(this).find('button').remove();
        });

        $("#preview").click(function(event){
          var resdata = $("#div1").html();
          $("#privew").modal("show");
          $("#data").html(resdata);
        });

        $('#task_reply').on('submit', function(event){
          event.preventDefault();
          $("#save_submit_alert").show(1000);
          $("#save_submit").hide(1000);
          $("body iframe#iframe_id").contents().find("body").attr("contenteditable", "false");
          var resdata = $("body #iframe_id").contents().find("html").html();
          console.log(resdata);
          var slide_path = $("#templateid").val();
          $("#slide_path_get").val(slide_path);
          $("#final_data").val(resdata);
          $.ajax({
            url:"editSlideTestProcess.php",
            method:'POST',
            async:true,
            data:new FormData(this),
            contentType:false,
            processData:false,
            success:function(data)
            {
              console.log(data);
              $(".close").trigger('click');
            },
            beforeSend: function(){
              $(".mLoading").addClass("active");
            },
            complete: function(){
              $(".mLoading").removeClass("active");
            }
          });

          $.ajax({
            url:"taskReplyProcess.php",
            method:'POST',
            async:true,
            data:new FormData(this),
            contentType:false,
            processData:false,
            success:function(data)
            {
              console.log(data);
              var json = $.parseJSON(data);
              if(json.status){
                $("#save_submit_alert_succ").show(1000);
                $("#save_submit_alert").hide(1000);
                $(".close").trigger('click');
                $("#desc").append(json.message);
                launch_toast();

                window.setTimeout(function(){
                  location.href = "../../taskListOTR.php";
                }, 2000);
              } else {
                $(".close").trigger('click');
                $("#desc").append(json.message);
                launch_toast();
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

      $(".templates").click(function(){
        var templateid = $(this).attr("data-id");
        $("#templateid").val(templateid);
        $("iframe").attr("src",templateid);
        $("#inst_btn").show();
        $("#enableEdit").click(function() {
          $(this).text("Edit Enabled");
          $(this).removeClass("btn-info");
          $(this).addClass("btn-success");
          $("body iframe#iframe_id").contents().find("body").attr("contenteditable", "true");

          $("body #iframe_id").contents().find("li").on("mouseenter", function() {
            $(this).find('button').remove();
            $(this).append('<button contenteditable="false" class="addli btn btn-md btn-success">+</button><button contenteditable="false" class="delli btn btn-md btn-danger">-</button>');
          });

          $("body #iframe_id").contents().find("li").on("mouseleave", function() {
            $(this).find('button').remove();
          });

          $("body #iframe_id").contents().on("click", "button.addli", function() {
            $(this).closest('li').clone().insertAfter($(this).closest('li'));
            $(this).closest('ul').find('button').remove();


            $("body #iframe_id").contents().find("li").on("mouseenter", function() {
              console.log("came");
              $(this).find('button').remove();
              $(this).append('<button contenteditable="false" class="addli btn btn-md btn-success">+</button><button contenteditable="false" class="delli btn btn-md btn-danger">-</button>');
            });

            $("body #iframe_id").contents().find("li").on("mouseleave", function() {
              $(this).find('button').remove();
            });
          });

          $("body #iframe_id").contents().on("click", "button.delli", function() {
            $(this).closest('li').remove();
          });

          $("#iframe_id").contents().find("img").attr("contenteditable", "false");
          //interacting iframe
          $("#iframe_id").contents().find("img").click(function() {
            $("#iframe_id").contents().find("img").removeClass("replace_img");
            $(this).addClass("replace_img");
            $("#resources").modal('show');
            $.ajax({
              url:"../../apis/getContentImages/getImages.php",
              method:'POST',
              data:"ref=images",
              success:function(data)
              {
                $("#img_table").html(data);
                $('.imgpath').change(function(){
                  var imgpath = $( 'input[name=imgpath]:checked' ).val();
                  $.ajax({
                    url:"../../apis/getContentImages/copyImage.php",
                    method:'POST',
                    data:"imgpath="+imgpath+"&dest_path="+templateid,
                    success:function(data)
                    {
                      if(data != "error"){
                        $("#resources").modal('hide');
                        $("#iframe_id").contents().find(".replace_img").attr('src', data);
                      } else {
                        console.log(data);
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
        });
        
        //console.log($("body iframe#iframe_id").contents().find("body").html());
        /*var pagedata = "";
        $.ajax({
          url:"loadSlide.php",
          method:'POST',
          cache: false,
          data:"file_path="+templateid,
          success:function(data)
          {
            $("#div1").html(data);
            $("img").attr("contenteditable", "false");
            $("#div1 img").click(function(){
              $("img").removeClass("replace_img");
              $(this).addClass("replace_img");
              $("#resources").modal('show');
              $.ajax({
                url:"../../apis/getContentImages/getImages.php",
                method:'POST',
                data:"ref=images",
                success:function(data)
                {
                  $("#img_table").html(data);
                  $('.imgpath').change(function(){
                    var imgpath = $( 'input[name=imgpath]:checked' ).val();
                    $.ajax({
                      url:"../../apis/getContentImages/copyImage.php",
                      method:'POST',
                      data:"imgpath="+imgpath+"&dest_path="+templateid,
                      success:function(data)
                      {
                        if(data != "error"){
                          $("#resources").modal('hide');
                          $(".replace_img").attr('src',data);
                        } else {
                          console.log(data);
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
            $("#inst_btn").show();
          },
          beforeSend: function(){
            $(".mLoading").addClass("active");
          },
          complete: function(){
            $(".mLoading").removeClass("active");
          }
        });*/ 
      });
      $(window).load(function(){
        $(".templates").trigger("click");
      });
    </script>
  </body>
</html>
