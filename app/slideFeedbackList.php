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
  $getSlideFeedbackList = getSlideFeedbackList($role_id, $logged_user_id);
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
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.5/css/select.dataTables.min.css">
    <link href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" rel="stylesheet">

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
            <h6 class="mg-b-0 tx-14 tx-white">Slide Feedback</h6>
          </div><!-- card-header -->
          <div class="card-body">
            <table id="datatable" class="table table-striped table-bordered sourced-data">
              <thead>
                <tr>
                  <th>Sl. No</th>
                  <th>Updated By</th>
                  <!-- <th>Updated On</th> -->
                  <th>Class</th>
                  <th>Topic</th>
                  <th>Slide ID</th>
                  <th>Content</th>
                  <th>Template</th>
                  <th>Image</th>
                  <th>Heading</th>
                  <th>Movement</th>
                  <th>Layout</th>
                  <th>Drop</th>
                  <th>Remarks</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $i = 1;
                  foreach ($getSlideFeedbackList as $feedback) {
                    $feedbacktypeexplode = explode(",", $feedback['feedbackType']);
                    
                    $feedbackType = "";
                    if(in_array("Rewrite Sentence", $feedbacktypeexplode) || in_array("Change flow", $feedbacktypeexplode) || in_array("Rewrite Story", $feedbacktypeexplode) || in_array("Add new activity", $feedbacktypeexplode)) {
                      $contentFeedback = "";
                      foreach ($feedbacktypeexplode as $value) {
                        if($value == "Rewrite Sentence" | $value == "Change flow" | $value == "Rewrite Story" | $value == "Add new activity")
                          $contentFeedback .= $value.", "; 
                      }
                      $feedbackType .= '<td>'.$contentFeedback.'</td>'; 
                    } else {
                      $feedbackType .= '<td></td>';
                    }
                    if(in_array("Template", $feedbacktypeexplode)) {
                      $feedbackType .= '<td>Yes</td>'; 
                    } else {
                      $feedbackType .= '<td></td>';
                    }
                    if(in_array("Image", $feedbacktypeexplode)) {
                      $feedbackType .= '<td>Yes</td>'; 
                    } else {
                      $feedbackType .= '<td></td>';
                    }
                    if(in_array("Heading", $feedbacktypeexplode)) {
                      $feedbackType .= '<td>Yes</td>'; 
                    } else {
                      $feedbackType .= '<td></td>';
                    }
                    if(in_array("Movement", $feedbacktypeexplode)) {
                      $feedbackType .= '<td>Yes</td>'; 
                    } else {
                      $feedbackType .= '<td></td>';
                    }
                    if(in_array("Layout", $feedbacktypeexplode)) {
                      $feedbackType .= '<td>Yes</td>'; 
                    } else {
                      $feedbackType .= '<td></td>';
                    }
                    if(in_array("Drop", $feedbacktypeexplode)) {
                      $feedbackType .= '<td>Yes</td>'; 
                    } else {
                      $feedbackType .= '<td></td>';
                    }
                ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $feedback['updatedBy']; ?></td>
                    <td><?php echo $feedback['classId']; ?></td>
                    <td><?php echo $feedback['topic']; ?></td>
                    <td><?php echo $feedback['slideId']; ?></td>
                    <?php echo $feedbackType; ?>
                    <td><?php echo $feedback['feedback']; ?></td>
                  </tr>
                <?php
                  }
                ?>
              </tbody>
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
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.5/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    
    <script src="../lib/select2/js/select2.min.js"></script>

    <script src="../js/cms.js"></script>
    <script>
      $(function(){
        'use strict';

        $('#datatable').DataTable({
          responsive: true,
          dom: 'Bfrtip',
          buttons: [
              'excel'
          ]
        });
      });
    </script>
  </body>
</html>
