<?php
include_once "../session_token/checksession.php";
include_once "../configration/config.php";
include "../functions/db_functions.php";
include "../functions/common_functions.php";
include "report_common_functions.php";
//include_once "session_token/checktoken.php";
$token=$_SESSION['token'];
$logged_user_id=$_SESSION['cms_userid'];
$user_type = $_SESSION['cms_usertype'];
$role_id = $_SESSION['user_role_id'];
if(isset($_GET['class']))
 $filterClass = intval($_GET['class']);
else
  $filterClass = 0;
try {
  $getResponsiveTestIssues = getResponsiveTestIssues();
  /*echo "<pre/>";
  print_r($getResponsiveTestIssues);*/
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
    <link href="../../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../../lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../../lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../../lib/datatables/jquery.dataTables.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
    <link href="../../lib/ajax_loader/jquery.mloading.css" rel="stylesheet">
    <!-- CMS CSS -->
    <link rel="stylesheet" href="../../css/cms.css">
  </head>

  <body class="collapsed-menu">

    <!-- ########## START: LEFT PANEL ########## -->
    <?php include("../fixed-blocks/left_sidebar.php"); ?>
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <?php include("../fixed-blocks/header.php"); ?>
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pagetitle">
        
      </div><!-- d-flex -->

      <div class="br-pagebody">
        <!-- start you own content here -->
        <div class="card h-100 d-flex flex-column justify-content-between">
          <div class="card-header card-header d-flex align-items-center justify-content-between pd-y-5 bg-dark">
            <h6 class="mg-b-0 tx-14 tx-white">Responsive Test Report</h6>
          </div><!-- card-header -->
          <div class="card-body">
            <table id="datatable" class="table table-striped table-bordered sourced-data">
              <thead>
                <tr>
                  <th>Class</th>
                  <th>Topic</th>
                  <th>Device Type</th>
                  <th>status</th>
                  <th>TechTeam Status</th>
                  <th>Slide id</th>
                  <th>Comment</th>
                  <th>Logged By</th>
                  <th>Logged On</th>
                  <?php
                    if($user_type == "Tech Team") {
                  ?>
                  <th>Action</th>
                  <?php
                    }
                  ?>
                </tr>
              </thead>
              <tbody>
                <?php
                  $i = 1;
                  foreach ($getResponsiveTestIssues as $getResponsiveTestIssue) {

                    $class = $getResponsiveTestIssue['class'];
                    if($filterClass > 0 && $filterClass != $class)
                      continue;
                    $topic_name = $getResponsiveTestIssue['topic_name'];
                    $device_name = $getResponsiveTestIssue['device_name'];
                    $slide_id = $getResponsiveTestIssue['slide_id'];
                    if(isset($getResponsiveTestIssue['comment']))
                      $comment = $getResponsiveTestIssue['comment'];
                    else
                      $comment = "";
                    $updated_by = $getResponsiveTestIssue['updated_by'];
                    if(isset($getResponsiveTestIssue['updated_on']))
                      $updated_on = $getResponsiveTestIssue['updated_on'];
                    else
                      $updated_on = "";
                    $status = $getResponsiveTestIssue['status'];
                    if(isset($getResponsiveTestIssue['slide_responsive_status_id']))
                      $slide_responsive_status_id = $getResponsiveTestIssue['slide_responsive_status_id'];
                    else
                      $slide_responsive_status_id = "";
                    $tt_status = $getResponsiveTestIssue['tt_status'];
                    if($tt_status == 0){
                      if ($status == "No Issue") {
                        $tt_status = "Not yet started";
                      }else{
                        $tt_status = "";
                      }
                    }else{
                      $tt_status = "closed";
                    }
                    if(isset($getResponsiveTestIssue['slide_path']))
                      $slide_path = $getResponsiveTestIssue['slide_path'];
                    else
                      $slide_path = "";

                ?>
                  <tr>
                    <td><?php echo $class; ?></td>
                    <td><?php echo $topic_name; ?></td>
                    <td><?php echo $device_name; ?></td>
                    <td><?php echo $status; ?></td>
                    <td>
                      <?php
                        if($status != "No Issue") 
                          echo $tt_status; 
                      ?>
                    </td>
                    <td>
                      <?php echo $slide_id; ?>
                      <?php
                        if($user_type == "Tech Team") {
                      ?>
                      <a target="_blank" href="<?php echo $web_root."app/"; ?>transactions/tt/codeEditor.php?htmlPath=<?php echo $web_root."app/".$getResponsiveTestIssue['slide_path']; ?>"><?php echo $getResponsiveTestIssue['slide_type']; ?></a>
                      <?php } ?>    
                    </td>
                    <td><?php echo $comment; ?></td>
                    <td><?php echo $updated_by; ?></td>
                    <td><?php echo $updated_on; ?></td>
                    <?php
                      if($user_type == "Tech Team") {
                    ?>
                    <td>
                      <?php if($tt_status != "closed") { ?>
                      <input type="hidden" class="slide_responsive_status_id" value="<?php echo $slide_responsive_status_id; ?>">
                      <select class="form-control status" style="padding: 0.15rem 0rem;">
                        <option value="0"<?php if($tt_status == 0){ ?> selected <?php } ?>>Issue</option>
                        <option value="1"<?php if($tt_status == 1){ ?> selected <?php } ?>>Closed</option>
                      </select>
                      <?php } ?>
                    </td>
                    <?php
                      }
                    ?>
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
    <script src="../../lib/jquery/jquery.js"></script>
    <script src="../../lib/popper.js/popper.js"></script>
    <script src="../../lib/bootstrap/js/bootstrap.js"></script>
    <script src="../../lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="../../lib/moment/moment.js"></script>
    <script src="../../lib/jquery-ui/jquery-ui.js"></script>
    <script src="../../lib/jquery-switchbutton/jquery.switchButton.js"></script>
    <script src="../../lib/peity/jquery.peity.js"></script>
    <script src="../../lib/highlightjs/highlight.pack.js"></script>
    <script src="../../lib/datatables/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="../../lib/datatables-responsive/dataTables.responsive.js"></script>
    <script src="../../lib/ajax_loader/jquery.mloading.js"></script>
    <script src="../../lib/jqueryToast/jquery.toaster.js"></script>
    <script src="../../js/cms.js"></script>
    <script>
      $(function(){
        'use strict';

        $('#datatable').DataTable({
          responsive: true,
          "scrollY": "500px",
          "scrollCollapse": true,
          "bPaginate": false,
          "dom": 'Bfrtip',
          "buttons": [
              'excelHtml5',
          ]
        });

        $(".status").change(function(){
          var id = $(this).closest('tr').find('.slide_responsive_status_id').val();
          var status = $(this).val();
          console.log("id"+id+", staus"+status);
          $.ajax({
            type: "POST",
            url: "apis/updateSlideResponsiveStatus.php",
            data: 'id='+id+"&status="+status,
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
