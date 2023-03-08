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
    <link href="../../../lib/ajax_loader/jquery.mloading.css" rel="stylesheet">
    <link href="../../../lib/fileinputs/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
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
    .cw_blk,.vd_blk,.gd_blk,.tt_blk,.ass_to{
      display: none;
    }
    .ps{
      overflow-y: visible !important;
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
        <!-- start you own content here -->
        <div class="br-section-wrapper">
          <h6 class="br-section-label">Review Topics and Assign Work</h6>
          <div id="div1"></div>
        </div>
      </div><!-- br-pagebody -->
    </div><!-- br-mainpanel -->
    <div id="modaldemo3" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
      <div class="modal-dialog modal-lg" role="document" style="right: 0;transition: opacity 0.3s linear, right 0.3s ease-out;position: fixed;margin: auto;width: 620px;height: 100%;transform: translate3d(0%, 0, 0);">
        <div class="modal-content tx-size-sm" style="height: 100%;overflow-y: auto;border-radius: 0;border: none;">
          <div class="modal-header pd-x-20">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Instruction</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="post" id="new_task_form" enctype="multipart/form-data">
            <div class="modal-body pd-20">
              <input type="hidden" name="slide_id" id="slide_id" value=""/>
              <input type="hidden" name="slide_classid" id="slide_classid" value=""/>
              <input type="hidden" name="slide_topicid" id="slide_topicid" value=""/>
              <input type="hidden" name="slide_path" id="slide_path" value=""/>
              <input type="hidden" name="slide_btnid" id="slide_btnid" value=""/>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="status_cw">Status:</label>
                    <select class="form-control" name="main_status" id="main_status">
                      <option value="">- Select Status -</option>
                      <?php
                        foreach ($getStatus as $auto_id => $status_name) {
                          if($auto_id == 10 || $auto_id == 11){
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
              <div class="row ass_to" id="ass_to">
                <div class="col-md-12">
                  <label for="inputs">Assigned To:</label> <br>
                  <label class="checkbox-inline"><input id="CW" type="checkbox" class="dept_type" name="assign_to[]" value="CW">Content Writer</label>
                  <!-- <label class="checkbox-inline"><input id="VD" type="checkbox" class="dept_type" name="assign_to[]" value="VD">Visual Designer</label>
                  <label class="checkbox-inline"><input id="GD" type="checkbox" class="dept_type" name="assign_to[]" value="GD">Graphic Designer</label> -->
                  <label class="checkbox-inline"><input id="TT" type="checkbox" class="dept_type" name="assign_to[]" value="TT">Tech Team</label>
                </div>
              </div><!-- Common Form -->
              <div class="row">
                <div class="col-md-12">
                  <div id="accordion6" class="accordion accordion-head-colored accordion-info mg-t-20" role="tablist" aria-multiselectable="true">
                    <div class="card cw_blk" id="cw_blk">
                      <div class="card-header" role="tab" id="headingOne6">
                        <h6 class="mg-b-0">
                          <a data-toggle="collapse" data-parent="#accordion6" href="#cw" aria-expanded="true" aria-controls="cw">
                            Content Writer
                          </a>
                        </h6>
                      </div><!-- card-header -->

                      <div id="cw" class="collapse show" role="tabpanel" aria-labelledby="headingOne6">
                        <div class="card-block pd-20">
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="user_cw">Assign To:</label>
                                <select class="form-control" name="user_cw" id="user_cw">
                                  <option value="">-Select User-</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-8">
                              <div class="form-group">
                                <label for="inst_cw">Instructions:</label>
                                <textarea class="form-control" rows="5" name="inst_cw" id="inst_cw"></textarea>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="file_cw">Reference Files:</label>
                                <div class="file-loading">
                                  <input id="file-1" type="file" name="cw_files[]" multiple class="file" data-overwrite-initial="false">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card vd_blk" id="vd_blk">
                      <div class="card-header" role="tab" id="headingTwo6">
                        <h6 class="mg-b-0">
                          <a class="collapsed transition" data-toggle="collapse" data-parent="#accordion6" href="#vd" aria-expanded="false" aria-controls="vd">
                            Visual Designer
                          </a>
                        </h6>
                      </div>
                      <div id="vd" class="collapse" role="tabpanel" aria-labelledby="headingTwo6">
                        <div class="card-block pd-20">
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="user_vd">Assign To:</label>
                                <select class="form-control" name="user_vd" id="user_vd">
                                  <option value="">- Select User -</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-8">
                              <div class="form-group">
                                <label for="inst_vd">Instructions:</label>
                                <textarea class="form-control" rows="5" name="inst_vd" id="inst_vd"></textarea>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="file_vd">Reference Files:</label>
                                <div class="file-loading">
                                  <input id="file_vd" type="file" name="vd_files[]" multiple class="file" data-overwrite-initial="false">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card gd_blk" id="gd_blk">
                      <div class="card-header" role="tab" id="headingThree6">
                        <h6 class="mg-b-0">
                          <a class="collapsed transition" data-toggle="collapse" data-parent="#accordion6" href="#gd" aria-expanded="false" aria-controls="gd">
                            Graphic Designer
                          </a>
                        </h6>
                      </div>
                      <div id="gd" class="collapse" role="tabpanel" aria-labelledby="headingThree6">
                        <div class="card-block pd-20">
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="user_gd">Assign To:</label>
                                <select class="form-control" name="user_gd" id="user_gd">
                                  <option value="">- Select User -</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-8">
                              <div class="form-group">
                                <label for="inst_gd">Instructions:</label>
                                <textarea class="form-control" rows="5" name="inst_gd" id="inst_gd"></textarea>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="file_gd">Reference Files:</label>
                                <div class="file-loading">
                                  <input id="file_gd" type="file" name="gd_files[]" multiple class="file" data-overwrite-initial="false">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><!-- collapse -->
                    </div>
                    <div class="card tt_blk" id="tt_blk">
                      <div class="card-header" role="tab" id="headingFour6">
                        <h6 class="mg-b-0">
                          <a class="collapsed transition" data-toggle="collapse" data-parent="#accordion6" href="#tt" aria-expanded="true" aria-controls="tt">
                            Tech Team
                          </a>
                        </h6>
                      </div>
                      <div id="tt" class="collapse show" role="tabpanel" aria-labelledby="headingFour6">
                        <div class="card-block pd-20">
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="user_tt">Assign To:</label>
                                <select class="form-control" name="user_tt" id="user_tt">
                                  <option value="">- Select User -</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-8">
                              <div class="form-group">
                                <label for="inst_tt">Instructions:</label>
                                <textarea class="form-control" rows="5" name="inst_tt" id="inst_tt"></textarea>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="file_tt">Reference Files:</label>
                                <div class="file-loading">
                                  <input id="file_tt" type="file" name="ttfiles[]" multiple class="file" data-overwrite-initial="false">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><!-- collapse -->
                    </div><!-- card -->
                  </div><!-- accordion -->
                </div>
              </div>
            </div><!-- modal-body -->
            <div class="modal-footer">
              <input type="submit" name = "submit" value="Submit" class="btn btn-md btn-info" />
            </div>
          </form>
        </div>
      </div><!-- modal-dialog -->
    </div>
    <div class="center inst_btn hidden-xs-block hidden-sm-block visible-md-block visible-lg-block" data-toggle="modal" data-target="#modaldemo3" id="inst_btn">
        <a href="#">Instruction</a>
    </div>
    
    <!-- ########## END: MAIN PANEL ########## -->
    <script src="../../../lib/jquery/jquery.js"></script>
    <script src="../../../lib/popper.js/popper.js"></script>
    <script src="../../../lib/fileinputs/js/fileinput.js" type="text/javascript"></script>
    <script src="../../../lib/bootstrap/js/bootstrap.js"></script>
    <script src="../../../lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="../../../lib/moment/moment.js"></script>
    <script src="../../../lib/jquery-ui/jquery-ui.js"></script>
    <script src="../../../lib/jquery-switchbutton/jquery.switchButton.js"></script>
    <script src="../../../lib/peity/jquery.peity.js"></script>
    <script src="../../../lib/ajax_loader/jquery.mloading.js"></script>
    <script src="../../../lib/jqueryToast/jquery.toaster.js"></script>
    <script src="../../../js/cms.js"></script>
    <script>
      $(function(){
        'use strict';
        $("#inst_btn").hide();
        $("#inst_btn").click(function(){
          //console.log($('#modaldemo3.in').length > 0);
          $(".inst_btn").hide();
        });
        $(".close").click(function(){
          $(".inst_btn").show();
        });

        $("#file-1, #file_vd, #file_gd, #file_tt").fileinput({
          theme: 'fa',
          uploadUrl: '#', // you must set a valid URL here else you will get an error
          showUpload: false, // hide upload button
          allowedFileExtensions: ['jpg', 'png', 'gif', 'pdf', 'xlsx', 'xls', 'csv'],
          overwriteInitial: false,
          maxFileSize: 1000,
          maxFilesNum: 10,
          //allowedFileTypes: ['image', 'video', 'flash'],
          slugCallback: function (filename) {
            return filename.replace('(', '_').replace(']', '_');
          }
        });

        $("#main_status").change(function(){
          var main_status = $(this).val();
          if(main_status == 11) {
            $("#ass_to").removeClass("ass_to");
          } else {
            $("#ass_to").addClass("ass_to");
            $("#cw_blk").addClass("cw_blk");
            $("#vd_blk").addClass("vd_blk");
            $("#gd_blk").addClass("gd_blk");
            $("#tt_blk").addClass("tt_blk");
          }
        });

        $('input[type="checkbox"]').click(function(){
          var id_cw = $("#CW").val();
          var id_vd = $("#VD").val();
          var id_gd = $("#GD").val();
          var id_tt = $("#TT").val();
          
          if($("#CW").prop("checked") == true && id_cw == "CW"){
            $("#user_cw").attr("required", "required");
            $("#cw_blk").removeClass("cw_blk");
            $("#file-1").fileinput();
            $.ajax({
              type: "POST",
              url: "apis/getUsers.php",
              data: 'checkeddept='+id_cw,
              success: function(data){
                var data = $.parseJSON(data);
                var options = '<option value="">-Select User-</option>';
                if(data != null) {
                  for (var i = 0; i < data.length; i++) {
                    {
                      options += '<option value="' + data[i].id + '">' + data[i].username + '</option>';
                    }
                  }
                } else {
                  options += '<option value="" disabled>No Users Availlable of this Role</option>';
                }
                $("#user_cw").html(options);
              },
              beforeSend: function(){
                $("body").mLoading()
              },
              complete: function(){
                $("body").mLoading('hide')
              }
            });
          }
          else if($("#CW").prop("checked") == false){
            $("#cw_blk").addClass("cw_blk");
            console.log("Checkbox is unchecked.");
            $("#user_cw").removeAttr("required");
          }
          if($("#VD").prop("checked") == true && id_vd == "VD"){
            $("#user_vd").attr("required", "required");
            $("#vd_blk").removeClass("vd_blk");
            $("#file_vd").fileinput();
            $.ajax({
              type: "POST",
              url: "apis/getUsers.php",
              data: 'checkeddept='+id_vd,
              success: function(data){
                var data = $.parseJSON(data);
                var options = '<option value="">-Select User-</option>';
                if(data != null) {
                  for (var i = 0; i < data.length; i++) {
                    {
                      options += '<option value="' + data[i].id + '">' + data[i].username + '</option>';
                    }
                  }
                } else {
                  options += '<option value="" disabled>No Users Availlable of this Role</option>';
                }
                $("#user_vd").html(options);
              },
              beforeSend: function(){
                $("body").mLoading()
              },
              complete: function(){
                $("body").mLoading('hide')
              }
            });
          }
          else if($("#VD").prop("checked") == false){
            $("#user_vd").removeAttr("required");
            $("#vd_blk").addClass("vd_blk");
            console.log("Checkbox is unchecked.");
          }
          if($("#GD").prop("checked") == true && id_gd == "GD"){
            $("#user_gd").attr("required", "required");
            $("#gd_blk").removeClass("gd_blk");
            $("#file_gd").fileinput();
             $.ajax({
              type: "POST",
              url: "apis/getUsers.php",
              data: 'checkeddept='+id_gd,
              success: function(data){
                var data = $.parseJSON(data);
                var options = '<option value="">-Select User-</option>';
                if(data != null) {
                  for (var i = 0; i < data.length; i++) {
                    {
                      options += '<option value="' + data[i].id + '">' + data[i].username + '</option>';
                    }
                  }
                } else {
                  options += '<option value="" disabled>No Users Availlable of this Role</option>';
                }
                $("#user_gd").html(options);
              },
              beforeSend: function(){
                $("body").mLoading()
              },
              complete: function(){
                $("body").mLoading('hide')
              }
            });
          }
          else if($("#GD").prop("checked") == false){
            $("#user_gd").removeAttr("required");
            $("#gd_blk").addClass("gd_blk");
            console.log("Checkbox is unchecked.");
          }
          if($("#TT").prop("checked") == true && id_tt == "TT"){
            $("#user_tt").attr("required", "required");
            $("#tt_blk").removeClass("tt_blk");
            $("#file_tt").fileinput();
            $.ajax({
              type: "POST",
              url: "apis/getUsers.php",
              data: 'checkeddept='+id_tt,
              success: function(data){
                var data = $.parseJSON(data);
                var options = '<option value="">-Select User-</option>';
                if(data != null) {
                  for (var i = 0; i < data.length; i++) {
                    {
                      options += '<option value="' + data[i].id + '">' + data[i].username + '</option>';
                    }
                  }
                } else {
                  options += '<option value="" disabled>No Users Availlable of this Role</option>';
                }
                $("#user_tt").html(options);
              },
              beforeSend: function(){
                $("body").mLoading()
              },
              complete: function(){
                $("body").mLoading('hide')
              }
            });
          }
          else if($("#TT").prop("checked") == false){
            $("#user_tt").removeAttr("required");
            $("#tt_blk").addClass("tt_blk");
            console.log("Checkbox is unchecked.");
          }
        });
        
        $('#new_task_form').on('submit', function(event){
          event.preventDefault();
          var dept = new Array();
          $(".dept_type:checked").each(function() {
            dept.push($(this).val());
          });
          //console.log(dept.length);
          if((dept.length != 0 && $("#main_status").val() == 11) || $("#main_status").val() == 10)
          {
            $.ajax({
              url:"assignWorkProcess.php",
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
                  $(".close").trigger('click');
                  $("#inst_btn").hide();
                  $("#user_cw").removeAttr("required");
                  $("#user_tt").removeAttr("required");
                  $("#user_gd").removeAttr("required");
                  $("#user_vd").removeAttr("required");
                  $("#ass_to").addClass("ass_to");
                  $("#cw_blk").addClass("cw_blk");
                  $("#vd_blk").addClass("vd_blk");
                  $("#gd_blk").addClass("gd_blk");
                  $("#tt_blk").addClass("tt_blk");
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
          }
          else
          {
            alert("Atleast select one department");
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
                var slidepath = $(this).attr("data-id");
                var slidepath_id = $(this).attr("data-val");
                var slidepath_classid = $(this).attr("data-val1");
                var slidepath_topicid = $(this).attr("data-val2");
                var slide_btnid = this.id;
                
                $("#slide_id").val(slidepath_id);
                $("#slide_classid").val(slidepath_classid);
                $("#slide_topicid").val(slidepath_topicid);
                $("#slide_path").val(slidepath);
                $("#slide_btnid").val(slide_btnid);
                console.log(slidepath);
                var object = "<object width='100%' height='670px' data="+slidepath+"></object>";
                $('#div1').html(object);
                $("#inst_btn").show();
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
