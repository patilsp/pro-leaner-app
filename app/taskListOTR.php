<?php
include_once "session_token/checksession.php";
include_once "configration/config.php";
include "functions/db_functions.php";
//include_once "session_token/checktoken.php";
$token=$_SESSION['token'];
$logged_user_id=$_SESSION['cms_userid'];
$user_type = $_SESSION['cms_usertype'];
$role_id = $_SESSION['user_role_id'];
try {
  include "functions/common_functions.php";
  $getTaskList = getTaskListAddEdit($role_id, $logged_user_id);
  /*echo "<pre/>";
  print_r($getTaskList);*/
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
            <h6 class="mg-b-0 tx-14 tx-white">Tasks List - Publish</h6>
            <?php
              if($role_id == "1") {
            ?>
            <div class="card-option tx-24">
              <a href="transactions/id/assignWork.php" class="btn btn-md btn-info">New Task</a>
            </div><!-- card-option -->
            <?php
              } else {
            ?>
            <div class="card-option tx-24">
              <a href="transactions/id/cwAssignEdit.php" class="btn btn-md btn-info">Review Content</a>
            </div>
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
                  <th>Type of Work</th>
                  <th>Assigned ON</th>
                  <th>Slide Id</th>
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
                    <td><?php echo $task['title']; ?></td>
                    <td><?php echo date("d-M-Y", strtotime($task['updated_date'])); ?></td>
                    
                    
                    <td><?php echo $task['slide_id']; ?></td>
                    <td>
                      <span class="label label-info"><?php echo $task['status']; ?></span>
                    </td>
                    <td>
                      <?php
                        if($role_id == 1 && ($task['status'] != "Not Ok" && $task['status'] != "Rework" && $task['status'] != "Publish")) {
                      ?>
                      <a href="<?php echo $web_root; ?>app/transactions/id/getWork.php?class=<?php echo $task['class_id'] ?>&topic=<?php echo $task['topic_id'] ?>&slide=<?php echo $task['slide_id'] ?>&xy=<?php echo $token; ?>&task_assi_id=<?php echo $task['task_ass_id']; ?>&task_id=<?php echo $task['task_id']; ?>&task_userid=<?php echo $task['task_userid']; ?>" class="btn btn-md btn-warning">Get Work</a>
                      <?php
                        } if($role_id > 1 && ($task['status'] == "Not Ok" || $task['status'] == "Rework") && $task['work_type']!=5) {
                      ?>
                      <a href="<?php echo $web_root; ?>app/transactions/cw/editSlideTest.php?class=<?php echo $task['class_id'] ?>&topic=<?php echo $task['topic_id'] ?>&slide=<?php echo $task['slide_id'] ?>&xy=<?php echo $token; ?>&task_assi_id=<?php echo $task['task_ass_id']; ?>&task_id=<?php echo $task['task_id']; ?>" class="btn btn-md btn-warning">Edit Slide</a>
                      <?php
                        }if($role_id == 2 && ($task['status'] == "Create" || $task['status'] == "Rework") && $task['work_type']==5) {
                          if($task['slide_id'] != "Add slides for Existing Topic") {
                      ?>
                            <a href="<?php echo $web_root; ?>app/transactions/addSlides/slideCreate.php?class=<?php echo $task['class_id'] ?>&topic=<?php echo $task['topic_id'] ?>&prev_slide=<?php echo $task['slide_id'] ?>&xy=<?php echo $token; ?>&task_assi_id=<?php echo $task['task_ass_id']; ?>&task_id=<?php echo $task['task_id']; ?>&template_id=<?php echo $task['template_id']; ?>&layout_id=<?php echo $task['layout_id']; ?>" class="btn btn-md btn-warning">Add Content</a>
                      <?php
                          }else{
                      ?>
                            <a href="<?php echo $web_root; ?>app/transactions/addSlides/slideCreateExistingTopic.php?class=<?php echo $task['class_id'] ?>&topic=<?php echo $task['topic_id'] ?>&prev_slide=ExistingTopic&xy=<?php echo $token; ?>&task_assi_id=<?php echo $task['task_ass_id']; ?>&task_id=<?php echo $task['task_id']; ?>" class="btn btn-md btn-warning">Add Slide</a>
                      <?php
                          }
                        }if($role_id == 3 && ($task['status'] == "Send to GD") && $task['work_type']==5 && $task['task_userid'] == $logged_user_id) {
                          if($task['slide_id'] != "Add slides for Existing Topic") {
                      ?>
                            <a href="<?php echo $web_root; ?>app/transactions/addSlides/slideCreate.php?class=<?php echo $task['class_id'] ?>&topic=<?php echo $task['topic_id'] ?>&prev_slide=<?php echo $task['slide_id'] ?>&xy=<?php echo $token; ?>&task_assi_id=<?php echo $task['task_ass_id']; ?>&task_id=<?php echo $task['task_id']; ?>&template_id=<?php echo $task['template_id']; ?>&layout_id=<?php echo $task['layout_id']; ?>" class="btn btn-md btn-warning">Update Images</a>
                      <?php
                          }else{
                      ?>
                            <a href="<?php echo $web_root; ?>app/transactions/addSlides/slideCreateExistingTopic.php?class=<?php echo $task['class_id'] ?>&topic=<?php echo $task['topic_id'] ?>&prev_slide=ExistingTopic&xy=<?php echo $token; ?>&task_assi_id=<?php echo $task['task_ass_id']; ?>&task_id=<?php echo $task['task_id']; ?>" class="btn btn-md btn-warning">Add Images</a>
                      <?php
                          }
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
                  <th>Title</th>
                  <th>Role</th>
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

      });
    </script>
  </body>
</html>
