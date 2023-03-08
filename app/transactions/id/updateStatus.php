<?php
include_once "../../session_token/checksession.php";
include_once "../../configration/config.php";
include "../../functions/common_functions.php";
include "apis/getTaskStatus.php";
//include_once "../session_token/checktoken.php";
$token=$_SESSION['token'];
$logged_user_id=$_SESSION['cms_userid'];
$user_type = $_SESSION['cms_usertype'];
$task_id = $_GET['task_id'];
$task_assi_id = $_GET['task_assi_id'];
try{
  $getClasses = getClasses();
  $getStatus = getStatus();
  $getTopics = getTopics("");
  //print_r($getTopics);
  $getUsers = getUsers("",$logged_user_id);
  $getTaskStatus = getTaskStatus($task_id,$task_assi_id);
  //print_r($getTaskStatus);
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
      .card-body-main{
        height: 65vh;
        overflow-y: auto;
      }
      .card-body-main .card_output{
        width: 97%;
        margin-left: 3%;
      }
      .card_input{
        width: 97%;
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
            Update Task Status
          </div><!-- card-header -->
          <form method="post" id="update_task_form" enctype="multipart/form-data">
            <div class="card-body bd bd-t-0 rounded-bottom card-body-main">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="title">Title/Name:</label>
                    <input type="text" class="form-control" name="title" value="<?php echo $getTaskStatus['task_name'] ?>" id="title">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="class_name">Select Class:</label>
                    <select class="form-control" name="class_name" id="class_name">
                      <option value="">- Select Class -</option>
                      <?php
                        foreach ($getClasses as $auto_id => $class_name) {
                          if($getTaskStatus['class_id'] == $auto_id){
                            $select = 'selected=selected';
                          } else {
                            $select ="";
                          }
                      ?>
                          <option value="<?php echo $auto_id; ?>" <?php echo $select; ?>><?php echo $class_name; ?></option>
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
                      <?php
                        foreach ($getTopics as $topic) {
                          if($getTaskStatus['topics_id'] == $topic['id']){
                            $select = 'selected=selected';
                          } else {
                            $select ="";
                          }
                      ?>
                        <option value="<?php echo $topic['id']; ?>" <?php echo $select ?>><?php echo $topic['description']; ?></option>
                      <?php
                        }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="inputs">Inputs:</label>
                    <textarea class="form-control" rows="5" name="inputs" id="inputs"><?php echo $getTaskStatus['inputs']; ?></textarea>
                  </div>
                </div>
              </div>
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
                        ID Task Input status <?php echo $role['status']; ?>
                      </div><!-- card-header -->
                      <div class="card-body bd bd-t-0 rounded-bottom">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="inst_cw">Instructions:</label>
                              <textarea class="form-control" rows="5" name="inst_cw" id="inst_cw"><?php echo $role['instructions']; ?></textarea>
                            </div>
                          </div>
                          <div class="row">
                            <?php
                              foreach ($attachments as $attachment) {
                                $file_type = explode(".", $attachment);
                                $file_type = $file_type[1];
                            ?>
                            <div class="col-md-2">
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
                        Content Writer Task Output - Status - <?php echo $role['status']; ?>
                      </div><!-- card-header -->
                      <div class="card-body bd bd-t-0 rounded-bottom">
                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="inst_cw">Remarks:</label>
                              <textarea class="form-control" rows="5" name="inst_cw" id="inst_cw"><?php echo $role['instructions']; ?></textarea>
                            </div>
                          </div>
                          <div class="row">
                            <?php
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
                          <div class="col-md-3">
                            <div class="form-group d-flex align-items-center justify-content-center h-100">
                              <button class="center-block btn btn-lg btn-danger">Review Work</button>
                            </div>
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
                      <input type="hidden" name="task_assi_id" value="<?php echo $task_assi_id; ?>">
                      <input type="hidden" name="task_id" value="<?php echo $task_id; ?>">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="status_cw">Status:</label>
                            <select class="form-control" name="up_status_cw" id="status_cw" required>
                              <option value="">- Select Status -</option>
                              <?php
                                foreach ($getStatus as $auto_id => $status_name) {
                                  if($auto_id == 2 || $auto_id == 5){
                              ?>
                                  <option value="<?php echo $auto_id; ?>"><?php echo $status_name; ?></option>
                              <?php
                                  }
                                }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="inst_cw">Instructions:</label>
                            <textarea class="form-control" rows="5" name="up_inst_cw" id="inst_cw"></textarea>
                          </div>
                        </div>
                        <div class="col-md-8">
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

        $('#update_task_form').on('submit', function(event){
          event.preventDefault();
          $.ajax({
            url:"updateStatusProcess.php",
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
            }/*,
            beforeSend: function(){
              $("body").mLoading()
            },
            complete: function(){
              $("body").mLoading('hide')
            }*/
          });
        });
      });
    </script>
  </body>
</html>
