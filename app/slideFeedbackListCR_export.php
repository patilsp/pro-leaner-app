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
  $getSlideFeedbackList = getSlideFeedbackListCR($role_id, $logged_user_id);
  $type_of_issue_status = type_of_issue_status();
  $type_of_issue = type_of_issue();
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/3.2.6/css/fixedColumns.bootstrap4.min.css">
    <link href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" rel="stylesheet">
    <link href="../lib/ajax_loader/jquery.mloading.css" rel="stylesheet">
    <!-- CMS CSS -->
    <link rel="stylesheet" href="../css/cms.css">
    <style type="text/css">
      .updated{
          border: 2px solid green;
          background: #4CAF50;
          color: #f9f7f7;
      }
    </style>
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
            <table id="datatable" class="table table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>Sl. No</th>
                  <th>Updated By</th>
                  <!-- <th>Updated On</th> -->
                  <th>Class</th>
                  <th>Topic</th>
                  <th>Slide ID</th>
                  <th>Overall Coherence at topic leve</th>
                  <th>Headings</th>
                  <th>Content</th>
                  <th>Flow</th>
                  <th>Responses</th>
                  <th>Image and Relevance</th>
                  <th>Age appropriateness</th>
                  <th>Connect from Start to end</th>
                  <th>Consistency</th>
                  <th>Remarks</th>
                  <th>Issue Type</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $i = 1;
                  foreach ($getSlideFeedbackList as $feedback) {
                    $feedbacktypeexplode = explode(",", $feedback['feedbackType']);
                    
                    $feedbackType = "";
                    if(in_array("Layout", $feedbacktypeexplode) || in_array("Number of Bullet Points", $feedbacktypeexplode) || in_array("Formatting", $feedbacktypeexplode) || in_array("Font Size", $feedbacktypeexplode)) {
                      $contentFeedback = "";
                      foreach ($feedbacktypeexplode as $value) {
                        if($value == "Layout" | $value == "Number of Bullet Points" | $value == "Formatting" | $value == "Font Size")
                          $contentFeedback .= $value.", "; 
                      }
                      $feedbackType .= '<td>'.$contentFeedback.'</td>'; 
                    } else {
                      $feedbackType .= '<td></td>';
                    }
                    if(in_array("Headings", $feedbacktypeexplode)) {
                      $feedbackType .= '<td>Yes</td>'; 
                    } else {
                      $feedbackType .= '<td></td>';
                    }
                    if(in_array("Content", $feedbacktypeexplode)) {
                      $feedbackType .= '<td>Yes</td>'; 
                    } else {
                      $feedbackType .= '<td></td>';
                    }
                    if(in_array("Flow", $feedbacktypeexplode)) {
                      $feedbackType .= '<td>Yes</td>'; 
                    } else {
                      $feedbackType .= '<td></td>';
                    }
                    if(in_array("Responses", $feedbacktypeexplode)) {
                      $feedbackType .= '<td>Yes</td>'; 
                    } else {
                      $feedbackType .= '<td></td>';
                    }
                    if(in_array("Image and Relevance", $feedbacktypeexplode)) {
                      $feedbackType .= '<td>Yes</td>'; 
                    } else {
                      $feedbackType .= '<td></td>';
                    }
                    if(in_array("Age appropriateness", $feedbacktypeexplode)) {
                      $feedbackType .= '<td>Yes</td>'; 
                    } else {
                      $feedbackType .= '<td></td>';
                    }
                    if(in_array("Connect from Start to end", $feedbacktypeexplode)) {
                      $feedbackType .= '<td>Yes</td>'; 
                    } else {
                      $feedbackType .= '<td></td>';
                    }
                    if(in_array("Consistency", $feedbacktypeexplode)) {
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
                    <td>
                      <?php
                        if($feedback['issue_type_status'] != 2) {
                      ?>
                      <input type="hidden" class="cr_issue_id" value="<?php echo $feedback['cr_issue_id']; ?>">
                      <?php
                        foreach ($type_of_issue as $issue) {
                          if($feedback['issue_type'] == $issue['id']){
                        ?>
                          <?php echo $issue['issue']; ?>
                        <?php
                            }
                          }                        
                        ?>
                      <?php
                        }
                      ?>
                    </td>
                    <td>
                      <?php
                        if($feedback['issue_type_status'] != 2) {
                      ?>
                      <input type="hidden" class="cr_issue_id" value="<?php echo $feedback['cr_issue_id']; ?>">
                      <?php
                        foreach ($type_of_issue_status as $issue_status) {
                          if($feedback['issue_type_status'] == $issue_status['id']){
                        ?>
                          <?php echo $issue_status['status']; ?>
                        <?php
                          }                    
                        ?>
                      <?php
                        }
                      } else if($feedback['issue_type_status'] == 2){ ?>
                        Closed
                      <?php
                      }
                      ?>
                    </td>
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
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <link href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" rel="stylesheet">
    <script src="../lib/select2/js/select2.min.js"></script>
    <script src="../lib/ajax_loader/jquery.mloading.js"></script>
    <script src="../lib/jqueryToast/jquery.toaster.js"></script>

    <script src="../js/cms.js"></script>
    <script>
      $(function(){
        'use strict';

        $('#datatable').DataTable({
          scrollY:        "300px",
          scrollX:        true,
          scrollCollapse: true,
          paging:         false,
          fixedColumns:   {
            leftColumns: 5,
            rightColumns: 2
          },
          dom: 'Bfrtip',
          buttons: [
              'excel'
          ]
        });

        $(".issue_type").change(function(){
          var id = $(this).closest('tr').find('.cr_issue_id').val();
          var issue_type = $(this).val();
          console.log("id"+id+", issue_type"+issue_type);
          $.ajax({
            type: "POST",
            url: "apis/tasks/updateCRIssueTypeandStatus.php",
            data: 'id='+id+"&issue_type="+issue_type+"&type=issue_type_update",
            success: function(data){
              //console.log(data);
              $.toaster({ message : 'Successfully Updated.', title : '', priority : 'success' });
            },
            beforeSend: function(){
              $("body").mLoading()
            },
            complete: function(){
              $("body").mLoading('hide')
            }
          });
        });
        $(".issue_type_status").change(function(){
          var id = $(this).closest('tr').find('.cr_issue_id').val();
          var issue_type_status = $(this).val();
          console.log("id"+id+", issue_type_status"+issue_type_status);
          $.ajax({
            type: "POST",
            url: "apis/tasks/updateCRIssueTypeandStatus.php",
            data: 'id='+id+"&issue_type_status="+issue_type_status+"&type=issue_type_status_update",
            success: function(data){
              //console.log(data);
              $.toaster({ message : 'Successfully Updated.', title : '', priority : 'success' });
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
