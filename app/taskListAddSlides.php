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
  $getTaskList = getTaskListAdd($role_id, $logged_user_id);
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
            <h6 class="mg-b-0 tx-14 tx-white">Tasks List (Add Slides) - Publish</h6>
            <?php
              if($role_id == "1") {
            ?>
            <div class="card-option tx-24">
              <a href="transactions/addSlides/slideAssign.php" class="btn btn-md btn-info">New Task</a>
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
                  <th>Type of Work</th>
                  <th>SlideEmpty</th>
                  <th>Assigned To</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $published_task_ids = array();
                  $query = "SELECT * FROM task_production_ready";
                  $stmt = $db->query($query);
                  $rowcount = $stmt->rowCount();
                  if($rowcount > 0){
                    while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
                      $published_task_ids[] = $fetch['task_id'];
                    }
                  }

                  /*echo "<pre/>";
                  print_r($published_task_ids);*/

                  $i = 1;
                  /*echo "<pre/>";
                  print_r($getTaskList);*/
                  $finacial_lit_topic_ids = array(331, 332, 335, 337, 314, 315, 316, 293, 294, 296, 298, 299, 272, 273, 274, 275, 276, 278, 252, 259, 255, 256, 260, 257, 258);
                  foreach ($getTaskList as $task) {
                    if(in_array($task['task_id'], $published_task_ids))
                      continue;
                    //if(in_array($task['topic_id'], $finacial_lit_topic_ids))
                       //continue;

                    //to highlight layout6 slides contains topics tr
                    $layout6Count = $task['layout6'];
                    $tr_bg_color = '';
                    if($layout6Count > 0) {
                      $tr_bg_color = 'background-color: #ffeb3b;';
                    }
                ?>
                  <tr style="<?php echo $tr_bg_color; ?>">
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $task['class']; ?></td>
                    <td><?php echo $task['topic']; ?></td>
                    <td><?php echo $task['title']; ?></td>
                    <td><?php echo $task['slideContentEmptyContains']; ?></td>
                    <td><?php echo $task['AssignedTo']; ?></td>
                    <td>
                      <?php
                        if($task['status'] == "Review")
                          $status_btn_lable = "First Level QC";
                        elseif ($task['status'] == "Publish") 
                          $status_btn_lable = "Final QC";
                        else
                          $status_btn_lable = $task['status'];
                      ?>
                      <span class="label label-info"><?php echo $status_btn_lable; ?></span>
                    </td>
                    <td>
                      <?php
                        if($role_id == 1 && $task['status'] == "Review") {
                          if($task['slide_id'] != "Add slides for Existing Topic") {
                      ?>
                     <!--  <a href="<?php //echo $web_root; ?>app/transactions/addSlides/slideCreate.php?class=<?php //echo $task['class_id'] ?>&topic=<?php //echo $task['topic_id'] ?>&prev_slide=''&slide=<?php //echo $task['slide_id'] ?>&xy=<?php //echo $token; ?>&task_assi_id=<?php //echo $task['task_ass_id']; ?>&task_id=<?php //echo $task['task_id']; ?>&task_userid=<?php //echo $task['task_userid']; ?>" class="btn btn-md btn-warning">Get Work</a> -->
                      <?php
                          }else{
                      ?>
                        <a href="<?php echo $web_root; ?>app/transactions/addSlides/slideCreateExistingTopic.php?class=<?php echo $task['class_id'] ?>&topic=<?php echo $task['topic_id'] ?>&prev_slide=ExistingTopic&slide=<?php echo $task['slide_id'] ?>&xy=<?php echo $token; ?>&task_assi_id=<?php echo $task['task_ass_id']; ?>&task_id=<?php echo $task['task_id']; ?>&task_userid=<?php echo $task['task_userid']; ?>" class="btn btn-md btn-warning">Get Work</a>
                      <?php
                          }
                        } if($role_id > 1 && ($task['status'] == "Not Ok" || $task['status'] == "Rework")) {
                      ?>
                      <a href="<?php echo $web_root; ?>app/transactions/cw/editSlideTest.php?class=<?php echo $task['class_id'] ?>&topic=<?php echo $task['topic_id'] ?>&slide=<?php echo $task['slide_id'] ?>&xy=<?php echo $token; ?>&task_assi_id=<?php echo $task['task_ass_id']; ?>&task_id=<?php echo $task['task_id']; ?>" class="btn btn-md btn-warning">Edit Slide</a>
                      <?php
                        /* 
                          display Status has been updated to 
                          
                          "review/Publish - view & edit, Create/send to gd - View" 
                        
                          updated to 

                          "Create/send to gd - WIP, First Level QC - review and Final QC - Publish"
                        */

                        } else {
                          if($task['status'] == "Review" || $task['status'] == "Publish")
                            $btn_lable = "Review";
                          elseif ($task['status'] == "QC") 
                            $btn_lable = "Final QC";
                          else
                            $btn_lable = "WIP";
                      ?>
                        <a href="<?php echo $web_root; ?>app/transactions/addSlides/slideCreate.php?class=<?php echo $task['class_id'] ?>&topic=<?php echo $task['topic_id'] ?>&prev_slide=''&slide=<?php echo $task['slide_id'] ?>&xy=<?php echo $token; ?>&task_assi_id=<?php echo $task['task_ass_id']; ?>&task_id=<?php echo $task['task_id']; ?>&task_userid=<?php echo $task['task_userid']; ?>" class="btn btn-md btn-warning"><?php echo $btn_lable; ?></a>
                      <?php
                        }
                      ?>
                    </td>
                  </tr>
                <?php
                  //}
                }
                ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>SNO</th>
                  <th>Class</th>
                  <th>Topic</th>
                  <th>Type of Work</th>
                  <th>SlideEmpty</th>
                  <th>Assigned To</th>
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
