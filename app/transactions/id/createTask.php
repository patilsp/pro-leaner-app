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
    <link href="../../../lib/highlightjs/github.css" rel="stylesheet">
    <link href="../../../lib/fileinputs/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="../../../lib/ajax_loader/jquery.mloading.css" rel="stylesheet">

    <!-- CMS CSS -->
    <link rel="stylesheet" href="../../../css/cms.css">

    <style type="text/css">
      .br-pagebody {
        margin-top: 0px;
      }
      .card-body{
        height: 65vh;
        overflow-y: auto;
      }
      .cw_blk,.vd_blk,.gd_blk,.tt_blk{
        display: none;
      }
    </style>
  </head>

  <body class="collapsed-menu">

    <!-- ########## START: LEFT PANEL ########## -->
    <?php include("../../fixed-blocks/left_sidebar.php"); ?>
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <?php include("../../fixed-blocks/header.php"); ?>
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pagetitle">
      </div><!-- d-flex -->

      <div class="br-pagebody">
        <!-- start you own content here -->
        <div class="card h-100 d-flex flex-column justify-content-between">
          <div class="card-header tx-medium bd-0 tx-white bg-dark">
            Create New Content Item
          </div><!-- card-header -->
          <form method="post" id="new_task_form" action="save_task.php" enctype="multipart/form-data">
            <div class="card-body bd bd-t-0 rounded-bottom">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="title">Title/Name:</label>
                    <input type="text" class="form-control" name="title" id="title">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="class_name">Select Class:</label>
                    <select class="form-control" name="class_name" id="class_name">
                      <option value="">- Select Class -</option>
                      <?php
                        foreach ($getClasses as $auto_id => $class_name) {
                      ?>
                          <option value="<?php echo $auto_id; ?>"><?php echo $class_name; ?></option>
                      <?php
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="topic">Select Topic:</label>
                    <select class="form-control" name="topic" id="topic">
                      <option value="">-Select Topics-</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="inputs">Inputs:</label>
                    <textarea class="form-control" rows="5" name="inputs" id="inputs"></textarea>
                  </div>
                </div>
              </div>
              <div class="row" id="ass_to">
                <div class="col-md-12">
                  <label for="inputs">Assigned To:</label> <br>
                  <label class="checkbox-inline"><input id="CW" type="checkbox" class="dept_type" name="assign_to[]" value="CW">Content Writer</label>
                  <label class="checkbox-inline"><input id="VD" type="checkbox" class="dept_type" name="assign_to[]" value="VD">Visual Designer</label>
                  <label class="checkbox-inline"><input id="GD" type="checkbox" class="dept_type" name="assign_to[]" value="GD">Graphic Designer</label>
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
                                <label for="status_cw">Status:</label>
                                <select class="form-control" name="status_cw" id="status_cw">
                                  <option value="">- Select Status -</option>
                                  <?php
                                    foreach ($getStatus as $auto_id => $status_name) {
                                  ?>
                                      <option value="<?php echo $auto_id; ?>"><?php echo $status_name; ?></option>
                                  <?php
                                    }
                                  ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="user_cw">Assign To:</label>
                                <select class="form-control" name="user_cw" id="user_cw">
                                  <option value="">-Select User-</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="inst_cw">Instructions:</label>
                                <textarea class="form-control" rows="5" name="inst_cw" id="inst_cw"></textarea>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="file_cw">Attach Files:</label>
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
                                <label for="status_vd">Status:</label>
                                <select class="form-control" name="status_vd" id="status_vd">
                                  <option value="">- Select Status -</option>
                                  <?php
                                    foreach ($getStatus as $auto_id => $status_name) {
                                  ?>
                                      <option value="<?php echo $auto_id; ?>"><?php echo $status_name; ?></option>
                                  <?php
                                    }
                                  ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="user_vd">Assign To:</label>
                                <select class="form-control" name="user_vd" id="user_vd">
                                  <option value="">- Select User -</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="inst_vd">Instructions:</label>
                                <textarea class="form-control" rows="5" name="inst_vd" id="inst_vd"></textarea>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="file_vd">Attach Files:</label>
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
                                <label for="status_gd">Status:</label>
                                <select class="form-control" name="status_gd" id="status_gd">
                                  <option value="">- Select Status -</option>
                                  <?php
                                    foreach ($getStatus as $auto_id => $status_name) {
                                  ?>
                                      <option value="<?php echo $auto_id; ?>"><?php echo $status_name; ?></option>
                                  <?php
                                    }
                                  ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="user_gd">Assign To:</label>
                                <select class="form-control" name="user_gd" id="user_gd">
                                  <option value="">- Select User -</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="inst_gd">Instructions:</label>
                                <textarea class="form-control" rows="5" name="inst_gd" id="inst_gd"></textarea>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="file_gd">Attach Files:</label>
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
                          <a class="collapsed transition" data-toggle="collapse" data-parent="#accordion6" href="#tt" aria-expanded="false" aria-controls="tt">
                            Tech Team
                          </a>
                        </h6>
                      </div>
                      <div id="tt" class="collapse" role="tabpanel" aria-labelledby="headingFour6">
                        <div class="card-block pd-20">
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="status_tt">Status:</label>
                                <select class="form-control" name="status_tt" id="status_tt">
                                  <option value="">- Select Status -</option>
                                  <?php
                                    foreach ($getStatus as $auto_id => $status_name) {
                                  ?>
                                      <option value="<?php echo $auto_id; ?>"><?php echo $status_name; ?></option>
                                  <?php
                                    }
                                  ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="user_tt">Assign To:</label>
                                <select class="form-control" name="user_tt" id="user_tt">
                                  <option value="">- Select User -</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="inst_tt">Instructions:</label>
                                <textarea class="form-control" rows="5" name="inst_tt" id="inst_tt"></textarea>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="file_tt">Attach Files:</label>
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
            </div><!-- card-body -->
            <div class="card-footer bd bd-t-0 d-flex justify-content-between">
              <a href="<?php echo $web_root; ?>app/taskList.php" class="btn btn-md btn-danger">Cancel</a>
              <input type="submit" name = "submit" value="Submit" class="btn btn-md btn-info" />
            </div><!-- card-footer -->
          </form>
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
                <p class="mg-b-20 mg-x-20" id="success_msg"></p>
                <a href="<?php echo $web_root; ?>app/taskList.php" class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20">
                  Continue</a>
              </div><!-- modal-body -->
            </div><!-- modal-content -->
          </div><!-- modal-dialog -->
        </div><!-- modal -->
      </div><!-- br-pagebody -->
    </div><!-- br-mainpanel -->

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
    <!-- ajax loader -->
    <script src="../../../lib/ajax_loader/jquery.mloading.js"></script>
    <script src="../../../js/cms.js"></script>
    <script>
      $(function(){
        'use strict';
        // show only the icons and hide left menu label by default
        $('.menu-item-label').addClass('op-lg-0-force d-lg-none');

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
          }
        })

        $('input[type="checkbox"]').click(function(){
          var id_cw = $("#CW").val();
          var id_vd = $("#VD").val();
          var id_gd = $("#GD").val();
          var id_tt = $("#TT").val();
          
          if($("#CW").prop("checked") == true && id_cw == "CW"){
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
          }
          if($("#VD").prop("checked") == true && id_vd == "VD"){
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
            $("#vd_blk").addClass("vd_blk");
            console.log("Checkbox is unchecked.");
          }
          if($("#GD").prop("checked") == true && id_gd == "GD"){
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
            $("#gd_blk").addClass("gd_blk");
            console.log("Checkbox is unchecked.");
          }
          if($("#TT").prop("checked") == true && id_tt == "TT"){
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
          console.log(dept.length);
          if(dept.length != 0)
          {
            $.ajax({
              url:"createTaskProcess.php",
              method:'POST',
              data:new FormData(this),
              contentType:false,
              processData:false,
              success:function(data)
              {
                console.log(data);
                var json = $.parseJSON(data);
                if(json.status == "true"){
                  $("#success_msg").append(json.message)
                  $("#modalsuccess").modal('show');
                } else {
                  $("#success_msg").append(json.message)
                  $("#modalsuccess").modal('show');
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
      });
    </script>
  </body>
</html>
