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
  $getTaskListCR = getTaskListCR($role_id);
  $getStatusCR = getStatusCR();
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
              if($role_id == "1") {
            ?>
            <div class="card-option tx-24">
              <a href="transactions/id/createTask.php" class="btn btn-md btn-info">New Task</a>
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
                  <th>Review Status</th>
                  <th>Review Date</th>
                  <th>Notes</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $i = 1;
                  foreach ($getTaskListCR as $task) {
                ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $task['class']; ?></td>
                    <td><?php echo $task['topic_name']; ?></td>
                    <td>
                      <span class="label label-info"><?php echo $task['status_name']; ?></span>
                    </td>
                    <td><?php echo $task['review_date']; ?></td>
                    <td><?php echo $task['review_notes']; ?></td>
                    
                    <td>
                      <?php
                        if($role_id == 6) {
                      ?>
                      <a href="<?php echo $web_root; ?>app/transactions/cw/editSlideTest.php?class=<?php echo $task['class'] ?>&topic=<?php echo $task['topic_id'] ?>&xy=<?php echo $token; ?>" class="btn btn-md btn-info">Review Now</a>
                      <a href="#" class="btn btn-md btn-warning" data-toggle="modal" data-target="#UpdateStatusModal">Update Status </a>
                      <?php
                        } else {
                      ?>
                      <a href="<?php echo $web_root; ?>app/transactions/cw/newSlide.php?class=<?php echo $task['class_id'] ?>&topic=<?php echo $task['topic_id'] ?>&xy=<?php echo $token; ?>" class="btn btn-md btn-info">Add Slide</a>
                      <a href="<?php echo $web_root; ?>app/transactions/cw/editSlideTest.php?class=<?php echo $task['class_id'] ?>&topic=<?php echo $task['topic_id'] ?>&xy=<?php echo $token; ?>" class="btn btn-md btn-warning">Edit Slide</a>
                      <a href="#" class="btn btn-md btn-danger">View & Update Task</a>
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
                  <th>Review Status</th>
                  <th>Review Date</th>
                  <th>Notes</th>
                  <th>Action</th>
                </tr>
              </tfoot>
            </table>

            <!-- LARGE MODAL -->
            <div id="UpdateStatusModal" class="modal fade">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content tx-size-sm">
                  <div class="modal-header pd-x-20">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Update Status</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form class="updateStatusForm" name="updateStatusForm">
                  <div class="modal-body pd-20">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label for="status">Status:</label>
                          <select class="form-control" name="status" id="status" required>
                            <option value="">- Select Status -</option>
                            <?php
                              foreach ($getStatusCR as $auto_id => $status_name) {
                            ?>
                                <option value="<?php echo $auto_id; ?>"><?php echo $status_name; ?></option>
                            <?php
                              }
                            ?>
                          </select>
                        </div>
                        <div class="form-group" id="note_field">
                          <label for="date">Notes:</label>
                          <textarea class="form-control" id="note"></textarea>
                        </div>
                        <div class="form-group" id="date_field">
                          <label for="date">Completed On:</label>
                          <input type="date" class="form-control" id="date">
                        </div>
                      </div>
                    </div>
                  </div><!-- modal-body -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary tx-size-xs" data-dismiss="modal">Close</button>
                    <button type="button" id="update_status" class="btn btn-primary tx-size-xs">Update</button>
                  </div>
                  </form>
                </div>
              </div><!-- modal-dialog -->
            </div><!-- modal -->
          </div><!-- card-body -->
        </div>
      </div><!-- br-pagebody -->
    </div><!-- br-mainpanel -->



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

        $("#date_field,#note_field").hide();
        $("#status").change(function(){
          var status_id = $(this).val();
          if(status_id == 9){
            $("#date_field,#note_field").show();
          }
        });
        $("#update_status").click(function(){
          var status = $("#status").val();
          var date = $("#date").val();
          $.ajax({
            type: "POST",
            url: "apis/tasks/updateCRStatus.php",
            data: 'status='+status+'&date='+date,
            success: function(data){
              
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
