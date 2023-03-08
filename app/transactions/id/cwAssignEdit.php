<?php
include_once "../../session_token/checksession.php";
include_once "../../configration/config.php";
include "../../functions/common_functions.php";
//include_once "../session_token/checktoken.php";
$token=$_SESSION['token'];
$logged_user_id=$_SESSION['cms_userid'];
$user_type = $_SESSION['cms_usertype'];
try{
  $getClasses = getClasses();
  $getStatus = getStatus();
  $getUsers = getUsers("",$logged_user_id);
} catch(Exception $exp){
  print_r($exp);
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
    <link href="../../../lib/bootstrap/glyphicons.css" rel="stylesheet">
    <link href="../../../lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../../../lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../../../lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../../../lib/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
    <link href="../../../lib/ajax_loader/jquery.mloading.css" rel="stylesheet">
    <!-- CMS CSS -->
    <link rel="stylesheet" href="../../../css/cms.css">
    
  </head>
  <style type="text/css">
    .br-pagebody {
      margin-top: 0px;
    }
    .br-section-wrapper {
      padding: 14px;
    }
    /*Sticky button register*/
    .center{
      position: fixed;
      top: 50%;
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
    .cw_blk,.vd_blk,.gd_blk,.tt_blk,.ass_to{
      display: none;
    }
    .ps{
      overflow-y: visible !important;
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
        width: 200px;
        height: 150px;
    }
    .table, thead{
      text-align: center;
    }
    .table-bordered > tbody > tr > td{
      vertical-align: middle;
    }
    th{
      text-align: center;
    }
    #resources .modal-lg {
      max-width: 1400px;
      width: 100%;
    }
    .btn{
      white-space: normal !important;
      word-wrap: break-word !important;
      word-break: break-all;
    }
    .tooltip{
      z-index: 1151 !important;
    }
  </style>

  <body>

    <!-- ########## START: LEFT PANEL ########## -->
    <?php include("../../fixed-blocks/reviewSlideSlidebar.php"); ?>
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <?php include("../../fixed-blocks/reviewSlideHeader.php"); ?>
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pagetitle">
        
      </div><!-- d-flex -->

      <div class="br-pagebody">
        <form method="post" id="new_task_form" enctype="multipart/form-data">
          <input type="hidden" name="slide_id" id="slide_id" value=""/>
          <input type="hidden" name="slide_classid" id="slide_classid" value=""/>
          <input type="hidden" name="slide_topicid" id="slide_topicid" value=""/>
          <input type="hidden" name="slide_path" id="slide_path" value=""/>
          <input type="hidden" name="slide_btnid" id="slide_btnid" value=""/>

          <input type="hidden" name="slide_path" id="slide_path_get" value=""/>
          <input type="hidden" name="data1" id="final_data" value=""/>

          <!-- start you own content here -->
          <div class="card h-100 d-flex flex-column justify-content-between">
            <div class="card-header card-header d-flex align-items-center justify-content-between pd-y-5 bg-dark">
              <h6 class="mg-b-0 tx-14 tx-white">Edit Slide and Update Status</h6>
              <div class="card-option tx-24">
                <div class="col-md-12">
                  <div class="form-group">
                    <select class="form-control" name="main_status" id="main_status" required="required">
                      <option value="">- Select Status -</option>
                      <?php
                        foreach ($getStatus as $auto_id => $status_name) {
                          if($auto_id == 10 || $auto_id == 11){
                            if($status_name == "Not Ok")
                              $status_name = "Edit";
                      ?>
                          <option value="<?php echo $auto_id; ?>"><?php echo $status_name; ?></option>
                      <?php
                          }
                        }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="card-option tx-24">
                <input type="submit" name = "submit" value="Submit" class="btn btn-md btn-info" />
              </div><!-- card-option -->
            </div><!-- card-header -->
            <div class="card-body">
              <input type="hidden" name="templateid" id="templateid" value=""/>
              <div id="div1"></div>
            </div><!-- card-body -->
          </div>
        </form>

        <div id="toast"><div id="img">Status</div><div id="desc"></div></div>
      </div><!-- br-pagebody -->
    </div><!-- br-mainpanel -->
    
    <div id="modaldemo3" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
      <div class="modal-dialog modal-lg" role="document" style="right: 0;transition: opacity 0.3s linear, right 0.3s ease-out;position: fixed;margin: auto;width: 620px;height: 100%;transform: translate3d(0%, 0, 0);">
        <div class="modal-content tx-size-sm" style="height: 100%;overflow-y: auto;border-radius: 0;border: none;">
          <div class="modal-header pd-x-20">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Slide Feedback</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="post" id="feedbackForm" enctype="multipart/form-data">
            <div class="modal-body pd-20">
              <input type="hidden" name="slide_id" id="feed_slide_id" value=""/>
              <input type="hidden" name="slide_classid" id="feed_slide_classid" value=""/>
              <input type="hidden" name="slide_topicid" id="feed_slide_topicid" value=""/>
              <input type="hidden" name="slide_path" id="feed_slide_path" value=""/>
              <div class="row">
                <style type="text/css">
                  .feedbackcol label.checkbox-inline {
                    margin-left: 22px;
                  }
                </style>
                <?php if($user_type == "Content Reviewer") { ?>
                  <input type="hidden" name="feedback_role" id="feedback_role" value="CR"/>
                  <div class="col-md-12 feedbackcol">
                    <label for="inputs" style="font-weight: bold;">Visual:</label> <br>
                    <label class="checkbox-inline" data-toggle="popover" data-content="Overall Layout to check alignment of text to the slide, if the text is overflowing into the template/image, alignment of image to the slide."><input id="ic" type="checkbox" class="feedbackType" name="feedbackType[]" value="Layout">Layout</label>
                    <label class="checkbox-inline" data-toggle="popover" data-content="Each slide should have between 3 - 4 bullet points. If there is more, please capture in slide feedback and ask for 1 more slide to be added. Are the icons same inside the topic."><input id="ai" type="checkbox" class="feedbackType" name="feedbackType[]" value="Number of Bullet Points">Number of Bullet Points</label>
                    <label class="checkbox-inline" data-toggle="popover" data-content="Alignment of text in the slide, line spacing must be consistent across the slide and topic"><input id="lc" type="checkbox" class="feedbackType" name="feedbackType[]" value="Formatting">Formatting</label>
                    <label class="checkbox-inline" data-toggle="popover" data-content="All headings should be in the same font size and bullet points should be in the same size inside a slide and across the topic."><input id="lc" type="checkbox" class="feedbackType" name="feedbackType[]" value="Font Size">Font Size</label> 
                    <label class="checkbox-inline" data-toggle="popover" data-content="Does the index slide have max of 4 icons in a row"><input id="lc" type="checkbox" class="feedbackType" name="feedbackType[]" value="Index">Index</label> <br />
                    <label for="inputs" style="margin-left: 0px;font-weight: bold;">Overall Coherence at topic level:</label> <br />
                    <label class="checkbox-inline" data-toggle="popover" data-content="To check if every slide has a heading and if it is properly aligned. Are the headings relevant to the context of the topic."><input id="cc" type="checkbox" class="feedbackType" name="feedbackType[]" value="Headings">Headings</label>
                    <label class="checkbox-inline" data-toggle="popover" data-content="Is the content and its flow matching the overall learning outcome."><input id="cc" type="checkbox" class="feedbackType" name="feedbackType[]" value="Content">Content</label>
                    <label class="checkbox-inline" data-toggle="popover" data-content="Is the content matching the overall flow across the classes"><input id="cc" type="checkbox" class="feedbackType" name="feedbackType[]" value="Flow">Flow</label>
                    <label class="checkbox-inline" data-toggle="popover" data-content="Are the responses of the activities, scenarios & CYU correct"><input id="cc" type="checkbox" class="feedbackType" name="feedbackType[]" value="Responses">Responses</label>
                    <label class="checkbox-inline" data-toggle="popover" data-content="Do all the slides have images and are the images relevant to the content and are age appropriate"><input id="cc" type="checkbox" class="feedbackType" name="feedbackType[]" value="Image and Relevance">Image and Relevance</label>
                    <label class="checkbox-inline" data-toggle="popover" data-content="Are the words used and the images in the slides age appropriate"><input id="cc" type="checkbox" class="feedbackType" name="feedbackType[]" value="Age appropriateness">Age appropriateness</label>
                    <label class="checkbox-inline" data-toggle="popover" data-content="All the content, scenarios, activities and CYU needs to be connected to the learning outcome for each topic."><input id="cc" type="checkbox" class="feedbackType" name="feedbackType[]" value="Connect from Start to end">Connect from Start to end</label>
                    <label class="checkbox-inline" data-toggle="popover" data-content="Is there overall consistency in the topic (Language, images, bullet points, Scenario, Activity & CYU)"><input id="cc" type="checkbox" class="feedbackType" name="feedbackType[]" value="Consistency">Consistency</label>
                  </div>
                <?php } else { ?>
                <div class="col-md-12 feedbackcol">
                  <label for="inputs" style="font-weight: bold;">Feedback For:</label> <br>
                  <label class="checkbox-inline"><input id="ic" type="checkbox" class="feedbackType" name="feedbackType[]" value="Template">Template</label>
                  <label class="checkbox-inline"><input id="ai" type="checkbox" class="feedbackType" name="feedbackType[]" value="Image">Image</label>
                  <label class="checkbox-inline"><input id="lc" type="checkbox" class="feedbackType" name="feedbackType[]" value="Heading">Heading</label>
                  <label class="checkbox-inline"><input id="lc" type="checkbox" class="feedbackType" name="feedbackType[]" value="Movement">Movement</label>
                  <label class="checkbox-inline"><input id="lc" type="checkbox" class="feedbackType" name="feedbackType[]" value="Layout">Layout</label>
                  <label class="checkbox-inline"><input id="lc" type="checkbox" class="feedbackType" name="feedbackType[]" value="Drop">Drop</label> <br />
                  <label for="inputs" style="margin-left: 9px;font-weight: bold;">Content:</label> <br />
                  <label class="checkbox-inline"><input id="cc" type="checkbox" class="feedbackType" name="feedbackType[]" value="Rewrite Sentence">Rewrite Sentence</label>
                  <label class="checkbox-inline"><input id="cc" type="checkbox" class="feedbackType" name="feedbackType[]" value="Change flow">Change flow</label>
                  <label class="checkbox-inline"><input id="cc" type="checkbox" class="feedbackType" name="feedbackType[]" value="Rewrite Story">Rewrite Story</label>
                  <label class="checkbox-inline"><input id="cc" type="checkbox" class="feedbackType" name="feedbackType[]" value="Add new activity">Add new activity</label>
                </div>
                <?php } ?>
                <div class="col-md-12">
                  <!-- <button type="button" class="btn btn-secondary" data-toggle="popover" title="Popover title" data-content="Default popover">
                    Hover me
                  </button> -->
                  <br/>
                  <div class="form-group">
                    <label for="feedback">Feedback:</label>
                    <textarea class="form-control" rows="5" name="feedback" id="feedback"></textarea required>
                  </div>
                </div>
              </div><!-- Common Form -->
            </div><!-- modal-body -->
            <div class="modal-footer">
              <input type="submit" name = "submit" value="Submit" class="btn btn-md btn-info" />
            </div>
          </form>
        </div>
      </div><!-- modal-dialog -->
    </div>
    
    <!-- LARGE MODAL -->
    <div id="resources" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1">
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
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->
    <div class="center inst_btn hidden-xs-block hidden-sm-block visible-md-block visible-lg-block" data-toggle="modal" data-target="#modaldemo3" id="inst_btn">
        <a href="#">Slide Feedback</a>
    </div>


    <div class="modal fade" id="info">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <!-- Modal body -->
        <div class="modal-body">
          <div class="card text-center">
            <div class="card-body">
              <p class="font-weight-bold text-info">Don't copy and paste from any document(Ex- ppt/word/excel) While edit the slide. </p>
            </div>
          </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger info_close_btn" data-dismiss="modal">close</button>
        </div>

      </div>
    </div>
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
    <script src="../../../lib/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
    <script src="../../../lib/ajax_loader/jquery.mloading.js"></script>
    <script src="../../../lib/jqueryToast/jquery.toaster.js"></script>
    <script src="../../../js/cms.js"></script>
    <script>

      $(function () {
        $("#info").modal("show");
      }); 



      function launch_toast() {
          var x = document.getElementById("toast")
          x.className = "show";
          setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
      }
      $(function(){
        'use strict';

        $('[data-toggle="popover"]').popover({
            placement : 'bottom',
            trigger : 'hover'
        });
        $("#inst_btn").hide();
        $("#inst_btn").click(function(){
          //console.log($('#modaldemo3.in').length > 0);
          $(".inst_btn").hide();
        });
        $(".close").click(function(){
          $(".inst_btn").show();
        });

        
        $("#main_status").change(function(){
          var main_status = $(this).val();
          if(main_status == 11) {
            $("#cw_blk").removeClass("cw_blk");


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
              var templateid= $("#templateid").val();
              console.log(templateid);
              $.ajax({
                url:"../../apis/getContentImages/getResourceImages.php",
                method:'POST',
                data:"class_id="+$('#slide_classid').val()+"&topic_id="+$('#slide_topicid').val()+"&ref=images",
                success:function(data)
                {
                  $("#img_table").html(data);
                  $("input#tags").tagsinput('input');
                  imgUploadRes();

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
          } else {
            $("#cw_blk").addClass("cw_blk");
          }
        });

        $('#new_task_form').on('submit', function(event){
          event.preventDefault();
          if($("#main_status").val() == 10){
            $.ajax({
              url:"cwAssignEditProcess.php",
              method:'POST',
              data:new FormData(this),
              contentType:false,
              processData:false,
              success:function(data)
              {
                //console.log(data);
                var json = $.parseJSON(data);
                console.log(json.status);
                if(json.status){
                  document.getElementById("new_task_form").reset();
                  $("#main_status").val("");
                  $('#div1').html("");
                  $.toaster({ message : 'Successfully Updated.', title :'', priority : 'success' });
                  if(json.slide == "ok") {
                    $('#'+json.slide_id_name+ " .slideicon").html("<i style='color:red;font-size:19px' class='icon ion-checkmark-circled'></i>");
                  }
                  else {
                    $('#'+json.slide_id_name+ " .slideicon").html("<i style='color:red;font-size:19px' class='icon ion-backspace'></i>");
                  }
                  console.log("success");
                } else {
                  $.toaster({ message : 'Are you getting error, Please contact tech team.', title : 'Oh No!', priority : 'danger' });
                  console.log("fail");
                }
              },
              beforeSend: function(){
                $("body").mLoading()
              },
              complete: function(){
                $("body").mLoading('hide')
              }
            });
          } else {
            $("body iframe#iframe_id").contents().find("body").attr("contenteditable", "false");
            var resdata = $("body #iframe_id").contents().find("html").html();
            console.log(resdata);
            var slide_path = $("#templateid").val();
            $("#slide_path_get").val(slide_path);
            $("#final_data").val(resdata);
            $.ajax({
              url:"cwEditSlideProcess.php",
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
              url:"cwTaskReplyProcess.php",
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
                  //$('#div1').html("");
                  $('#'+json.slide_id_name+ " .slideicon").html("<i style='color:red;font-size:19px' class='icon ion-backspace'></i>");
                  $("#desc").append(json.message);
                  $("#main_status").val("");
                  launch_toast();
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
          
          }
        });

        $("#class_name").change(function(){
          var class_id = $(this).val();
          if(class_id != ""){
            $.ajax({
              type: "POST",
              url: "../../apis/tasks/getTopics.php",
              data: 'classes='+class_id,
              success: function(data){
                var data = $.parseJSON(data);
                var options = '<option value="">-Select Topics-</option>';
                if(data != null) {
                  for (var i = 0; i < data.length; i++) {
                    {
                      options += '<option value="' + data[i].id + '">' + data[i].description + '</option>';
                    }
                  }
                } else {
                  options += '<option value="" disabled>No Topics Availlable</option>';
                }
                $("#topic").html(options);
              },
              beforeSend: function(){
                $("body").mLoading()
              },
              complete: function(){
                $("body").mLoading('hide')
              }
            });
          } else {
            var options = '<option value="">-Select Topics-</option>';
            $("#topic").html(options);
          }
        });

        $("#topic").change(function(){
          document.getElementById("feedbackForm").reset();

          var class_id = $("#class_name").val();
          var topic_id = $(this).val();
          $('#div1').html("");
          $.ajax({
            type: "POST",
            url: "../../apis/tasks/getReviewSlides.php",
            data: 'class_id='+class_id+'&topic_id='+topic_id,
            success: function(data){
              var data = $.parseJSON(data);
              var slides = '';
              if(data.length > 0) {
                //$("#inst_btn").show();
                for (var i = 0; i < data.length; i++) {
                  {
                    slides += data[i];
                  }
                }
              } else {
                slides += '<div class="col-md-12 mg-t-20 mg-md-t-0"><div class="card bd-0"><img class="card-img-top img-fluid" src="../id/images/notImage.png" alt="Image"><div class="card-body rounded-bottom"><button class="d-block mx-auto btn btn-md btn-warning templates" data-id="">Choose Class and Topic</button></div></div></div>';
              }
              $("#review_div").html(slides).show(1000);

              $(".review_slide_btn").click(function(){
                document.getElementById("feedbackForm").reset();
                $("#inst_btn").show();
                $(".review_slide_btn").removeClass("active");
                $(this).addClass("active");


                var slidepath = $(this).attr("data-id");
                var slidepath_id = $(this).attr("data-val");
                var slidepath_classid = $(this).attr("data-val1");
                var slidepath_topicid = $(this).attr("data-val2");
                var slide_btnid = this.id;
                
                $("#main_status").val("");
                $("#slide_id").val(slidepath_id);
                $("#slide_classid").val(slidepath_classid);
                $("#slide_topicid").val(slidepath_topicid);
                $("#slide_path").val(slidepath);
                $("#slide_btnid").val(slide_btnid);

                $("#feed_slide_id").val($("#slide_id").val());
                $("#feed_slide_classid").val($("#slide_classid").val());
                $("#feed_slide_topicid").val($("#slide_topicid").val());
                $("#feed_slide_path").val($("#slide_path").val());
                console.log(slidepath);
                var templateid = $("#templateid").val(slidepath);
                var object = "<iframe id='iframe_id' frameborder='0' width='100%' height='675px' src="+slidepath+'?'+Math.random()*Math.random()+"></iframe>"
                $('#div1').html(object);
                //$("#inst_btn").show();
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


        $('#feedbackForm').on('submit', function(event){
          event.preventDefault();
          var feedbackType = new Array();
          $(".feedbackType:checked").each(function() {
            feedbackType.push($(this).val());
          });
          //console.log(dept.length);
          if(feedbackType.length != 0)
          {
            $.ajax({
              url:"slideFeedbackProcess.php",
              method:'POST',
              data:new FormData(this),
              contentType:false,
              processData:false,
              success:function(data)
              {
                $(".inst_btn").hide();
                //console.log(data);
                var json = $.parseJSON(data);
                console.log(json.status);
                if(json.status){
                  $('#div1').html("");
                  $("#modaldemo3").modal("hide");
                  document.getElementById("feedbackForm").reset();
                  $.toaster({ message : 'Successfully Updated.', title :'', priority : 'success' });
                  console.log("success");
                } else {
                  $.toaster({ message : 'Fail to update feedback, Please contact tech team.', title : 'Oh No!', priority : 'danger' });
                  console.log("fail");
                }
              },
              beforeSend: function(){
                $("body").mLoading()
              },
              complete: function(){
                $("body").mLoading('hide')
              }
            });
          }
          else
          {
            alert("Atleast select any one feedback type");
          }
        });
        
        function imgUploadRes() {
          $('#img_upload').on('submit', function(event){
            event.preventDefault();
            $.ajax({
              url:'../../apis/getContentImages/uploadImagesEES.php?class_id='+$('#slide_classid').val()+'&topics_id='+$('#slide_topicid').val(),
              method:'POST',
              data:new FormData(this),
              contentType:false,
              processData:false,
              success:function(data)
              {
                var json = $.parseJSON(data);
                console.log(json);
                document.getElementById("img_upload").reset(); 
                $('input#tags').tagsinput('removeAll');

                $.ajax({
                  url:"../../apis/getContentImages/getResourceImages.php",
                  method:'POST',
                  data:"class_id="+$('#slide_classid').val()+"&topic_id="+$('#slide_topicid').val()+"&ref=images",
                  success:function(data)
                  {
                    $("input#tags").tagsinput('input');
                    $("#img_table").html(data);

                    $('.imgpath').change(function(){
                      var imgpath = $( 'input[name=imgpath]:checked' ).val();
                      var templateid= $("#templateid").val();
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
                  }
                });
              }
            });
          });
        }
      });
    </script>
  </body>
</html>
