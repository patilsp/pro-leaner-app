<?php
include_once "session_token/checksession.php";
include_once "configration/config.php";
//include_once "session_token/checktoken.php";
$token=$_SESSION['token'];
$logged_user_id=$_SESSION['cms_userid'];
$user_type = $_SESSION['cms_usertype'];
$role_id = $_SESSION['user_role_id'];
try {
  include "functions/common_functions.php";
  $getUsers = getUsers("ID", $logged_user_id);
  $getClasses = getClasses();
  $getTaskList = getTaskListPMID($role_id, $logged_user_id);
  $getStatus = getStatus();
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
    <link href="../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../lib/highlightjs/github.css" rel="stylesheet">
    <link href="../lib/datatables/jquery.dataTables.css" rel="stylesheet">
    <link href="../lib/select2/css/select2.min.css" rel="stylesheet">
    <link href="../lib/ajax_loader/jquery.mloading.css" rel="stylesheet">

    <!-- CMS CSS -->
    <link rel="stylesheet" href="../css/cms.css">
  </head>

  <body class="collapsed-menu">

    <!-- ########## START: LEFT PANEL ########## -->
    <?php include("fixed-blocks/left_sidebar.php"); ?>
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <?php include("fixed-blocks/header.php"); ?>
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pagetitle">
        
      </div><!-- d-flex -->

      <div class="br-pagebody">
        <!-- start you own content here -->
        <div class="card h-100 d-flex flex-column justify-content-between">
          <div class="card-header card-header d-flex align-items-center justify-content-between pd-y-5 bg-dark">
            <h6 class="mg-b-0 tx-14 tx-white">Tasks List</h6>
            <?php
              if($role_id == "7") {
            ?>
            <div class="card-option tx-24">
              <a href="#" class="btn btn-info tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-toggle="modal" data-target="#newTask">New Task</a>
            </div><!-- card-option -->
            <?php
              }
            ?>
          </div><!-- card-header -->
          <div class="card-body">
            <table id="datatable" class="table table-striped table-bordered sourced-data">
              <thead>
                <tr>
                  <th>SNO</th>
                  <th>Class</th>
                  <th>Topic</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $i = 1;
                foreach ($getTaskList as $task) {
              ?>
                <tr>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $task['class']; ?></td>
                  <td><?php echo $task['topic']; ?></td>
                  <td><?php echo $task['status']; ?></td>
                  <td>
                    <?php
                      if($role_id == "7") {
                    ?>
                    <button class="btn btn-md btn-info view" data-id="<?php echo $task['task_id']."|".$task['task_ass_id']; ?>">View</button>
                    <?php
                      } else {
                    ?>
                    <button class="btn btn-md btn-info viewUpdateModal" data-id="<?php echo $task['task_id']."|".$task['task_ass_id']; ?>">View&amp;Update</button>
                    <?php
                      }
                    ?>
                  </td>
                </tr>
              <?php
                }
              ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>SNO</th>
                  <th>Class</th>
                  <th>Topic</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </tfoot>
            </table>
          </div><!-- card-body -->
        </div>
      </div><!-- br-pagebody -->
    </div><!-- br-mainpanel -->

    <!-- LARGE MODAL -->
    <div id="newTask" class="modal fade">
      <div class="modal-dialog modal-lg" role="form" style="width:100%">
        <div class="modal-content tx-size-sm">
          <div class="modal-header pd-x-20">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add Task</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" id="new_task_form" enctype="multipart/form-data">
            <div class="modal-body pd-20">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="user_cw">Assign To:</label>
                    <select class="form-control" name="users" id="users" required>
                      <option value="">-Select User-</option>
                      <?php
                        foreach ($getUsers as $user) {
                          if($user['role_id'] == 1){
                      ?>
                      <option value="<?php echo $user['id']; ?>"><?php echo $user['username']; ?></option>
                      <?php
                          }
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="user_cw">Class:</label>
                    <select class="form-control" name="class_name" id="class_name" required>
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
                    <label for="user_cw">Topics:</label>
                    <select class="form-control" name="topic" id="topic" required>
                      <option value="">-Select Topics-</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="inst_cw">Instructions:</label>
                    <textarea class="form-control" rows="2" name="inst" id="inst" required></textarea>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="file_cw">Reference Files:</label>
                    <div class="file-loading">
                      <input id="file-1" type="file" name="ref_files[]" multiple class="file" data-overwrite-initial="false">
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- modal-body -->
            <div class="modal-footer">
              <input type="submit" name="submit" value="Save" class="btn btn-info tx-size-xs" />
            </div>
          </form>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->

    <!-- View and Update -->
    <div id="viewUpdate" class="modal fade">
      <div class="modal-dialog modal-lg" role="form" style="width:100%">
        <div class="modal-content tx-size-sm">
          <div class="modal-header pd-x-20">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">View &amp; Update Task</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" id="update_status_form" enctype="multipart/form-data">
            <input type="hidden" name="task_id" id="task_id_ip" value="" />
            <input type="hidden" name="task_ass_id" id="task_ass_id_ip" value="" />
            <div class="modal-body pd-20">
              <div class="row">
                <div id="res_data">
                  
                </div>
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-header tx-medium">
                      ID Reply
                    </div><!-- card-header -->
                    <div class="card-body">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="user_cw">Status:</label>
                          <select class="form-control" name="status" id="status" required>
                            <option value="">-Select Status-</option>
                            <?php
                              foreach ($getStatus as  $val => $status) {
                                if($status == "Completed"){
                            ?>
                            <option value="<?php echo $val; ?>"><?php echo $status; ?></option>
                            <?php
                                }
                              }
                            ?>
                          </select>
                        </div>                        
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="inst_cw">Remarks:</label>
                          <textarea class="form-control" rows="2" name="remarks" id="remarks"></textarea>
                        </div>
                      </div>
                    </div><!-- card-body -->
                  </div>
                </div>
              </div>
            </div><!-- modal-body -->
            <div class="modal-footer">
              <input type="submit" name="submit" value="Update" class="btn btn-info tx-size-xs" />
            </div>
          </form>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->

    <!-- View and Update -->
    <div id="view" class="modal fade">
      <div class="modal-dialog modal-lg" role="form" style="width:100%">
        <div class="modal-content tx-size-sm">
          <div class="modal-header pd-x-20">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">View &amp; Update Task</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" id="update_status_form" enctype="multipart/form-data">
            <input type="hidden" name="task_id" id="task_id_ip" value="" />
            <input type="hidden" name="task_ass_id" id="task_ass_id_ip" value="" />
            <div class="modal-body pd-20">
              <div class="row">
                <div class="res_data">
                  
                </div>
              </div>
            </div><!-- modal-body -->
          </form>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->

    <!-- ########## END: MAIN PANEL ########## -->
    <script src="../lib/jquery/jquery.js"></script>
    <script src="../lib/popper.js/popper.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.js"></script>
    <script src="../lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="../lib/moment/moment.js"></script>
    <script src="../lib/jquery-ui/jquery-ui.js"></script>
    <script src="../lib/jquery-switchbutton/jquery.switchButton.js"></script>
    <script src="../lib/peity/jquery.peity.js"></script>
    <script src="../lib/highlightjs/highlight.pack.js"></script>
    <script src="../lib/datatables/jquery.dataTables.js"></script>
    <script src="../lib/datatables-responsive/dataTables.responsive.js"></script>
    <script src="../lib/select2/js/select2.min.js"></script>
    <script src="../lib/ajax_loader/jquery.mloading.js"></script>

    <script src="../js/cms.js"></script>
    <script>
      $(function(){
        'use strict';

        $('#datatable').DataTable({
          responsive: true,
          language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
            lengthMenu: '_MENU_ items/page',
          }
        });
        // Select2
        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

        $("#class_name").change(function(){
          var class_id = $(this).val();
          if(class_id != ""){
            $.ajax({
              type: "POST",
              url: "apis/tasks/getTopics.php",
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

        $('#new_task_form').on('submit', function(event){
          event.preventDefault();
          $.ajax({
            url:"transactions/pm/assignWorkProcess.php",
            method:'POST',
            data:new FormData(this),
            contentType:false,
            processData:false,
            success:function(data)
            {
              //console.log(data);
              var json = $.parseJSON(data);
              console.log(json.status);
              location.reload();
            },
            beforeSend: function(){
              $("body").mLoading()
            },
            complete: function(){
              $("body").mLoading('hide')
            }
          });
        });


        //get ID data for view
        $(".viewUpdateModal").click(function(){
          console.log("came");
          var data_str = $(this).attr("data-id").split('|');
          var task_id = data_str[0];
          var task_ass_id = data_str[1];
          $("#task_id_ip").val(task_id);
          $("#task_ass_id_ip").val(task_ass_id);
          console.log(data_str);
          $.ajax({
            type: "POST",
            url: "apis/tasks/getPMIDTransaction.php",
            data: 'task_id='+task_id+'&task_ass_id='+task_ass_id,
            success: function(data){
              var data = $.parseJSON(data);
              console.log(data);
              $("#res_data").html(data);
              $("#viewUpdate").modal("show");
            },
            beforeSend: function(){
              $("body").mLoading()
            },
            complete: function(){
              $("body").mLoading('hide')
            }
          });
        });

        //get ID data for view
        $(".view").click(function(){
          console.log("came");
          var data_str = $(this).attr("data-id").split('|');
          var task_id = data_str[0];
          var task_ass_id = data_str[1];
          $("#task_id_ip").val(task_id);
          $("#task_ass_id_ip").val(task_ass_id);
          console.log(data_str);
          $.ajax({
            type: "POST",
            url: "apis/tasks/getPMIDTransaction.php",
            data: 'task_id='+task_id+'&task_ass_id='+task_ass_id,
            success: function(data){
              var data = $.parseJSON(data);
              console.log(data);
              $(".res_data").html(data);
              $("#view").modal("show");
            },
            beforeSend: function(){
              $("body").mLoading()
            },
            complete: function(){
              $("body").mLoading('hide')
            }
          });
        });


        $('#update_status_form').on('submit', function(event){
          event.preventDefault();
          $.ajax({
            url:"transactions/id/statusUpdateProcess_PM.php",
            method:'POST',
            data:new FormData(this),
            contentType:false,
            processData:false,
            success:function(data)
            {
              //console.log(data);
              var json = $.parseJSON(data);
              console.log(json.status);
              $("#viewUpdate").modal('hide');
              location.reload();
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
